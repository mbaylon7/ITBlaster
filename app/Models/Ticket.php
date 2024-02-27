<?php

namespace App\Models;

use CodeIgniter\Model;

class Ticket extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_ticket';
    protected $primaryKey       = 'ticketid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ticketid', 'clientid','projectid','parentid','childid','assign_to','ticket_task_description','ticket_status_flag','ticket_title','ticket_start_date','ticket_alloted_time','ticket_due_date','ticket_label','ticket_priority_label','is_approved'];

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
