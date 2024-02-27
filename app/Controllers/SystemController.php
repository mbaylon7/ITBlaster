<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SystemLog;
use App\Models\ClientProfile;
use App\Models\User;

class SystemController extends BaseController
{
    public function __construct() {
        $this->systemModel = new SystemLog();
        $this->clientModel = new ClientProfile();
        $this->userModel = new User();
    }
    public function index()
    {
        $login_user = $this->clientModel->where('userId', session('id'))->first();
        $logs = $this->systemModel->findAll();
        $users = $this->userModel->findAll();

        $data = array(
            'PK_id'            =>    $login_user['id'],
            'userId'           =>    $login_user['userId'],
            'name'             =>    $login_user['name'],
            'position'         =>    $login_user['user_position'],
            'contact'          =>    $login_user['contactnumber'],
            'email'            =>    $login_user['email'],
            'company'          =>    $login_user['company'],
            'introduction'     =>    $login_user['introduction'],
            'avatar'           =>    $login_user['profile_avatar'],
            'logs'             =>    $logs,
            'users'            =>    $users
        );
        return view('system/system_logs', $data);
    }
}
