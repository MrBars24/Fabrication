<?php

class Job_model extends MX_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }



    function createJob($data){

        $query = $this->db->insert('jobs', $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function createAttached($files, $attachable_id){
        for($i=0; $i<count($files['name']); $i++){
            $data = array(
                'filename' => $files['name'][$i],
                'path' => $files[$i]['file'],
                'user_id' => $_SESSION['user']->id,
                'attachable_type' => "job",
            );
            $query = $this->db->insert('attachments', $data);
        }
        return $query;
    }

    /**
     *
     *
     * @params $category
     */

    function allWatch(){
        $limit = 0;
        $offset = 0;
        $search = "";
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }

        if(isset($_GET['page'])){
            $offset = $_GET['page'];
        }

        if(isset($_GET['search']) > 0){
            $search = $_GET['search'];
            $this->like(array("jobs.title"=>$search));
        }

        $where = array(
            "watchlists.expert_id" => $id = auth()->id
        );

        $q = $this->getIndexDataCount("jobs",$limit,$offset,'jobs.created_at','DESC',$where,'','watchlists','jobs.id=watchlists.job_id','LEFT',"jobs.*");



        $q['draw'] = (int)$offset;
        return $q;
    }

    function all(){
         $limit = 0;
         $offset = 0;
         $search = "";

         if(isset($_SESSION['user']->id)){
             $search_sql = array(
                 'fabricator_id !=' => $_SESSION['user']->id,
                 'jobs.is_deleted' => 0
             );
         }else{
            $search_sql = array(
                'jobs.is_deleted' => 0
            );
         }
         if(isset($_GET['limit'])){
             $limit = $_GET['limit'];
         }

         if(isset($_GET['page'])){
             $offset = $_GET['page'];
         }

        if(isset($_GET['search']) > 0){
            $search = $_GET['search'];
            $this->like(array("title"=>$search));
         }

         @$id = auth()->id;
         $q = $this->getIndexDataCount("jobs",
                $limit,
                $offset,
                'jobs.created_at',
                'DESC',
                $search_sql,
                '',
                'watchlists',
                'jobs.id=watchlists.job_id','LEFT',"jobs.*,IF(watchlists.expert_id = '$id',1,0) as is_watchlist,
                (SELECT count(*) from bids where job_id = jobs.id) as bids");
         //$q = $this->getIndexDataCount("jobs",$limit,$offset,'created_at','DESC',);
         $q['draw'] = (int)$offset;
         return $q;
    }

    function getBidCount($id){
        $q = $this->db->select("count(*) as count")
            ->from('bids')
            ->where('job_id',$id)
            ->get();

        return $q->row()->count;
    }

    function addWish($data){
        return $this->db->insert("watchlists",$data);
    }

    function removeWish($data){
        $this->db->where($data);
        return $this->db->delete("watchlists");
    }

    function getAllJobs() {
        $query = $this->db->select('*')
            ->from('jobs')
            ->where('is_deleted', 0)
            ->get();

        if ($query->num_rows() < 1) {
            return array();
        }

        return $query->result_array();
    }
    // GET ALL JOBS EXCECPT THE LOGIN MEMBER
    function getAllJobsExceptMe() {
        $query = $this->db->select('*')
            ->from('jobs')
            ->where('is_deleted', 0)
            ->get();

        if ($query->num_rows() < 1) {
            return array();
        }

        return $query->result_array();
    }

    function getMyJobs(){
        $query = $this->db->select('*')
        ->from('jobs')
        ->where('fabricator_id', $_SESSION['user']->id)
        ->where('is_deleted', 0)
        ->get();

        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }

    function getJob($id){

        $query = $this->db->select('*')
        ->from('jobs')
        ->where('id',$id)
        ->get();
        if($query->num_rows() > 0){
            return $query->row();
        }
        else {
            return false;
        }
    }

    function getSearchJobs($search){
        /*$query = $this->db->select('*');
        ->where(array('title' => $search ));
        ->from('jobs');
        ->get();
        if($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }*/
    }



    function getJobsByCategoryId($categoryId) {
        $query = $this->db->select('*')
            ->from('jobs')
            ->join('categoryables', 'categoryables.categoryable_id = jobs.id')
            ->join('project_category', 'categoryables.category_id = project_category.id')
            ->where('categoryable_type', 'job')
            ->where('categoryables.category_id', $categoryId)
            ->where('jobs.is_deleted', 0)
            ->get();

        if ($query->num_rows() < 1) {
            return array();
        }
        return $query->result_array();
    }

}
