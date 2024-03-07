<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Ticket;
use App\Models\ITProfile;
use App\Models\Project;
use App\Models\ClientProfile;
use App\Models\Applicant;
use App\Models\Comment;
use App\Models\SystemLog;
use App\Models\Files;
use App\Models\ProjectAdmin;
use DateTime;


class TicketController extends BaseController
{
    public function __construct() {
        $this->commentModel = new Comment();
        $this->ticketModel = new Ticket();
        $this->projectModel = new Project();
        $this->itModel = new ITProfile();
        $this->clientModel = new ClientProfile();
        $this->systemModel = new SystemLog();
        $this->applicantModel = new Applicant();
        $this->filesModel = new Files();
        $this->projectAdminModel = new ProjectAdmin();
        $this->sessionid = session('id');
        $this->session_name = session('name');
    }
    
    public function index() {
        $today = date('Y-m-d');
        $site = 'Active Project Tickets';
        $targetDate = date('Y-m-d', strtotime('+3 days'));
        $client = $this->clientModel->findAll();
        $applicant = $this->applicantModel->findAll();
        $it = $this->itModel->where('userId', session('id'))->first();
        $clientu = $this->clientModel->where('userId', session('id'))->first();
        $document = $this->filesModel->where(['file_status_flag' => 0])->findAll();
        $ticket = $this->ticketModel->where(['ticket_status_flag' => 0])->findAll();
        $developers = $this->itModel->where(['employment_status !=' => 2, 'is_verified' => 'Yes', 'is_availability' => 'Yes'])->findAll();
        $project = $this->projectModel->where(['project_status_flag' => 0, 'pmid IS NOT' => NULL])->orderBy('created_at', 'DESC')->findAll();
        $ticket = $this->ticketModel->where(['ticket_status_flag' => 0, 'is_approved' => 'Yes', 'ticket_label !=' => 'Cancelled'])->findAll();
        
        $owned_project = $this->projectModel
                ->select('tbl_project.*, tbl_project_admin.*, itprofile.*')
                ->join('tbl_project_admin', 'tbl_project_admin.projectid = tbl_project.projectid')
                ->join('itprofile', 'itprofile.id = tbl_project_admin.devid')
                ->where(['itprofile.id' => $it['id']])
                ->findAll();
        
        $manage_project = $this->projectModel
                ->select('tbl_project.*, clientprofile.company, clientprofile.name')
                ->join('clientprofile', 'tbl_project.clientid = clientprofile.id')
                ->where(['project_status_flag' => 0, 'pmid !=' => '', 'pmid !=' => NULL])
                ->findAll();

        $manage_project_ns = $this->projectModel
                ->select('tbl_project.*, clientprofile.company, clientprofile.name')
                ->join('clientprofile', 'tbl_project.clientid = clientprofile.id')
                ->where([
                    'project_label' => 'Not Started',
                    'project_status_flag' => 0, 
                    'pmid !=' => '', 
                    'pmid !=' => NULL])
                ->findAll();

        $manage_project_cmpt = $this->projectModel
                ->select('tbl_project.*, clientprofile.company, clientprofile.name')
                ->join('clientprofile', 'tbl_project.clientid = clientprofile.id')
                ->where(['project_label' => 'Completed',
                    'project_status_flag' => 0, 
                    'pmid !=' => '', 
                    'pmid !=' => NULL])
                ->findAll();

        $manage_project_oh = $this->projectModel
                ->select('tbl_project.*, clientprofile.company, clientprofile.name')
                ->join('clientprofile', 'tbl_project.clientid = clientprofile.id')
                ->where([
                    'project_label' => 'On Hold',
                    'project_status_flag' => 0, 
                    'pmid !=' => '', 
                    'pmid !=' => NULL])
                ->findAll();

        $manage_project_cncl = $this->projectModel
                ->select('tbl_project.*, clientprofile.company, clientprofile.name')
                ->join('clientprofile', 'tbl_project.clientid = clientprofile.id')
                ->where([
                    'project_label' => 'Cancelled',
                    'project_status_flag' => 0, 
                    'pmid !=' => '', 
                    'pmid !=' => NULL])
                ->findAll();

        $manage_project_ip = $this->projectModel
                ->select('tbl_project.*, clientprofile.company, clientprofile.name')
                ->join('clientprofile', 'tbl_project.clientid = clientprofile.id')
                ->where([
                    'project_label' => 'In Progress',
                    'project_status_flag' => 0, 
                    'pmid !=' => '', 
                    'pmid !=' => NULL])
                ->findAll();

        $manage_project_rcv = $this->projectModel
                ->select('tbl_project.*, clientprofile.company, clientprofile.name')
                ->join('clientprofile', 'tbl_project.clientid = clientprofile.id')
                ->where(['project_status_flag' => 1, 'pmid !=' => '', 'pmid !=' => NULL])
                ->findAll();

        $developer_assigned = $this->projectAdminModel
                ->select('tbl_project_admin.pa_projectid, tbl_project_admin.projectid, tbl_project_admin.devid, itprofile.name, itprofile.profile_avatar')
                ->join('itprofile', 'tbl_project_admin.devid = itprofile.id')
                ->where(['tbl_project_admin.pa_status_flag' => 0])
                ->findAll();

        $dued = $this->ticketModel
                ->selectCount('tbl_ticket.ticket_due_date')
                ->join('tbl_project', 'tbl_ticket.projectid = tbl_project.projectid')
                ->join('itprofile', 'tbl_project.pmid = itprofile.id')
                ->where([
                    'ticket_due_date <' => date('Y-m-d'), 
                    'ticket_status_flag' => 0,
                    'pmid' => $it['id']])
                ->countAllResults();

        $neardue = $this->ticketModel
                ->select('tbl_ticket.ticket_due_date')
                ->join('tbl_project', 'tbl_ticket.projectid = tbl_project.projectid')
                ->join('itprofile', 'tbl_project.pmid = itprofile.id')
                ->where([
                    'ticket_due_date <>' => $targetDate, 
                    'ticket_status_flag' => 0,
                    'pmid' => $it['id']])
                ->countAllResults();

        $ontrack = $this->ticketModel
                ->select('tbl_ticket.ticket_due_date')
                ->join('tbl_project', 'tbl_ticket.projectid = tbl_project.projectid')
                ->join('itprofile', 'tbl_project.pmid = itprofile.id')
                ->where([
                    'ticket_due_date >' => $targetDate, 
                    'ticket_status_flag' => 0, 
                    'pmid' => $it['id']])
                ->countAllResults();

        $active_project_count = $this->projectModel
                ->join('itprofile', 'tbl_project.pmid = itprofile.id')
                ->where([
                    'tbl_project.project_status_flag' => 0, 
                    'tbl_project.pmid' => $it['id'],
                    'tbl_project.project_label !=' => 'Completed',
                    'tbl_project.project_label !=' => 'Archived',
                    'tbl_project.project_label !=' => 'On Hold',
                    ])
                ->countAllResults();

        $completed_p_count = $this->projectModel
                ->join('itprofile', 'tbl_project.pmid = itprofile.id')
                ->where([
                    'tbl_project.project_status_flag' => 0, 
                    'tbl_project.project_label' => 
                    'Completed', 
                    'tbl_project.pmid' => $it['id']])
                ->countAllResults();

        $completed_t_count = $this->ticketModel
                ->join('tbl_project', 'tbl_ticket.projectid = tbl_project.projectid')
                ->where([
                    'tbl_ticket.ticket_status_flag' => 0, 
                    'tbl_ticket.ticket_label' => 'Completed', 
                    'tbl_project.project_status_flag' => 0, 
                    'tbl_project.pmid' => $it['id']])
                ->countAllResults();
                            
        $active_ticket_count = $this->ticketModel
                ->join('tbl_project', 'tbl_ticket.projectid = tbl_project.projectid')
                ->where([
                    'tbl_ticket.ticket_status_flag' => 0, 
                    'tbl_project.project_status_flag' => 0, 
                    'tbl_project.pmid' => $it['id']])
                ->countAllResults();

        $avatar = '';
            if(!empty($it)) {
                $avatar = ($it['profile_avatar'] == '')? '' : $it['profile_avatar'];
                $is_permitted = ($it['employment_status']== '')? '' : $it['employment_status'];
            } elseif(!empty($clientu)) {
                $avatar = ($clientu['profile_avatar'] == '')? '' : $clientu['profile_avatar'];
            }
        
        $data = array(
            'name'          =>  $it['name'],
            'tickets'       =>  $ticket,
            'developers'    =>  $developers,
            'documents'     =>  $document,
            'developer'     =>  $developer_assigned,
            'owned'         =>  $owned_project,
            'manage'        =>  $manage_project,
            'notstarted'    =>  $manage_project_ns,
            'completed'     =>  $manage_project_cmpt,
            'onhold'        =>  $manage_project_oh,
            'cancelled'     =>  $manage_project_cncl,
            'inprogress'    =>  $manage_project_ip,
            'dued'          =>  $dued,
            'ontrack'       =>  $ontrack,
            'neardue'       =>  $neardue,
            'active_project_count' =>  $active_project_count,
            'completed_p_count'  =>  $completed_p_count,
            'completed_t_count'  =>  $completed_t_count,
            'active_ticket_count'  =>  $active_ticket_count,
            'archived'      =>  $manage_project_rcv,
            'is_verified'   =>  $it['is_verified'],
            'itid'          =>  $it['id'],
            'userid'        =>  $it['userId'],
            'project'       =>  $project,
            'applicant'     =>  $applicant,
            'client'        =>  $client,
            'name'          =>  session('name'),
            'avatar'        =>  $avatar,
            'usertype'      =>  $is_permitted,
            'site'          =>  $site
        );
        return view('ticket/ticket_board_list', $data);
    }

