<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ITProfile;
use App\Models\Files;

class FileUploadController extends BaseController
{
    public function __construct()
    {
        $this->fileModel = new Files();
        $this->ITProfile = new ITProfile();
    }

    public function uploadMultiple()
    {
        $msg = 'Please select valid files';

        if($this->request->getFileMultiple('files')) {
            foreach($this->request->getFileMultiple('files') as $file) {
                $fileDir = '/files/'.$this->session->get('name');
                $file->move('uploads'.$fileDir);

                $data = [
                    'itid'      => session('id'),
                    'file_name' => $file->getClientName(),
                    'file_type' => $file->getClientMimeType()
                ];

                $this->fileModel->save($data);
                $msg = 'Files have been successfully uploaded';
            }
        }

        return redirect()->to('/')->with('msg', $msg);
    }

    public function upload()
    {
        helper(['form', 'url']);

        $session = session();
        $id = session('id');

        $input = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/png]',
                'max_size[file,1024]',
                'ext_in[files,doc,docx,pdf,jpeg,jpg,png,webp,xlsx]',
            ]
        ]);

        if(!$input) {
            print_r('Choose a valid file');
        } else {
            $img = $this->request->getFile('file');
            $img->move(WRITEPATH . 'uploads');

            $data = [ 
                'files' => $img->getName()
            ];

            $model->update($id, $data);

            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'File uploaded successfully'
                ]
            ];

            return $response;
        }

        return $input;
    }
}