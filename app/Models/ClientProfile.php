<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Project;
use App\Models\Ticket;

class ClientProfile extends Model 
{
    protected $table = 'clientprofile';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'userId',
        'name',
        'user_position',
        'contactnumber',
        'email',
        'profile_avatar',
        'company',
        'introduction'
    ];

    public function get_client_data(){
        $session = session();
        $model = new ClientProfile();
        $client = $model->where('userId', $session->get('id'))->first();
        $projectModel = new Project();
        // $c_projects = $projectModel->where('clientid', $client['id'])->findAll();
        $c_projects = $projectModel->select('tbl_project.projectid, tbl_project.project_name, tbl_project.project_label, tbl_project.project_code')->where(['tbl_project.clientid' => $client['id']])->findAll();
        $ticketModel = new Ticket();
        $all_ticket = $ticketModel->select('ticketid, projectid')->findAll();
        $data = array(
            'id'               =>    session('id'),
            'PK_id'            =>    $client['id'],
            'userId'           =>    $client['userId'],
            'name'             =>    $client['name'],
            'position'         =>    $client['user_position'],
            'contact'          =>    $client['contactnumber'],
            'email'            =>    $client['email'],
            'company'          =>    $client['company'],
            'introduction'     =>    $client['introduction'],
            'avatar'           =>    $client['profile_avatar'],
            'c_projects'       =>    $c_projects,
            'all_ticket'       =>    $all_ticket
        );

        return $data;
    }

    public function create_user_profile($userId){
        $request = \Config\Services::request();
        $model = new ClientProfile();

        $data = [
            'userId' => $userId,
            'name' => $request->getVar('user_name'),
            'user_position' => $request->getVar('user_position'),
            'contactnumber' => $request->getVar('user_contact'),
            'email' => $request->getVar('user_email'),
            'company' => $request->getVar('user_companyname')
        ];

        $model->insert($data);

        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Client profile created successfully'
            ]
        ];

        return $response;
    }
    public function searchClientData($keyword)
    {
        return $this->like('name', $keyword)
                    ->orWhere('user_position', $keyword)
                    ->orWhere('company', $keyword)
                    ->findAll();
    }
}