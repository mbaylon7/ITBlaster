<?php

namespace App\Controllers;

use App\Models\SkillOwned;
use App\Models\SkillList;
use App\Models\Project;

class Home extends BaseController
{
    public function __construct() {
        $this->projectModel = new Project();
    }
    
    public function index()
    {
        $skillOwned = new SkillOwned();
        
        $skills = $skillOwned->select('owned_skill_setid, tbl_skillset_list.*, COUNT(*) as count')
            ->join('tbl_skillset_list', 'tbl_skill_owned.owned_skill_setid = tbl_skillset_list.skill_setid')
            ->where('tbl_skill_owned.skill_status_flag', 1)
            ->orderBy('tbl_skillset_list.skill_name', 'ASC')
            ->groupBy('owned_skill_setid')
            ->findAll(12);
        
        $projects = $this->projectModel->select('project_name, project_alias_name, allot_skills')->where(['is_displayed' => 'Yes'])->findAll();
        
        $data = array(
            'skills' => $skills,
            'projects' => $projects
        );
        // load the view with the data
        return view('front/index', $data);
    }

    public function itServices(){
        $projects = $this->projectModel->select('project_name, allot_skills')->findAll();

        $data = array(
            'projects' => $projects
        );
        return view('front/manage_it_services',$data);
    }

    public function itAllSkills(){
        $skillOwned = new SkillOwned();
        
        $skills = $skillOwned->select('owned_skill_setid, tbl_skillset_list.*, COUNT(*) as count')
            ->join('tbl_skillset_list', 'tbl_skill_owned.owned_skill_setid = tbl_skillset_list.skill_setid')
            ->where('tbl_skill_owned.skill_status_flag', 1)
            ->orderBy('tbl_skillset_list.skill_name', 'ASC')
            ->groupBy('owned_skill_setid')
            ->findAll();
        
        $data = array(
            'skills' => $skills,
        );
        return view('front/it_all_skills', $data);
    }
}
