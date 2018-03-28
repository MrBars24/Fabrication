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

    function UpdateJob($id, $data){
        $query = $this->db->where('id', $id)
            ->update('jobs', $data);
        return $query;
    }
    function createAttached($files, $attachable_id){
        for($i=0; $i<count($files['name']); $i++){
            $data = array(
                'filename' => $files['name'][$i],
                'path' => $files[$i]['file'],
                'user_id' => $_SESSION['user']->id,
                'attachable_type' => "job",
                'job_id' => $attachable_id
            );
            $query = $this->db->insert('attachments', $data);
        }
        return $query;
    }
    function deleteFiles($id){
        $data = array(
            'is_deleted' => 1,
            'deleted_at' => date("Y-m-d h:i:sa")
        );
        $this->db->where_in('id', $id);
        $query = $this->db->update('attachments', $data);
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
            $this->like(array("title"=>$search));
        }

        $where = array(
            "expert_watchlist" => auth()->id
        );

        $q = $this->getIndexDataCount("job_details",$limit,$offset,'created_at','DESC',$where);
        $q['draw'] = (int)$offset;
        return $q;
    }

    function all(){
         $limit = 0;
         $offset = 0;
         $search = "";

         if(isset(auth()->id)){
             $search_sql = array(
                 'fabricator_id !=' => auth()->id,
                 'is_deleted' => 0
             );
         }else{
            $search_sql = array(
                'is_deleted' => 0
            );
         }
         if(isset($_GET['limit'])){
             $limit = $_GET['limit'];
         }

         if(isset($_GET['page'])){
             $offset = $_GET['page'];
         }

        if(isset($_GET['search']['string'])){
            $search = $_GET['search']['string'];
            $search_sql['title LIKE'] = "%$search%";
        }

        if(isset($_GET['search']['status'])){
            if($_GET['search']['status'] != 'all'){
                $search = $_GET['search']['status'];
                $search_sql['status'] = $_GET['search']['status'];
            }
        }

        if(isset($_GET['search']['budget'])){
            if($_GET['search']['budget'] != 'any'){
                list($min,$max) = explode("-", $_GET['search']['budget']);

                $search = $_GET['search']['budget'];
                $this->rawWhere("(budget_min >= $min AND budget_min <= $max) OR (budget_max >= $min AND budget_max <= $max)");
            }
        }

        if(isset($_GET['search']['category'])){
            if($_GET['search']['category'] != 'any'){
                $search = $_GET['search']['category'];
                $search_sql['project_category_id'] = $search;
            }
        }

         @$id = auth()->id;
         $q = $this->getIndexDataCount("job_details",
                $limit,
                $offset,
                'created_at',
                'DESC',
                $search_sql,
                '',
                '',
                '',
                '',"*,IF(expert_watchlist = '$id',1,0) as is_watchlist");
         //$q = $this->getIndexDataCount("jobs",$limit,$offset,'created_at','DESC',);
         $q['draw'] = (int)$offset;
         return $q;
    }


    function myAllJobs(){
         $limit = 5;
         $offset = 0;
         $search = "";
         if(isset(auth()->id)){
             $search_sql = array(
                 'fabricator_id' => auth()->id,
                 'is_deleted' => 0
             );
         }
         $q = $this->getIndexDataCount("job_details",$limit,$offset,'created_at','DESC', $search_sql);
         return $q;
        //  if(isset($_GET['limit'])){
        //      $limit = $_GET['limit'];
        //  }
        //
        //  if(isset($_GET['page'])){
        //      $offset = $_GET['page'];
        //  }
        //
        // if(isset($_GET['search']) > 0){
        //     $search = $_GET['search'];
        //     $this->like(array("title"=>$search));
        //  }

         //@$id = auth()->id;
         // $q = $this->getIndexDataCount("jobs",
         //        $limit,
         //        $offset,
         //        'jobs.created_at',
         //        'DESC',
         //        $search_sql,
         //        '',
         //        'watchlists',
         //        'jobs.id=watchlists.job_id','LEFT',"jobs.*,IF(watchlists.expert_id = '$id',1,0) as is_watchlist,
         //        (SELECT count(*) from bids where job_id = jobs.id) as bids");
         //$q['draw'] = (int)$offset;
    }

    function allOpen($isMe = FALSE){
        if($isMe){
            $search_sql = array(
                'fabricator_id' => $_SESSION['user']->id,
                'is_deleted' => 0
            );
        }else{
            $search_sql = array(
                'fabricator_id !=' => $_SESSION['user']->id,
                'is_deleted' => 0
            );
        }

        $this->db->where($search_sql);
        $q = $this->db->get("job_details");

        if($q->num_rows() > 0){
            return $q->result();
        }

        return [];
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
        $user_id = auth()->id;
        $query = $this->db->select("*,IF(expert_watchlist = '$user_id',1,0) as is_watchlist")
        ->from('job_details')
        ->where('id',$id)
        ->where('is_deleted', 0)
        ->get();
        if($query->num_rows() > 0){
            return $query->row();
        }
        else {
            return false;
        }
    }
    function getAllJobInfo($id){
        $query = $this->db->select('*')
                ->from('job_details')
                ->where('id', $id)
                ->get();
        return $query->row();
    }
    function getAllJobsInfo($id){
        $query = $this->db->select('*')
                 ->from('job_details')
                 ->where('fabricator_id', $id)
                 ->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
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
    function getWinJob($id){
        $query = $this->db->select('jobs.*, bids.*, member.fullname, member.id')
                 ->from('jobs')
                 ->join('bids', 'jobs.id = bids.job_id')
                 ->join('member','member.id = jobs.accepted_bid')
                 ->where('bids.expert_id', $id)
                 ->where('bids.status', 1)
                 ->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }
    function getJobAvailable($id){
        $query = $this->db->select('jobs.title, jobs.id')
                 ->where('fabricator_id', $id)
                 ->where('status', "open")
                 ->where('is_deleted', 0)
                 ->get('jobs');
        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }

    /**
    *
    * get post and bids summary
    *
    */

    function getSummary(){
        $q = $this->db->select('max_bid, max_post, my_bids, my_posts')
            ->from('user_details')
            ->where("id",auth()->id)
            ->get();

        if($q->num_rows() > 0){
            return $q->row();
        }

        return [];
    }
}
