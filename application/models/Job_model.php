<?php

class Job_model extends MX_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    function createSkills($skills){
		$data = array('title'=>$skills);
		$query = $this->db->insert('skills',$data);
		if(!$this->db->insert_id()){
			$error = $this->db->error();
			$error['success'] = FALSE;
			echo json_encode($error);
			exit;
		}
		return $this->db->insert_id();
    }
    // /*Create Skillss for jobs*/

    function removedSkills($id){
        $query = $this->db->where('job_id', $id)
                          ->delete('jobs_expertise');
        return $query;
    }
    function removedMaterial($id){
        $query = $this->db->where('job_id', $id)
                         ->delete('jobs_materials');
        return $query;
    }
	 function createSkillsJob(){
		$expertise = array_unique($this->input->post('expertise'));
        if($expertise){
            $expertise = array_map(function($ex) {
                $skill = json_decode($ex);
                    if($skill->isNew):
                        $skill_id = $this->createSkills($skill->keystring);
                        $skill->new_id = $skill_id;
                    else:
                        $skill->new_id = $skill->keystring;
                    endif;
                return $skill;
            }, array_unique($expertise));
            return $expertise;
        }
	}

    function createSkillsToJob($id, $job_id){

        foreach($id as $skill_id):

            $data = array(
                'job_id' => $job_id,
                'skill_id' => $skill_id->new_id
            );
            $this->db->insert('jobs_expertise', $data);
        endforeach;
        return TRUE;
    }
    function createJob($data){
        $query = $this->db->insert('jobs', $data);
        $id = $this->db->insert_id();
        return $id;
    }
    function createMaterial($job_id, $materials){

        if($materials){
            foreach($materials as $material){
                $data = array(
                    'job_id' => $job_id,
                    'material_id' => $material
                );
                $this->db->insert('jobs_materials', $data);
            }
        }
        return TRUE;
    }

    function UpdateJob($id, $data){
		$this->db->set('bidding_expire_at','NOW()',false);
        $query = $this->db->where('id', $id)
            ->update('jobs', $data);
        return $query;
    }
	function closeBid($id, $data){
		$this->db->set("bidding_expire_at","NOW()",false);
		$query = $this->db->where('id', $id)
		->update('jobs', $data);

		if($query){
			return $this->db->where('id',$id)->get('jobs')->row()->bidding_expire_at;
		}

		return FALSE;
	}
    function createAttached($files, $attachable_id){
        for($i=0; $i<count($files['name']); $i++){
            $data = array(
                'filename' => $files['name'][$i],
                'path' => $files[$i]['file'],
                'user_id' => auth()->id,
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
            "watchlists.expert_id" => auth()->id
        );

        $q = $this->getIndexDataCount("job_details",$limit,$offset,'watchlists.created_at','DESC',$where,
		'',
		'watchlists',
		'job_details.id = watchlists.job_id',
		'INNER',
		'*,watchlists.expert_id AS expert_watchlist');
        //$q['draw'] = (int)$offset;
        return $q;
    }

    function finishJob($id){
        $data = array(
            'finished_at' => date("Y-m-d h:i:sa"),
            'status' => 'finished'
        );
        $query = $this->db->where('id', $id)
                 ->update('jobs', $data);
        return $query;
    }
	
	function clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

    function all(){
         $limit = 0;
         $offset = 0;
         $search = "";

         $search_sql = array('is_deleted' => 0);
         if(isset($_GET['limit'])){
             $limit = $_GET['limit'];
         }

         if(isset($_GET['page'])){
             $offset = $_GET['page'];
         }

        if(isset($_GET['search']['string'])){
            $search = $_GET['search']['string'];
			$search = $this->clean($search);
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
                $this->rawWhere("((budget_min >= $min AND budget_min <= $max) OR (budget_max >= $min AND budget_max <= $max))");
            }
        }

        if(isset($_GET['search']['category'])){
            if($_GET['search']['category'] != 'any'){
                $search = $_GET['search']['category'];
                $search_sql['project_category_id'] = $search;
            }
        }

         @$id = auth()->id;

		 if(isset(auth()->id)){
			$selection = "*,isWatchlist(id,$id) as is_watchlist";
		 }else{
			$selection = "*";
		 }

         $q = $this->getIndexDataCount("job_details",
                $limit,
                $offset,
                'created_at',
                'DESC',
                $search_sql,
                '',
                '',
                '',
                '',$selection);
         //$q = $this->getIndexDataCount("jobs",$limit,$offset,'created_at','DESC',);
         //$q['draw'] = (int)$offset;
         return $q;
    }


    function myAllJobs(){
		$limit = 0;
         $offset = 0;
		
         if(isset($_GET['limit'])){
             $limit = $_GET['limit'];
         }
		 
		 if(isset($_GET['page'])){
             $offset = $_GET['page'];
         }
		 
         $search = "";
         if(isset(auth()->id)){
             $search_sql = array(
                 'fabricator_id' => auth()->id,
                 'is_deleted' => 0
             );
         }
		 
		 if(isset($_GET['search']['status'])){
            $search = $_GET['search']['status'];
			$search_sql['status'] = $search;
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
                'is_deleted' => 0,
                'status' => "open"
            );
        }else{
            $search_sql = array(
                'fabricator_id !=' => $_SESSION['user']->id,
                'is_deleted' => 0,
                'status' => "open"
            );
        }

        $this->db->where($search_sql);
		$this->db->order_by('created_at','DESC');
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
		
		if(empty($user_id)) redirect('/');
		
        $query = $this->db->select("*,isWatchlist($id,$user_id) as is_watchlist")
				->from('job_details')
				->where('id',$id)
				->where('is_deleted', 0)
				->get();
        if($query->num_rows() > 0){

			$row = $query->unbuffered_row();
			$row->materials = $this->getJobMaterials($row->id);
			$row->expertise = $this->getJobExpertise($row->id);

            return $row;
        }
        else {
            return false;
        }
    }

	function getJobMaterials($id){
		$q = $this->db->select('a.id,a.material_name')
			->from('materials_list a')
			->join('jobs_materials b','a.id = b.material_id')
			->where('b.job_id',$id)
			->get();
		if($q->num_rows() > 0){
			return $q->result();
		}

		return [];
	}

	function getJobExpertise($id){
		$q = $this->db->select('a.id,a.title')
			->from('skills a')
			->join('jobs_expertise b','a.id = b.skill_id')
			->where('b.job_id',$id)
			->get();

		if($q->num_rows() > 0){
			return $q->result();
		}

		return [];
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
                 ->join('member','member.id = jobs.fabricator_id')
                 ->where('bids.expert_id', $id)
                 ->where('bids.status', 1)
                 ->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }

    function jobsWonActive($user_id) {
      $query = $this->db->select('jobs.*, bids.*, member.fullname, member.id')
               ->from('jobs')
               ->join('bids', 'jobs.id = bids.job_id')
               ->join('member','member.id = jobs.accepted_bid')
               ->where('bids.expert_id', $user_id)
               ->where('bids.status', 1)
               ->where('jobs.finished_at IS NULL', NULL, FALSE)
               ->get();
      if($query->num_rows() > 0){
          return $query->result();
      }
      return array();
    }
    function getJobForBid($id){
        $query = $this->db->select('*')
                          ->where('id', $id)
                          ->get('jobs');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return array();
        }
    }
    function jobsWonActivePaginate($user_id) {
      $jobs_won_ids = array_map(function($e) {
        return $e->job_id;
      }, $this->jobsWonActive($user_id));

      if (count($jobs_won_ids) == 0) {
        return array('data' => array(), 'total' => 0);
      }

      $limit = 0;
      $offset = 0;

      if(isset($_GET['limit'])){
          $limit = $_GET['limit'];
      }
      if(isset($_GET['page'])){
          $offset = $_GET['page'];
      }

      $q = $this->getIndexDataCount("job_details",
           $limit,
           $offset,
           'created_at',
           'DESC',
           'id IN ' .' (' . implode(',', $jobs_won_ids) .')',
           '',
           '',
           '',
           '',
           '*');

      return $q;
    }

    // Previous Jobs

    public function previousJobs($user_id) {
      $query = $this->db->select('bids.*')
               ->from('jobs')
               ->join('bids', 'jobs.id = bids.job_id')
               ->join('member','member.id = jobs.accepted_bid')
               ->where('bids.expert_id', $user_id)
               ->where('bids.status', 1)
               ->where('jobs.finished_at IS NOT NULL', NULL, FALSE)
               ->order_by('bids.accepted_at', 'desc')
               ->get();
      if($query->num_rows() > 0){
          return $query->result_array();
      }
      return array();
    }

    public function previousJobsPaginate($user_id) {
      $previous_jobs = $this->previousJobs($user_id);

      if (count($previous_jobs) == 0) {
        return array('data' => array(), 'total' => 0);
      }

      $previous_jobs_id = array_column($previous_jobs, 'job_id');

      $previous_jobs = array_map(function($e) {
        $data = [];
        $data['job_id'] = $e['job_id'];

        $data['bid'] =$e;
        return $data;
      }, $previous_jobs);


      $limit = 0;
      $offset = 0;

      if(isset($_GET['limit'])){
          $limit = $_GET['limit'];
      }
      if(isset($_GET['page'])){
          $offset = $_GET['page'];
      }

      $jobs_paginated = $this->getIndexDataCount("job_details",
           $limit,
           $offset,
           'created_at',
           'DESC',
           'id IN ' .' (' . implode(',', $previous_jobs_id) .')',
           '',
           '',
           '',
           '',
           '*');

      $jobs_paginated['data'] = array_map(function($e) use ( &$previous_jobs) {
          foreach($previous_jobs as $job) {
            if($e->id == $job['job_id']) {
              $e->bid_info = $job['bid'];
              break;
            }
          }
          return $e;
      }, $jobs_paginated['data']);
      return $jobs_paginated;
    }


    function getJobAvailable($id){
        $query = $this->db->select('jobs.title, jobs.id')
                 ->where('fabricator_id', $id)
                 ->where('status', "open")
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