    public function applyEntry() {
        try {
           $data = array(
            'projectid'  =>  $this->request->getVar('projectid'),
            'clientid'   =>  $this->request->getVar('clientid'),
            'ticketid'   =>  $this->request->getVar('ticketid'),
            'itid'       =>  $this->request->getVar('itid')
           );
           if($this->applicantModel->save($data)) {
              return $this->response->setJSON([
                'status'   => '200',
                'error'    => 'false',
                'title'    => 'Applied',
                'text'     => 'Kindly wait for the meantime you will hearing from us soon. Thank you!'
              ]);
           }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function addComment() {
        try {
           $data = array(
            'projectid'        =>  $this->request->getVar('projectid'),
            'clientid'         =>  $this->request->getVar('clientid'),
            'ticketid'         =>  $this->request->getVar('ticketid'),
            'comment_content'  =>  $this->request->getVar('comment'),
            'userid'           =>  session('id')
           );
           if($this->commentModel->save($data)) {
            $log = array(
                'userid' => $this->sessionid,
                'projectid' => $this->request->getVar('projectid'),
                'action_activity' => 'Added new comment on Ticket#' . $this->request->getVar('ticketid')
            );
            if($this->systemModel->save($log)) {
                return $this->response->setJSON([
                    'status'    => '200',
                    'error'     => 'false',
                    'title'     => 'Cheers',
                    'text'      => 'Your Comment Successfully Added!'
                ]);
            }
           }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function updateTicket() {
        try {
            $ticketid = $this->request->getVar('ticketid');
            $data = array(
                'ticket_title' => $this->request->getVar('title'),
                'ticket_due_date' => $this->request->getVar('duedate'),
                'ticket_label' => $this->request->getVar('label'),
                'ticket_priority_label' => $this->request->getVar('priority'),
                'ticket_task_description' => $this->request->getVar('ticket_description'),
            );
            if($this->ticketModel->update($ticketid, $data)) {
                $logs = array(
                    'userid' => $this->sessionid,
                    'action_activity'   => 'Some of ' .$this->request->getVar('title'). ' informations was updated'
                );
                if($this->systemModel->save($logs)) {
                    $this->session->setFlashdata('success', 'Some of ' .$this->request->getVar('title'). ' informations was updated Successfully!');
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function manageTicket() {
        try {
            $ticketid = $this->request->getVar('ticketid');
            $data = array(
                'ticket_status_flag' => $this->request->getVar('status')
            );
            if($this->ticketModel->update($ticketid, $data)) {
                $log = array(
                    'userid' => session('id'),
                    'projectid' => $this->request->getVar('projectid'),
                    'action_activity' => $this->request->getVar('action')
                );
                if($this->systemModel->save($log)) {
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function approvedTicket() {
        try {
            $ticketid = $this->request->getVar('id');
            $data = array(
                'is_approved'   => 'Yes',
            );
            if($this->ticketModel->update($ticketid, $data)) {
                $log = array(
                    'userid' => session('id'),
                    'projectid' => $this->request->getVar('projectid'),
                    'action_activity' => 'Ticket #'. $ticketid . ' was Approved by '. $this->session_name
                );
                $this->systemModel->save($log);
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }
    
    public function approveAllTickets() {
        try {
            $bulk_data = array();
            foreach($this->request->getPost('approval_tickets') as $key => $value){
                echo $ticketid = $this->request->getPost('approval_tickets')[$key];
                $data = array(
                    'is_approved' =>  'Yes',
                    'ticket_label' => 'Not Started'
                );
                if($this->ticketModel->update($ticketid, $data)) {
                    $this->session->setFlashdata('success', 'Some of ' .$this->request->getVar('title'). ' informations was updated Successfully!');
                }
            }
            return redirect()->back();
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getTicketSubTasks($id) {
        $parentTicket = $this->ticketModel->find($id);
        $childTickets = $this->ticketModel
                    ->where([
                        'ticket_status_flag' => 0, 
                        'ticket_label !=' => 'Cancelled', 
                        'is_approved' => 'Yes', 
                        'parentid' => $parentTicket['ticketid'], 
                        'childid =' => 0])
                    ->findAll();
        $grandChildTickets = $this->ticketModel
                    ->where([
                        'ticket_status_flag' => 0, 
                        'ticket_label !=' => 'Cancelled', 
                        'is_approved' => 'Yes', 
                        'parentid' => $parentTicket['ticketid'], 
                        'childid !=' => 0])
                    ->findAll();
        $grandChildTickets2 = $this->ticketModel
                    ->where([
                        'ticket_status_flag' => 0, 
                        'ticket_label !=' => 'Cancelled', 
                        'is_approved' => 'Yes', 
                        'parentid' => $parentTicket['ticketid'], 
                        'childid !=' => 0, 
                        'ticketid = childid'])
                    ->findAll();

        $subtask = '';
        $activities = '';
        $index=0;
        if(!empty($childTickets)){
            $subtask .= '
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="2%"></th>
                            <th>Ticket #</th>
                            <th>Subtask</th>
                            <th>Description</th>
                            <th>Duedate</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>';
            foreach ($childTickets as $child) {
                $duedate = new DateTime($child['ticket_due_date']);
                $due_date_formatted = $duedate->format("F d, Y");

                $created_date = new DateTime($child['created_at']);
                $created_at_formatted = $created_date->format("F d, Y");
                $labelClasses = [
                    'Not Started' => 'badge border',
                    'In Progress' => 'badge border-info badge-info',
                    'Completed'   => 'badge border border-success badge-success',
                    'On Hold'     => 'badge border border-warning badge-warning',
                    'Cancelled'   => 'badge border border-danger badge-danger',
                ];

                $badge = $child['ticket_label'];
                if (isset($labelClasses[$badge])) {
                    $label = '<span class="status-contact ' . $labelClasses[$badge] . '">' . $badge . '</span>';
                } else {
                    // Handle the case where $badge doesn't match any known labels
                    $label = $badge; // Default behavior, no badge
                }

                $subtask .='
                  <tr>
                    <td><input type="checkbox" name="ticketCheckbox" class="checkbox_action" value="'.$child['ticketid'].'"></td>
                    <td class="text-center">
                        <a data-toggle="modal" class="uploadTicket" data-parent="'.$child['parentid'].'" data-child="'.$child['ticketid'].'" data-target="#upload-ticket-modal"><i class="bi bi-upload text-info" data-toggle="tooltip" title="uploadTicket"></i> &nbsp;</a>
                        <a data-toggle="modal" class="addSubTask" data-parent="'.$child['parentid'].'" data-child="'.$child['ticketid'].'" data-target="#add-ticket-modal"><i class="bi bi-plus-square text-info" data-toggle="tooltip" title="Add Sub-task"></i> &nbsp;</a>
                      <a data-toggle="collapse" href="#collapseExample'.$child['ticketid'].'" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="bi bi-arrows-collapse text-info" data-toggle="tooltip" title="Show sub-task"></i> &nbsp;</a>
                    </td>
                    <td> <a href="#" data-toggle="modal" class="view-ticket-details" id="'.$child['ticketid'].'" data-target="#view-ticket-modal">'.$child['ticketid'].'</a></td>';
                    if(!empty($grandChildTickets2)) { $index=0;
                        foreach($grandChildTickets2 as $cgchild) {
                            if($child['ticketid'] == $cgchild['childid']) {
                                $index++;
                            }
                        }
                    }
                    $subtask .=
                    '<td>'.$index.'</td>
                    <td><div class="text-ellipsisss">'.$child['ticket_task_description'].'</div></td>
                    <td>'.$due_date_formatted.'</td>
                    <td>'.$label.'</td>
                    <td>'.$created_at_formatted.'</td>
                  </tr>
                ';
                if(!empty($grandChildTickets)) {
                    $i=0;
                    $subtask .='<tr>
                        <td colspan="8" class="p-0">
                        <div class="collapse px-2 pb-3" id="collapseExample'.$child['ticketid'].'">
                            <div class="box" style="min-height: 200px!important; margin-top: 17px;">
                            <span class="h5 mt-2">Sub Tickets</span>
                            <table class="table table-bordered table-hover mt-3">
                                <thead style="background: #CACDD9!important;">
                                <tr>
                                    <th></th>
                                    <th>Ticket #</th>
                                    <th>Description</th>
                                    <th>Duedate</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                                </thead>';
                    foreach ($grandChildTickets as $gchild) {
                        if($child['ticketid'] == $gchild['childid']) {
                            $labelClasses = [
                                'Not Started' => 'badge border',
                                'In Progress' => 'badge border-info badge-info',
                                'Completed'   => 'badge border border-success badge-success',
                                'On Hold'     => 'badge border border-warning badge-warning',
                                'Cancelled'   => 'badge border border-danger badge-danger',
                            ];
                            
                            $badge = $gchild['ticket_label'];
                            
                            if (isset($labelClasses[$badge])) {
                                $label = '<span class="status-contact ' . $labelClasses[$badge] . '">' . $badge . '</span>';
                            } else {
                                // Handle the case where $badge doesn't match any known labels
                                $label = $badge; // Default behavior, no badge
                            }
                            $i++;
                            $gduedate = new DateTime($gchild['ticket_due_date']);
                            $gdue_date_formatted = $gduedate->format("F d, Y");

                            $gcreated_date = new DateTime($gchild['created_at']);
                            $gcreated_at_formatted = $gcreated_date->format("F d, Y");
                            $subtask .= '
                            <tr>
                                <td><input type="checkbox" name="ticketCheckbox" class="checkbox_action" value="'.$gchild['ticketid'].'"></td>
                                <td><a href="#" data-toggle="modal" class="view-ticket-details" id="'.$gchild['ticketid'].'" data-target="#view-ticket-modal">'.$gchild['ticketid'].'</a></td>
                                <td><div class="text-ellipsisss">'.$gchild['ticket_task_description'].'</div></td>
                                <td>'.$gdue_date_formatted.'</td>
                                <td>'.$label.'</td>
                                <td>'.$gcreated_at_formatted.'</td>
                            </tr>
                            ';
                        }
                    }
                    $subtask .= '
                        </table>
                        </div>
                    </div>
                    </td>
                    </tr>
                ';
                }
            }
            $subtask .='
                    </tbody>
                </table>';
            
        } else {
            echo '
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th></th>
                    <th>Ticket #</th>
                    <th>Description</th>
                    <th>Duedate</th>
                    <th>Status</th>
                    <th>Created</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center" colspan="6"><i class="bi bi-exclamation-circle text-warning"></i> &nbsp; No data</td>
                  </tr>
                </tbody>
              </table>';
        }

        return $this->response->setJSON([
            'error' => false,
            'output' => $subtask,
            'activity'  => $activities,
            'test'  => $grandChildTickets2
        ]);

        
    }

    public function getTicketHistory($id) {
        $parentTicket = $this->ticketModel->find($id);
        $history = $this->systemModel
            ->select('tbl_logs.*, tbl_ticket.ticketid, user.name')
            ->join('tbl_ticket', 'tbl_ticket.projectid = tbl_logs.projectid')
            ->join('user', 'user.id = tbl_logs.userid')
            ->where(['tbl_logs.ticketid' => $parentTicket['ticketid']])
            ->findAll();

        $activities = '';
        $index = 0;
        if(!empty($history)) {
            $activities .= '
                <table class="table table-bordered" id="dataTableFull1">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Personel</th>
                        <th>Action</th>
                        <th>Timestamp</th>
                    </tr>
                    </thead>
                    <tbody>';
            foreach ($history as $data) $index++;{
                $activities .= '
                  <tr>
                    <td>'.$index.'</td>
                    <td>'.$data['name'].'</td>
                    <td>'.$data['action_activity'].'</td>
                    <td>'.$data['created_at'].'</td>
                  </tr>';
            }
            $activities .='</tbody>
            </table>';
        }

        return $this->response->setJSON([
            'error' => false,
            'activity'  => $activities
        ]);
    }

    private function migrateTicket($projectid, $clientid, $parentid) {
        $commonData = [
            'clientid' => $clientid,
            'projectid' => $projectid,
            'parentid' => 0,
            'ticket_label' => 'Not Started',
            'ticket_priority_label' => 'Moderate',
            'is_approved' => 'Yes',
            'ticket_due_date' => date('Y-m-d\TH:i', strtotime('+1 month')), // One month from today
        ];
    
        $tickets = [
            ['ticket_title' => 'Gathering Requirements', 'ticket_task_description' => 'Gathering Requirements'],
            ['ticket_title' => 'Analysis', 'ticket_task_description' => 'Analysis'],
            ['ticket_title' => 'Design/Front End', 'ticket_task_description' => 'Design/Front End'],
            ['ticket_title' => 'Coding/Software Development', 'ticket_task_description' => 'Coding/Software Development'],
            ['ticket_title' => 'Testing', 'ticket_task_description' => 'Testing'],
            ['ticket_title' => 'Implementation', 'ticket_task_description' => 'Implementation'],
            ['ticket_title' => 'Demo Presentation', 'ticket_task_description' => 'Demo Presentation'],
            ['ticket_title' => 'Approval', 'ticket_task_description' => 'Approval'],
            ['ticket_title' => 'Post Implementation', 'ticket_task_description' => 'Post Implementation'],
        ];
    
        // Merge common data with individual ticket data
        foreach ($tickets as &$ticket) {
            $ticket = array_merge($commonData, $ticket);
        }
    
        $this->ticketModel->insertBatch($tickets);
    }
    
    public function test() {
        if($this->migrateTicket(1,2,3)){
            echo 1;
        } else {
            2;
        }
    }

    public function createAssignProject() {
        try {
            $projectCode = bin2hex(random_bytes(5));
            $project = array(
                'clientid' => $this->request->getVar('clientid'),
                'pmid' => $this->request->getVar('pmid'),
                'project_name' => $this->request->getVar('project_name'),
                'description' => $this->request->getVar('description'),
                'start_date' => $this->request->getVar('start_date'),
                'due_date' => $this->request->getVar('due_date'),
                'specialist_tag' => $this->request->getVar('tag'),
                'allot_skills' => $this->request->getVar('skills'),
                'project_budget' => $this->request->getVar('budget'),
                'project_label' => $this->request->getVar('label'),
                'project_allot_time' => $this->request->getVar('allot_time'),
                'project_code' => $projectCode
            );
            $PK_id = $this->projectModel->save($project);
            $inserted_id = $this->projectModel->insertID();
            if($PK_id) {
                $PK_id = $inserted_id;
                $bulk_data = array();
                foreach($this->request->getVar('developers') as $key => $value){
                    $projectadmin = array(
                        'clientid'  => $this->request->getVar('clientid'),
                        'devid'  => $this->request->getVar('developers')[$key],
                        'projectid'  => $PK_id
                    );
                    $bulk_data[] = $projectadmin;    
                }
                if($this->projectAdminModel->insertBatch($bulk_data)) {
                    $logs = array(
                        'userid' => $this->sessionid,
                        'action_activity' => 'A new project Added by '. $this->session_name
                    );
                    if( $this->systemModel->save($logs)) {
                        // return redirect()->back();
                    }
                }
                if($this->request->getVar('status_type')) {
                    $projectid = $inserted_id;
                    $clientid = $this->request->getVar('clientid');
                    $parentid = $this->ticketModel->insertID();
                    $this->migrateTicket($projectid, $clientid, $parentid);
                }

            }
            $referrer = $this->request->getServer('HTTP_REFERER');
            return redirect()->to($referrer);
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function listAllProjects() {
        $projects = $this->projectModel->where(['project_status_flag' => 0, 'pmid IS NOT' => NULL])->orderBy('created_at', 'DESC')->findAll();

        if(!empty($projects)) {
            $result = '';
            foreach ($projects as $project) {
                $labelClasses = [
                    'Not Started' => 'badge border',
                    'In Progress' => 'badge border-info badge-info',
                    'Completed' => 'badge border border-success badge-success',
                    'On Hold' => 'badge border border-warning badge-warning',
                    'Cancelled' => 'badge border border-danger badge-danger',
                    'Archived' => 'badge border border-dard badge-dark'
                  ];
                  $is_displayed = ($project['is_displayed'] === 'Yes') ? 'checked' : '';
                  $labelClass = $labelClasses[$project['project_label']] ?? '';
                  $label = '<span class="' . $labelClass . '">' . $project['project_label'] . '</span>';
                  $result .= '
                      <tr>
                          <td class="text-uppercase text-bold">' . $project['project_name'] . '</td>
                          <td>' . $project['description'] . '</td>
                          <td>' . $label . '</td>
                          <td>' . (new DateTime($project['due_date']))->format("F d, Y") . '</td>
                          <td class="text-center">
                              <input type="checkbox" class="displayProject" ' . $is_displayed . ' value="'.$project['projectid'].'"> Yes
                          </td>
                      </tr>';
            }
            return $this->response->setJSON([
                'success' => true,
                'result' => $result
            ]);
        }
    }

    public function hideShowProject($projectid) {
        $project = $this->projectModel->find($projectid);
        // print_r($project);
        $value = $this->request->getVar('value');
        $data = array(
            'is_displayed' => $value
        );
        if($this->projectModel->update($project['projectid'], $data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Project updated Successfully!'
            ]);
        }
    }

    public function filterOpenTicketsByDev() {
        $dev = $this->itModel->where(['userId' => $this->request->getVar('devid')])->first();
        $tickets = $this->ticketModel
            ->where("ticket_status_flag = 0 AND ticket_label NOT IN ('Archived', 'Completed', 'On Hold') AND is_approved = 'Yes'")
            ->where('assign_to', $this->request->getVar('devid'))
            ->orderBy('projectid', 'ASC')
            ->findAll();
        $projects = $this->projectModel
            ->where("project_status_flag = 0 AND project_label NOT IN ('Archived', 'Completed', 'On Hold')")
            ->findAll();

            // ticket_due_date
        $output = '';
        foreach($tickets ?? [] as $ticket) {
            $labelClasses = [
                'Not Started' => 'badge border',
                'In Progress' => 'badge border-info badge-info',
                'Completed' => 'badge border border-success badge-success',
                'On Hold' => 'badge border border-warning badge-warning',
                'Cancelled' => 'badge border border-danger badge-danger'
              ];
            $labelClass = $labelClasses[$ticket['ticket_label']] ?? '';
            $label = '<span class="' . $labelClass . '">' . $ticket['ticket_label'] . '</span>';
            foreach($projects ?? [] as $project) {
                if($ticket['projectid'] == $project['projectid']) {
                    $output .='
                        <tr>
                            <td class="text-uppercase text-bold">'.$project['project_name'].'</td>
                            <td>'.$ticket['ticket_task_description'].'</td>
                            <td>'.$dev['name'].'</td>
                            <td>'.(new DateTime($ticket['ticket_due_date']))->format("F d, Y").'</td>
                            <td>'.$label.'</td>
                        </tr>
                    ';
                }
            }
        }   

    //    echo '<pre>'; print_r($output);

        return $this->response->setJSON([
            'success' => true,
            'result' => $output
        ]);
    }
    
    public function allOpenTickets() {
        $tickets = $this->ticketModel
            ->where("ticket_status_flag = 0 AND ticket_label NOT IN ('Archived', 'Completed', 'On Hold') AND is_approved = 'Yes'")
            ->orderBy('projectid', 'ASC')
            ->findAll();
        $projects = $this->projectModel
            ->where("project_status_flag = 0 AND project_label NOT IN ('Archived', 'Completed', 'On Hold')")
            ->findAll();

        $output = '';
        $i=0;
        foreach($tickets ?? [] as $ticket) { $i++;
            $labelClasses = [
                'Not Started' => 'badge border',
                'In Progress' => 'badge border-info badge-info',
                'Completed' => 'badge border border-success badge-success',
                'On Hold' => 'badge border border-warning badge-warning',
                'Cancelled' => 'badge border border-danger badge-danger'
              ];
            $labelClass = $labelClasses[$ticket['ticket_label']] ?? '';
            $label = '<span class="' . $labelClass . '">' . $ticket['ticket_label'] . '</span>';
            foreach($projects ?? [] as $project) {
                if($ticket['projectid'] == $project['projectid']) {
                    $output .='
                        <tr>
                            <td class="text-uppercase text-bold">'.$project['project_name'].'</td>
                            <td>'.$ticket['ticket_task_description'].'</td>
                            <td>'.(new DateTime($ticket['ticket_due_date']))->format("F d, Y").'</td>
                            <td>'.$label.'</td>
                        </tr>
                    ';
                }
            }
        } 

        return $this->response->setJSON([
            'success' => true,
            'result' => $output
        ]);
    //    echo '<pre>'; print_r($i);s
    }

    public function updateMultipleTicketStatus() {
        $selectedIds = $this->request->getVar('selectedIds');
        $status = $this->request->getVar('status');

        if (!is_array($selectedIds) || empty($selectedIds)) {
            $response = array('status' => 'error', 'message' => 'Invalid or empty IDs array.');
            echo json_encode($response);
            exit;
        }

        $count = 0;
        $idString = implode(',', $selectedIds);

        $tickets = $this->ticketModel->select('*')
            ->where('ticketid IN ('.$idString.')')
            ->findAll();

        foreach($tickets as $ticket) {
            if($this->ticketModel->update($ticket['ticketid'], ['ticket_label' => $status])) {
                $count++;
            }
        }
        return $this->response->setJSON([
            'success' => true,
            'tickets' => $tickets,
            'count'   => $count,
            'message' => 'Ticket Updated Successfully!'
        ]);
        
    }
        
}
// Ians password
// $2y$10$HRWEWXFLX2LrtTuz7TR.Herx2.2Ynk4TNf6hbxlYuwVZmoWJJBvla