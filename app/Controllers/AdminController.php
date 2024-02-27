<?php

namespace App\Controllers;

    use App\Controllers\BaseController;
    use App\Models\ITProfile;
    use App\Models\ClientProfile;
    use App\Models\AdminProfile;
    use App\Models\User;
    use App\Models\Project;
    use App\Models\Ticket;
    use App\Models\ProjectAdmin;
    use App\Models\EducationalBackground;
    use App\Models\FileUploaded;
    use App\Models\WorkExperience;
    use App\Models\SkillList;
    use App\Models\SkillOwned;
    use App\Models\Files;
    use App\Models\ClientProductServices;


class AdminController extends BaseController
{
    public function __construct(){
        $this->userModel = new User();
        $this->clientModel = new ClientProfile();
        $this->itModel = new ITProfile();
        $this->adminProfile = new AdminProfile();
        $this->projectModel = new Project();
        $this->ticketModel = new Ticket();
        $this->projectAdminModel = new ProjectAdmin();
        $this->sessionname = session('name');
        $this->sessionid = session('id');
        $this->skillsModel = new SkillList();
        $this->skillOwnModel = new SkillOwned();
        $this->educationModel = new EducationalBackground();
        $this->workModel = new WorkExperience();
        $this->fileModel = new Files();
        $this->productServicesModel = new ClientProductServices();
        $this->is_admin = session('is_admin');
    }

    public function index() {
        $user = $this->adminProfile->where('userId', $this->sessionid)->first();
        $data = array(
            'sessionid'    =>  $this->sessionid,
            'is_admin'     =>  $this->is_admin,
            'name'         =>  $user['name'],
            'avatar'       =>  $user['profile_avatar'],
            'email'        =>  $user['email'],
            'introduction' =>  $user['introduction'],
            'contact'      =>  $user['contactnumber'],
            'position'     =>  $user['user_position'],
        );
        return view('admin/admin', $data);
    }

    public function allUsers() {
        $active_users = $this->userModel->where(['status' => 0])->findAll();
        $inactive_users = $this->userModel->where(['status' => 1])->findAll();
        $suppended_users = $this->userModel->where(['status' => 2])->findAll();
        $profile = $this->adminProfile->where(['userId' => $this->sessionid])->first();

        
        $data = array(
            'active' => $active_users,
            'inactive' => $inactive_users,
            'suppended' => $suppended_users,
            'profile' => $profile
        );
        return view('admin/people/all_users', $data);
    }


    public function allProjects() {
        $all_project = $this->projectModel->where(['project_status_flag' => 0])->findAll();
        $it_professional = $this->itModel->where(['is_verified' => 'Yes'])->findAll();
        $client_project = $this->projectModel->select('tbl_project.projectid, tbl_project.project_name, tbl_project.project_budget, tbl_project.project_code, tbl_project.project_image, tbl_project.description, tbl_project.project_allot_time, tbl_project.project_label, tbl_project.specialist_tag, tbl_project.due_date, tbl_project.start_date, tbl_project.start_date, tbl_project.project_status_flag, clientprofile.company, clientprofile.name, clientprofile.profile_avatar')->join('clientprofile', 'tbl_project.clientid = clientprofile.id')->where(['project_status_flag' => 0])->findAll();
        $developer_assigned = $this->projectAdminModel->select('tbl_project_admin.pa_projectid, tbl_project_admin.projectid, tbl_project_admin.devid, itprofile.name, itprofile.profile_avatar')->join('itprofile', 'tbl_project_admin.devid = itprofile.id')->where(['tbl_project_admin.pa_status_flag' => 0])->findAll();
        $project_count = $this->projectModel->where(['project_status_flag' => 0])->countAllResults();
        $active_project_count = $this->projectModel->where(['project_status_flag' => 0, 'project_label !=' => 'Completed', 'project_label !=' => 'Not Started'])->countAllResults();
        $completed_project_count = $this->projectModel->where(['project_status_flag' => 0, 'project_label' => 'Completed'])->countAllResults();
        $np_project_count = $this->projectModel->where(['project_status_flag' => 0, 'project_label' => 'Not Started'])->countAllResults();
        $client_count = $this->clientModel->countAllResults();
        $all_client= $this->clientModel->select('name, profile_avatar, company')->findAll();
        $profile = $this->adminProfile->where(['userId' => $this->sessionid])->first();
        $ticket = $this->ticketModel->where(['ticket_status_flag' => 0, 'is_approved' => 'Yes', 'ticket_label !=' => 'Cancelled'])->findAll();

        $data = array(
            'all_project' => $all_project,
            'tickets' => $ticket,
            'it_professional' => $it_professional,
            'developer' => $developer_assigned,
            'client_project' => $client_project,
            'project_count' => $project_count,
            'active_project_count' => $active_project_count,
            'completed_project_count' => $completed_project_count,
            'np_project_count' => $np_project_count,
            'all_client' => $all_client,
            'client_count' => $client_count,
            'profile' => $profile
        );
        return view('admin/project/all', $data);
    }
    
