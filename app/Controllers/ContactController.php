<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ContactController extends BaseController
{
    public function send() {
        $session = \Config\Services::session();
        $email = \Config\Services::email();
        $validation = \Config\Services::validation();
        $captcha_response = trim($this->request->getPost('g-recaptcha-response'));

        if (!empty($captcha_response)) {
            $secret_key = '6LchvBsmAAAAANG1jlUeyLmjdISAL7E6eFWh82-y';

            $check = array(
                'secret'    =>  $secret_key,
                'response'  =>  $captcha_response
            );

            $startProcess = curl_init();
            curl_setopt($startProcess, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($startProcess, CURLOPT_POST, true);
            curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));
            curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);

            $received_data = curl_exec($startProcess);

            if ($received_data !== false) {
                $final_response = json_decode($received_data, true);

                if (isset($final_response['success']) && $final_response['success']) {
                    $rules = $validation->getRuleGroup('contactUsValidation');

                    if ($this->validate($rules)) {
                        $message = $this->request->getVar('message');
                        $body = "
                            <html>
                            <body>
                                <h3>You have a message from: </h3>
                                <p>Name: ".$this->request->getVar('name')."</p>
                                <p>Phone No: ".$this->request->getVar('phone_no')."</p>
                                <p>Email: ".$this->request->getVar('email_address')."</p>
                                <hr />
                                <p>Message: ".$message."</p>
                            </body>
                            </html>
                        ";
                        
                        $email->initialize(email_settings());
                        $email->setTo('arnel@consultareinc.com, services@interlinkiq.com, virginia@consultareinc.com');
                        $email->setCC('marvin@consultareinc.com');
                        
                        $email->setSubject('Contact Us - Inquiry');
                        $email->setMessage($body);
        
                        if ($email->send()) {
                            $session->setFlashdata('success_message', 'Your message has been successfully sent!');
                        } else {
                            $data = $email->printDebugger(['headers']);
                            log_message('error', 'ContactController::send Unable to send Contact Us Email Notifications: '. json_encode($data));
                            $session->setFlashdata(array('error' => 'Unable to Send your Inquiry. Please try again later.'));
                        }
                    } else {
                        $session->setFlashdata($validation->getErrors());
                    }
                    return redirect()->to('#contactus');
                } else {
                    $session->setFlashdata('error_message', 'Failed');
                }
            } else {
                $session->setFlashdata('error_message', 'An error occurred while verifying reCAPTCHA.');
            }
        } else {
            $session->setFlashdata('error_message', 'Validate recaptcha is required');
            return redirect()->to('#contactus');
        }
    }
}
