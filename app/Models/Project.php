<?php

namespace App\Models;

use CodeIgniter\Model;

class Project extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_project';
    protected $primaryKey       = 'projectid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['clientid','itid','pmid','project_code','project_name','project_alias_name','project_image','description','last_update','desired_timeline','project_budget','project_code','start_date','due_date','allot_skills','project_allot_time','specialist_tag','project_label','is_displayed','project_status_flag'];

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
}