    public function viewProject($code) {
        $today = date('Y-m-d');
        $targetDate = date('Y-m-d', strtotime('+3 days'));
        $project_details = $this->projectModel->where('project_code', $code)->first();
        $projectid = $project_details['projectid'];
        $project_client = $this->clientModel->where(['id' => $project_details['clientid']])->first();
        $project_ticket_count = $this->ticketModel->where(['ticket_status_flag' => 0, 'is_approved' => 'Yes', 'projectid' => $projectid])->countAllResults();
        $project_tickets = $this->ticketModel->where(['ticket_status_flag' => 0, 'is_approved' => 'Yes', 'projectid' => $projectid])->findAll();
        $project_ticket_ns = $this->ticketModel->where(['ticket_status_flag' => 0, 'ticket_label' => 'Not Started', 'projectid' => $projectid])->countAllResults();
        $project_ticket_active = $this->ticketModel->where(['ticket_status_flag' => 0, 'ticket_label !=' => 'Not Started', 'ticket_label !=' => 'Completed', 'projectid' => $projectid])->countAllResults();
        $project_ticket_completed = $this->ticketModel->where(['ticket_status_flag' => 0, 'ticket_label' => 'Completed', 'projectid' => $projectid])->countAllResults();
        $project_ticket_dues= $this->ticketModel->where(['ticket_due_date <' => $today, 'ticket_status_flag' => 0, 'is_approved' => 'Yes', 'ticket_label !=' => 'Completed', 'projectid' => $projectid])->countAllResults();

        $data = array(
            'details' => $project_details,
            'project_ticket_count' => $project_ticket_count,
            'project_tickets' => $project_tickets,
            'project_ticket_dc' => $project_ticket_dues,
            'project_ticket_nc' => $project_ticket_ns,
            'project_ticket_ac' => $project_ticket_active,
            'client' => $project_client,
            'project_ticket_cc' => $project_ticket_completed
        );
        return view('admin/project/view_project', $data);
    }


    public function itProfessionalIndex() {
        $itpersonels = $this->userModel->select('user.*, itprofile.*')->join('itprofile', 'user.id = itprofile.userId')->orderBy('user.name', 'ASC')->findAll();
        $data = array(
            'itpersonels' => $itpersonels
        );
        return view('admin/people/it_list', $data);

       
    }

    public function clientIndex() {
        $clients = $this->userModel->select('user.*, clientprofile.*')->join('clientprofile', 'user.id = clientprofile.userId')->orderBy('user.name', 'ASC')->findAll();
        $counts = $this->userModel->select('user.*, clientprofile.*')->join('clientprofile', 'user.id = clientprofile.userId')->orderBy('user.name', 'ASC')->countAllResults();
        $projects = $this->projectModel->where(['project_status_flag' => 0])->findAll();
        $products = $this->productServicesModel->where(['prodser_status_flag' => 1])->findAll();
        $data = array(
            'counts' => $counts,
            'clients' => $clients,
            'projects' => $projects,
            'service_products' => $products
        );
        return view('admin/people/client_list', $data);
    }

    public function search() {
        $keyword = $this->request->getPost('keyword');
        $data['results'] = $this->itModel->searchData($keyword);
        return json_encode($data);
    }
    
    public function clientSearch() {
        $keyword = $this->request->getPost('keyword');
        $data['results'] = $this->clientModel->searchClientData($keyword);
        return json_encode($data);
    }

