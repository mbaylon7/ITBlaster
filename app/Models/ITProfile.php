<?php

namespace App\Models;

use CodeIgniter\Model;
use \App\Models\User;

class ITProfile extends Model 
{
    protected $table = 'itprofile';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'userId',
        'name',
        'user_position',
        'contactnumber',
        'email',
        'desired_rate',
        'resume_file',
        'profile_avatar',
        'profile_status',
        'employment_status',
        'is_availability',
        'is_verified',
        'introduction'
    ];

    public function create_user_profile($userId)
    {
        $request = \Config\Services::request();
        $model   = new ITProfile();

        $data = [
            'userId'           =>   $userId,
            'name'             =>   $request->getVar('user_name'),
            'user_position'    =>   $request->getVar('user_position'),
            'contactnumber'    =>   $request->getVar('user_contact'),
            'email'            =>   $request->getVar('user_email'),
            'desired_rate'     =>   $request->getVar('user_rate')
        ];

        $model->insert($data);

        $response = [
            'status'        => 201,
            'error'         => null,
            'messages'      => [
                'success'   => 'User profile created successfully'
            ]
        ];

        return $response;
    }
    
    public function searchData($keyword)
    {
        return $this->like('name', $keyword)
                    ->orWhere('user_position', $keyword)
                    ->orWhere('desired_rate', $keyword)
                    ->findAll();
    }
}