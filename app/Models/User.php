<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'email',
        'password',
        'activation_date',
        'status',
        'uniqueid',
        'usertype'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function login()
    {
        $session = session();
        $request = \Config\Services::request();
        $user    = new User();
        $data    = $user->where('email', $request->getVar('email'))->first();
        
        if(!empty($data)){
            $pass = $data['password'];
            $authenticatePassword = password_verify($request->getVar('password'), $pass);
            if($data['status'] == 'Inactive') { 
                if($authenticatePassword) {
                    $session->setFlashdata('error', 'Activate Your Account First! We already send you an Activation link to the email you registered. Thank you!');
                    return redirect()->to('signin');
                }
            }

            if($authenticatePassword) {
                $ses_data = [ 'id' => $data['id'], 'name' => $data['name'], 'email' => $data['email'], 'usertype' => $data['usertype'], 'status' => $data['status'], 'isLoggedIn' => TRUE
                ];

                $session->set($ses_data);
                
                if($data['usertype'] == 1) {
                    return redirect()->to('it');
                } elseif($data['usertype'] == 2) {
                    return redirect()->to('client');
                } elseif($data['usertype'] == 0) {
                    return redirect()->to('admin');
                }
            } else {
                $session->setFlashdata('error', 'Password is incorrect.');
                return redirect()->to('signin');
            }

        }else {
            $session->setFlashdata('error', 'Email does not exist');
            return redirect()->to('signin');
        }
    }

    public function verifyUniid($id) {
        $this->userModel = new User;
        $data = $this->userModel->select('id, activation_date, uniqueid, status')->where('uniqueid', $id)->get();
        if(!empty($data)) {
            return $data->getRow();
        } else {
            return false;
        }
    }

    public function updateStatus($uniid) {
        $builder = $this->db->table('user');
        $builder->where('uniqueid', $uniid);
        $builder->update(['status' => 'Active']);
        if($this->db->affectedRows() == 1){
            return true;
        } else {
            return false;
        }
    }

    public function updateAt($id) {
        $builder = $this->db->table('user');
        $builder->where('uniqueid', $id);
        $builder->update(['updated_at' => date('Y-m-d h:i:s')]);
        if($this->db->affectedRows() == 1){
            return true;
        } else {
            return false;
        }
    }

    public function verifyToken($token) {
        $builder = $this->db->table('user');
        $builder->select('uniqueid, name, updated_at');
        $builder->where('uniqueid', $token);
        $result = $builder->get();
        if(!empty($result)){
            return $result->getRowArray();
        } else {
            return false;
        }

    }

    public function tokenExpiryTime($regTime) {
        $currTime = now();
        $regtime = strtotime($regTime);
        $diffTime = (int)$currTime - (int)$regTime;

        if(1800 < $diffTime) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePassword($id, $password) {
        $builder = $this->db->table('user');
        $builder->where('uniqueid', $id);
        $builder->update(['password' => $password]);
        if($this->db->affectedRows() == 1){
            return true;
        } else {
            return false;
        }
    }
}
