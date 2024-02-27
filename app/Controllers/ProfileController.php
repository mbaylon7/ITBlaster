<?php

namespace App\Controllers;

    use App\Controllers\BaseController;
    use App\Models\ITProfile;
    use App\Models\ClientProfile;
    use App\Models\EducationalBackground;
    use App\Models\FileUploaded;
    use App\Models\WorkExperience;
    use App\Models\SkillList;
    use App\Models\SkillOwned;
    use App\Models\User;
    use App\Models\Files;
    use App\Models\Project;
    use CodeIgniter\API\ResponseTrait;


class ProfileController extends BaseController
{
    public function __construct(){
        $this->email = \Config\Services::email();
        $this->session = \Config\Services::session();
        $this->fileModel = new Files();
        $this->userModel = new User();
        $this->projectModel = new Project();
        $this->itProfileModel = new ITProfile();
        $this->clientModel = new ClientProfile();
        $this->skillsModel = new SkillList();
        $this->skillOwnModel = new SkillOwned();
        $this->educationModel = new EducationalBackground();
        $this->workModel = new WorkExperience();
        $this->sessionid = session('id');
    }

    public function index(){
        $session     =   session();
        $profile     =   $this->itProfileModel->where('userId',  $this->sessionid)->first();
        $client      =   $this->clientModel->where('userId',  $this->sessionid)->first();
        $project     =   $this->projectModel->select('tbl_project.*, tbl_project_admin.*')->join('tbl_project_admin', 'tbl_project.projectid = tbl_project_admin.projectid')->join('itprofile', 'tbl_project_admin.devid = itprofile.id')->where(['tbl_project_admin.devid' => $profile['id'], 'pa_status_flag' => 0, 'tbl_project.project_label' => 'Completed'])->countAllResults();
        $skill_list  =   $this->skillsModel->orderBy('skill_name', 'ASC')->findAll();
        $projects = $this->projectModel->select('tbl_project.*, tbl_project_admin.*')->join('tbl_project_admin', 'tbl_project.projectid = tbl_project_admin.projectid')->join('itprofile', 'tbl_project_admin.devid = itprofile.id')->where(['tbl_project_admin.devid' => $profile['id'], 'pa_status_flag' => 0, 'tbl_project.project_label' => 'Completed'])->findAll();
        $current = $this->projectModel->select('tbl_project.*, tbl_project_admin.*')->join('tbl_project_admin', 'tbl_project.projectid = tbl_project_admin.projectid')->join('itprofile', 'tbl_project_admin.devid = itprofile.id')->where(['tbl_project_admin.devid' => $profile['id'], 'pa_status_flag' => 0, 'tbl_project.project_label !=' => 'Completed'])->findAll();
        $skills      = $this->skillOwnModel->select('tbl_skill_owned.*, tbl_skillset_list.*')
                        ->join('tbl_skillset_list', 'tbl_skill_owned.owned_skill_setid = tbl_skillset_list.skill_setid')
                        ->where('tbl_skill_owned.skill_status_flag', 1)
                        ->where('tbl_skill_owned.skill_itid', $profile['id'])
                        ->orderBy('tbl_skillset_list.skill_name', 'ASC')
                        ->findAll();
        $education   =   $this->educationModel->where('educational_bg_profile_id', session('id'))->where('educational_bg_status_flag', 1)->findAll();
        $experience  =   $this->workModel->where('work_xp_profile_id ', session('id'))->where('work_xp_status_flag', 1)->findAll();
        $files       =   $this->fileModel->where('itid', session('id'))->where('file_status_flag', 0)->findAll();
        
        $avatar = '';
        if(!empty($profile)) {
            $avatar = ($profile['profile_avatar'] == '')? '' : $profile['profile_avatar'];
        } elseif(!empty($client)) {
            $avatar = ($client['profile_avatar'] == '')? '' : $client['profile_avatar'];
        }

        $data = array(
            'id'              =>    session('id'),
            'skills'          =>    $skills,
            'project_count'   =>    $project,
            'projects'        =>    $projects,
            'current'         =>    $current,
            'files'           =>    $files,
            'education'       =>    $education,
            'experience'      =>    $experience,
            'skill_list'      =>    $skill_list,
            'userId'          =>    session('id'),
            'name'            =>    $profile['name'],
            'contactnumber'   =>    $profile['contactnumber'],
            'email'           =>    $profile['email'],
            'introduction'    =>    $profile['introduction'],
            'position'        =>    $profile['user_position'],
            'avatar'          =>    $avatar,
            'rate'            =>    $profile['desired_rate'],
            'resume'          =>    $profile['resume_file'],
            'is_verified'     =>    $profile['is_verified']
        );

        return view('it/profile', $data);
    }

