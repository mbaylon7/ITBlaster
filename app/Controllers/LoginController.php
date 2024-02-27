<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\User;

class LoginController extends BaseController
{
    public function __construct()
    {
        $this->userModel = new User();
        $this->email = \Config\Services::email();
        $this->session = \Config\Services::session();
        $validation = \Config\Services::validation();
    }

    public function index()
    {
        return view('auth/login');
    }

    public function loginAuth()
    {
        return $this->userModel->login();
    }

    public function forgotPassword() {
        $data = array();
        if($this->request->getMethod(true) == 'POST') {
            $rules = [
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required'  =>  '{field} is required',
                        'valid_email'  =>  'Please enter valid {field}'
                    ]
                ],
            ];
            if($this->validate($rules)) {
                $userdata = $this->userModel->where('email', $this->request->getVar('email'))->first();
                if(!empty($userdata)) {
                    if($this->userModel->updateAt($userdata['uniqueid'])) {
                        $to = $this->request->getVar('email');
                        $subject = 'Password Reset Request';
                        $token = $userdata['uniqueid'];
                        $message = '

                        Dear '.$userdata['name'].',
                        <br><br>
                        I hope this email finds you well. It appears that you have requested a password reset for your ITBlaster account. We understand that forgetting passwords can happen to the best of us, and we are here to assist you in regaining access to your account.
                        <br><br>
                        To proceed with the password reset, please follow the instructions below:
                        <br><br>
                        1. Click on the "Forgot Password" or "Reset Password" link below provided in this email. You will be taken to a page where you can create a new password.<br>
                        <a href="'.base_url().'reset-password/'.$token.'" target="_blank">Reset My Password</a><br>
                        2. Choose a strong, unique password that you haven`t used before, and enter it into the provided fields.<br>
                        3. After submitting the new password, you will receive a confirmation message that your password has been successfully reset.<br>
                        <br><br>
                        <span style="color:red"><strong>Note:</strong></span> This reset password link expires in half an hour after you requested to reset your account password.
                        <br><br>
                        If you did not request a password reset or if you believe this email was sent to you in error, please ignore it. Your account will remain secure, and no further action is required.
                        <br><br>
                        Thank you for using ITBlaster. We appreciate your trust in us and are committed to providing a secure and reliable experience for all our users.
                        <br><br>
                        Best regards,
                        <br><br>
                        <strong>IT Blaster Management Services</strong><br>
                        1-703-906-9719';
                        
                        // Hi '.$userdata['name'].'<br><br>To reset password to your account please click this link provide to this email.<br> <a href="'.base_url().'reset-password/'.$token.'" target="_blank"> Change My Password</a><br><br><br> <span style="color:red"><strong>Note:</strong></span> This activation link expires in half an hour after you requested to reset your account password.<br><br><br><br><br> Thanks<br> From IT Blaster';
                        $this->email->initialize(email_settings());
                        $this->email->setTo($to);
                        $this->email->setCC('marvin.baylon.it@gmail.com');
                        $this->email->setSubject($subject);
                        $this->email->setMessage($message);          
                        if($this->email->send()){
                            $this->session->setFlashdata('success', 'Reset password link has been sent to your registered email, Please verify within 30 minutes');
                            return redirect()->to('/signin');
                        } else {
                            $this->session->setFlashdata('error', 'Unable to send reset password link, Please check your network and try again');
                            return redirect()->to(current_url());
                        }          
                    } else {
                        $this->session->setFlashdata('error', 'Sorry, Something went wrong please try again.');
                    }
                } else {
                    $this->session->setFlashdata('error', 'Email does not Exist!');
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('auth/forgot', $data);
    }

    public function resetPassword($token = null) {
        $data = array();
        if(!empty($token)) {
            $userdata = $this->userModel->verifyToken($token);
            if(!empty($userdata)) {
                if($this->tokenExpiryTime($userdata['updated_at'])) {
                    if($this->request->getMethod(true) == 'POST') {
                        $rules = [
                            'password' => [
                                'label' => 'Password',
                                'rules' => 'required|min_length[8]',
                                'errors' => [
                                    'required'  =>  '{field} is required',
                                    'min_length'  =>  'Please enter atleast 8 character to your {field}'
                                ]
                            ],
                            'confirmpassword' => [
                                'label' => 'Password',
                                'rules' => 'required|matches[password]',
                                'errors' => [
                                    'required'  =>  '{field} is required',
                                    'matches[password]'  =>  '{field} is not matched'
                                ]
                            ],
                        ];
                        if($this->validate($rules)) {
                            $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                            if($this->userModel->updatePassword($token, $password)) {
                                $this->session->setFlashdata('success', 'Password Updated Successfully.');
                                return redirect()->to('/signin');
                            } else {
                                $this->session->setFlashdata('error', 'Sorry, Unable to Change Password.');
                                return redirect()->to(current_url());
                            }
                        } else {
                            $data['validation'] = $this->validator;
                        }
                    } 
                } else {
                    $data['error'] = 'Seems! the Forgot Password link has passed its alloted time limit';
                }
            } else {
                $data['error'] = 'Sorry! Unable to find user account!';
            }
            
        return view('auth/reset_password', $data);
        } else {
            $data['error'] = 'Unauthorized Access!';
        }

    }

    public function tokenExpiryTime($time) {
        $update_time = strtotime($time);
        $current_time = time();
        $diffTime = $current_time - $update_time;
        if($diffTime < 1800) {
            return true;
        } else {
            return false;
        }
    }
}
