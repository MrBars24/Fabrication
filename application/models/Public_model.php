<?php
class Public_model extends MX_Model{

    public $table = "users";

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function getPublicProf($id){
         $this->db->select('*');
         $this->db->where('id', $id);
         $query = $this->db->get('member');
         if($query->num_rows() > 0){
            return $query->row();
        }
        return array();

    }

    function updatePubProf($id){
		$title = $this->input->post('public-title');
		$keyword = $this->input->post('public-keywords');
		$overview = $this->input->post('public-overview');
		$service = $this->input->post('public-service');
		$wtypes = $this->input->post('work_type');

		$data = array(
			'title' => $title,
			'keywords' =>  $keyword,
			'overview' => $overview,
			'service_description' => $service
			);
		$this->db->where('id', $id);
		$update = $this->db->update('member',$data );

		if($update){
			$this->db->where('user_id', $id);
			$this->db->delete('work_category');

			if(count($wtypes) > 0){
				foreach($wtypes as $wt){
					$dt[] = array('user_id'=>$id,'category_id'=>$wt);
				}
				$this->db->insert_batch("work_category",$dt);
			}

			$d = $this->getUpdatedProfile($id);
			$d->work_types = $this->getWorkTypes();
		}

		return $d;
    }
    function getMyWork($id){
        $this->db->select('*');
        $this->db->from('project_category as a');
        $this->db->join('work_category as b', 'b.category_id = a.id');
        $this->db->where('b.user_id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return [];
    }
	function getUpdatedProfile($id){
		$this->db->select('title,keywords,overview,service_description');
		$this->db->from("member");
		$this->db->where("id",$id);
		$q = $this->db->get();
		if($q->num_rows() > 0){
			return $q->row();
		}

		return [];

	}

    function updatePublicIndustry($id){
        $industries = $this->input->post('industry[]');
        $data = array(
            'industry' => $industries
        );
        $this->db->where('id', $id);
        return $this->db->update('member' , $data);

    }

	function getWorkTypes(){
		$this->db->select("id, display_name as text, display_name as value, display_name as label, isUserWork(".auth()->id.",id) as isUserWork");
		$q = $this->db->get('project_category');
		if($q->num_rows() > 0){
			return $q->result();
		}

		return [];
	}

    function getSkills(){
        $id = auth()->id;
        $query = $this->db->query("SELECT * FROM skills WHERE id NOT IN (SELECT skills_id FROM skills_member WHERE user_id = $id AND is_deleted = 0)");
        if($query){
            return $query->result();
        }
        return [];
    }
    function getSkillsJob(){
        $q = $_GET['q'];

        $id = auth()->id;
        $query = $this->db->query("SELECT *,title as label, title as text, title as value FROM skills WHERE id NOT IN (SELECT skills_id FROM skills_member WHERE user_id = $id AND is_deleted = 0) AND title LIKE '$q%'");
        if($query){
            return $query->result();
        }
        return [];
    }
    function getMySkills($id){
        $query = $this->db->select('skills.id as sid, skills_member.user_id, skills_member.skills_id,skills.title')
                 ->from('skills_member')
                 ->where('skills_member.user_id', $id)
                 ->join('skills', 'skills_member.skills_id = skills.id')
                 ->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return array();
        }
    }
    function removeSkills(){
        $query = $this->db->where('user_id', auth()->id)
                ->delete('skills_member');
        return $query;
    }
	function getMyAwards($id){
        $query = $this->db->where('member_id',auth()->id)->get('awards');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return array();
        }
    }
	function addAward(){
		$data = array(
			'member_id'=>auth()->id,
			'award_name'=>$this->input->post('award'),
			'year_taken'=>$this->input->post('awardyear'),
		);

		$query = $this->db->insert('awards',$data);
		if(!$this->db->insert_id()){
			$error = $this->db->error();
			$error['success'] = FALSE;
			echo json_encode($error);
			exit;
		}
		return $this->getAward($this->db->insert_id());
    }

	function getAward($id){
		return $this->db->where('id',$id)->get('awards')->row();
	}

    function checkSkills($skills){
        $query = $this->db->select('id')
                 ->where('id', $skills)
                 ->get('skills');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return [];
        }
    }
    function createSkillsToMember($skill){

        foreach($skill as $skill_id):
            $data = array(
                'user_id' => auth()->id,
                'skills_id' => $skill_id
            );
            $this->db->insert('skills_member', $data);
        endforeach;

    }

    function createSkillsInMember($expertise){
        $skill = array();
        $expertise = array_map(function($ex) {
                    $checkSkill = $this->checkSkills($ex);

                    if(!$checkSkill){
                        $skill_id = $this->createSkills($ex);
                        $skill = $skill_id;
                    }else{
                        $skill = $checkSkill->id;
                    }

            return $skill;
        }, $expertise);

        return $expertise;

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
    function deleteSkills($id){
        $query = $this->db->where('id', $id)
                 ->set('is_deleted', 1)
                 ->update('skills_member');
        return $query;
    }

	function deleteAward($id){
		$query = $this->db->where('id', $id)
                 ->set('is_deleted', 1)
                 ->update('awards');
        return $query;
	}
}