    public function profileCompletionIndicator(){
        $profile           =  $this->itProfileModel->where('userId',  $this->sessionid)->first();
        $profile_score     =  0;
        $skill_score       =  0;
        $experience_score  =  0;
        $education_score   =  0;
        $file_score        =  0;

     $skills         = $this->skillOwnModel->select('tbl_skill_owned.*, tbl_skillset_list.*')
                        ->join('tbl_skillset_list', 'tbl_skill_owned.owned_skill_setid = tbl_skillset_list.skill_setid')
                        ->where('tbl_skill_owned.skill_status_flag', 1)
                        ->where('tbl_skill_owned.skill_itid', $profile['id'])
                        ->findAll();
        $education   =   $this->educationModel->where('educational_bg_profile_id', session('id'))->where('educational_bg_status_flag', 1)->findAll();
        $experience  =   $this->workModel->where('work_xp_profile_id ', session('id'))->where('work_xp_status_flag', 1)->findAll();
        $files       =   $this->fileModel->where('itid', session('id'))->where('file_status_flag', 0)->findAll();

        if(!empty($profile['name']) && !empty($profile['resume_file']) && !empty($profile['profile_avatar']) && !empty($profile['user_position']) && !empty($profile['desired_rate']) && !empty($profile['contactnumber']) && !empty($profile['email']) && !empty($profile['introduction'])){ $profile_score = 100; } else { $profile_score = 0; }
        if(!empty($skills)){ $skill_score = 100; } else { $skill_score = 0; }
        if(!empty($education)){ $education_score = 100; } else { $education_score = 0; }
        if(!empty($experience)){ $experience_score = 100; } else { $experience_score = 0; }
        if(!empty($files)){ $file_score = 100; } else { $ile_score = 0; }
        
        $completion            = $profile_score + $skill_score + $education_score + $experience_score + $file_score;
        $completion_percentage = $completion / 5 * 1.0;

        $status                = $profile['profile_status'];
        if($completion_percentage == 100 && $status != 1){
            $profile   = $this->itProfileModel->where('userId',  $this->sessionid)->first();
            $profileid = $profile['id'];

            $subject = ''.$profile['name'].'`s Profile is Complete and Ready for Evaluation and Interview';
            $message = '
            Dear HR,
            <br><br>
            I hope this email finds you well. I would like to inform you that '.$profile['name'].', one of our potential candidates, has completed his profile on our platform. His profile is now ready to be evaluated and scheduled for an interview.
            <br><br>
            '.$profile['name'].' has diligently filled out all the necessary information, including his qualifications, work experience, and skills. His complete profile provides a comprehensive overview of his background and suitability for the role. We encourage you to review his profile and consider him for the next steps in the hiring process.
            <br><br>
            Please find below the summary of '.$profile['name'].'`s profile:
            <br><br>
            Name: '.$profile['name'].'<br>
            Profile Completion: 100%
            <br><br>
            We believe that '.$profile['name'].'`s qualifications align well with the requirements of the position. We recommend scheduling an interview to further assess his suitability and discuss his potential contribution to our organization. '.$profile['name'].' has expressed his availability for an interview, and we can coordinate the details according to your preferred schedule.
            <br><br>
            Should you require any additional information or have any specific questions regarding '.$profile['name'].'`s profile, please don`t hesitate to reach out to me. I will be more than happy to provide any assistance you may need.
            <br><br>
            Thank you for your attention to this matter. We look forward to your positive consideration of '.$profile['name'].'`s application and the opportunity to evaluate his potential further.
            <br><br>
            Best regards,
            <br><br><br>
            
            IT Blaster Management Services<br>    
            1-703-906-9719';
            
            
            // 
            $this->email->initialize(email_settings());
            // $this->email->setTo('arnel@consultareinc.com, sbrandonjake@gmail.com, sagarinoken29@gmail.com');
            $this->email->setTo('marvin.baylon.it@gmail.com');
            
            $this->email->setSubject($subject);
            $this->email->setMessage($message);

            if ($this->email->send()) {
                echo '<script>
                        Swal.fire({
                            title: "Cheers!",
                            text: "Your profile is 100% complete, we will be evaluating your profile! Expect an interview from us, Please keep your lines open.",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                    </script>';

            $data = array(
                'profile_status'  => 1,
                'is_verified'  => 'Yes'
            );
            
            $this->itProfileModel->update($profileid, $data);
            } else {
                $data = $email->printDebugger(['headers']);
                log_message('error', 'ContactController::send Unable to send Contact Us Email Notifications: '. json_encode($data));
                $session->setFlashdata(array('error' => 'Unable to Send your Inquiry. Please try again later.'));
            }
        }
        
        echo '
        <div class="progress progress-xl active" style="height: 30px;">
            <div class="progress-bar bg-success progress-bar rounded" role="progressbar"
                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: '.$completion_percentage.'%">
            <span class="d-flex justify-content-center align-items-center">'.$completion_percentage.'% Complete</span>
            </div>
            <input type"hidden" class="d-none" id="profilePercentage" value="'.$completion_percentage.'">
        </div>
        ';
        
    }

    public function fetchAllFilesById(){
        $files   =  $this->fileModel->select('fileid , file_name')->where(['itid' => session('id'), 'file_status_flag' => 0])->findAll();
        $output  =  '';

        if(!empty($files)){
            foreach($files as $file){
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
                    <div class="d-flex g-3 mb-2">
                        <span class="mt-1" style="margin-right:5px"><a class="removeFileUploadedListed" data-id="0" id="'.$file['fileid'].'"><i class="bi bi-x-circle text-secondary"></i></a></span>
                        <span class="h4" style="margin-right: 10px"><i class="bi bi-'.$icon.' text-'.$color.'"></i></span>
                        <span class="w-100 text-ellipsis"><a href="/uploads/files/'.$this->session->get('name').'/'.$file['file_name'].'" download data-toggle="tooltip" title="Download/View">'.$file['file_name'].'</a></span>
                    </div>';
            }
            echo $output;
            }else{
                echo '
                    <div class="d-flex justify-content-center text-secondary">
                        <span><i>No files uploaded yet!</i></span>
                    </div>';
        }
    }

    public function fetchAllEducationById(){
        $educationModel = new EducationalBackground();
        $education = $educationModel->select('educational_bg_id, educational_bg_school, educational_bg_year')->where(['educational_bg_profile_id' => session('id'), 'educational_bg_status_flag' => 1])->findAll();
        $output = '';

        if(!empty($education)){
            foreach($education as $data){
                $output .=' 
                    <div class="custom-content rounded text-ellipsis">
                        <i class="bi bi-mortarboard text-secondary" style="font-size: 20px;"></i> <span class="text-ellipsis">'.$data['educational_bg_school'].' | '.$data['educational_bg_year'].'</span><i class="bi bi-x-circle text-muted removeEducationListed" data-id="0" id="'.$data['educational_bg_id'].'" data-toggle="tooltip" title="Remove"></i></a>
                    </div>
                ';
            }
            echo $output;
        }else{
            echo '
            <div class="d-flex justify-content-center text-secondary w-100">
                <span><i>No Education Background Posted yet!</i></span>
            </div>';
        }
    }

    public function fetchAllWorkExpById(){
        $workExperienceModel = new WorkExperience();
        $experience = $workExperienceModel->select('work_xp_id, work_xp_company, work_xp_position, work_xp_year')->where(['work_xp_profile_id' => session('id'), 'work_xp_status_flag' => 1])->findAll();
        $output = '';

        if(!empty($experience)){
            foreach($experience as $data){
                    $output .='
                        <div class="custom-content rounded text-ellipsis">
                            <i class="bi bi-buildings text-secondary" style="font-size: 20px;"></i><span class="text-ellipsis">'.$data['work_xp_company'].' | '.$data['work_xp_position'].' | '.$data['work_xp_year'].' </span><a style="cursor:pointer" class="removeWorkExperienceListed" data-id="0" id="'.$data['work_xp_id'].'"><i class="bi bi-x-circle text-muted" data-toggle="tooltip" title="Remove"></i></a>
                        </div>';
            }
            echo $output;
        }else{
            echo '
            <div class="d-flex justify-content-center text-secondary w-100">
                <span><i>No Work Experience Posted yet!</i></span>
            </div>';
        }
    }

    public function fetchAllSkillsById(){
        $skillOwned = new SkillOwned();
        $it = $this->itProfileModel->select('id')->where('userId', session('id'))->first();
        $skills = $skillOwned->select('tbl_skill_owned.skill_ownedid, tbl_skill_owned.skill_itid, tbl_skill_owned.owned_skill_setid, tbl_skillset_list.skill_name, tbl_skillset_list.skill_setid')
            ->join('tbl_skillset_list', 'tbl_skill_owned.owned_skill_setid = tbl_skillset_list.skill_setid')
            ->where(['tbl_skill_owned.skill_status_flag' => 1, 'tbl_skill_owned.skill_itid' => $it['id']])
            ->orderBy('tbl_skillset_list.skill_name', 'ASC')
            ->findAll();

        $output = '';

        if(!empty($skills)){
            foreach($skills as $skill){
                $output .=' 
                    <div class="custom-content rounded">
                        '.$skill['skill_name'].' <a class="removeSkillsListed" data-id="0" id="'.$skill['skill_ownedid'].'"><i class="bi bi-x-circle text-muted" data-toggle="tooltip" title="Remove"></i></a>
                    </div>';
            }
            echo $output;
        }else{
            echo '
            <div class="d-flex justify-content-center text-secondary w-100">
                <span><i>No Skills Posted yet!</i></span>
            </div>';
        }
    }

    public function store_educational_background(){
        $m_educ_bg = new EducationalBackground();

        for($x=0; $x<count($this->request->getVar('user_profile_edu_school')); $x++) {
            $data = [
                'educational_bg_profile_id' => session('id'),
                'educational_bg_school'     => $this->request->getVar('user_profile_edu_school')[$x],
                'educational_bg_year'       => $this->request->getVar('user_profile_edu_school_yr')[$x]
            ];
            $m_educ_bg->save($data);
        }
    }

    public function store_work_experience(){
        $m_work_xp = new WorkExperience();

        for($x=0; $x<count($this->request->getVar('user_profile_xp_company')); $x++) {
            $data = [
                'work_xp_profile_id' => session('id'),
                'work_xp_company'    => $this->request->getVar('user_profile_xp_company')[$x],
                'work_xp_position'   => $this->request->getVar('user_profile_xp_role')[$x],
                'work_xp_year'       => $this->request->getVar('user_profile_xp_year')[$x]
            ];

            $m_work_xp->save($data);
        }
    }

    public function updateIntroduction(){
        $it   = $this->itProfileModel->where('userId',  $this->sessionid)->first();
        $itid = $it['id'];

        $data = array(
            'introduction'  =>  $this->request->getVar('user_profile_introduction')
        );
        $this->itProfileModel->update($itid, $data);
    }

    public function updateProfile(){
        try {
            $it           = $this->itProfileModel->where('userId',  $this->sessionid)->first();
            $itid         = $it['id'];

            $data = array(
                'name' =>  $this->request->getPost('user_name'),
                'user_position' =>  $this->request->getPost('user_position'),
                'contactnumber' =>  $this->request->getPost('user_contact'),
                'email' =>  $this->request->getPost('user_email'),
                'desired_rate' =>  $this->request->getPost('user_rate'),
                'introduction' =>  $this->request->getPost('user_introduction'),
                'profile_avatar' =>  $it['profile_avatar']
            );
            $this->itProfileModel->update($itid, $data);

            $data2 = array(
                'name'  => $this->request->getPost('user_name'),
                'email' => $this->request->getPost('user_email')
            );

            $this->userModel->update( $this->sessionid, $data2);

        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function removeProfile(){
        try {
            $itprofile   = $this->itProfileModel->where('userId',  $this->sessionid)->first();
            $itid = $itprofile['id'];
      
            $data = [
                'profile_avatar' =>  NULL,
            ];

            $this->itProfileModel->update($itid, $data);
            if(file_exists('uploads/files/'.$itprofile['name'].'/'.$itprofile['profile_avatar'].'')){
                unlink('uploads/files/'.$itprofile['name'].'/'.$itprofile['profile_avatar'].'');
                 return redirect()->back();
            }
            
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function UploadProfile(){
        try {
            $itprofile      =   $this->itProfileModel->where('userId',  $this->sessionid)->first();
            $itprofileid    =   $itprofile['id'];
            $currentProfile = $itprofile['profile_avatar'];

      
            $validated = $this->validate([
                'file' => [
                    'uploaded[file]',
                    'is_image[file]',
                    'mime_in[file,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[file,4096]',
                ],
            ]);
     
            if ($validated) {
                $file = $this->request->getFile('file');
                $fileDir = '/files/'.$this->session->get('name');
                $file->move('uploads'.$fileDir);
                 $data = [
                    'profile_avatar' =>  $file->getClientName(),
                ];

                $this->itProfileModel->update($itprofileid, $data);
                if(!empty($currentProfile)){
                    if(file_exists('uploads/files/'.$itprofile['name'].'/'.$currentProfile.'')){
                        unlink('uploads/files/'.$itprofile['name'].'/'.$itprofile['profile_avatar'].'');
                         return redirect()->back();
                     }
                }else{
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

    public function UploadCV(){
        try {
            $itprofile      =   $this->itProfileModel->where('userId',  $this->sessionid)->first();
            $itprofileid    =   $itprofile['id'];
            $currentResume  =   $itprofile['resume_file'];

            $validated = $this->validate([
                'file' => [
                    'uploaded[file]',
                    'max_size[file,4096]',
                    'ext_in[file,doc,docx,pdf]'
                ],
            ]);
     
            if ($validated) {
                $file = $this->request->getFile('file');
                $fileDir = '/files/'.$this->session->get('name');
                $file->move('uploads'.$fileDir);
                 $data = array(
                    'resume_file' =>  $file->getClientName()
                 );

                $this->itProfileModel->update($itprofileid, $data);
                if(!empty($currentResume)){
                    if(file_exists('uploads/files/'.$itprofile['name'].'/'.$currentResume.'')){
                        unlink('uploads/files/'.$itprofile['name'].'/'.$itprofile['resume_file'].'');
                         return redirect()->back();
                     }
                }else{
                    return redirect()->back();
                }
               
            } else {
                $this->session->setFlashdata('error', 'Accepts only pdf and docx files!');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function insertItSkills(){
        try {
            $bulk_data = array();
            $it = $this->itProfileModel->where('userId', session('id'))->first();
            foreach($this->request->getPost('it_skills') as $key => $value){
                $data = array(
                    'skill_itid'  =>  $it['id'],
                    'owned_skill_setid' =>  $this->request->getPost('it_skills')[$key]
                );
            $bulk_data[] = $data;    
        }
            $this->skillOwnModel->insertBatch($bulk_data);
            // $clientContactModel->insertBatch($bulk_contact);
            print_r($_POST);
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function removeItFiles(){
        try {
            $fileid = $this->request->getVar('id');
    
            $data = array(
                'file_status_flag' => 1
            );

            $this->fileModel->update($fileid, $data);
          
        } catch (\Exception $e) {
            exit($e->getMessage());
        }  
    }

    public function removeItWorkExperience(){
        try {
            $workid = $this->request->getVar('id');
    
            $data = array(
                'work_xp_status_flag' => $this->request->getVar('status')
            );

            $this->workModel->update($workid, $data);
          
        } catch (\Exception $e) {
            exit($e->getMessage());
        }  
    }

    public function removeItEducationalBackGround(){
        try {
            $schoolid = $this->request->getVar('id');
    
            $data = array(
                'educational_bg_status_flag' => $this->request->getVar('status')
            );

            
            $this->educationModel->update($schoolid, $data);
          
        } catch (\Exception $e) {
            exit($e->getMessage());
        }  
    }

    public function removeItSkills(){
        try {
            $skillid = $this->request->getVar('id');
    
            $data = array(
                'skill_status_flag' => $this->request->getVar('status')
            );
           
            $skillUpdate = $this->skillOwnModel->update($skillid, $data);

            if($skillUpdate){
                return $this->response->setJSON([
                    'error'   => false,
                    'status'  => 200,
                    'title'   => 'Cheers',  
                    'message' => 'Skill Set Removed Successfully.'
                ]);
            }   
        } catch (\Exception $e) {
            exit($e->getMessage());
        }  
    }

    public function client_profile_page(){
        $data = $this->clientModel->get_client_data();
        return view('client/profile', $data);
    }

    public function logout() {
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }
}