    public function itProfile($name, $id) {
        $profile = $this->itModel->where(['name' => $name])->first();
        $projects = $this->projectAdminModel->select('tbl_project.*')->join('tbl_project', 'tbl_project_admin.projectid = tbl_project.projectid')->where(['tbl_project_admin.devid' => $profile['id']])->findAll();
        $projects_count = $this->projectAdminModel->select('tbl_project.*')->join('tbl_project', 'tbl_project_admin.projectid = tbl_project.projectid')->where(['tbl_project_admin.devid' => $profile['id']])->countAllResults();
        $project_owned_tickets = $this->itModel->select('tbl_ticket.*, tbl_project.project_name, tbl_project.project_code, clientprofile.name AS client')->join('tbl_project_admin', 'itprofile.id = tbl_project_admin.devid')->join('tbl_project', 'tbl_project_admin.projectid = tbl_project.projectid')->join('tbl_ticket', 'tbl_project.projectid = tbl_ticket.projectid')->join('clientprofile', 'tbl_ticket.clientid = clientprofile.id')->where(['tbl_ticket.ticket_label !=' => 'Completed', 'tbl_ticket.ticket_status_flag' => 0, 'tbl_ticket.is_approved' => 'Yes', 'itprofile.id' => $profile['id']])->findAll();

        $project_owned_ticket = $this->itModel->join('tbl_project_admin', 'itprofile.id = tbl_project_admin.devid')->join('tbl_project', 'tbl_project_admin.projectid = tbl_project.projectid')->join('tbl_ticket', 'tbl_project.projectid = tbl_ticket.projectid')->join('clientprofile', 'tbl_ticket.clientid = clientprofile.id')->where(['tbl_ticket.ticket_label !=' => 'Completed', 'tbl_ticket.ticket_status_flag' => 0, 'tbl_ticket.is_approved' => 'Yes', 'itprofile.id' => $profile['id']])->countAllResults();
        $tickets = $this->ticketModel->where(['is_approved' => 'Yes', 'ticket_status_flag' => 0])->findAll();

        $profile_score     =  0;
        $skill_score       =  0;
        $experience_score  =  0;
        $education_score   =  0;
        $file_score        =  0;

        $skills      = $this->skillOwnModel->select('tbl_skill_owned.*, tbl_skillset_list.*')
                        ->join('tbl_skillset_list', 'tbl_skill_owned.owned_skill_setid = tbl_skillset_list.skill_setid')
                        ->where('tbl_skill_owned.skill_status_flag', 1)
                        ->where('tbl_skill_owned.skill_itid', $profile['id'])
                        ->findAll();
        $education   =   $this->educationModel->where('educational_bg_profile_id', $profile['id'])->where('educational_bg_status_flag', 1)->findAll();
        $experience  =   $this->workModel->where('work_xp_profile_id ', $profile['id'])->where('work_xp_status_flag', 1)->findAll();
        $files       =   $this->fileModel->where('itid', $profile['id'])->where('file_status_flag', 0)->findAll();

        if(!empty($profile['name']) && !empty($profile['resume_file']) && !empty($profile['profile_avatar']) && !empty($profile['user_position']) && !empty($profile['desired_rate']) && !empty($profile['contactnumber']) && !empty($profile['email']) && !empty($profile['introduction'])){ $profile_score = 100; } else { $profile_score = 0; }
        if(!empty($skills)){ $skill_score = 100; } else { $skill_score = 0; }
        if(!empty($education)){ $education_score = 100; } else { $education_score = 0; }
        if(!empty($experience)){ $experience_score = 100; } else { $experience_score = 0; }
        if(!empty($files)){ $file_score = 100; } else { $ile_score = 0; }
        
        $completion            = $profile_score + $skill_score + $education_score + $experience_score + $file_score;
        $completion_percentage = $completion / 5 * 1.0;

        $data = array(
            'completion_percentage' => $completion_percentage,
            'owned_tickets' => $project_owned_tickets,
            'owned_ticket' => $project_owned_ticket,
            'count' => $projects_count,
            'tickets' => $tickets,
            'profile' => $profile,
            'project' => $projects
        );

        return view('admin/people/profile',$data);
    }

}
