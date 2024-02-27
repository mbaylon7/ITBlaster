<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\User;
use App\Models\ITProfile;
use App\Models\ClientProfile;

class RegisterController extends BaseController
{
    public function __construct()
    {
        $this->ITProfile = new ITProfile();
        $this->userModel = new User();
        $this->ClientProfile = new ClientProfile();
        $this->email = \Config\Services::email();
        $this->session = \Config\Services::session();
    }

    public function index2() {
        return view('register');
    }

    public function index(){
        $data = array();
        if ($this->request->getMethod(true) == 'POST') {
            $rules = [
                'user_name' => 'required|min_length[2]|max_length[50]',
                'user_email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[user.email]',
                'user_password' => 'required|min_length[8]|max_length[50]|alpha_numeric',
                'confirmpassword' => 'matches[user_password]'
            ];

            $rules = [
                'user_name' => [
                    'label' => 'Name',
                    'rules' => 'required|min_length[6]|max_length[50]|alpha_space',
                    'errors' => [
                        'required'  =>  '{field} is required',
                        'min_length'  =>  '{field} is too short, enter atlest 6 characters',
                        'max_length'  =>  '{field} is too long maximum of 50 characters',
                        'alpha_space'  =>  '{field} only accepts alphabetic and spaces characters'
                    ]
                ],
                'user_contact' => [
                    'label' => 'Contact',
                    'rules' => 'required|decimal|min_length[6]',
                    'errors' => [
                        'required'  =>  '{field} is required',
                        'decimal'  =>  '{field} only accepts numbers and - + symbols',
                        'min_length'  =>  '{field} is too short, enter atlest 6 characters'
                    ]
                ],
                'user_email' => [
                    'label' => 'Email',
                    'rules' => 'required|min_length[15]|max_length[50]|valid_email|is_unique[user.email]',
                    'errors' => [
                        'required'  =>  '{field} is required',
                        'min_length'  =>  '{field} is too short, enter atlest 15 characters',
                        'is_unique'  =>  '{field} is already taken',
                        'max_length'  =>  '{field} is too long maximum of 50 characters',
                        'valid_email'  =>  'Please enter valid {field}'
                    ]
                ],
                'user_password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required'  =>  '{field} is required',
                        'min_length'  =>  'Please enter atleast 8 character to your {field}'
                    ]
                ],
                'confirmpassword' => [
                    'label' => 'Confirm Password',
                    'rules' => 'required|matches[user_password]',
                    'errors' => [
                        'required'  =>  '{field} is required',
                        'matches[user_password]'  =>  '{field} is not matched'
                    ]
                ],
            ];
    
