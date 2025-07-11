<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientProfile;
use App\Models\ITProfile;
use App\Models\Project;
use App\Models\ClientFiles;
use App\Models\Ticket;
use App\Models\Comment;
use App\Models\SystemLog;
use App\Models\Files;
use App\Models\User;
use App\Models\Applicant;
use App\Models\SkillOwned;
use App\Models\ProjectAdmin;
use App\Models\EducationalBackground;
use App\Models\WorkExperience;
use App\Models\SkillList;
use DateTime;
<?php

namespace App\Controllers;

    use App\Controllers\BaseController;
    use App\Models\ClientProfile;
    use App\Models\ITProfile;
    use App\Models\Project;
    use App\Models\ClientFiles;
    use App\Models\Ticket;
    use App\Models\Comment;
    use App\Models\SystemLog;
    use App\Models\Files;
    use App\Models\User;
    use App\Models\Applicant;
    use App\Models\SkillOwned;
    use App\Models\ProjectAdmin;
    use App\Models\EducationalBackground;
    use App\Models\WorkExperience;
    use App\Models\SkillList;
    // use App\Models\TIcketOwner;
    use DateTime;

class ProjectController extends BaseController
{
    public function __construct() {
        $this->projectModel = new Project();
        $this->projectAdminModel = new ProjectAdmin();
        $this->applicantModel = new Applicant();
        $this->clientModel = new ClientProfile();
        $this->itModel = new ITProfile();
        $this->fileModel = new ClientFiles();
        $this->filesModel = new Files();
        $this->userModel = new User();
        $this->ticketModel = new Ticket();
        $this->commentModel = new Comment();
        $this->systemModel = new SystemLog();
        $this->skillOwnModel = new SkillOwned();
        $this->skillsModel = new SkillList();
        $this->educationModel = new EducationalBackground();
        $this->experienceModel = new WorkExperience();
        $this->commentModel = new Comment();
        // $this->TicketOwnerModel = new TIcketOwner();
        $this->ses_usertype = session('usertype');
        $this->sessionid = session('id');
        $this->session_name = session('name');
        $this->email = \Config\Services::email();
    }

    // Project Lists Via Tag Labels
    public function index() {
        $session = session();
        $it = $this->itModel->where('userId', $session->get('id'))->first();
        $all_document = $this->filesModel->where('file_status_flag', 1)->findAll();
        $client = $this->clientModel->where('userId', $session->get('id'))->first();     
        $all = $this->projectModel->where('clientid', $client['id'])->where('project_status_flag', 0)->findAll();
        $project = $this->projectModel
            ->where([
                'project_status_flag' => 0,
                'clientid' => $client['id']])
            ->findAll();

        $notstarted = $this->projectModel
            ->where([
                'project_label' => 'Not Started', 
                'project_status_flag' => 0, 
                'clientid' => $client['id']])
            ->countAllResults();

        $progress = $this->projectModel
            ->where([
                'project_label' => 'In Progress', 
                'project_status_flag' => 0, 
                'clientid' => $client['id']])
            ->countAllResults();

        $onhold = $this->projectModel
            ->where([
                'project_label' => 'On Hold', 
                'project_status_flag' => 0, 
                'clientid' => $client['id']])
            ->countAllResults();

        $cancelled = $this->projectModel
            ->where([
                'project_label' => 'Cancelled', 
                'project_status_flag' => 0, 
                'clientid' => $client['id']])
            ->countAllResults();

        $completed = $this->projectModel
            ->where([
                'project_label' => 'Completed', 
                'project_status_flag' => 0, 
                'clientid' => $client['id']])
            ->countAllResults();

        $forapproval = $this->projectModel
            ->where([
                'project_label' => 'For Approval', 
                'project_status_flag' => 0, 
                'clientid' => $client['id']])
            ->countAllResults();

        $archived = $this->projectModel
            ->where([
                'clientid' => $client['id'], 
                'project_status_flag' => 1])
            ->countAllResults();

        $p_notstarted = $this->projectModel
            ->where([
                'project_label' => 'Not Started', 
                'project_status_flag' => 0, 
                'clientid' => $client['id']])
            ->findAll();

        $p_progress = $this->projectModel
            ->where([
                'project_label' => 'In Progress', 
                'project_status_flag' => 0, 
                'clientid' => $client['id']])
            ->findAll();

        $p_hold = $this->projectModel
            ->where([
                'project_label' => 'On Hold', 
                'project_status_flag' => 0, 
                'clientid' => $client['id']])
            ->findAll();

        $p_cancelled = $this->projectModel
            ->where([
                'project_label' => 'Cancelled', 
                'project_status_flag' => 0, 
                'clientid' => $client['id']])
            ->findAll();

        $p_completed = $this->projectModel
            ->where([
                'project_label' => 'Completed', 
                'project_status_flag' => 0, 
                'clientid' => $client['id']])
            ->findAll();

        $p_forapproval = $this->projectModel
            ->where([
                'project_label' => 'For Approval', 
                'project_status_flag' => 0, 
                'clientid' => $client['id']])
            ->findAll();

        $p_archived = $this->projectModel
            ->where([
                'project_status_flag' => 1, 
                'clientid' => $client['id']])
            ->findAll();

        $all_ticket = $this->ticketModel
            ->where(['ticket_status_flag' => 0, 'ticket_label !=' => 'Cancelled', 'is_approved' => 'Yes'])->findAll();

        $avatar = '';
        if(!empty($it)) {
            $avatar = ($it['profile_avatar'] == '')? '' : $it['profile_avatar'];
        } elseif(!empty($client)) {
            $avatar = ($client['profile_avatar'] == '')? '' : $client['profile_avatar'];
        }

        $data = array(
            'session_id'       =>    $this->sessionid,
            'PK_id'            =>    $client['id'],
            'userId'           =>    $client['userId'],
            'name'             =>    $this->session_name,
            'position'         =>    $client['user_position'],
            'contact'          =>    $client['contactnumber'],
            'email'            =>    $client['email'],
            'company'          =>    $client['company'],
            'introduction'     =>    $client['introduction'],
            'avatar'           =>    $avatar,
            'notstarted'       =>    $notstarted,
            'progress'         =>    $progress,
            'completed'        =>    $completed,
            'archived'         =>    $archived,
            'onhold'           =>    $onhold,
            'cancelled'        =>    $cancelled,
            'forapproval'      =>    $forapproval,
            'p_notstarted'     =>    $p_notstarted,
            'p_progress'       =>    $p_progress,
            'p_completed'      =>    $p_completed,
            'p_archived'       =>    $p_archived,
            'p_hold'           =>    $p_hold,
            'p_forapproval'    =>    $p_forapproval,
            'p_cancelled'      =>    $p_cancelled,
            'all_document'     =>    $all_document,
            'all_ticket'       =>    $all_ticket,
            'all'              =>    $all
        );
        return view('project/project', $data);
    }

    // Project Details
    public function viewProject($code) {
        $project = $this->projectModel->where('project_code', $code)->first();
        $id = $project['projectid'];
        $itpersonels = $this->itModel->where(['is_verified' => 'Yes'])->findAll();
        $client = $this->clientModel->where('userId', $this->sessionid)->first();
        $all_client = $this->clientModel->findAll();
        $it = $this->itModel->where('userId', $this->sessionid)->first();
        $all_document = $this->filesModel->where('file_status_flag', 0)->findAll();
        $all_comment = $this->commentModel->where('comment_status_flag', 0)->findAll();
        $applicants = $this->itModel
            ->select('itprofile.*, tbl_applicant.*')
            ->join('tbl_applicant', 'tbl_applicant.itid = itprofile.id', 'inner')
            ->where('application_status', 0)
            ->orderBy('tbl_applicant.created_at', 'DESC')
            ->findAll();

        $skills = $this->itModel
            ->select('tbl_skill_owned.*, tbl_skillset_list.*, itprofile.id')
            ->join('tbl_skill_owned','tbl_skill_owned.skill_itid = itprofile.id')
            ->join('tbl_skillset_list', 'tbl_skillset_list.skill_setid = tbl_skill_owned.owned_skill_setid')
            ->where(['tbl_skill_owned.skill_status_flag' => 1])
            ->orderBy('tbl_skillset_list.skill_name', 'ASC')
            ->findAll();
        
        $history = $this->projectModel
            ->select('tbl_logs.*, tbl_project.projectid, user.id, user.name')
            ->join('tbl_logs', 'tbl_project.projectid = tbl_logs.projectid')
            ->join('user', 'tbl_logs.userid = user.id')
            ->where(['tbl_logs.projectid' => $project['projectid'], 'tbl_project.project_status_flag' => 0])
            ->orderBy('tbl_logs.created_at', 'DESC')
            ->findAll();
        $developers = $this->projectAdminModel
            ->select('itprofile.*, tbl_project_admin.*')
            ->join('itprofile', 'tbl_project_admin.devid = itprofile.id')
            ->where(['tbl_project_admin.projectid' => $project['projectid'], 'tbl_project_admin.pa_status_flag' => 0])
            ->findAll();
            
        $project_owner = $this->projectModel
            ->select('clientprofile.*')
            ->join('clientprofile', 'tbl_project.clientid = clientprofile.id')
            ->where(['tbl_project.project_code' => $code])
            ->first();
        
        $avatar = '';
        $is_permitted = ''; 
        if(!empty($it)) {
            $avatar = ($it['profile_avatar'] == '')? '' : $it['profile_avatar'];
            $is_permitted = ($it['employment_status']== '')? '' : $it['employment_status'];
        } elseif(!empty($client)) {
            $avatar = ($client['profile_avatar'] == '')? '' : $client['profile_avatar'];
        }

        $data = array(
            'history'       =>  $history,
            'itpersonels'   =>  $itpersonels,
            'applicants'    =>  $applicants,
            'skills'        =>  $skills,
            'all_document'  =>  $all_document,
            'all_comment'   =>  $all_comment,
            'project'       =>  $project,
            'client'        =>  $client,
            'name'          =>  $this->session_name,
            'avatar'        =>  $avatar,
            'owner'         =>  $project_owner,
            'developers'    =>  $developers,
            'all_client'    =>  $all_client,
            'usertype'      =>  $is_permitted
        );
        
        return view('project/view_project', $data);
    }

