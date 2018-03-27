<?php
class Industry_model extends CI_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getIndustries() {
        $query = $this->db->select('*')
            ->from('project_category')
            ->where('is_deleted', 0)
            ->order_by('display_name', 'ASC')
            ->get();
        
        if($query->num_rows() < 1) {
            return array();
        }
        return $query->result_array();
    }

    function getBudgetfilters() {
        $query = $this->db->select('*')
            ->from('budget_filter')
            ->where('is_deleted', 0)
            ->order_by('min_budget', 'ASC')
            ->get();
        
        if($query->num_rows() < 1) {
            return array();
        }
        return $query->result_array();
    }

    // function getJobs() {
    //     $query = $this->db->select('*')
    //         ->from('jobs')
    //         ->where('is_deleted', 0)
    //         ->order_by('id', 'ASC')
    //         ->get();
        
    //     if($query->num_rows() < 1) {
    //         return array();
    //     }
    //     return $query->result_array();
    // }

    // function getJobs2($id) {
    //     $query = $this->db->select('*')
    //         ->from('jobs')
    //         ->where('is_deleted', 0)
    //         ->where('id', $id)
    //         ->order_by('id' , 'ASC')
    //         ->get();
        
    //     if($query->num_rows() < 1) {
    //         return array();
    //     }
    //     return $query->row();
    // }

    function addIndustry($data){
        if($this->db->insert('categoryables', $data)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function getTopIndustries($limit = 8) {
        $innerQuery = $this->db->select('jobs.project_category, COUNT(*) as total_jobs')
                ->from('jobs')
                ->where('is_deleted', 0)
                ->group_by('project_category')
                ->get_compiled_select();
                
        // dd($innerQuery);

        $this->db->reset_query();

        $topJobsQuery = $this->db->select('project_category.*,
                    IFNULL(jobs.total_jobs, 0) as total_jobs')
                ->from('project_category')
                ->join('( ' . $innerQuery . ' ) as jobs', 'jobs.project_category = project_category.id', 'LEFT')
                ->where('project_category.is_deleted', 0)
                ->group_by('project_category.id')
                ->order_by('total_jobs', 'DESC')
                ->limit((int)$limit)
                ->get();
        
        if ($topJobsQuery->num_rows() > 0 ) {
            return $topJobsQuery->result();
        }
        return array();
    }

}