            if($this->validate($rules)) {
                $user = new User();
                $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
                $data = [
                    'companyname' => ($this->request->getVar('user_companyname')!== NULL) ? $this->request->getVar('user_companyname') : '',
                    'user_position' => ($this->request->getVar('user_position')!== NULL) ? $this->request->getVar('user_position') : '',
                    'desired_rate' => ($this->request->getVar('user_rate')!== NULL) ? $this->request->getVar('user_rate') : '',
                    'name' => $this->request->getVar('user_name'),
                    'contactnumber' => $this->request->getVar('user_contact'),
                    'email' => $this->request->getVar('user_email'),
                    'password' => password_hash($this->request->getVar('user_password'), PASSWORD_DEFAULT),
                    'usertype' => $this->request->getVar('registrationtype'),
                    'uniqueid'  =>  $uniid,
                    'activation_date'   => date('Y-m-d h:i:s')
                ];
    
                $user->save($data);
                $id = $user->getInsertID();
    
                if($this->request->getVar('registrationtype') == 1) {
                    if($this->ITProfile->create_user_profile($id)){
                        $to = ''.$this->request->getVar('user_email').'';
                        $subject = 'Activate Your Account - IT Blaster';
                        $message = '
                        Dear '.$this->request->getVar('user_name').',
                        <br><br>
                        Thank you for registering with IT Blaster. We are excited to have you as a new member of our community. To complete your account activation, please click the following link:
                        <br>
                        <a href="'.base_url().'register/activate/'.$uniid.'" target="_blank"> Activate Account</a>
                        <br><br>
                        By clicking the link above, you will be directed to a secure page where you can set up your account.
                        <br><br>
                        If you did not register for an account with IT Blaster, please disregard this email.
                        <br><br>
                        If you encounter any issues or need further assistance, please don`t hesitate to contact us. We`re here to help!
                        <br><br>
                        <span style="color:red"><strong>Note:</strong></span> This activation link expires in 1 hour after you register/create your account.
                        <br><br>
                        Thank you again for joining IT Blaster. We look forward to serving you.
                        <br><br>
                        Best regards,
                        <br><br>
                        IT Blaster Management Services<br>
                        1-703-906-9719';
                        //  Hi <br><br> Your account was created successfully on '.date('Y-m-d H:i').'<br> To Activate your account, Please click this activation link provide to this email.<br> <a href="'.base_url().'register/activate/'.$uniid.'" target="_blank"> Activate Now</a><br><br><br> <span style="color:red"><strong>Note:</strong></span> This activation link expires in 1 hour after you register/create your account<br><br><br><br><br> Thanks<br> From IT Blaster';
                        $this->email->initialize(email_settings());
                        $this->email->setTo($to);
                        $this->email->setFrom('services@itblaster.net', 'IT Blaster Management Services');
                        $this->email->setSubject($subject);
                        $this->email->setMessage($message);

                        if($this->email->send()) {
                            // $this->session->setFlashdata('success', 'Account Created Successfully. We Send You an Activation link using the email you registered.');
                            $this->session->setFlashdata('success', 'Account is Created Successfully. You may now login the credential you registered with.');
                            return redirect()->to('/signin');
                        } else {
                            $this->session->setFlashdata('error', 'Account Created Successfully. Unfortunately, We could not send you email Actication link.');
                            return redirect()->to(current_url());
                        }
                    }
                } else {
                    if($this->ClientProfile->create_user_profile($id)) {
                        $to = $this->request->getVar('user_email');
                        $subject = 'Account Activation Link - IT Blaster as Client';
                        $message = 'Hi '.$this->request->getVar('user_name').'<br><br> Your account was created successfully on '.date('Y-m-d H:i').'<br> To Activate your account, Please click this activation link provide to this email.<br> <a href="'.base_url().'register/activate/'.$uniid.'" target="_blank"> Activate Now</a><br><br><br> <span style="color:red"><strong>Note:</strong></span> This activation link expires in 1 hour after you register/create your account<br><br><br><br><br> Thanks<br> From IT Blaster';

                        $this->email->initialize(email_settings());
                        $this->email->setTo($to);
                        $this->email->setFrom('services@itblaster.net', 'IT Blaster Management Services');
                        $this->email->setSubject($subject);
                        $this->email->setMessage($message);

                        if($this->email->send()) {
                            $this->session->setFlashdata('success', 'Account Created Successfully. We Send You an Activation link using the email you registered.');
                            return redirect()->to('/signin');
                        } else {
                            $this->session->setFlashdata('error', 'Account Created Successfully. Unfortunately, We could not send you email Actication link.');
                            return redirect()->to('/signin');
                        }
                    }
                }
                return redirect()->to('/signin');
            } else {
                $data['validation'] = $this->validator;
            }

        }
        return view('auth/register', $data);
    }

    public function activate($uniid = null) {
        $data = array();
        if(!empty($uniid)) {
            $userdata = $this->userModel->verifyUniid($uniid);
            if($userdata) {
                if($this->verifyExpiryTime($userdata->activation_date)) {
                    if($userdata->status == 'Inactive') {
                        $status = $this->userModel->updateStatus($uniid);
                        if($status == true) {
                            $this->session->setFlashdata('success', 'Your Account is now Activated you may now login your credentials.');
                            return redirect()->to('/signin');
                        } else {
                            $this->session->setFlashdata('error', 'Account does not Activated!');
                            return redirect()->to('/signin');
                        }
                    } else {
                        $this->session->setFlashdata('success', 'Your Account is already Activated you may now login your credentials.');
                        return redirect()->to('/signin');
                    }
                } else {
                    $this->session->setFlashdata('error', 'Seems! the Activation link has passed its alloted time limit');
                    return redirect()->to('/signin');
                }
            }
        }
    }
    
    public function verifyExpiryTime($regTime) {
        $currTime = now();
        $regtime = strtotime($regTime);
        $diffTime = (int)$currTime - (int)$regTime;

        if(3600 < $diffTime) {
            return true;
        } else {
            return false;
        }
    }
}