    public function projectDetails($projectid) {
        $project = $this->projectModel->find($projectid);
        $all = $this->ticketModel->where(['projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'Yes'])->countAllResults();
        $ns_ticket = $this->ticketModel
            ->where([
                'ticket_label' => 'Not Started', 
                'projectid' => $projectid, 
                'ticket_status_flag' => 0, 
                'is_approved' => 'Yes', 
                'parentid' => 0, 
                'childid' => 0])
            ->countAllResults();

        $ip_ticket = $this->ticketModel
            ->where([
                'ticket_label' => 'In Progress', 
                'projectid' => $projectid, 
                'ticket_status_flag' => 0, 
                'is_approved' => 'Yes', 
                'parentid' => 0, 
                'childid' => 0])
            ->countAllResults();

        $cmp_ticket = $this->ticketModel
            ->where([
                'ticket_label' => 'Completed', 
                'projectid' => $projectid, 
                'ticket_status_flag' => 0, 
                'is_approved' => 'Yes', 
                'parentid' => 0, 
                'childid' => 0])
            ->countAllResults();

        $cnc_ticket = $this->ticketModel
            ->where([
                'ticket_label' => 'Cancelled', 
                'projectid' => $projectid, 
                'ticket_status_flag' => 0, 
                'is_approved' => 'Yes', 
                'parentid' => 0, 
                'childid' => 0])
            ->countAllResults();

        $hld_ticket = $this->ticketModel
            ->where([
                'ticket_label' => 'On Hold', 
                'projectid' => $projectid, 
                'ticket_status_flag' => 0, 
                'is_approved' => 'Yes', 
                'parentid' => 0, 
                'childid' => 0])
            ->countAllResults();

        $arc_ticket = $this->ticketModel
            ->where(['projectid' => $projectid, 'ticket_status_flag' => 1])
            ->countAllResults();

        $ap_ticket = $this->ticketModel
            ->where([
                'projectid' => $projectid, 
                'ticket_status_flag' => 0, 
                'is_approved' => 'No'])
            ->countAllResults();

        $files = $this->filesModel
            ->where([
                'projectid' => $projectid, 
                'file_status_flag' => 0])
            ->countAllResults();

        $developers = $this->projectAdminModel
            ->select('itprofile.*, tbl_project_admin.*')
            ->join('itprofile', 'tbl_project_admin.devid = itprofile.id')
            ->where([
                'tbl_project_admin.projectid' => $projectid, 
                'tbl_project_admin.pa_status_flag' => 0])
            ->findAll();

        $pm_personel = $this->projectModel
            ->select('itprofile.*, tbl_project.*')
            ->join('itprofile', 'tbl_project.pmid = itprofile.id')
            ->find($projectid);

        $project_owner = $this->projectModel
            ->select('clientprofile.*')
            ->join('clientprofile', 'tbl_project.clientid = clientprofile.id')
            ->where(['tbl_project.projectid' => $projectid])
            ->first();

        $count_applicants = $this->itModel
            ->select('itprofile.*, tbl_applicant.*')
            ->join('tbl_applicant', 'tbl_applicant.itid = itprofile.id', 'inner')
            ->where(['tbl_applicant.projectid' => $projectid, 'application_status' => 0])
            ->countAllResults();

        $assigned_pm = $this->itModel->where(['is_verified' => 'Yes'])->findAll();
        $userit = $this->itModel->where('userId', $this->sessionid)->first();
        $duedate = new DateTime($project['due_date']);
        $dued_at = $duedate->format("F d, Y");

        $is_permitted = ($this->ses_usertype == 1 && $userit['employment_status'] == 1) ? 'd-none' : '';
        $is_client = ($this->ses_usertype == 2) ? 'd-none' : '';

        $data = array(
            'all'          =>   $all,
            'notStarted'   =>   $ns_ticket,
            'inProgress'   =>   $ip_ticket,
            'completed'    =>   $cmp_ticket,
            'cancelled'    =>   $cnc_ticket,
            'hold'         =>   $hld_ticket,
            'archived'     =>   $arc_ticket,
            'forApproval'  =>   $ap_ticket,
            'files'        =>   $files,
            'developers'   =>   $developers,
            'project'      =>   $project,
            'owner'        =>   $project_owner,
            'manager'      =>   $pm_personel,
            'is_permitted' =>   $is_permitted,
            'is_client'    =>   $is_client,
            'project_due'  =>   $dued_at,
            'assigned_pm'  =>   $assigned_pm,
            'applicants'   =>   $count_applicants
        );

        return $this->response->setJSON([
            'error' => false,
            'data' => $data
        ]);
    }

    // Fetch All Data (Not use)
    public function getAllData() {
        $client = $this->clientModel->where('userId', $this->sessionid)->first();
        $all_document = $this->filesModel->where('file_status_flag', 1)->findAll();
        $all_ticket = $this->ticketModel->where('ticket_status_flag', 0)->findAll();
        $project = $this->projectModel->where('project_status_flag', 0)->where('clientid', $client['id'])->findAll();
        $output ='
        <table class="table table-hover table-bordered" id="dataTableFull0">
        <thead class="bg-light">
            <tr class="text-center">
                <th>TITLE</th>
                <th>TAG/SKILLS</th>
                <th width="20%">DESCRIPTION</th>
                <th>DESIRED DUEDATE</th>
                <th>TICKETS</th>
                <th>DOCUMENTS</th>
                <th>STATUS</th>
                <th>CREATED</th>
                <th>MANAGE</th>
            </tr>
        </thead>
        <tbody>';
            $label = '';
            foreach ($project ?? [] as $data) {
                $count_file = 0;
                $count_ticket = 0;

                foreach($all_document ?? [] as $file) {
                    if ($data['projectid'] == $file['projectid']) {
                        $count_file++;
                    }
                }

                foreach($all_ticket ?? [] as $ticket) {
                    if ($data['projectid'] == $ticket['projectid']) {
                        $count_ticket++;
                    }
                }

                $labelClass = [
                    'Not Started' => 'badge border',
                    'In Progress' => 'badge border-info badge-info',
                    'Completed'   => 'badge border border-success badge-success',
                    'On Hold'     => 'badge border border-warning badge-warning',
                    'Cancelled'   => 'badge border border-danger badge-danger'
                ];

                $label = isset($labelClass[$data['project_label']]) ? '<span class="' . $labelClass[$data['project_label']] . '">' . $data['project_label'] . '</span>' : '';

                $output .= '
                        <tr class="text-center">
                            <td><a target="_blank" id="'.$data['project_name'].'" class="projectName'.$data['projectid'].'" href="'.base_url().'project/view/projectid='.$data['projectid'].'">'.$data['project_name'].'</a></td>
                            <td>'.$data['specialist_tag'].'</td>
                            <td><div class="text-ellipsis">'.$data['description'].'</div></td>
                            <td>'.$data['due_date'].'</td>
                            <td>'.$count_ticket.'</td>
                            <td>'.$count_file.'</td>
                            <td>'.$label.'</td>
                            <td>'.$data['created_at'].'</td>
                            <td> <a style="cursor:pointer" class="manageProjectStatus" data-id="1" id="'. $data['projectid'].'" class="ticket-file-upload"><span data-toggle="tooltip" title="Move to Archived"><i class="bi bi-calendar2-x text-danger"></i></span></a></td>
                        </tr>';
            } 
            $output .='</tbody> </table>';
            return $this->response->setJSON([
                'error' => false,
                'message'   => $output
            ]);
    }

    // Create Projects
    public function createProject() {
        try {
            $projectCode = bin2hex(random_bytes(5)); // Generate a random hexadecimal string of 10 characters
    
            $data = [
                'project_name' => $this->request->getVar('project_title'),
                'clientid' => $this->request->getVar('clientid'),
                'allot_skills' => $this->request->getVar('skills'),
                'specialist_tag' => $this->request->getVar('specialist'),
                'project_budget' => $this->request->getVar('offered_rate'),
                'start_date' => $this->request->getVar('start_date'),
                'due_date' => $this->request->getVar('due_date'),
                'project_allot_time' => $this->request->getVar('allot_time'),
                'description' => $this->request->getVar('project_description'),
                'project_code' => $projectCode,
                'project_label' => 'Not Started'
            ];
    
            if ($this->projectModel->save($data)) {
                return $this->response->setJSON([
                    'error'   => false,
                    'status'  => 200,
                    'title'   => 'Cheers',
                    'message' => 'Project has been created!'
                ]);
            } else {
                return $this->response->setJSON([
                    'error'   => true,
                    'status'  => 500,
                    'title'   => 'Error',
                    'message' => 'Failed to create project.'
                ]);
            }
        } catch (\Exception $e) {
            // Log the exception for future reference
            log_message('error', $e->getMessage());
    
            return $this->response->setJSON([
                'error'   => true,
                'status'  => 500,
                'title'   => 'Error',
                'message' => 'Internal Server Error'
            ]);
        }
    }

    // Update Project Details
    public function updateProject() {
        try {
            $projectid = $this->request->getVar('projectid');
    
            $data = [
                'project_name' => $this->request->getVar('project_title'),
                'project_label' => $this->request->getVar('project_status'),
                'clientid' => $this->request->getVar('clientid'),
                'allot_skills' => $this->request->getVar('skills'),
                'specialist_tag' => $this->request->getVar('specialist'),
                'project_budget' => $this->request->getVar('offered_rate'),
                'start_date' => $this->request->getVar('start_date'),
                'due_date' => $this->request->getVar('due_date'),
                'description' => $this->request->getVar('project_description')
            ];
    
            if ($this->projectModel->update($projectid, $data)) {
                $this->session->setFlashdata('success', $this->request->getVar('project_title') . ' Updated Successfully!');
                $logs = [
                    'userid' => $this->sessionid,
                    'projectid' => $projectid,
                    'action_activity' => 'Some of ' . $this->request->getVar('project_title') . ' information was updated'
                ];
                if($this->systemModel->save($logs)) {
                    return $this->response->setJSON([
                        'message' => 'Project Updated Successfully!'
                    ]);
                }
                
            } else {
                log_message('error', 'Failed to update project: ' . $projectid);
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
 
        }
    }
    
    // Assign Personel
    public function assignPersonel() {
        try {
            $projectid = $this->request->getVar('projectid');
            $column = $this->request->getVar('column');
            $selectedDevs = $this->request->getVar('assignto');
            $commaSeparatedId = implode(',', $selectedDevs);
    
            $data = [$column => $commaSeparatedId];
            if ($this->projectModel->update($projectid, $data)) {
                $logs = [
                    'userid' => $this->sessionid,
                    'projectid' => $projectid,
                    'action_activity' => 'New personnel(s) were selected and assigned as Project Manager to this project.'
                ];
                if($this->systemModel->save($logs)) {
                    return $this->response->setJSON([
                        'status'  => 200,
                        'message' => 'Project Manager(s) was assign to this project Successfully'
                    ]);
                }
            } else {
                log_message('error', 'Failed to assign personnel to project: ' . $projectid);
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
        }
    }
    
    public function assignDevelopers(){
        try {
            $projectid = $this->request->getVar('projectid');
            $bulk_data = array();
                foreach($this->request->getVar('developers') as $key => $value){
                    $projectadmin = array(
                        'clientid'  => $this->request->getVar('clientid'),
                        'devid'  => $this->request->getVar('developers')[$key],
                        'projectid'  => $projectid
                    );
                    $bulk_data[] = $projectadmin;    
                }
                if($this->projectAdminModel->insertBatch($bulk_data)) {
                    $this->session->setFlashdata('success', 'Developers Selected and Assigned to this project Successfully!');
                    $logs = array(
                        'userid'            =>  $this->sessionid,
                        'projectid'         =>  $projectid,
                        'action_activity'   =>  'New Developer(s) was selected and assigned to this project.' 
                    );
                    if($this->systemModel->save($logs)) {
                        return $this->response->setJSON([
                            'message' => 'Developer(s) was assign to this project Successfully'
                        ]);
                    }
                }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // Accept/Hire Applicant Developer
    public function hireDeveloper() {
        try {
            $applicationid = $this->request->getVar('applicationid');
            $applicantid = $this->request->getVar('applicantid');
            $projectid = $this->request->getVar('projectid');

            $profile = $this->itModel->where('id', $applicantid)->first();
            $project = $this->projectModel->where('projectid', $projectid)->first();

            $data = array(
                'employment_status' =>  1,
                'is_availability' =>  'No',
            );
            if($this->itModel->update($profile['id'] ,$data)){
                $status = array('application_status' => 1);
                if($this->applicantModel->update($applicationid, $status)) {
                    $admin = array(
                        'clientid'  => $this->request->getVar('clientid'),
                        'devid'  => $this->request->getVar('applicantid'),
                        'projectid'  => $this->request->getVar('projectid')
                    );
                    $this->projectAdminModel->save($admin);
                }
                $logs = array(
                    'userid'            =>  $this->sessionid,
                    'projectid'         =>  $projectid,
                    'action_activity'   =>  $profile['name'] . ' was selected and assigned as Developer to this project.' 
                );  
                if($this->systemModel->save($logs)) {
                    return $this->response->setJSON([
                        'error'   => false,
                        'status'  => 200,
                        'title'   => 'Cheers',  
                        'message' => $profile['name']. ' Successfully Assigned to this Project!'
                    ]);
                    // $to      = ''.$profile['email'].'';
                    // $subject = 'Welcome to '.$project['project_name'].' Team!';
                    // $message = 'Dear '.$profile['name'].',<br><br>
                    // I hope this email finds you well. I wanted to take a moment to personally welcome you to the <strong>'.$project['project_name'].' team project!</strong> We are thrilled to have you on board and excited about the skills and expertise you bring to our development efforts.
                    // <br><br>
                    // As a newly hired developer, you will play a crucial role in our project`s success. We believe that your knowledge and experience will greatly contribute to our team`s ability to deliver high-quality software solutions. Your skills align perfectly with the requirements of the <strong>'.$project['project_name'].'</strong>, and we are confident that you will make valuable contributions right from the start.
                    // <br><br>
                    // Once again, welcome to the <strong>'.$project['project_name'].' team project!</strong>  We are delighted to have you on board and look forward to working together to achieve our shared goals.
                    // <br><br><br>
                    // Best regards,
                    
                    // <strong>IT Blaster Management Services</strong><br>
                    //     1-703-906-9719
                    // ';
                    // $this->email->initialize(email_settings());
                    // $this->email->setTo($to);
                    // // $this->email->setCC('arnel@consultareinc.com, sbrandonjake@gmail.com, sagarinoken29@gmail.com');
                    // $this->email->setFrom('services@itblaster.net', 'IT Blaster Management Services');
                    // $this->email->setSubject($subject);
                    // $this->email->setMessage($message);
                    // if ($this->email->send()) {
                    //     return $this->response->setJSON([
                    //             'error'   => false,
                    //             'status'  => 200,
                    //             'title'   => 'Cheers',  
                    //             'message' => $profile['name']. ' Successfully Assigned to this Project!'
                    //     ]);
                    // } else {
                    //     $this->session->setFlashdata('error', 'Something went wrong! Please try Again later.');
                    //     return redirect()->back();
                    // }
                } 
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // Visit Application Profile
    public function viewApplicantProfile($id) {
        $profile = $this->itModel->find($id);
        $user =  $this->itModel->where('userId', $this->sessionid)->first();
        $client =  $this->clientModel->where('userId', $this->sessionid)->first();
        $education = $this->educationModel->where('educational_bg_profile_id', $profile['userId'])->findAll();
        $skills = $this->itModel->select('tbl_skill_owned.*, tbl_skillset_list.*, itprofile.id')->join('tbl_skill_owned','tbl_skill_owned.skill_itid = itprofile.id')->join('tbl_skillset_list', 'tbl_skillset_list.skill_setid = tbl_skill_owned.owned_skill_setid')->where(['tbl_skill_owned.skill_status_flag' => 1, 'tbl_skill_owned.skill_itid'    =>  $profile['id']])->orderBy('tbl_skillset_list.skill_name', 'ASC')->findAll();
        $experience = $this->experienceModel->where('work_xp_profile_id', $profile['userId'])->findAll();
        $project_count = $this->projectModel->select('tbl_project.*, tbl_project_admin.*')->join('tbl_project_admin', 'tbl_project.projectid = tbl_project_admin.projectid')->join('itprofile', 'tbl_project_admin.devid = itprofile.id')->where(['tbl_project_admin.devid' => $profile['id'], 'pa_status_flag' => 0, 'tbl_project.project_label' => 'Completed'])->countAllResults();
        $projects = $this->projectModel->select('tbl_project.*, tbl_project_admin.*')->join('tbl_project_admin', 'tbl_project.projectid = tbl_project_admin.projectid')->join('itprofile', 'tbl_project_admin.devid = itprofile.id')->where(['tbl_project_admin.devid' => $profile['id'], 'pa_status_flag' => 0, 'tbl_project.project_label' => 'Completed'])->findAll();
        $current = $this->projectModel->select('tbl_project.*, tbl_project_admin.*')->join('tbl_project_admin', 'tbl_project.projectid = tbl_project_admin.projectid')->join('itprofile', 'tbl_project_admin.devid = itprofile.id')->where(['tbl_project_admin.devid' => $profile['id'], 'pa_status_flag' => 0, 'tbl_project.project_label !=' => 'Completed'])->findAll();
        $avatar = '';
        if(!empty($user)) {
            $avatar = ($user['profile_avatar'] == '')? '' : $user['profile_avatar'];
        } elseif(!empty($client)) {
            $avatar = ($client['profile_avatar'] == '')? '' : $client['profile_avatar'];
        }
        $data = array(
            'profile'       =>   $profile,
            'name'          =>   $profile['name'],
            'avatar'        =>   $avatar,
            'project_count' =>   $project_count,
            'projects'      =>   $projects,
            'current'       =>   $current,
            'education'     =>   $education,
            'skills'        =>   $skills,
            'experience'    =>   $experience
        );
        return view('project/view_applicant_profile', $data);
    }

    // Remove Assigned Project
    public function removeAssignedPersonel() {
        try {
            $personeltype = $this->request->getVar('personeltype');
            $personelid = $this->request->getVar('personelid');
            $projectid = $this->request->getVar('projectid');
            $profile = $this->itModel->where('id', $personelid)->first();
            if($personeltype == 2) {
                $data = array(
                    'pmid'  => NULL
                );
                if($this->projectModel->update($projectid, $data)){
                    $data = array('employment_status'  => 0);
                    $this->itModel->update($personelid, $data);

                    $log = array(
                        'userid' => $this->sessionid,
                        'history_remarks'   => $this->request->getVar('remarks'),
                        'projectid'   => $this->request->getVar('projectid'),
                        'action_activity' => $this->request->getVar('activity')
                    );
                    $this->systemModel->save($log);
                   
                } 
            } else {
                $admins = $this->projectAdminModel->where(['projectid' => $projectid, 'devid' => $personelid])->first();
                $adminid = $admins['pa_projectid'];
                if($this->projectAdminModel->where('pa_projectid', $adminid)->delete()) {
                    $update_user = array('employment_status'  => 0);
                    $this->itModel->update($personelid, $update_user);

                    $log = array(
                        'userid' => $this->sessionid,
                        'history_remarks'   => $this->request->getVar('remarks'),
                        'projectid'   => $this->request->getVar('projectid'),
                        'action_activity' => $this->request->getVar('activity')
                    );
                    if( $this->systemModel->save($log)) {
                        return $this->response->setJSON([
                            'error'   => false,
                            'status'  => 200,
                            'title'   => 'Cheers',  
                            'message' => $profile['name']. ' Successfully Assigned to this Project!'
                        ]);
                        
                    }
                }
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // TICKETS
    public function createTicket() {
        try {
            $selectedDevs = $this->request->getVar('assignto');
            $commaSeparatedId = implode(',', $selectedDevs);

            $user = $this->itModel->where('userId', $this->sessionid)->first();
            $client = $this->clientModel->where('userId', $this->sessionid)->first();
            $projectid = $this->request->getVar('projectid');
            if(!empty($user)) {
                $usertype = $user['employment_status'];
                $is_approved = ($usertype == 2) ? 'Yes' : 'No';
                $label = ($usertype == 2) ? $this->request->getVar('status') : 'Not Started';
                
                $data = array(
                    'clientid' => $this->request->getVar('clientid'),
                    'projectid' => $this->request->getVar('projectid'),
                    'ticket_title' => $this->request->getVar('title'),
                    'assign_to' => $commaSeparatedId,
                    'ticket_start_date' => $this->request->getVar('duedate'),
                    'ticket_alloted_time' => $this->request->getVar('alloted_time'),
                    'ticket_due_date' => $this->request->getVar('duedate'),
                    'ticket_task_description' => $this->request->getVar('description'),
                    'ticket_priority_label' => $this->request->getVar('priority'),
                    'parentid' => $this->request->getVar('parentid'),
                    'childid' => $this->request->getVar('childid'),
                    'ticket_label' => $label,
                    'is_approved' => $is_approved
                );
            } elseif(!empty($client)) {
                $data = array(
                    'clientid' => $this->request->getVar('clientid'),
                    'projectid' => $this->request->getVar('projectid'),
                    'ticket_title' => $this->request->getVar('title'),
                    'ticket_start_date' => $this->request->getVar('duedate'),
                    'ticket_alloted_time' => $this->request->getVar('alloted_time'),
                    'ticket_due_date' => $this->request->getVar('duedate'),
                    'ticket_task_description' => $this->request->getVar('description'),
                    'ticket_priority_label' => $this->request->getVar('priority'),
                    'parentid' => $this->request->getVar('parentid'),
                    'childid' => $this->request->getVar('childid'),
                    'ticket_label' =>  $this->request->getVar('status'),
                    'is_approved' => 'Yes'
                );
            }

            // echo '<pre>';print_r($data);
            
            if($this->ticketModel->save($data)){
                // $updateData = array('last_update' => date('Y-m-d H:i:s'));
                // Update the project with the correct projectid
                // $this->projectModel->where('projectid', $projectid)->update($updateData);
                
                $log = array(
                    'userid' => $this->sessionid,
                    'projectid' => $this->request->getVar('projectid'),
                    'action_activity' => 'New Ticket Added by '. $this->session_name
                );
                if($this->systemModel->save($log)) {
                    return redirect()->back();
                }
            } 
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // Add Ticket Comment
    public function addTicketComment() {
        try {
            $projectid = $this->request->getVar('projectid');
            $data = array(
                'ticketid' => $this->request->getVar('ticketid'),
                'userid' => $this->sessionid,
                'comment_content' => $this->request->getVar('comment')
            );
            if($this->commentModel->save($data)) {
                $logs = array(
                    'userid' => $this->sessionid,
                    'projectid' => $this->request->getVar('projectid'),
                    'action_activity' => 'Adding Comment on Ticket#'.' '. $this->request->getVar('ticketid')
                );
                if($this->systemModel->save($logs)) {
                    return $this->response->setJSON([
                        'error' => false,
                        'title' => 'Cheers!',
                        'text'   => 'Comment successfully added to this ticket.'
                    ]);
                }
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // View Ticket Details
    public function viewTicketDetails($id) {
        $ticket = $this->ticketModel->find($id);
        $comments = $this->commentModel->select('tbl_comment.*, itprofile.name, itprofile.profile_avatar, itprofile.id')->join('itprofile', 'tbl_comment.userid = itprofile.userId')->where('ticketid', $ticket['ticketid'])->findAll();
        $files = $this->filesModel->where('ticketid', $ticket['ticketid'])->findAll();

        $tcomments = '';
        if(!empty($comments)) {
            foreach ($comments as $comment) {
                $tcomments .='
                      <div>
                        <img data-toggle="tooltip" title="'.$comment['name'].'" class="direct-chat-img img-bordered-sm" src="/uploads/files/'.$comment['name'].'/'.$comment['profile_avatar'].'" alt="message user image" style="margin-left:15px; width: 35px; height: 35px;">
                        <div class="timeline-item">
                            <!-- header -->
                            <span class="time"><i class="far fa-clock"></i> <span id="commentTime'.$comment['commentid'].'"></span></span>
                            <h3 class="timeline-header"><a href="#">'.$comment['name'].'</a></h3>

                            <div class="timeline-body">
                                '.$comment['comment_content'].'
                            </div>
                        </div>
                      </div>
                    <script>
                        var inputTime = "'.$comment['created_at'].'";
                        var parsedTime = new Date(inputTime);
        
                        var month = parsedTime.toLocaleString("default", { month: "short" });
                        var day = parsedTime.getDate();
                        var year = parsedTime.getFullYear();
                        var hours = parsedTime.getHours();
                        var minutes = parsedTime.getMinutes();
                    
                        var formattedTime = month + " " + day + " " + year + " " + hours + ":" + minutes;
                        $("#commentTime'.$comment['commentid'].'").html(formattedTime);
                    </script>
                    
                ';
            }
        } else {
            $tcomments .='No Comment to this ticket yet.';
        }


        $tfiles = '';
        if(!empty($files)) {
            foreach ($files as $file) {
                $icon  = '';
                $color = '';
                if(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'pdf'){
                    $color = 'danger';
                    $icon  = 'file-earmark-pdf';
                }elseif(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'docx' || pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'doc'){
                    $color = 'primary';
                    $icon  = 'file-earmark-word';
                }elseif(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'xlsx' || pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'xls'){
                    $color = 'success';
                    $icon  = 'file-earmark-excel';
                }elseif(pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'xlsx' && pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'xls' && pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'pdf' && pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'docx' && pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'doc'){
                    $color = '';
                    $icon  = 'filetype-'.pathinfo($file['file_name'], PATHINFO_EXTENSION);
                }
                $tfiles .='
                <div class="col-md-4 mb-3">
                    <div class="custom-card">
                        <div class="custom-card-body">
                            <div class="d-flex align-items-center">
                            <i class="bi bi-'.$icon.' text-'.$color.' px-2" style="font-size:30px"></i> 
                            <a href="#" data-toggle="tooltip" title="Upload/View">'.$file['file_name'].'</a>
                            </div>
                        </div>
                    </div>
                    <span style="color:#999; font-size:12px"><i class="far fa-clock px-2"></i><span id="uploadedTime'.$file['fileid'].'"></span></span>
                </div>
                <script>
                    var inputTime = "'.$file['created_at'].'";
                    var parsedTime = new Date(inputTime);

                    var month = parsedTime.toLocaleString("default", { month: "short" });
                    var day = parsedTime.getDate();
                    var year = parsedTime.getFullYear();
                    var hours = parsedTime.getHours();
                    var minutes = parsedTime.getMinutes();

                    var formattedTime = month + " " + day + " " + year + " " + hours + ":" + minutes;
                    document.getElementById("uploadedTime'.$file['fileid'].'").innerHTML = formattedTime;
                </script>
                ';
            }
        } else {
            $tfiles .='No Files Uploaded to this ticket yet.';
        } 

        return $this->response->setJSON([
            'error' => false,
            'message' => $ticket,
            'comment'   => $tcomments,
            'file'   => $tfiles
        ]);
    }

    // Attached File Ticket
    public function attachedFiles() {
        try {
            $project_name = $this->request->getVar('project_name');
            $projectid = $this->request->getVar('projectid');
            $validated = $this->validate([
                'file' => [
                    'uploaded[file]',
                    'max_size[file,4096]',
                ],
            ]);
            if ($validated) {
                $file = $this->request->getFile('file');
                $fileDir = '/files/'.$project_name.'/ticket';
                $file->move('uploads'.$fileDir);
                $data = array(
                    'ticketid' =>  $this->request->getVar('ticketid'),
                    'file_name' =>  $file->getClientName(),
                    'userid' =>  $this->sessionid,
                    'file_type' => $file->getClientMimeType()
                );
                if($this->filesModel->save($data)){
                    $log = array(
                        'userid' => $this->sessionid,
                        'projectid' => $projectid,
                        'action_activity' => 'Attached new file in Ticket#'.' '. $this->request->getVar('ticketid')
                    );
                    if($this->systemModel->save($log)) {
                        return $this->response->setJSON([
                            'status'    => '200',
                            'error'     => 'false',
                            'title'     => 'Cheers',
                            'text'      => 'File Attached to the Ticket Successfully Added!'
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // Manage Project Status
    public function manageProjectStatus() {
        try {
            $projectid = $this->request->getVar('projectid');
            $data = array(
                'project_status_flag' => $this->request->getVar('status')
            );

            if($this->projectModel->update($projectid, $data)) {
                $log = array(
                    'userid' => $this->sessionid,
                    'projectid' => $this->request->getVar('projectid'),
                    'action_activity' => 'ID:'. $projectid . ' ' .$this->request->getVar('action')
                );
                if($this->systemModel->save($log)) {
                    return redirect()->back();
                }
            }

        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getTicketHistory($id){
        $ticket = $this->ticketModel->find($id);
    }

    public function getAllProjectTicket($projectid) {
        $ticket = $this->ticketModel->where(['projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'Yes', 'parentid' => 0, 'childid' => 0])->orderBy('ticketid', 'DESC')->findAll();
        $all_document = $this->filesModel->where('file_status_flag', 0)->findAll();
        $all_comment = $this->commentModel->where('comment_status_flag', 0)->findAll();
        $all_ticket = $this->ticketModel->select('parentid, ticket_label, childid')->where(['projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'Yes'])->findAll();
        $developers = $this->projectAdminModel->select('itprofile.*, tbl_project_admin.*')->join('itprofile', 'tbl_project_admin.devid = itprofile.id')->where(['tbl_project_admin.projectid' => $projectid, 'tbl_project_admin.pa_status_flag' => 0])->findAll();

        $userit = $this->itModel->where('userId', session('id'))->first();
        $user_type = session('usertype');

        $is_permitted = ($user_type == 1 && $userit['employment_status'] == 1) ? 'd-none' : '';
        $is_client = ($user_type == 2) ? 'd-none' : '';
        $result = '';
        if(!empty($ticket)) {
            $result .='<table class="table table-hover table-bordered" id="daataTableFull1">
                <thead class="bg-light">
                <tr class="text-center">
                <th width="4%"></th>
                  <th width="10%">TICKET #</th>
                  <th width="20%">DESCRIPTION</th>
                  <th>DESIRED DUEDATE</th>
                  <th>ASSIGN DEVELOPER</th>
                  <th>SUB TICKETS</th>
                  <th>DOCUMENTS</th>
                  <th>COMMENTS</th>
                  <th>STATUS</th>
                  <th width="10%" class="text-center">CREATED</th>
                  <th class='.$is_permitted.'>MANAGE</th>
                </tr>
                </thead>
                <tbody>';
            foreach ($ticket as $data) {
                $ticketLabelClasses = [
                    'Not Started' => 'badge border',
                    'In Progress' => 'badge border-success badge-info',
                    'On Hold' => 'badge border border-warning badge-warning',
                    'Cancelled' => 'badge border border-danger badge-danger',
                    'Completed' => 'badge border border-light badge-success'
                ];
    
                $ticketPriorityClasses = [
                    'Low' => 'secondary',
                    'Moderate' => 'success',
                    'High' => 'warning',
                    'Very High' => 'danger'
                ];
    
                $ticketLabel = $ticketLabelClasses[$data['ticket_label']] ?? '';
                $label = '<span class="'.$ticketLabel.'">'.$data['ticket_label'].'';
                $ticketPriorityLabel = $data['ticket_priority_label'];
                $priorityColorClass = $ticketPriorityClasses[$ticketPriorityLabel] ?? '';
    
                $priority = '';
                if ($priorityColorClass) {
                    $priority = '<span class="px-2"><i class="bi bi-flag-fill text-' . $priorityColorClass . '" data-toggle="tooltip" title="' . $ticketPriorityLabel . '"></i></span>';
                }

               $total_completion = 0;

                $count_file = count(array_filter($all_document, function ($file) use ($data) {
                    return $data['ticketid'] == $file['ticketid'];
                }));

                $count_comment = count(array_filter($all_comment, function ($comment) use ($data) {
                    return $data['ticketid'] == $comment['ticketid'];
                }));

                $count_subtask = 0;
                $count_completed_tickets = 0;
                $count_gsubtask = 0;
                foreach ($all_ticket as $ticket) {
                    if ($data['ticketid'] == $ticket['parentid']) {
                        if ($ticket['ticket_label'] == 'Completed') {
                            $count_completed_tickets++;
                        }
                        $count_subtask++;
                    }
                }

                $total_subtask = $count_subtask + $count_gsubtask;
                $main_ticket = ($data['ticket_label'] == 'Completed') ? 1 : 0;

                $x = $count_subtask + 1;
                $y = $count_completed_tickets + $main_ticket;

                if ($x > 0) {
                    $total_completion = round($y / $x * 100);
                }

                 $duedate = new DateTime($data['ticket_due_date']);
                 $dued_at = $duedate->format("F d, Y");

                 $created_date = new DateTime($data['created_at']);
                 $created_at = $created_date->format("F d, Y");
                 
               $result .='
               <tr class="text-center">
               <td>
                 <a data-toggle="modal" data-target="#add-ticket-modal" class="addSubTask" id="'.$data['ticketid'].'"><i data-toggle="tooltip" title="Add Sub-ticket" class="bi bi-plus-square-fill h5 text-info"></i></a>
                 <a data-toggle="canvas" data-target="#bs-canvas-right" aria-expanded="false" onclick="showOffcanvas()" aria-controls="bs-canvas-right" class="offCanvas" id="'.$data['ticketid'].'"><i data-toggle="tooltip" title="View Ticket History/Ticket Sub-task" class="bi bi-arrow-left-square-fill h5 text-info"></i></a>
               </td>
               <td>
                 '.$priority.'<a style="cursor:pointer" class="view-ticket-details" id="'.$data['ticketid'].'" data-toggle="modal" data-target="#view-ticket-modal"><span data-toggle="tooltip" title="View ticket"> TICKET #'.$data['ticketid'].'</span></a>
                 <div class="px-3">
                   <div class="progress">
                     <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                         aria-valuenow="'.$total_completion.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$total_completion.'%">
                     </div>
                   </div>
                 </div>
                   <span>'.$total_completion.'% Complete</span>
               </td>
               <td><div class="text-ellipsis">'.$data['ticket_task_description'].'</div></td>
               <td>'.$dued_at.'</td>
               <td>
               ';

                $assignid = $data['assign_to'];
                $arrayids = explode(",", $assignid);

                $assignedDevelopers = array_filter($developers, function($assigned) use ($arrayids) {
                    return in_array($assigned['id'], $arrayids);
                });
                if(empty($assignedDevelopers)) {
                    $result.= '<span class="p-2 rounded"><i class="bi bi-exclamation-circle"></i><span class="font-italic px-2">No developer(s) assigned</span></span>';
                }
                foreach ($assignedDevelopers ?? [] as $assigned) {
                    if(!empty($assigned['profile_avatar'])){
                        $result .= '<img data-toggle="tooltip" title="'.$assigned['name'].'" src="/uploads/files/'.$assigned['name'].'/'.$assigned['profile_avatar'].'" width="36" height="36" class="img-circle" style="margin-left:-10px; border: 2px solid #6c757d;">';
                    } else {
                        preg_match_all('/[A-Z]/', $assigned['name'], $matches);
                        $capitalLetters = implode('', $matches[0]);
                        $result .= '<a href="#" data-toggle="tooltip" title="'.$assigned['name'].'" class="h4 bg-light text-secondary border-dark rounded-pill px-2 font-weight-bold" style="margin-left:-10px; border: 3px solid #6c757d;">'.$capitalLetters.'</a>';
                    }
                }
                $result .='</td>
               <td>'.$total_subtask.'</td>
               <td>'.$count_file.'</td>
               <td>'.$count_comment.'</td>
               <td>'.$label.'</td>
               <td>'.$created_at.'</td>
               <td class="'.$is_permitted.'">
                 <div class="d-flex justify-content-center gap-2">
                   <a class="ticketArchive" id="'. $data['ticketid'].'" class="ticket-file-upload"><span data-toggle="tooltip" title="Move to Archived"><i class="bi bi-calendar2-x text-danger"></i></span></a>  
                 </div>
               </td>
             </tr>
               ';
           }
           $result .='
               </tbody>
           </table>
           ';
        } else {
            $result.= '<table class="table table-hover table-bordered">
            <thead class="bg-light">
            <tr class="text-center">
              <th width="10%">TICKET #</th>
              <th width="20%">DESCRIPTION</th>
              <th>DESIRED DUEDATE</th>
              <th>ASSIGN DEVELOPER</th>
              <th>SUB TICKETS</th>
              <th>DOCUMENTS</th>
              <th>COMMENTS</th>
              <th>STATUS</th>
              <th width="10%" class="text-center">CREATED</th>
              <th class='.$is_permitted.'>MANAGE</th>
            </tr>
            </thead>
            <tbody>
            
            </tbody>
          </table>';
        }
        return $this->response->setJSON([
            'error' => false,
            'result' => $result
            // 'subTickets' => $all_ticket
        ]);  
    }

    // Ticket per Status
    public function ticketTabDetails($status, $projectid){
        $projectid = $this->request->getVar('projectid');
        $all_document = $this->filesModel->where('file_status_flag', 0)->findAll();
        $all_comment = $this->commentModel->where('comment_status_flag', 0)->findAll();
        // $ticket_owner = $this->ticketModel
        //         ->select('
        //             tbl_ticketowners.ticketid,
        //             tbl_ticketowners.personelid,
        //             itprofile.name,
        //             itprofile.profile_avatar')
        //         ->join('tbl_ticketowners', 'tbl_ticket.ticketid = tbl_ticketowners.ticketid')
        //         ->join('itprofile', 'tbl_ticketowners.personelid = itprofile.userId')
        //         ->findAll();
        $ticket = $this->ticketModel
                ->where([
                    'ticket_label' => $status, 
                    'projectid' => $projectid, 
                    'ticket_status_flag' => 0, 
                    'is_approved' => 'Yes', 
                    'parentid' => 0, 
                    'childid' => 0])
                ->orderBy('ticketid', 'DESC')
                ->findAll();
        $forapprovalTicket = $this->ticketModel
                ->where([
                    'projectid' => $projectid, 
                    'ticket_status_flag' => 0, 
                    'is_approved' => 'No'])
                ->orderBy('ticketid', 'DESC')
                ->findAll();
        $archivedTicket = $this->ticketModel
                ->where([
                    'projectid' => $projectid, 
                    'ticket_status_flag' => 1])
                ->orderBy('ticketid', 'DESC')
                ->findAll();
        $all_ticket = $this->ticketModel
                ->select('parentid, ticket_label, childid')
                ->where([
                    'projectid' => $projectid, 
                    'ticket_status_flag' => 0, 
                    'is_approved' => 'Yes'])
                ->findAll();
        $developers = $this->projectAdminModel
                ->select('itprofile.*, tbl_project_admin.*')
                ->join('itprofile', 'tbl_project_admin.devid = itprofile.id')
                ->where([
                    'tbl_project_admin.projectid' => $projectid, 
                    'tbl_project_admin.pa_status_flag' => 0])
                ->findAll();

        $result = '';
        $userit = $this->itModel->where('userId', session('id'))->first();
        $user_type = session('usertype');
        $is_permitted = ($user_type == 1 && $userit['employment_status'] == 1) ? 'd-none' : '';
        $is_client = ($user_type == 2) ? 'd-none' : '';
        if($status == 'Archived') {
            $result .= '<table class="table table-hover table-bordered">
            <thead class="bg-light">
              <tr>
                <th class="text-center">TICKET #</th>
                <th class="text-center" width="20%">DESCRIPTION</th>
                <th class="text-center">DESIRED DUEDATE</th>
                <th class="text-center">DOCUMENTS</th>
                <th class="text-center">COMMENTS</th>
                <th class="text-center">STATUS</th>
                <th width="10%" class="text-center">CREATED</th>
                <th width="10%" class="text-center '.$is_permitted.'">ACTION</th>
              </tr>
              </thead>
              <tbody>';
              if(!empty($archivedTicket)) { 
                foreach ($archivedTicket as $data) {
                    $ticketPriorityClasses = [
                        'Low' => 'secondary',
                        'Moderate' => 'success',
                        'High' => 'warning',
                        'Very High' => 'danger'
                    ];

                    $ticketPriorityLabel = $data['ticket_priority_label'];
                    $priorityColorClass = $ticketPriorityClasses[$ticketPriorityLabel] ?? '';
        
                    $priority = '';
                    if ($priorityColorClass) {
                        $priority = '<span class="px-2"><i class="bi bi-flag-fill text-' . $priorityColorClass . '" data-toggle="tooltip" title="' . $ticketPriorityLabel . '"></i></span>';
                    }

                    if (!empty($all_document)) {
                        $count_file = count(array_filter($all_document, function ($file) use ($data) {
                            return $file['ticketid'] === $data['ticketid'];
                        }));
                    } else {
                        $count_file = 0;
                    }

                    if (!empty($all_comment)) {
                        $count_comment = count(array_filter($all_comment, function ($comment) use ($data) {
                            return $comment['ticketid'] === $data['ticketid'];
                        }));
                    } else {
                        $count_comment = 0;
                    }

                    $inputDateTimeCreated = new DateTime($data['created_at']);
                    $outputDateCreated = $inputDateTimeCreated->format("F d, Y");

                    $inputDateTimeDue = new DateTime($data['ticket_due_date']);
                    $outputDateDue = $inputDateTimeDue->format("F d, Y");
                    $userit = $this->itModel->where('userId', session('id'))->first();
                    $user_type = session('usertype');

                    $is_permitted = ($user_type == 1 && $userit['employment_status'] == 1) ? 'd-none' : '';
                    $is_client = ($user_type == 2) ? 'd-none' : '';

                    $result .= '
                    <tr class="text-center">
                    <td>'.$priority.'<a style="cursor:pointer" class="view-ticket-details" id="'.$data['ticketid'].'" data-toggle="modal" data-target="#view-ticket-modal"><span data-toggle="tooltip" title="View ticket"> TICKET #'.$data['ticketid'].'</span></a></td>
                    <td><div class="text-ellipsis">'.$data['ticket_task_description'].'</div></td>
                    <td>'.$outputDateDue.'</td>
                    <td>'.$count_file.'</td>
                    <td>'.$count_comment.'</td>
                    <td><span class="badge border bg-secondary">Archived</span></td>
                    <td>'.$outputDateCreated.'</td>
                    <td class="'.$is_permitted.'">
                      <div class="d-flex justify-content-center gap-2">
                        <a style="cursor:pointer" class="restoreTicket" data-toggle="tooltip" title="Restore" id="'. $data['ticketid'].'" class="ticket-file-upload"> <i class="bi bi-recycle text-success" style="font-size: 16px !important;"></i></a>  
                      </div>
                    </td>
                  </tr>
                    ';
                }
              }
              $result .= '</tbody>
              </table>';
        } elseif($status == 'For Approval') {
            $userit = $this->itModel->where('userId', session('id'))->first();
            $user_type = session('usertype');

            $is_permitted = ($user_type == 1 && $userit['employment_status'] == 1) ? 'd-none' : '';
            $is_client = ($user_type == 2) ? 'd-none' : '';
            $result .= '<table class="table table-hover table-bordered">
            <thead class="bg-light">
              <tr>
                <th width="3%" class="'.$is_permitted.'"><input id="select-all" type="checkbox"></th>
                <th class="text-center">TICKET #</th>
                <th class="text-center" width="20%">DESCRIPTION</th>
                <th class="text-center">DESIRED DUEDATE</th>
                <th class="text-center">DOCUMENTS</th>
                <th class="text-center">COMMENTS</th>
                <th class="text-center">STATUS</th>
                <th width="10%" class="text-center">CREATED</th>
                <th class="'.$is_permitted.' text-center">MANAGE</th>
              </tr>
              </thead>
              <tbody>';
              if(!empty($forapprovalTicket)) {
                foreach ($forapprovalTicket as $data){
                    $ticketPriorityClasses = [
                        'Low' => 'secondary',
                        'Moderate' => 'success',
                        'High' => 'warning',
                        'Very High' => 'danger'
                    ];

                    $ticketPriorityLabel = $data['ticket_priority_label'];
                    $priorityColorClass = $ticketPriorityClasses[$ticketPriorityLabel] ?? '';
        
                    $priority = '';
                    if ($priorityColorClass) {
                        $priority = '<span class="px-2"><i class="bi bi-flag-fill text-' . $priorityColorClass . '" data-toggle="tooltip" title="' . $ticketPriorityLabel . '"></i></span>';
                    }

                    if (!empty($all_document)) {
                        $count_file = count(array_filter($all_document, function ($file) use ($data) {
                            return $file['ticketid'] === $data['ticketid'];
                        }));
                    } else {
                        $count_file = 0;
                    }

                    if (!empty($all_comment)) {
                        $count_comment = count(array_filter($all_comment, function ($comment) use ($data) {
                            return $comment['ticketid'] === $data['ticketid'];
                        }));
                    } else {
                        $count_comment = 0;
                    }

                    $inputDateTimeCreated = new DateTime($data['created_at']);
                    $outputDateCreated = $inputDateTimeCreated->format("F d, Y");

                    $inputDateTimeDue = new DateTime($data['ticket_due_date']);
                    $outputDateDue = $inputDateTimeDue->format("F d, Y");

                    $result .= '
                    <tr class="text-center">
                    <td class="'.$is_permitted.'"><input class="checkbox" name="approval_tickets[]" value="'.$data['ticketid'].'" type="checkbox"></td>
                    <td>'.$priority.'<a style="cursor:pointer" class="view-ticket-details" id="'.$data['ticketid'].'" data-toggle="modal" data-target="#view-ticket-modal"><span data-toggle="tooltip" title="View ticket"> TICKET #'.$data['ticketid'].'</span></a></td>
                    <td><div class="text-ellipsis">'.$data['ticket_task_description'].'</div></td>
                    <td>'.$outputDateDue.'</td>
                    <td>'.$count_file.'</td>
                    <td>'.$count_comment.'</td>
                    <td><span class="badge border bg-secondary">For Approval</span></td>
                    <td>'.$outputDateCreated.'</td>
                    <td class='.$is_permitted.' text-center">
                    <div class="d-flex justify-content-center gap-2">
                      <a style="cursor:pointer" class="approvedTicket" data-toggle="tooltip" title="Approved" id="'. $data['ticketid'].'" class="ticket-file-upload"> <i class="bi bi-check-circle text-success" style="font-size: 16px !important;"></i></a>  
                    </div>
                  </td>
                  </tr>
                    ';
                }
              }
              $result .= '
              <button type="submit" class="btn btn-sm btn-success d-none is_clicked" id="update_button_hide"><i class="bi bi-check-circle"></i> &nbsp; Approve</button>
              </tbody>
              </table>';
        }else {
            $result .= '<table class="table table-hover table-bordered">
            <thead class="bg-light">
            <tr class="text-center">
            <th width="4%"></th>
              <th width="10%">TICKET #</th>
              <th width="20%">DESCRIPTION</th>
              <th>DESIRED DUEDATE</th>
              <th>ASSIGNED DEVELOPERS</th>
              <th>SUB TICKETS</th>
              <th>DOCUMENTS</th>
              <th>COMMENTS</th>
              <th>STATUS</th>
              <th width="10%" class="text-center">CREATED</th>
              <th class="'.$is_permitted.'">MANAGE</th>
            </tr>
            </thead>
            <tbody>';
            foreach ($ticket as $data) {
                $ticketLabelClasses = [
                    'Not Started' => 'badge border',
                    'In Progress' => 'badge border-success badge-info',
                    'On Hold' => 'badge border border-warning badge-warning',
                    'Cancelled' => 'badge border border-danger badge-danger',
                    'Completed' => 'badge border border-light badge-success'
                ];
    
                $ticketPriorityClasses = [
                    'Low' => 'secondary',
                    'Moderate' => 'success',
                    'High' => 'warning',
                    'Very High' => 'danger'
                ];
    
                $ticketLabel = $ticketLabelClasses[$data['ticket_label']] ?? '';
                $label = '<span class="'.$ticketLabel.'">'.$data['ticket_label'].'';
                $ticketPriorityLabel = $data['ticket_priority_label'];
                $priorityColorClass = $ticketPriorityClasses[$ticketPriorityLabel] ?? '';
    
                $priority = '';
                if ($priorityColorClass) {
                    $priority = '<span class="px-2"><i class="bi bi-flag-fill text-' . $priorityColorClass . '" data-toggle="tooltip" title="' . $ticketPriorityLabel . '"></i></span>';
                }
                $count_file = count(array_filter($all_document, function ($file) use ($data) {
                    return $file['ticketid'] === $data['ticketid'];
                }));
                
                $count_comment = count(array_filter($all_comment, function ($comment) use ($data) {
                    return $comment['ticketid'] === $data['ticketid'];
                }));
                
                $count_subtask = count(array_filter($all_ticket, function ($ticket) use ($data) {
                    return $ticket['parentid'] === $data['ticketid'];
                }));
                
                $count_completed_tickets = count(array_filter($all_ticket, function ($ticket) use ($data) {
                    return $ticket['parentid'] === $data['ticketid'] && $ticket['ticket_label'] === 'Completed';
                }));
                
                $count_gsubtask = 0; 
                $total_subtask = $count_subtask + $count_gsubtask;
                $main_ticket = ($data['ticket_label'] === 'Completed') ? 1 : 0;
                $x = $count_subtask + 1;
                $y = $count_completed_tickets + $main_ticket;
                $total_completion = ($x > 0) ? round($y / $x * 100) : 0;

                $duedate = new DateTime($data['ticket_due_date']);
                $dued_at = $duedate->format("F d, Y");

                $created_date = new DateTime($data['created_at']);
                $created_at = $created_date->format("F d, Y");

                $userit = $this->itModel->where('userId', session('id'))->first();
                $user_type = session('usertype');
    
                $is_permitted = ($user_type == 1 && $userit['employment_status'] == 1) ? 'd-none' : '';
                $is_client = ($user_type == 2) ? 'd-none' : '';
                  
                $result .='
                <tr class="text-center">
                    <td>
                        <a data-toggle="modal" data-target="#add-ticket-modal" class="addSubTask" id="'. $data['ticketid'] .'"><i data-toggle="tooltip" title="Add Sub-ticket" class="bi bi-plus-square-fill h5 text-info"></i></a>
                        <a data-toggle="canvas" data-target="#bs-canvas-right" aria-expanded="false" onclick="showOffcanvas()" aria-controls="bs-canvas-right" class="offCanvas" id="'. $data['ticketid'] .'"><i data-toggle="tooltip" title="View Ticket History/Ticket Sub-task" class="bi bi-arrow-left-square-fill h5 text-info"></i></a>
                    </td>
                    <td>
                        '. $priority .'<a style="cursor:pointer" class="view-ticket-details" id="'. $data['ticketid'] .'" data-toggle="modal" data-target="#view-ticket-modal"><span data-toggle="tooltip" title="View ticket"> TICKET #'. $data['ticketid'] .'</span></a>
                        <div class="px-3">
                            <div class="progress">
                                <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="'. $total_completion .'" aria-valuemin="0" aria-valuemax="100" style="width: '. $total_completion .'%"></div>
                            </div>
                        </div>
                        <span>'. $total_completion .'% Complete</span>
                    </td>
                    <td>
                        <div class="text-ellipsis">'. $data['ticket_task_description'] .'</div>
                    </td>
                    <td>'. $dued_at .'</td>
                    <td>';

                    $assignid = $data['assign_to'];
                    $arrayids = explode(",", $assignid);

                    $assignedDevelopers = array_filter($developers, function($assigned) use ($arrayids) {
                        return in_array($assigned['id'], $arrayids);
                    });

                    if(empty($assignedDevelopers)) {
                        $result.= '<span class="p-2 rounded"><i class="bi bi-exclamation-circle"></i><span class="font-italic px-2">No developer(s) assigned</span></span>';
                    }

                    foreach ($assignedDevelopers as $assigned) {
                        if(!empty($assigned['profile_avatar'])){
                            $result .= '<img data-toggle="tooltip" title="'.$assigned['name'].'" src="/uploads/files/'.$assigned['name'].'/'.$assigned['profile_avatar'].'" width="36" height="36" class="img-circle" style="margin-left:-10px; border: 2px solid #6c757d;">';
                        } else {
                            preg_match_all('/[A-Z]/', $assigned['name'], $matches);
                            $capitalLetters = implode('', $matches[0]);
                            $result .= '<a href="#" data-toggle="tooltip" title="'.$assigned['name'].'" class="h4 bg-light text-secondary border-dark rounded-pill px-2 font-weight-bold" style="margin-left:-10px; border: 3px solid #6c757d;">'.$capitalLetters.'</a>';
                        }
                    }
                    $result .='</td>
                    <td>'. $total_subtask .'</td>
                    <td>'. $count_file .'</td>
                    <td>'. $count_comment .'</td>
                    <td>'. $label .'</td>
                    <td>'. $created_at .'</td>
                    <td class="'.$is_permitted.'">
                        <div class="d-flex justify-content-center gap-2">
                            <a class="ticketArchive" id="'. $data['ticketid'] .'" class="ticket-file-upload"><span data-toggle="tooltip" title="Move to Archived"><i class="bi bi-calendar2-x text-danger"></i></span></a>
                        </div>
                    </td>
                </tr>
                ';
            }
            $result .='
                </tbody>
            </table>
            ';
        }
        
        return $this->response->setJSON([
            'error' => false,
            'result' => $result
            // 'subTickets' => $all_ticket
        ]);     
    }
}


class ProjectController extends BaseController
{
    public function __construct() {
        $this->projectModel = new Project();
        $this->projectAdminModel = new ProjectAdmin();
        $this->applicantModel = new Applicant();
        $this->clientModel = new ClientProfile();
        $this->itModel = new ITProfile();
        $this->fileModel = new ClientFiles();
        $this->filesModel = new Files();
        $this->userModel = new User();
        $this->ticketModel = new Ticket();
        $this->commentModel = new Comment();
        $this->systemModel = new SystemLog();
        $this->skillOwnModel = new SkillOwned();
        $this->skillsModel = new SkillList();
        $this->educationModel = new EducationalBackground();
        $this->experienceModel = new WorkExperience();
        $this->commentModel = new Comment();
        $this->ses_usertype = session('usertype');
        $this->sessionid = session('id');
        $this->session_name = session('name');
        $this->email = \Config\Services::email();
    }

    // Project Lists Via Tag Labels
    public function index() {
        $session = session();
        $client = $this->clientModel->where('userId', $session->get('id'))->first();
        $it = $this->itModel->where('userId', $session->get('id'))->first();
        $project = $this->projectModel->where('project_status_flag', 0)->where('clientid', $client['id'])->findAll();     
    
        // Project
        $all = $this->projectModel->where('clientid', $client['id'])->where('project_status_flag', 0)->findAll();
        $notstarted = $this->projectModel->where('project_label', 'Not Started')->where('project_status_flag', 0)->where('clientid', $client['id'])->countAllResults();
        $progress = $this->projectModel->where('project_label', 'In Progress')->where('project_status_flag', 0)->where('clientid', $client['id'])->countAllResults();
        $onhold = $this->projectModel->where('project_label', 'On Hold')->where('project_status_flag', 0)->where('clientid', $client['id'])->countAllResults();
        $cancelled = $this->projectModel->where('project_label', 'Cancelled')->where('project_status_flag', 0)->where('clientid', $client['id'])->countAllResults();
        $completed = $this->projectModel->where('project_label', 'Completed')->where('project_status_flag', 0)->where('clientid', $client['id'])->countAllResults();
        $forapproval = $this->projectModel->where('project_label', 'For Approval')->where('project_status_flag', 0)->where('clientid', $client['id'])->countAllResults();
        $archived = $this->projectModel->where('clientid', $client['id'])->where('project_status_flag', 1)->countAllResults();
        $p_notstarted = $this->projectModel->where('project_label', 'Not Started')->where('project_status_flag', 0)->where('clientid', $client['id'])->findAll();
        $p_progress = $this->projectModel->where('project_label', 'In Progress')->where('project_status_flag', 0)->where('clientid', $client['id'])->findAll();
        $p_hold = $this->projectModel->where('project_label', 'On Hold')->where('project_status_flag', 0)->where('clientid', $client['id'])->findAll();
        $p_cancelled = $this->projectModel->where('project_label', 'Cancelled')->where('project_status_flag', 0)->where('clientid', $client['id'])->findAll();
        $p_completed = $this->projectModel->where('project_label', 'Completed')->where('project_status_flag', 0)->where('clientid', $client['id'])->findAll();
        $p_forapproval = $this->projectModel->where('project_label', 'For Approval')->where('project_status_flag', 0)->where('clientid', $client['id'])->findAll();
        $p_archived = $this->projectModel->where('clientid', $client['id'])->where('project_status_flag', 1)->findAll();
        $all_document = $this->filesModel->where('file_status_flag', 1)->findAll();
        $all_ticket = $this->ticketModel->where(['ticket_status_flag' => 0, 'ticket_label !=' => 'Cancelled', 'is_approved' => 'Yes'])->findAll();

        $avatar = '';
        if(!empty($it)) {
            $avatar = ($it['profile_avatar'] == '')? '' : $it['profile_avatar'];
        } elseif(!empty($client)) {
            $avatar = ($client['profile_avatar'] == '')? '' : $client['profile_avatar'];
        }

        $data = array(
            'session_id'       =>    $this->sessionid,
            'PK_id'            =>    $client['id'],
            'userId'           =>    $client['userId'],
            'name'             =>    $this->session_name,
            'position'         =>    $client['user_position'],
            'contact'          =>    $client['contactnumber'],
            'email'            =>    $client['email'],
            'company'          =>    $client['company'],
            'introduction'     =>    $client['introduction'],
            'avatar'           =>    $avatar,
            'notstarted'       =>    $notstarted,
            'progress'         =>    $progress,
            'completed'        =>    $completed,
            'archived'         =>    $archived,
            'onhold'           =>    $onhold,
            'cancelled'        =>    $cancelled,
            'forapproval'      =>    $forapproval,
            'p_notstarted'     =>    $p_notstarted,
            'p_progress'       =>    $p_progress,
            'p_completed'      =>    $p_completed,
            'p_archived'       =>    $p_archived,
            'p_hold'           =>    $p_hold,
            'p_forapproval'    =>    $p_forapproval,
            'p_cancelled'      =>    $p_cancelled,
            'all_document'     =>    $all_document,
            'all_ticket'       =>    $all_ticket,
            'all'              =>    $all
        );
        return view('project/project', $data);
    }

    // Project Details
    public function viewProject($code) {
        $project = $this->projectModel->where('project_code', $code)->first();
        $id = $project['projectid'];
        $applicants = $this->itModel->select('itprofile.*, tbl_applicant.*')->join('tbl_applicant', 'tbl_applicant.itid = itprofile.id', 'inner')->where('application_status', 0)->orderBy('tbl_applicant.created_at', 'DESC')->findAll();
        $skills = $this->itModel->select('tbl_skill_owned.*, tbl_skillset_list.*, itprofile.id')->join('tbl_skill_owned','tbl_skill_owned.skill_itid = itprofile.id')->join('tbl_skillset_list', 'tbl_skillset_list.skill_setid = tbl_skill_owned.owned_skill_setid')->where(['tbl_skill_owned.skill_status_flag' => 1])->orderBy('tbl_skillset_list.skill_name', 'ASC')->findAll();
        $itpersonels = $this->itModel->where(['profile_status' => 1, 'is_verified' => 'Yes'])->findAll();
        $client = $this->clientModel->where('userId', $this->sessionid)->first();
        $it = $this->itModel->where('userId', $this->sessionid)->first();
        $all_document = $this->filesModel->where('file_status_flag', 0)->findAll();
        $all_comment = $this->commentModel->where('comment_status_flag', 0)->findAll();
        $history = $this->projectModel->select('tbl_logs.*, tbl_project.projectid, user.id, user.name')->join('tbl_logs', 'tbl_project.projectid = tbl_logs.projectid')->join('user', 'tbl_logs.userid = user.id')->where(['tbl_logs.projectid' => $project['projectid'], 'tbl_project.project_status_flag' => 0])->orderBy('tbl_logs.created_at', 'DESC')->findAll();
        
        $avatar = '';
        $is_permitted = '';
        if(!empty($it)) {
            $avatar = ($it['profile_avatar'] == '')? '' : $it['profile_avatar'];
            $is_permitted = ($it['employment_status']== '')? '' : $it['employment_status'];
        } elseif(!empty($client)) {
            $avatar = ($client['profile_avatar'] == '')? '' : $client['profile_avatar'];
        }

        $data = array(
            'history'       =>  $history,
            'itpersonels'   =>  $itpersonels,
            'applicants'    =>  $applicants,
            'skills'        =>  $skills,
            'all_document'  =>  $all_document,
            'all_comment'   =>  $all_comment,
            'project'       =>  $project,
            'client'        =>  $client,
            'name'          =>  $this->session_name,
            'avatar'        =>  $avatar,
            'usertype'      =>  $is_permitted
        );
        
        return view('project/view_project', $data);
    }

    public function projectDetails($projectid) {
        $project = $this->projectModel->find($projectid);
        $all = $this->ticketModel->where(['projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'Yes'])->countAllResults();
        $ns_ticket = $this->ticketModel->where(['ticket_label' => 'Not Started', 'projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'Yes', 'parentid' => 0, 'childid' => 0])->countAllResults();
        $ip_ticket = $this->ticketModel->where(['ticket_label' => 'In Progress', 'projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'Yes', 'parentid' => 0, 'childid' => 0])->countAllResults();
        $cmp_ticket = $this->ticketModel->where(['ticket_label' => 'Completed', 'projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'Yes', 'parentid' => 0, 'childid' => 0])->countAllResults();
        $cnc_ticket = $this->ticketModel->where(['ticket_label' => 'Cancelled', 'projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'Yes', 'parentid' => 0, 'childid' => 0])->countAllResults();
        $hld_ticket = $this->ticketModel->where(['ticket_label' => 'On Hold', 'projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'Yes', 'parentid' => 0, 'childid' => 0])->countAllResults();
        $arc_ticket = $this->ticketModel->where(['projectid' => $projectid, 'ticket_status_flag' => 1])->countAllResults();
        $ap_ticket = $this->ticketModel->where(['projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'No'])->countAllResults();
        $files = $this->filesModel->where(['projectid' => $projectid, 'file_status_flag' => 0])->countAllResults();
        $developers = $this->projectAdminModel->select('itprofile.*, tbl_project_admin.*')->join('itprofile', 'tbl_project_admin.devid = itprofile.id')->where(['tbl_project_admin.projectid' => $projectid, 'tbl_project_admin.pa_status_flag' => 0])->findAll();
        $pm_personel = $this->projectModel->select('itprofile.*, tbl_project.*')->join('itprofile', 'tbl_project.pmid = itprofile.id')->find($projectid);
        $project_owner = $this->projectModel->select('clientprofile.*')->join('clientprofile', 'tbl_project.clientid = clientprofile.id')->where(['tbl_project.projectid' => $projectid])->first();
        $count_applicants = $this->itModel->select('itprofile.*, tbl_applicant.*')->join('tbl_applicant', 'tbl_applicant.itid = itprofile.id', 'inner')->where(['tbl_applicant.projectid' => $projectid, 'application_status' => 0])->countAllResults();
        $userit = $this->itModel->where('userId', $this->sessionid)->first();
        $duedate = new DateTime($project['due_date']);
        $dued_at = $duedate->format("F d, Y");

        $is_permitted = ($this->ses_usertype == 1 && $userit['employment_status'] == 1) ? 'd-none' : '';
        $is_client = ($this->ses_usertype == 2) ? 'd-none' : '';

        $data = array(
            'all'          =>   $all,
            'notStarted'   =>   $ns_ticket,
            'inProgress'   =>   $ip_ticket,
            'completed'    =>   $cmp_ticket,
            'cancelled'    =>   $cnc_ticket,
            'hold'         =>   $hld_ticket,
            'archived'     =>   $arc_ticket,
            'forApproval'  =>   $ap_ticket,
            'files'        =>   $files,
            'developers'   =>   $developers,
            'project'      =>   $project,
            'owner'        =>   $project_owner,
            'manager'      =>   $pm_personel,
            'is_permitted' =>   $is_permitted,
            'is_client'    =>   $is_client,
            'project_due'  =>   $dued_at,
            'applicants'   =>   $count_applicants
        );

        return $this->response->setJSON([
            'error' => false,
            'data' => $data
        ]);
    }

    // Fetch All Data
    public function getAllData() {
        $client = $this->clientModel->where('userId', $this->sessionid)->first();
        $all_document = $this->filesModel->where('file_status_flag', 1)->findAll();
        $all_ticket = $this->ticketModel->where('ticket_status_flag', 0)->findAll();
        $project = $this->projectModel->where('project_status_flag', 0)->where('clientid', $client['id'])->findAll();
        $output ='
        <table class="table table-hover table-bordered" id="dataTableFull0">
        <thead class="bg-light">
            <tr class="text-center">
                <th>TITLE</th>
                <th>TAG/SKILLS</th>
                <th width="20%">DESCRIPTION</th>
                <th>DESIRED DUEDATE</th>
                <th>TICKETS</th>
                <th>DOCUMENTS</th>
                <th>STATUS</th>
                <th>CREATED</th>
                <th>MANAGE</th>
            </tr>
        </thead>
        <tbody>';
        if($project != 0){
            $label = '';
            foreach ($project as $data) {
                $count_ticket = 0; 
                $count_file = 0; 
                if(!empty($all_document)){
                  foreach ($all_document as $file){
                    if($data['projectid'] == $file['projectid']){
                      $count_file++;
                      }
                  }
                }
                if(!empty($all_ticket)){
                    foreach ($all_ticket as $ticket){
                      if($data['projectid'] == $ticket['projectid']){
                        $count_ticket++;
                        }
                    }
                  }
                if($data['project_label'] == 'Not Started'){
                    $label = '<span class="badge border">'.$data['project_label'].'</span>';
                }elseif($data['project_label'] == 'In Progress'){
                    $label = '<span class="badge border-info badge-info">'.$data['project_label'].'</span>';
                }elseif($data['project_label'] == 'Completed'){
                    $label = '<span class="badge border border-success badge-success">'.$data['project_label'].'</span>';
                }elseif($data['project_label'] == 'On Hold'){
                    $label = '<span class="badge border border-warning badge-warning">'.$data['project_label'].'</span>';
                }elseif($data['project_label'] == 'Cancelled'){
                    $label = '<span class="badge border border-danger badge-danger">'.$data['project_label'].'</span>';
                }
                $output .= '
                        <tr class="text-center">
                            <td><a target="_blank" id="'.$data['project_name'].'" class="projectName'.$data['projectid'].'" href="'.base_url().'project/view/projectid='.$data['projectid'].'">'.$data['project_name'].'</a></td>
                            <td>'.$data['specialist_tag'].'</td>
                            <td><div class="text-ellipsis">'.$data['description'].'</div></td>
                            <td>'.$data['due_date'].'</td>
                            <td>'.$count_ticket.'</td>
                            <td>'.$count_file.'</td>
                            <td>'.$label.'</td>
                            <td>'.$data['created_at'].'</td>
                            <td> <a style="cursor:pointer" class="manageProjectStatus" data-id="1" id="'. $data['projectid'].'" class="ticket-file-upload"><span data-toggle="tooltip" title="Move to Archived"><i class="bi bi-calendar2-x text-danger"></i></span></a></td>
                        </tr>';
            } 
            $output .='</tbody> </table>';
            return $this->response->setJSON([
                'error' => false,
                'message'   => $output
            ]);
        }
    }

    // Create Projects
    public function createProject() {
        try {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $randomString = substr(str_shuffle($characters), 0, 10);
            $data = array(
                'project_name' => $this->request->getVar('project_title'),
                'clientid' => $this->request->getVar('clientid'),
                'allot_skills' => $this->request->getVar('skills'),
                'specialist_tag' => $this->request->getVar('specialist'),
                'project_budget' => $this->request->getVar('offered_rate'),
                'start_date' => $this->request->getVar('start_date'),
                'due_date' => $this->request->getVar('due_date'),
                'project_allot_time' => $this->request->getVar('allot_time'),
                'description' => $this->request->getVar('project_description'),
                'project_code' => $randomString,
                'project_label' => 'Not Started'
            );
           
            if($this->projectModel->save($data)){
                return $this->response->setJSON([
                    'error'   => false,
                    'status'  => 200,
                    'title'   => 'Cheers',  
                    'message' => 'Project has been created!'
                ]);
            } 
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // Update Project Details
    public function updateProject() {
        try {
            $projectid = $this->request->getVar('projectid');
            $data = array(
                'project_name' => $this->request->getVar('project_title'),
                'project_label' => $this->request->getVar('project_status'),
                'clientid' => $this->request->getVar('clientid'),
                'allot_skills' => $this->request->getVar('skills'),
                'specialist_tag' => $this->request->getVar('specialist'),
                'project_budget' => $this->request->getVar('offered_rate'),
                'start_date' => $this->request->getVar('start_date'),
                'due_date' => $this->request->getVar('due_date'),
                'description' => $this->request->getVar('project_description'),
            );
            if($this->projectModel->update($projectid ,$data)){
                $this->session->setFlashdata('success', $this->request->getVar('project_title').' Updated Successfully!');
                $logs = array(
                    'userid' => $this->sessionid,
                    'projectid' => $projectid,
                    'action_activity'   => 'Some of ' .$this->request->getVar('project_title'). ' informations was updated'
                );
                $this->systemModel->save($logs);
                return redirect()->back();
            } 
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // Assign Personel
    public function assignPersonel() {
        try {
            $projectid = $this->request->getVar('projectid');
            $column = $this->request->getVar('column');
            $value = $this->request->getVar('value');
            $profile = $this->itModel->where('id', $value)->first();
            $project = $this->projectModel->where('projectid', $projectid)->first();

            $data = array($column =>  $value);
            if($this->projectModel->update($projectid ,$data)) {
                $data2 = array(
                    'employment_status'  =>  2    
                );
                $this->itModel->update($profile['id'] ,$data2);
                $logs = array(
                    'userid'            =>  $this->sessionid,
                    'projectid'         =>  $projectid,
                    'action_activity'   =>  $profile['name'] . ' was selected and assigned as Project Manager to this project.' 
                );
                if($this->systemModel->save($logs)) {
                    $to      = ''.$profile['email'].'';
                    $subject = 'Welcome to '.$project['project_name'].' Team!';
                    $message = 'Dear '.$profile['name'].',<br><br>
                    I hope this email finds you well. I wanted to take a moment to personally welcome you to the <strong>'.$project['project_name'].' team as a Project Manager.</strong> We are thrilled to have you on board and excited about the skills and expertise you bring to our development efforts.
                    <br><br>
                    As a newly hired developer, you will play a crucial role in our project`s success. We believe that your knowledge and experience will greatly contribute to our team`s ability to deliver high-quality software solutions. Your skills align perfectly with the requirements of the <strong>'.$project['project_name'].'</strong>, and we are confident that you will make valuable contributions right from the start.
                    <br><br>
                    Once again, welcome to the <strong>'.$project['project_name'].' team project!</strong>  We are delighted to have you on board and look forward to working together to achieve our shared goals.
                    <br><br><br>
                    Best regards,
                    
                    <strong>IT Blaster Management Services</strong><br>
                        1-703-906-9719
                    ';
                    $this->email->initialize(email_settings());
                    $this->email->setTo($to);
                    // $this->email->setCC('arnel@consultareinc.com, sbrandonjake@gmail.com, sagarinoken29@gmail.com');
                    $this->email->setFrom('services@itblaster.net', 'IT Blaster Management Services');
                    $this->email->setSubject($subject);
                    $this->email->setMessage($message);
                    if ($this->email->send()) {
                        $this->session->setFlashdata('success', ' '.$profile['name'].' Successfully Assigned to this Project!');
                        return redirect()->back();
                    } else {
                        $this->session->setFlashdata('error', 'Something went wrong! Please try Again later.');
                        return redirect()->back();
                    }
                }
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }
    
    public function assignDevelopers(){
        try {
            $projectid = $this->request->getVar('projectid');
            $bulk_data = array();
                foreach($this->request->getVar('developers') as $key => $value){
                    $projectadmin = array(
                        'clientid'  => $this->request->getVar('clientid'),
                        'devid'  => $this->request->getVar('developers')[$key],
                        'projectid'  => $projectid
                    );
                    $bulk_data[] = $projectadmin;    
                }
                if($this->projectAdminModel->insertBatch($bulk_data)) {
                    $this->session->setFlashdata('success', 'Developers Selected and Assigned to this project Successfully!');
                    $logs = array(
                        'userid'            =>  $this->sessionid,
                        'projectid'         =>  $projectid,
                        'action_activity'   =>  'New Developer(s) was selected and assigned to this project.' 
                    );
                    if($this->systemModel->save($logs)) {
                        return redirect()->back();
                    }
                }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // Accept/Hire Applicant Developer
    public function hireDeveloper() {
        try {
            $applicationid = $this->request->getVar('applicationid');
            $applicantid = $this->request->getVar('applicantid');
            $projectid = $this->request->getVar('projectid');

            $profile = $this->itModel->where('id', $applicantid)->first();
            $project = $this->projectModel->where('projectid', $projectid)->first();

            $data = array(
                'employment_status' =>  1,
                'is_availability' =>  'No',
            );
            if($this->itModel->update($profile['id'] ,$data)){
                $status = array('application_status' => 1);
                if($this->applicantModel->update($applicationid, $status)) {
                    $admin = array(
                        'clientid'  => $this->request->getVar('clientid'),
                        'devid'  => $this->request->getVar('applicantid'),
                        'projectid'  => $this->request->getVar('projectid')
                    );
                    $this->projectAdminModel->save($admin);
                }
                $logs = array(
                    'userid'            =>  $this->sessionid,
                    'projectid'         =>  $projectid,
                    'action_activity'   =>  $profile['name'] . ' was selected and assigned as Developer to this project.' 
                );  
                if($this->systemModel->save($logs)) {
                    $to      = ''.$profile['email'].'';
                    $subject = 'Welcome to '.$project['project_name'].' Team!';
                    $message = 'Dear '.$profile['name'].',<br><br>
                    I hope this email finds you well. I wanted to take a moment to personally welcome you to the <strong>'.$project['project_name'].' team project!</strong> We are thrilled to have you on board and excited about the skills and expertise you bring to our development efforts.
                    <br><br>
                    As a newly hired developer, you will play a crucial role in our project`s success. We believe that your knowledge and experience will greatly contribute to our team`s ability to deliver high-quality software solutions. Your skills align perfectly with the requirements of the <strong>'.$project['project_name'].'</strong>, and we are confident that you will make valuable contributions right from the start.
                    <br><br>
                    Once again, welcome to the <strong>'.$project['project_name'].' team project!</strong>  We are delighted to have you on board and look forward to working together to achieve our shared goals.
                    <br><br><br>
                    Best regards,
                    
                    <strong>IT Blaster Management Services</strong><br>
                        1-703-906-9719
                    ';
                    $this->email->initialize(email_settings());
                    $this->email->setTo($to);
                    // $this->email->setCC('arnel@consultareinc.com, sbrandonjake@gmail.com, sagarinoken29@gmail.com');
                    $this->email->setFrom('services@itblaster.net', 'IT Blaster Management Services');
                    $this->email->setSubject($subject);
                    $this->email->setMessage($message);
                    if ($this->email->send()) {
                        return $this->response->setJSON([
                                'error'   => false,
                                'status'  => 200,
                                'title'   => 'Cheers',  
                                'message' => $profile['name']. ' Successfully Assigned to this Project!'
                        ]);
                    } else {
                        $this->session->setFlashdata('error', 'Something went wrong! Please try Again later.');
                        return redirect()->back();
                    }
                } 
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // Visit Application Profile
    public function viewApplicantProfile($id) {
        $profile = $this->itModel->find($id);
        $user =  $this->itModel->where('userId', $this->sessionid)->first();
        $client =  $this->clientModel->where('userId', $this->sessionid)->first();
        $education = $this->educationModel->where('educational_bg_profile_id', $profile['userId'])->findAll();
        $skills = $this->itModel->select('tbl_skill_owned.*, tbl_skillset_list.*, itprofile.id')->join('tbl_skill_owned','tbl_skill_owned.skill_itid = itprofile.id')->join('tbl_skillset_list', 'tbl_skillset_list.skill_setid = tbl_skill_owned.owned_skill_setid')->where(['tbl_skill_owned.skill_status_flag' => 1, 'tbl_skill_owned.skill_itid'    =>  $profile['id']])->orderBy('tbl_skillset_list.skill_name', 'ASC')->findAll();
        $experience = $this->experienceModel->where('work_xp_profile_id', $profile['userId'])->findAll();
        $project_count = $this->projectModel->select('tbl_project.*, tbl_project_admin.*')->join('tbl_project_admin', 'tbl_project.projectid = tbl_project_admin.projectid')->join('itprofile', 'tbl_project_admin.devid = itprofile.id')->where(['tbl_project_admin.devid' => $profile['id'], 'pa_status_flag' => 0, 'tbl_project.project_label' => 'Completed'])->countAllResults();
        $projects = $this->projectModel->select('tbl_project.*, tbl_project_admin.*')->join('tbl_project_admin', 'tbl_project.projectid = tbl_project_admin.projectid')->join('itprofile', 'tbl_project_admin.devid = itprofile.id')->where(['tbl_project_admin.devid' => $profile['id'], 'pa_status_flag' => 0, 'tbl_project.project_label' => 'Completed'])->findAll();
        $current = $this->projectModel->select('tbl_project.*, tbl_project_admin.*')->join('tbl_project_admin', 'tbl_project.projectid = tbl_project_admin.projectid')->join('itprofile', 'tbl_project_admin.devid = itprofile.id')->where(['tbl_project_admin.devid' => $profile['id'], 'pa_status_flag' => 0, 'tbl_project.project_label !=' => 'Completed'])->findAll();
        $avatar = '';
        if(!empty($user)) {
            $avatar = ($user['profile_avatar'] == '')? '' : $user['profile_avatar'];
        } elseif(!empty($client)) {
            $avatar = ($client['profile_avatar'] == '')? '' : $client['profile_avatar'];
        }
        $data = array(
            'profile'       =>   $profile,
            'name'          =>   $profile['name'],
            'avatar'        =>   $avatar,
            'project_count' =>   $project_count,
            'projects'      =>   $projects,
            'current'       =>   $current,
            'education'     =>   $education,
            'skills'        =>   $skills,
            'experience'    =>   $experience
        );
        return view('project/view_applicant_profile', $data);
    }

    // Remove Assigned Project
    public function removeAssignedPersonel() {
        try {
            $personeltype = $this->request->getVar('personeltype');
            $personelid = $this->request->getVar('personelid');
            $projectid = $this->request->getVar('projectid');
            $profile = $this->itModel->where('id', $personelid)->first();
            if($personeltype == 2) {
                $data = array(
                    'pmid'  => NULL
                );
                if($this->projectModel->update($projectid, $data)){
                    $data = array('employment_status'  => 0);
                    $this->itModel->update($personelid, $data);

                    $log = array(
                        'userid' => $this->sessionid,
                        'history_remarks'   => $this->request->getVar('remarks'),
                        'projectid'   => $this->request->getVar('projectid'),
                        'action_activity' => $this->request->getVar('activity')
                    );
                    if( $this->systemModel->save($log)) {
                        $to      = ''.$profile['email'].'';
                        $subject = 'Removal from Project Team';
                        $message = 'Dear '.$profile['name'].',<br><br>
                        I hope this email finds you well. I am writing to inform you about a recent decision made by the project management team regarding your involvement in the project. After careful consideration and evaluation, we have regretfully decided to remove you from the project team, effective immediately.
                        <br><br>
                        Please be aware that this decision was not made lightly, and it was based on a thorough assessment of various factors, including project requirements, team dynamics, and individual contributions. While we acknowledge your efforts and contributions thus far, we believe that this adjustment is necessary to ensure the project`s success and maintain optimal productivity within the team.
                        <br><br>
                        We understand that this news may come as a disappointment, and we want to assure you that it does not reflect on your skills or abilities. We highly value your expertise and the contributions you have made during your time on the project. However, due to recent changes in project scope and resource allocation, we have had to make difficult decisions to realign team responsibilities.
                        <br><br>
                        Moving forward, your manager will work closely with you to discuss alternative projects or tasks that align with your skill set and interests. We encourage you to express any concerns or seek further clarification during this conversation. It is important to us that you remain an integral part of the organization, and we are committed to finding suitable opportunities for your professional growth.
                        <br><br>
                        We appreciate your understanding and cooperation in this matter. Should you have any questions or require additional information, please do not hesitate to reach out to your manager or me directly. We are here to support you during this transition period.
                        <br><br>
                        Thank you for your hard work and dedication to the project. We look forward to your continued contributions to our organization.
                        <br><br>
                        Sincerely,
                        <br><br><br>
                        <strong>IT Blaster Management Services</strong><br>
                        1-703-906-9719
                        ';
                        $this->email->initialize(email_settings());
                        $this->email->setTo($to);
                        $this->email->setCC('arnel@consultareinc.com');
                        $this->email->setFrom('services@itblaster.net', 'IT Blaster Management Services');
                        $this->email->setSubject($subject);
                        $this->email->setMessage($message);
                        if ($this->email->send()) {
                            return $this->response->setJSON([
                                'error'   => false,
                                'status'  => 200,
                                'title'   => 'Cheers',  
                                'message' => $profile['name']. ' Successfully Assigned to this Project!'
                            ]);
                        }
                    }
                } 
            } else {
                $admins = $this->projectAdminModel->where('projectid', $projectid)->first();
                $adminid = $admins['pa_projectid'];
                if($this->projectAdminModel->where('pa_projectid', $adminid)->delete()) {
                    $update_user = array('employment_status'  => 0);
                    $this->itModel->update($personelid, $update_user);

                    $log = array(
                        'userid' => $this->sessionid,
                        'history_remarks'   => $this->request->getVar('remarks'),
                        'projectid'   => $this->request->getVar('projectid'),
                        'action_activity' => $this->request->getVar('activity')
                    );
                    if( $this->systemModel->save($log)) {
                        $to      = ''.$profile['email'].'';
                        $subject = 'Removal from Project Team';
                        $message = 'Dear '.$profile['name'].',<br><br>
                        I hope this email finds you well. I am writing to inform you about a recent decision made by the project management team regarding your involvement in the project. After careful consideration and evaluation, we have regretfully decided to remove you from the project team, effective immediately.
                        <br><br>
                        Please be aware that this decision was not made lightly, and it was based on a thorough assessment of various factors, including project requirements, team dynamics, and individual contributions. While we acknowledge your efforts and contributions thus far, we believe that this adjustment is necessary to ensure the project`s success and maintain optimal productivity within the team.
                        <br><br>
                        We understand that this news may come as a disappointment, and we want to assure you that it does not reflect on your skills or abilities. We highly value your expertise and the contributions you have made during your time on the project. However, due to recent changes in project scope and resource allocation, we have had to make difficult decisions to realign team responsibilities.
                        <br><br>
                        Moving forward, your manager will work closely with you to discuss alternative projects or tasks that align with your skill set and interests. We encourage you to express any concerns or seek further clarification during this conversation. It is important to us that you remain an integral part of the organization, and we are committed to finding suitable opportunities for your professional growth.
                        <br><br>
                        We appreciate your understanding and cooperation in this matter. Should you have any questions or require additional information, please do not hesitate to reach out to your manager or me directly. We are here to support you during this transition period.
                        <br><br>
                        Thank you for your hard work and dedication to the project. We look forward to your continued contributions to our organization.
                        <br><br>
                        Sincerely,
                        <br><br><br>
                        <strong>IT Blaster Management Services</strong><br>
                        1-703-906-9719
                        ';
                        $this->email->initialize(email_settings());
                        $this->email->setTo($to);
                        $this->email->setCC('arnel@consultareinc.com');
                        $this->email->setFrom('services@itblaster.net', 'IT Blaster Management Services');
                        $this->email->setSubject($subject);
                        $this->email->setMessage($message);
                        if ($this->email->send()) {
                            return $this->response->setJSON([
                                'error'   => false,
                                'status'  => 200,
                                'title'   => 'Cheers',  
                                'message' => $profile['name']. ' Successfully Assigned to this Project!'
                            ]);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // TICKETS
    public function createTicket() {
        try {
            $user = $this->itModel->where('userId', $this->sessionid)->first();
            $client = $this->clientModel->where('userId', $this->sessionid)->first();
            $projectid = $this->request->getVar('projectid');
            if(!empty($user)) {
                $usertype = $user['employment_status'];
                $is_approved = ($usertype == 2) ? 'Yes' : 'No';
                $label = ($usertype == 2) ? $this->request->getVar('status') : 'Not Started';
                
                $data = array(
                    'clientid' => $this->request->getVar('clientid'),
                    'projectid' => $this->request->getVar('projectid'),
                    'ticket_title' => $this->request->getVar('title'),
                    'ticket_start_date' => $this->request->getVar('duedate'),
                    'ticket_alloted_time' => $this->request->getVar('alloted_time'),
                    'ticket_due_date' => $this->request->getVar('duedate'),
                    'ticket_task_description' => $this->request->getVar('description'),
                    'ticket_priority_label' => $this->request->getVar('priority'),
                    'parentid' => $this->request->getVar('parentid'),
                    'childid' => $this->request->getVar('childid'),
                    'ticket_label' => $label,
                    'is_approved' => $is_approved
                );
            } elseif(!empty($client)) {
                $data = array(
                    'clientid' => $this->request->getVar('clientid'),
                    'projectid' => $this->request->getVar('projectid'),
                    'ticket_title' => $this->request->getVar('title'),
                    'ticket_start_date' => $this->request->getVar('duedate'),
                    'ticket_alloted_time' => $this->request->getVar('alloted_time'),
                    'ticket_due_date' => $this->request->getVar('duedate'),
                    'ticket_task_description' => $this->request->getVar('description'),
                    'ticket_priority_label' => $this->request->getVar('priority'),
                    'parentid' => $this->request->getVar('parentid'),
                    'childid' => $this->request->getVar('childid'),
                    'ticket_label' =>  $this->request->getVar('status'),
                    'is_approved' => 'Yes'
                );
            }
            
            if($this->ticketModel->save($data)){
                $updateData = array('last_update' => date('Y-m-d H:i:s'));
                // Update the project with the correct projectid
                $this->projectModel->where('projectid', $projectid)->update($updateData);
                
                $log = array(
                    'userid' => $this->sessionid,
                    'projectid' => $this->request->getVar('projectid'),
                    'action_activity' => 'New Ticket Added by '. $this->session_name
                );
                if($this->systemModel->save($log)) {
                    return redirect()->back();
                }
            } 
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // Add Ticket Comment
    public function addTicketComment() {
        try {
            $projectid = $this->request->getVar('projectid');
            $data = array(
                'ticketid' => $this->request->getVar('ticketid'),
                'userid' => $this->sessionid,
                'comment_content' => $this->request->getVar('comment')
            );
            if($this->commentModel->save($data)) {
                $logs = array(
                    'userid' => $this->sessionid,
                    'projectid' => $this->request->getVar('projectid'),
                    'action_activity' => 'Adding Comment on Ticket#'.' '. $this->request->getVar('ticketid')
                );
                if($this->systemModel->save($logs)) {
                    return $this->response->setJSON([
                        'error' => false,
                        'title' => 'Cheers!',
                        'text'   => 'Comment successfully added to this ticket.'
                    ]);
                }
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // View Ticket Details
    public function viewTicketDetails($id) {
        $ticket = $this->ticketModel->find($id);
        $comments = $this->commentModel->select('tbl_comment.*, itprofile.name, itprofile.profile_avatar, itprofile.id')->join('itprofile', 'tbl_comment.userid = itprofile.userId')->where('ticketid', $ticket['ticketid'])->findAll();
        $files = $this->filesModel->where('ticketid', $ticket['ticketid'])->findAll();

        $tcomments = '';
        if(!empty($comments)) {
            foreach ($comments as $comment) {
                $tcomments .='
                      <div>
                        <img data-toggle="tooltip" title="'.$comment['name'].'" class="direct-chat-img img-bordered-sm" src="/uploads/files/'.$comment['name'].'/'.$comment['profile_avatar'].'" alt="message user image" style="margin-left:15px; width: 35px; height: 35px;">
                        <div class="timeline-item">
                            <!-- header -->
                            <span class="time"><i class="far fa-clock"></i> <span id="commentTime'.$comment['commentid'].'"></span></span>
                            <h3 class="timeline-header"><a href="#">'.$comment['name'].'</a></h3>

                            <div class="timeline-body">
                                '.$comment['comment_content'].'
                            </div>
                        </div>
                      </div>
                    <script>
                        var inputTime = "'.$comment['created_at'].'";
                        var parsedTime = new Date(inputTime);
        
                        var month = parsedTime.toLocaleString("default", { month: "short" });
                        var day = parsedTime.getDate();
                        var year = parsedTime.getFullYear();
                        var hours = parsedTime.getHours();
                        var minutes = parsedTime.getMinutes();
                    
                        var formattedTime = month + " " + day + " " + year + " " + hours + ":" + minutes;
                        $("#commentTime'.$comment['commentid'].'").html(formattedTime);
                    </script>
                    
                ';
            }
        } else {
            $tcomments .='No Comment to this ticket yet.';
        }


        $tfiles = '';
        if(!empty($files)) {
            foreach ($files as $file) {
                $icon  = '';
                $color = '';
                if(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'pdf'){
                    $color = 'danger';
                    $icon  = 'file-earmark-pdf';
                }elseif(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'docx' || pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'doc'){
                    $color = 'primary';
                    $icon  = 'file-earmark-word';
                }elseif(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'xlsx' || pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'xls'){
                    $color = 'success';
                    $icon  = 'file-earmark-excel';
                }elseif(pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'xlsx' && pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'xls' && pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'pdf' && pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'docx' && pathinfo($file['file_name'], PATHINFO_EXTENSION) != 'doc'){
                    $color = '';
                    $icon  = 'filetype-'.pathinfo($file['file_name'], PATHINFO_EXTENSION);
                }
                $tfiles .='
                <div class="col-md-4 mb-3">
                    <div class="custom-card">
                        <div class="custom-card-body">
                            <div class="d-flex align-items-center">
                            <i class="bi bi-'.$icon.' text-'.$color.' px-2" style="font-size:30px"></i> 
                            <a href="#" data-toggle="tooltip" title="Upload/View">'.$file['file_name'].'</a>
                            </div>
                        </div>
                    </div>
                    <span style="color:#999; font-size:12px"><i class="far fa-clock px-2"></i><span id="uploadedTime'.$file['fileid'].'"></span></span>
                </div>
                <script>
                    var inputTime = "'.$file['created_at'].'";
                    var parsedTime = new Date(inputTime);

                    var month = parsedTime.toLocaleString("default", { month: "short" });
                    var day = parsedTime.getDate();
                    var year = parsedTime.getFullYear();
                    var hours = parsedTime.getHours();
                    var minutes = parsedTime.getMinutes();

                    var formattedTime = month + " " + day + " " + year + " " + hours + ":" + minutes;
                    document.getElementById("uploadedTime'.$file['fileid'].'").innerHTML = formattedTime;
                </script>
                ';
            }
        } else {
            $tfiles .='No Files Uploaded to this ticket yet.';
        } 

        

        return $this->response->setJSON([
            'error' => false,
            'message' => $ticket,
            'comment'   => $tcomments,
            'file'   => $tfiles
        ]);
    }

    // Attached File Ticket
    public function attachedFiles() {
        try {
            $project_name = $this->request->getVar('project_name');
            $projectid = $this->request->getVar('projectid');
            $validated = $this->validate([
                'file' => [
                    'uploaded[file]',
                    'max_size[file,4096]',
                ],
            ]);
            if ($validated) {
                $file = $this->request->getFile('file');
                $fileDir = '/files/'.$project_name.'/ticket';
                $file->move('uploads'.$fileDir);
                $data = array(
                    'ticketid' =>  $this->request->getVar('ticketid'),
                    'file_name' =>  $file->getClientName(),
                    'userid' =>  $this->sessionid,
                    'file_type' => $file->getClientMimeType()
                );
                if($this->filesModel->save($data)){
                    $log = array(
                        'userid' => $this->sessionid,
                        'projectid' => $projectid,
                        'action_activity' => 'Attached new file in Ticket#'.' '. $this->request->getVar('ticketid')
                    );
                    if($this->systemModel->save($log)) {
                        return $this->response->setJSON([
                            'status'    => '200',
                            'error'     => 'false',
                            'title'     => 'Cheers',
                            'text'      => 'File Attached to the Ticket Successfully Added!'
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // Manage Project Status
    public function manageProjectStatus() {
        try {
            $projectid = $this->request->getVar('projectid');
            $data = array(
                'project_status_flag' => $this->request->getVar('status')
            );

            if($this->projectModel->update($projectid, $data)) {
                $log = array(
                    'userid' => $this->sessionid,
                    'projectid' => $this->request->getVar('projectid'),
                    'action_activity' => 'ID:'. $projectid . ' ' .$this->request->getVar('action')
                );
                if($this->systemModel->save($log)) {
                    return redirect()->back();
                }
            }

        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    // Get all Ticket Comments
    public function getTicketComments() {
        $comments = $this->commentModel->findAll();
        $tickets = $this->ticketModel->findAll();

        foreach ($tickets as $ticket) {
            foreach ($comments as $comment) {
                if($comment['ticketid'] == $ticket['ticketid']) {
                    print_r($comment['ticketid']);
                }
            }
        }

    }

    public function getTicketHistory($id){
        $ticket = $this->ticketModel->find($id);
    }

    public function getAllProjectTicket($projectid) {
        $ticket = $this->ticketModel->where(['projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'Yes', 'parentid' => 0, 'childid' => 0])->orderBy('ticketid', 'DESC')->findAll();
        $all_document = $this->filesModel->where('file_status_flag', 0)->findAll();
        $all_comment = $this->commentModel->where('comment_status_flag', 0)->findAll();
        $all_ticket = $this->ticketModel->select('parentid, ticket_label, childid')->where(['projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'Yes'])->findAll();

        $userit = $this->itModel->where('userId', session('id'))->first();
        $user_type = session('usertype');

        $is_permitted = ($user_type == 1 && $userit['employment_status'] == 1) ? 'd-none' : '';
        $is_client = ($user_type == 2) ? 'd-none' : '';
        $result = '';
        if(!empty($ticket)) {
            $result .='<table class="table table-hover table-bordered" id="dataTableFull1">
                <thead class="bg-light">
                <tr class="text-center">
                <th width="4%"></th>
                  <th width="10%">TICKET #</th>
                  <th width="20%">DESCRIPTION</th>
                  <th>DESIRED DUEDATE</th>
                  <th>SUB TICKETS</th>
                  <th>DOCUMENTS</th>
                  <th>COMMENTS</th>
                  <th>STATUS</th>
                  <th width="10%" class="text-center">CREATED</th>
                  <th class='.$is_permitted.'>MANAGE</th>
                </tr>
                </thead>
                <tbody>';
            foreach ($ticket as $data) {
                $ticketLabelClasses = [
                    'Not Started' => 'badge border',
                    'In Progress' => 'badge border-success badge-info',
                    'On Hold' => 'badge border border-warning badge-warning',
                    'Cancelled' => 'badge border border-danger badge-danger',
                    'Completed' => 'badge border border-light badge-success'
                ];
    
                $ticketPriorityClasses = [
                    'Low' => 'secondary',
                    'Moderate' => 'success',
                    'High' => 'warning',
                    'Very High' => 'danger'
                ];
    
                $ticketLabel = $ticketLabelClasses[$data['ticket_label']] ?? '';
                $label = '<span class="'.$ticketLabel.'">'.$data['ticket_label'].'';
                $ticketPriorityLabel = $data['ticket_priority_label'];
                $priorityColorClass = $ticketPriorityClasses[$ticketPriorityLabel] ?? '';
    
                $priority = '';
                if ($priorityColorClass) {
                    $priority = '<span class="px-2"><i class="bi bi-flag-fill text-' . $priorityColorClass . '" data-toggle="tooltip" title="' . $ticketPriorityLabel . '"></i></span>';
                }

               $total_completion = 0;

                $count_file = count(array_filter($all_document, function ($file) use ($data) {
                    return $data['ticketid'] == $file['ticketid'];
                }));

                $count_comment = count(array_filter($all_comment, function ($comment) use ($data) {
                    return $data['ticketid'] == $comment['ticketid'];
                }));

                $count_subtask = 0;
                $count_completed_tickets = 0;
                $count_gsubtask = 0;
                foreach ($all_ticket as $ticket) {
                    if ($data['ticketid'] == $ticket['parentid']) {
                        if ($ticket['ticket_label'] == 'Completed') {
                            $count_completed_tickets++;
                        }
                        $count_subtask++;
                    }
                }

                $total_subtask = $count_subtask + $count_gsubtask;
                $main_ticket = ($data['ticket_label'] == 'Completed') ? 1 : 0;

                $x = $count_subtask + 1;
                $y = $count_completed_tickets + $main_ticket;

                if ($x > 0) {
                    $total_completion = round($y / $x * 100);
                }

                 $duedate = new DateTime($data['ticket_due_date']);
                 $dued_at = $duedate->format("F d, Y");

                 $created_date = new DateTime($data['created_at']);
                 $created_at = $created_date->format("F d, Y");
                 
               $result .='
               <tr class="text-center">
               <td>
                 <a data-toggle="modal" data-target="#add-ticket-modal" class="addSubTask" id="'.$data['ticketid'].'"><i data-toggle="tooltip" title="Add Sub-ticket" class="bi bi-plus-square-fill h5 text-info"></i></a>
                 <a data-toggle="canvas" data-target="#bs-canvas-right" aria-expanded="false" onclick="showOffcanvas()" aria-controls="bs-canvas-right" class="offCanvas" id="'.$data['ticketid'].'"><i data-toggle="tooltip" title="View Ticket History/Ticket Sub-task" class="bi bi-arrow-left-square-fill h5 text-info"></i></a>
               </td>
               <td>
                 '.$priority.'<a style="cursor:pointer" class="view-ticket-details" id="'.$data['ticketid'].'" data-toggle="modal" data-target="#view-ticket-modal"><span data-toggle="tooltip" title="View ticket"> TICKET #'.$data['ticketid'].'</span></a>
                 <div class="px-3">
                   <div class="progress">
                     <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                         aria-valuenow="'.$total_completion.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$total_completion.'%">
                     </div>
                   </div>
                 </div>
                   <span>'.$total_completion.'% Complete</span>
               </td>
               <td><div class="text-ellipsis">'.$data['ticket_task_description'].'</div></td>
               <td>'.$dued_at.'</td>
               <td>'.$total_subtask.'</td>
               <td>'.$count_file.'</td>
               <td>'.$count_comment.'</td>
               <td>'.$label.'</td>
               <td>'.$created_at.'</td>
               <td class="'.$is_permitted.'">
                 <div class="d-flex justify-content-center gap-2">
                   <a class="ticketArchive" id="'. $data['ticketid'].'" class="ticket-file-upload"><span data-toggle="tooltip" title="Move to Archived"><i class="bi bi-calendar2-x text-danger"></i></span></a>  
                 </div>
               </td>
             </tr>
               ';
           }
           $result .='
               </tbody>
           </table>
           ';
        }
        return $this->response->setJSON([
            'error' => false,
            'result' => $result
            // 'subTickets' => $all_ticket
        ]);  
    }

    public function ticketTabDetails($status, $projectid){
        $projectid = $this->request->getVar('projectid');
        $ticket = $this->ticketModel->where(['ticket_label' => $status, 'projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'Yes', 'parentid' => 0, 'childid' => 0])->orderBy('ticketid', 'DESC')->findAll();
        $all_document = $this->filesModel->where('file_status_flag', 0)->findAll();
        $all_comment = $this->commentModel->where('comment_status_flag', 0)->findAll();
        $forapprovalTicket = $this->ticketModel->where(['projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'No'])->orderBy('ticketid', 'DESC')->findAll();
        $archivedTicket = $this->ticketModel->where(['projectid' => $projectid, 'ticket_status_flag' => 1])->orderBy('ticketid', 'DESC')->findAll();
        $all_ticket = $this->ticketModel->select('parentid, ticket_label, childid')->where(['projectid' => $projectid, 'ticket_status_flag' => 0, 'is_approved' => 'Yes'])->findAll();
        $result = '';
        $userit = $this->itModel->where('userId', session('id'))->first();
        $user_type = session('usertype');

        $is_permitted = ($user_type == 1 && $userit['employment_status'] == 1) ? 'd-none' : '';
        $is_client = ($user_type == 2) ? 'd-none' : '';
        if($status == 'Archived') {
            $result .= '<table class="table table-hover table-bordered" id="dataTableFull1">
            <thead class="bg-light">
              <tr>
                <th class="text-center">TICKET #</th>
                <th class="text-center" width="20%">DESCRIPTION</th>
                <th class="text-center">DESIRED DUEDATE</th>
                <th class="text-center">DOCUMENTS</th>
                <th class="text-center">COMMENTS</th>
                <th class="text-center">STATUS</th>
                <th width="10%" class="text-center">CREATED</th>
                <th width="10%" class="text-center '.$is_permitted.'">ACTION</th>
              </tr>
              </thead>
              <tbody>';
              if(!empty($archivedTicket)) { 
                foreach ($archivedTicket as $data) {
                    $ticketPriorityClasses = [
                        'Low' => 'secondary',
                        'Moderate' => 'success',
                        'High' => 'warning',
                        'Very High' => 'danger'
                    ];

                    $ticketPriorityLabel = $data['ticket_priority_label'];
                    $priorityColorClass = $ticketPriorityClasses[$ticketPriorityLabel] ?? '';
        
                    $priority = '';
                    if ($priorityColorClass) {
                        $priority = '<span class="px-2"><i class="bi bi-flag-fill text-' . $priorityColorClass . '" data-toggle="tooltip" title="' . $ticketPriorityLabel . '"></i></span>';
                    }

                    if (!empty($all_document)) {
                        $count_file = count(array_filter($all_document, function ($file) use ($data) {
                            return $file['ticketid'] === $data['ticketid'];
                        }));
                    } else {
                        $count_file = 0;
                    }

                    if (!empty($all_comment)) {
                        $count_comment = count(array_filter($all_comment, function ($comment) use ($data) {
                            return $comment['ticketid'] === $data['ticketid'];
                        }));
                    } else {
                        $count_comment = 0;
                    }

                    $inputDateTimeCreated = new DateTime($data['created_at']);
                    $outputDateCreated = $inputDateTimeCreated->format("F d, Y");

                    $inputDateTimeDue = new DateTime($data['ticket_due_date']);
                    $outputDateDue = $inputDateTimeDue->format("F d, Y");
                    $userit = $this->itModel->where('userId', session('id'))->first();
                    $user_type = session('usertype');

                    $is_permitted = ($user_type == 1 && $userit['employment_status'] == 1) ? 'd-none' : '';
                    $is_client = ($user_type == 2) ? 'd-none' : '';

                    $result .= '
                    <tr class="text-center">
                    <td>'.$priority.'<a style="cursor:pointer" class="view-ticket-details" id="'.$data['ticketid'].'" data-toggle="modal" data-target="#view-ticket-modal"><span data-toggle="tooltip" title="View ticket"> TICKET #'.$data['ticketid'].'</span></a></td>
                    <td><div class="text-ellipsis">'.$data['ticket_task_description'].'</div></td>
                    <td>'.$outputDateDue.'</td>
                    <td>'.$count_file.'</td>
                    <td>'.$count_comment.'</td>
                    <td><span class="badge border bg-secondary">Archived</span></td>
                    <td>'.$outputDateCreated.'</td>
                    <td class="'.$is_permitted.'">
                      <div class="d-flex justify-content-center gap-2">
                        <a style="cursor:pointer" class="restoreTicket" data-toggle="tooltip" title="Restore" id="'. $data['ticketid'].'" class="ticket-file-upload"> <i class="bi bi-recycle text-success" style="font-size: 16px !important;"></i></a>  
                      </div>
                    </td>
                  </tr>
                    ';
                }
              }
              $result .= '</tbody>
              </table>';
        } elseif($status == 'For Approval') {
            $userit = $this->itModel->where('userId', session('id'))->first();
            $user_type = session('usertype');

            $is_permitted = ($user_type == 1 && $userit['employment_status'] == 1) ? 'd-none' : '';
            $is_client = ($user_type == 2) ? 'd-none' : '';
            $result .= '<table class="table table-hover table-bordered" id="dataTableFull1">
            <thead class="bg-light">
              <tr>
                <th width="3%" class="'.$is_permitted.'"><input id="select-all" type="checkbox"></th>
                <th class="text-center">TICKET #</th>
                <th class="text-center" width="20%">DESCRIPTION</th>
                <th class="text-center">DESIRED DUEDATE</th>
                <th class="text-center">DOCUMENTS</th>
                <th class="text-center">COMMENTS</th>
                <th class="text-center">STATUS</th>
                <th width="10%" class="text-center">CREATED</th>
                <th class="'.$is_permitted.' text-center">MANAGE</th>
              </tr>
              </thead>
              <tbody>';
              if(!empty($forapprovalTicket)) {
                foreach ($forapprovalTicket as $data){
                    $ticketPriorityClasses = [
                        'Low' => 'secondary',
                        'Moderate' => 'success',
                        'High' => 'warning',
                        'Very High' => 'danger'
                    ];

                    $ticketPriorityLabel = $data['ticket_priority_label'];
                    $priorityColorClass = $ticketPriorityClasses[$ticketPriorityLabel] ?? '';
        
                    $priority = '';
                    if ($priorityColorClass) {
                        $priority = '<span class="px-2"><i class="bi bi-flag-fill text-' . $priorityColorClass . '" data-toggle="tooltip" title="' . $ticketPriorityLabel . '"></i></span>';
                    }

                    if (!empty($all_document)) {
                        $count_file = count(array_filter($all_document, function ($file) use ($data) {
                            return $file['ticketid'] === $data['ticketid'];
                        }));
                    } else {
                        $count_file = 0;
                    }

                    if (!empty($all_comment)) {
                        $count_comment = count(array_filter($all_comment, function ($comment) use ($data) {
                            return $comment['ticketid'] === $data['ticketid'];
                        }));
                    } else {
                        $count_comment = 0;
                    }

                    $inputDateTimeCreated = new DateTime($data['created_at']);
                    $outputDateCreated = $inputDateTimeCreated->format("F d, Y");

                    $inputDateTimeDue = new DateTime($data['ticket_due_date']);
                    $outputDateDue = $inputDateTimeDue->format("F d, Y");

                    $result .= '
                    <tr class="text-center">
                    <td class="'.$is_permitted.'"><input class="checkbox" name="approval_tickets[]" value="'.$data['ticketid'].'" type="checkbox"></td>
                    <td>'.$priority.'<a style="cursor:pointer" class="view-ticket-details" id="'.$data['ticketid'].'" data-toggle="modal" data-target="#view-ticket-modal"><span data-toggle="tooltip" title="View ticket"> TICKET #'.$data['ticketid'].'</span></a></td>
                    <td><div class="text-ellipsis">'.$data['ticket_task_description'].'</div></td>
                    <td>'.$outputDateDue.'</td>
                    <td>'.$count_file.'</td>
                    <td>'.$count_comment.'</td>
                    <td><span class="badge border bg-secondary">For Approval</span></td>
                    <td>'.$outputDateCreated.'</td>
                    <td class='.$is_permitted.' text-center">
                    <div class="d-flex justify-content-center gap-2">
                      <a style="cursor:pointer" class="approvedTicket" data-toggle="tooltip" title="Approved" id="'. $data['ticketid'].'" class="ticket-file-upload"> <i class="bi bi-check-circle text-success" style="font-size: 16px !important;"></i></a>  
                    </div>
                  </td>
                  </tr>
                    ';
                }
              }
              $result .= '
              <button type="submit" class="btn btn-sm btn-success d-none is_clicked" id="update_button_hide"><i class="bi bi-check-circle"></i> &nbsp; Approve</button>
              </tbody>
              </table>';
        }else {
            $result .= '<table class="table table-hover table-bordered" id="dataTableFull1">
            <thead class="bg-light">
            <tr class="text-center">
            <th width="4%"></th>
              <th width="10%">TICKET #</th>
              <th width="20%">DESCRIPTION</th>
              <th>DESIRED DUEDATE</th>
              <th>SUB TICKETS</th>
              <th>DOCUMENTS</th>
              <th>COMMENTS</th>
              <th>STATUS</th>
              <th width="10%" class="text-center">CREATED</th>
              <th class="'.$is_permitted.'">MANAGE</th>
            </tr>
            </thead>
            <tbody>';
            foreach ($ticket as $data) {
                $ticketLabelClasses = [
                    'Not Started' => 'badge border',
                    'In Progress' => 'badge border-success badge-info',
                    'On Hold' => 'badge border border-warning badge-warning',
                    'Cancelled' => 'badge border border-danger badge-danger',
                    'Completed' => 'badge border border-light badge-success'
                ];
    
                $ticketPriorityClasses = [
                    'Low' => 'secondary',
                    'Moderate' => 'success',
                    'High' => 'warning',
                    'Very High' => 'danger'
                ];
    
                $ticketLabel = $ticketLabelClasses[$data['ticket_label']] ?? '';
                $label = '<span class="'.$ticketLabel.'">'.$data['ticket_label'].'';
                $ticketPriorityLabel = $data['ticket_priority_label'];
                $priorityColorClass = $ticketPriorityClasses[$ticketPriorityLabel] ?? '';
    
                $priority = '';
                if ($priorityColorClass) {
                    $priority = '<span class="px-2"><i class="bi bi-flag-fill text-' . $priorityColorClass . '" data-toggle="tooltip" title="' . $ticketPriorityLabel . '"></i></span>';
                }
                $count_file = count(array_filter($all_document, function ($file) use ($data) {
                    return $file['ticketid'] === $data['ticketid'];
                }));
                
                $count_comment = count(array_filter($all_comment, function ($comment) use ($data) {
                    return $comment['ticketid'] === $data['ticketid'];
                }));
                
                $count_subtask = count(array_filter($all_ticket, function ($ticket) use ($data) {
                    return $ticket['parentid'] === $data['ticketid'];
                }));
                
                $count_completed_tickets = count(array_filter($all_ticket, function ($ticket) use ($data) {
                    return $ticket['parentid'] === $data['ticketid'] && $ticket['ticket_label'] === 'Completed';
                }));
                
                $count_gsubtask = 0; 
                $total_subtask = $count_subtask + $count_gsubtask;
                $main_ticket = ($data['ticket_label'] === 'Completed') ? 1 : 0;
                $x = $count_subtask + 1;
                $y = $count_completed_tickets + $main_ticket;
                $total_completion = ($x > 0) ? round($y / $x * 100) : 0;

                $duedate = new DateTime($data['ticket_due_date']);
                $dued_at = $duedate->format("F d, Y");

                $created_date = new DateTime($data['created_at']);
                $created_at = $created_date->format("F d, Y");

                $userit = $this->itModel->where('userId', session('id'))->first();
                $user_type = session('usertype');
    
                $is_permitted = ($user_type == 1 && $userit['employment_status'] == 1) ? 'd-none' : '';
                $is_client = ($user_type == 2) ? 'd-none' : '';
                  
                $result .='
                <tr class="text-center">
                    <td>
                        <a data-toggle="modal" data-target="#add-ticket-modal" class="addSubTask" id="'. $data['ticketid'] .'"><i data-toggle="tooltip" title="Add Sub-ticket" class="bi bi-plus-square-fill h5 text-info"></i></a>
                        <a data-toggle="canvas" data-target="#bs-canvas-right" aria-expanded="false" onclick="showOffcanvas()" aria-controls="bs-canvas-right" class="offCanvas" id="'. $data['ticketid'] .'"><i data-toggle="tooltip" title="View Ticket History/Ticket Sub-task" class="bi bi-arrow-left-square-fill h5 text-info"></i></a>
                    </td>
                    <td>
                        '. $priority .'<a style="cursor:pointer" class="view-ticket-details" id="'. $data['ticketid'] .'" data-toggle="modal" data-target="#view-ticket-modal"><span data-toggle="tooltip" title="View ticket"> TICKET #'. $data['ticketid'] .'</span></a>
                        <div class="px-3">
                            <div class="progress">
                                <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="'. $total_completion .'" aria-valuemin="0" aria-valuemax="100" style="width: '. $total_completion .'%"></div>
                            </div>
                        </div>
                        <span>'. $total_completion .'% Complete</span>
                    </td>
                    <td>
                        <div class="text-ellipsis">'. $data['ticket_task_description'] .'</div>
                    </td>
                    <td>'. $dued_at .'</td>
                    <td>'. $total_subtask .'</td>
                    <td>'. $count_file .'</td>
                    <td>'. $count_comment .'</td>
                    <td>'. $label .'</td>
                    <td>'. $created_at .'</td>
                    <td class="'.$is_permitted.'">
                        <div class="d-flex justify-content-center gap-2">
                            <a class="ticketArchive" id="'. $data['ticketid'] .'" class="ticket-file-upload"><span data-toggle="tooltip" title="Move to Archived"><i class="bi bi-calendar2-x text-danger"></i></span></a>
                        </div>
                    </td>
                </tr>
                ';
            }
            $result .='
                </tbody>
            </table>
            ';
        }
        
        return $this->response->setJSON([
            'error' => false,
            'result' => $result
            // 'subTickets' => $all_ticket
        ]);     
    }
}
