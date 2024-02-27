<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientContact;
use App\Models\ClientProductServices;
use App\Models\Files;
use App\Models\ClientProfile;
use App\Models\User;



class ClientController extends BaseController
{

    public function __construct() {
        $this->contactModel = new ClientContact();
        $this->servicesModel = new ClientProductServices();
        $this->fileModel = new Files();
        $this->profileModel = new ClientProfile();
        $this->userModel = new User();
    }

    public function fetchAllContactsById(){
        $contacts =   $this->contactModel->where('FK_id', $this->session->get('id'))->findAll();
        $output   = '';

        if(!empty($contacts)){
            foreach($contacts as $contact){
               if($contact['contact_status_flag'] == 1){
                    $output .='
                        <div class="custom-content rounded text-ellipsis">
                            <i class="bi bi-person-rolodex text-secondary" style="font-size: 20px; margin-right: 10px"></i> <span class="text-ellipsis">'.$contact['contact_name'].' &nbsp; |&nbsp;  '.$contact['contact_no'].' &nbsp; |&nbsp;  '.$contact['contact_position'].'</span><a class="removeClientContact" id="0" data-id="'.$contact['contact_id'].'"><i class="bi bi-x-circle text-muted" data-toggle="tooltip" title="Remove"></i></a>
                        </div>';
               }
            }
            echo $output;
        }else{
            echo '
            <div class="d-flex justify-content-center text-secondary w-100">
                <span><i>No Contacts Posted yet!</i></span>
            </div>';
        }
    }

    public function removeClientFile(){
        try {
            $fileid = $this->request->getVar('id');
            $data = array(
                'file_status_flag' => 1
            );

            $update = $this->fileModel->update($fileid, $data);
          
        } catch (\Exception $e) {
            exit($e->getMessage());
        }  
    }

    public function removeClientContact(){
        try {
            $contactid = $this->request->getVar('id');
    
            $data = array(
                'contact_status_flag' => $this->request->getVar('status')
            );

            $update = $this->contactModel->update($contactid, $data);
          
        } catch (\Exception $e) {
            exit($e->getMessage());
        }  
    }

    public function removeClientProduct(){
        try {
            $productid = $this->request->getVar('id');
    
            $data = array(
                'prodser_status_flag' => $this->request->getVar('status')
            );
            $update =  $this->servicesModel->update($productid, $data);
          
        } catch (\Exception $e) {
            exit($e->getMessage());
        }  
    }

    public function fetchAllFilesById(){
        $files = $this->fileModel->where('clientid', $this->session->get('id'))->findAll();
        $output = '';

        if(!empty($files)){
            foreach($files as $file){
                if($file['file_status_flag'] == 0){
                    $icon  = '';
                    $color = '';
                    if(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'pdf'){
                        $color = 'danger';
                        $icon  = 'file-earmark-pdf';
                    }if(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'docx' || pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'doc'){
                        $color = 'primary';
                        $icon  = 'file-earmark-word';
                    }if(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'xlsx' || pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'xls'){
                        $color = 'success';
                        $icon  = 'file-earmark-excel';
                    }if(pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'xlsx' && pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'xls' && pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'pdf' && pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'docx' && pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'doc'){
                        $color = '';
                        $icon  = 'filetype-'.pathinfo($file['file_name'], PATHINFO_EXTENSION);
                    }
                    
                    $output .='
                            <div class="d-flex g-3 mb-2 text-ellipsis">
                                <span class="mt-1" style="margin-right:5px"><a class="removeClientFiles" id="0" data-id="'.$file['fileid'].'"><i class="bi bi-x-circle text-secondary"></i></a></span>
                                <span class="h4" style="margin-right: 10px"><i class="bi bi-'.$icon.' text-'.$color.'"></i></span>
                                <span class="w-100 text-ellipsis"><a href="/uploads/files/'.$this->session->get('name').'/'.$file['file_name'].'" download data-toggle="tooltip" title="Download/View">'.$file['file_name'].'</a></span>
                            </div>';
                }
            }
            echo $output;
            }else{
                echo '
                    <div class="d-flex justify-content-center text-secondary">
                        <span><i>No files uploaded yet!</i></span>
                    </div>';
        }

    }

    public function fetchAllProductServicesById(){
        $products =  $this->servicesModel->where('FK_id', $this->session->get('id'))->findAll();
        $output = '';

        if(!empty($products)){
            foreach($products as $product){
              if($product['prodser_status_flag'] == 1){
                $output .=' 
                        <div class="custom-content rounded text-ellipsis">
                            '.$product['prodser_name'].' <a class="removeClientProduct" id="0" data-id="'.$product['prodser_id'].'"><i class="bi bi-x-circle text-muted" data-toggle="tooltip" title="Remove"></i></a>
                        </div>
                        ';
              }
            }
            echo $output;
        }else{
            echo '
            <div class="d-flex justify-content-center text-secondary w-100">
                <span><i>No Products and Services Posted yet!</i></span>
            </div>';
        }

    }

    public function insertProductServices(){
        try {
            $bulk_prodser = array();
            foreach ($this->request->getVar('product_services') as $key => $value) {
                $data = array(
                    'FK_id'            => session('id'),
                    'prodser_clientid' => session('id'),
                    'prodser_name'     => $this->request->getVar('product_services')[$key]
                );
                $bulk_prodser[] = $data;
            }
            $this->servicesModel->insertBatch($bulk_prodser);

        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function insertContact(){
        try {
            $bulk_contact = array();
            foreach ($this->request->getVar('contact_name') as $key => $value) {
                $data = array(
                    'FK_id'             =>  session('id'),
                    'contact_clientid'  =>  session('id'),
                    'contact_name'      =>  $this->request->getVar('contact_name')[$key],
                    'contact_no'        =>  $this->request->getVar('contact_no')[$key],
                    'contact_position'  =>  $this->request->getVar('contact_position')[$key]
                );
            $bulk_contact[] =  $data;
            }
            $this->contactModel->insertBatch($bulk_contact);
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function updateIntroduction(){
        try {
            $client   = $this->profileModel->where('userId', $this->session->get('id'))->first();
            $clientid = $client['id'];

            $data = array(
                'introduction'  =>  $this->request->getVar('client_company_introduction')
            );
            $this->profileModel->update($clientid, $data);
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function updateClientProfile(){
        try {
            $profileid = $this->request->getVar('user_id');

            $clientProfile = array(
                'email'          =>    $this->request->getVar('user_email'),
                'company'        =>    $this->request->getVar('user_company'),
                'user_position'  =>    $this->request->getVar('user_position'),
                'introduction'   =>    $this->request->getVar('company_introduction'),
                'name'           =>   $this->request->getVar('user_name'),
                'contactnumber'  =>   $this->request->getVar('user_contact')
            );

            $userInfo = array(
                'name'           =>   $this->request->getVar('user_name'),
                'email'          =>   $this->request->getVar('user_email')
            );

            
            $this->profileModel->update($profileid, $clientProfile);
            $this->userModel->update(session('id'), $userInfo);

        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function removeProfile(){
        try {
            $client   = $this->profileModel->where('userId', $this->session->get('id'))->first();
            $clientid = $client['id'];
      
            $data = [
                'profile_avatar' =>  NULL,
            ];

            $this->profileModel->update($clientid, $data);
            if(file_exists('uploads/files/'.$client['name'].'/'.$client['profile_avatar'].'')){
                unlink('uploads/files/'.$client['name'].'/'.$client['profile_avatar'].'');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function UploadProfile() {
        try {
            $client   = $this->profileModel->where('userId', $this->session->get('id'))->first();
            $clientid = $client['id'];
            $currentProfile = $client['profile_avatar'];
      
            $validated = $this->validate([
                'file' => [
                    'uploaded[file]',
                    'is_image[file]',
                    'mime_in[file,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[file,4096]'
                ],
            ]);
     
            if ($validated) {
                $file = $this->request->getFile('file');
                $fileDir = '/files/'.$this->session->get('name');
                $file->move('uploads'.$fileDir);

                $data = [
                    'profile_avatar' =>  $file->getClientName()
                ];

                $this->profileModel->update($clientid, $data);

                if(!empty($currentProfile)){
                    if(file_exists('uploads/files/'.$client['name'].'/'.$client['profile_avatar'].'')){
                        unlink('uploads/files/'.$client['name'].'/'.$client['profile_avatar'].'');
                        return redirect()->back();
                     }
                } else {
                    return redirect()->back(); 
                }   
            } else {
                $this->session->setFlashdata('error', 'Accepts only images!');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function uploadMultipleFiles() {
        try {
            if($this->request->getFileMultiple('files')) {
                foreach($this->request->getFileMultiple('files') as $file) {
                    $fileDir = '/files/'.$this->session->get('name');
                    $file->move('uploads'.$fileDir);
    
                    $data = [
                        'clientid' => session('id'),
                        'file_name' => $file->getClientName(),
                        'file_type' => $file->getClientMimeType()
                    ];
    
                    $this->fileModel->save($data);
                }
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
        
    }
}
