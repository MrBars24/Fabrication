<?php
class User_model extends MX_Model{

    public $table = "users";
    private $loginFields = 'id, email, username, user_type, account_type_due, membership_hash, user_id, firstname, lastname, max_bid, max_post, my_bids, my_posts, login_type';
	private $memberFields = 'avatar,avatar_thumbnail,id,fullname,account_type,account_type_due,membership_hash,overview,service_description,phone,mobile,bday,address,city,state,country_id,country_name,is_deleted,created_at,updated_at,deleted_at,title,keywords';

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

	function loginCheck(){
        $username = $this->input->post('username');
        $pass = $this->input->post('pwd');

        $this->db->select("id, username, user_id, user_type, firstname, lastname");
        $this->db->where("username",$username);
        $this->db->where("password",$pass);
        $q = $this->db->get("account");

        if($q->num_rows() > 0){
            $tmp =  $q->row();
            return $tmp;
        }

        return [];
    }

    function setLoginStamp($id){
        $this->db->where("id",$id);
        $this->db->set('last_login','NOW()',FALSE);
        $this->db->update("users");
    }

    function submitFabricator($data){
        if($this->db->insert("fabricators",$data)){
            return $this->db->insert_id();
        }else{
            return FALSE;
        }
    }

    function submitUpdateFabricator($data, $id){
        $this->db->where('id', $id);
        if($this->db->update('member', $data)){
            return TRUE;
        }else{
            return FALSE;
        }

    }

    function submitMember($data){
        if($this->db->insert("member", $data)){
			$member_id = $this->db->insert_id();

			$this->db->set('member_id',$member_id);
			$this->db->set('package_id',$data["account_type"]);
			$this->db->set('history_hash',md5(uniqid($member_id.$data["account_type"].time(), true)));
			$this->db->set('end_subscription_at','NOW() + INTERVAL 1 MONTH',false);
			$this->db->insert('membership_history');

			$this->db->where('id',$this->db->insert_id());
			$history = $this->db->get('membership_history')->row();

			$this->db->where("id",$member_id);
			$this->db->set("account_type_due",$history->end_subscription_at);
			$this->db->set("account_type",$data["account_type"]);
			$this->db->set("membership_hash",$history->history_hash);
			$this->db->update('member');


            return $member_id;
        }else{
            return FALSE;
        }
    }

    function submitUser($data){
        if($this->db->insert("users",$data)){
            return $this->db->insert_id();
        }else{
            return FALSE;
        }
    }

    function submitUpdateUser($data, $id){
        $this->db->where('user_id', $id);
        if($this->db->update("users", $data)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    function checkEmail($username){
        $this->db->select('*');

        if(filter_var($username, FILTER_VALIDATE_EMAIL)){
            $this->db->where('email', $username);
        }
        else{
            $this->db->where('username', $username);
        }

        $query = $this->db->get('users');
        if($query->num_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }

    function checkSocialLogin($type){
        $password = hash_hmac("sha1", $_POST['id'], "e-fab");

        $this->db->select($this->loginFields);
        $this->db->where('login_type',$type);
        $this->db->where('password', $password);
        $query = $this->db->get('user_details');

        if($query->num_rows() > 0){
            $row = $query->row();
            $row->user_details = $this->getMemberInfo($row->user_id);
            if($row->user_type == "member"){
                $row->url_redirect = base_url() . 'work';
            }
            else{
                $row->url_redirect = base_url() . 'admin';
            }
            return $row;
        }
        return FALSE;

    }

    function checkLogin(){
    	$pwd = hash_hmac("sha1", $this->input->post('pwd'), "e-fab");
        $username = $this->input->post('username');
        $password = $pwd;

        if(isset($_POST['id'])){
            $username = $_POST['id'];
            $password = $pwd = hash_hmac("sha1", $_POST['id'], "e-fab");
        }

        $this->db->select($this->loginFields);

        if(filter_var($username, FILTER_VALIDATE_EMAIL)){
            $this->db->where('email', $username);
        }
        else{
            $this->db->where('username', $username);
        }

		$this->db->select($this->loginFields);
        $this->db->where('password', $password);
        $query = $this->db->get('user_details');
        if($query->num_rows() > 0){
            $row = $query->row();
            $row->user_details = $this->getMemberInfo($row->id);
            if($row->user_type == "member"){
                $row->url_redirect = base_url() . 'work';
            }
            else{
                $row->url_redirect = base_url() . 'admin';
            }
            return $row;
        }
        return FALSE;
    }
    function getMemberInfo($id){

        $this->db->select($this->memberFields);
        $this->db->where('id', $id);
        $query = $this->db->get('user_details');
        if($query->num_rows() > 0){
            return $query->row();
        }
        return array();
    }
    function checkActivate($email){
        $query = $this->db->where('is_active', 1)
                 ->where('email', $email)
                 ->get('users');
        if($query->num_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }
    function getUserInfo($id){
        $this->db->where('id', $id);
        $query = $this->db->get('user_details');
        if($query->num_rows() > 0){
            return $query->row();
        }
        return array();
    }
    function getUserDetails($id){
        $query = $this->db->select('*')
             ->where('user_id', $id)
             ->get('user_details');
        if($query->num_rows() > 0){
            return $query->row();
        }
        return array();
    }
    // function getFabricatorInfo($id){
    //     $this->db->select('*');
    //     $this->db->where('id', $id);
    //     $query = $this->db->get('fabricators');
    //     if($query->num_rows() > 0){
    //         return $query->row();
    //     }
    //     return array();
    // }
    function updateUserSession(){
        $this->db->select($this->loginFields);

        $this->db->where("id",auth()->id);
        $query = $this->db->get('user_details');

        if($query->num_rows() > 0){
            $row = $query->row();
            $row->user_details = $this->getMemberInfo($row->user_id);

            $_SESSION['user'] = $row;
        }
    }

    public function updateAvatar($id, $filename) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('member', array(
            'avatar' => $filename
        ));
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function changePassword(){
        $pwd = hash_hmac("sha1", $this->input->post('npwd'), KEYCODE);
        $old = hash_hmac("sha1", $this->input->post('pwd'), KEYCODE);

        $this->db->where('id',auth()->id);
        $this->db->where('password',$old);
        if($this->db->update('users',array('password'=>$pwd))){
            return TRUE;
        }

        return FALSE;
    }

    public function setActive($id,$email){
        $this->db->where("user_id",$id);
        $this->db->where("email",$email);
		$update = $this->db->update("users",array("is_active"=>1));

		if($update){
			$this->db->where("member_id",$id);
			$this->db->set('end_subscription_at','NOW() + INTERVAL 1 MONTH',false);
			$this->db->update('membership_history');

			$this->db->where('member_id',$id);
			$history = $this->db->get('membership_history')->row();

			$this->db->where("id",$id);
			$this->db->set("account_type_due",$history->end_subscription_at);
			$this->db->update('member');
		}

        return $update;

    }

    function checkLoginConfirmation($id,$email){
        $this->db->select($this->loginFields);
        $this->db->where('user_id', $id);
        $this->db->where('email', $email);
        $query = $this->db->get('user_details');
        if($query->num_rows() > 0){
            $row = $query->row();
            $row->user_details = $this->getMemberInfo($row->user_id);
            if($row->user_type == "member"){
                $row->url_redirect = base_url() . 'work';
            }
            else{
                $row->url_redirect = base_url() . 'admin';
            }
            return $row;
        }
        return FALSE;
    }

    public function checkAccountExists($email){
        $this->db->where("email",$email);
        $this->db->where("login_type","google");
        $q = $this->db->get("users");

        if($q->num_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }

	public function getUser($email){
        $this->db->where("email",$email);
        $q = $this->db->get("users");

        if($q->num_rows() > 0){
            return $q->row();
        }
        return [];
    }

	public function addResetToken($id,$token){
		$this->db->where("id",$id);
		return $this->db->update("users",array(
			"reset_token" => $token
		));
	}

	public function resetPassword($id,$reset){
		$this->db->where("id",$id);
		$this->db->where("reset_token",$reset);
		$this->db->update("users",array(
			"password" => hash_hmac("sha1", $_POST['npwd'], KEYCODE)
		));



		return $this->db->affected_rows();
	}

    function allMember(){
        $limit = 0;
        $offset = 0;
        $search = "";
        $search_sql = [];

        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        if(isset($_GET['page'])){
            $offset = $_GET['page'];
        }
        if(isset($_GET['search']['txtsearch'])){
            $search = $_GET['search']['txtsearch'];
            $search_sql['fullname LIKE'] = "%$search%";
        }
		if(isset($_GET['search']['string'])){
            $search = $_GET['search']['string'];
            $search_sql['fullname LIKE'] = "%$search%";
        }
        if(isset($_GET['search']['country'])){
          if ($_GET['search']['country'] != 'any') {
            $search_sql['country_id'] = $_GET['search']['country'];
          }
        }
        if(isset($_GET['search']['category'])){
          if($_GET['search']['category'] != 'any') {
            $search_sql['category_id'] = $_GET['search']['category'];
          }
        }
        if(isset($_GET['search']['rating'])){
          if($_GET['search']['rating'] != 'any') {
            $search_sql['average_rating >='] = $_GET['search']['rating'];
          }
        }


         $q = $this->getIndexDataCount("user_details",
           $limit,
           $offset,
           'user_details.user_id',
           'DESC',
           $search_sql,
           'user_details.user_id',
           'work_category',
           'work_category.user_id = user_details.user_id',
           'LEFT',
           'user_details.*,work_category.category_id'
         );

         //$q = $this->getIndexDataCount("jobs",$limit,$offset,'created_at','DESC',);

		 for($i=0;$i<count($q['data']);$i++){
			$q['data'][$i]->work_type = $this->getWorkType($q['data'][$i]->user_id);
			$q['data'][$i]->user_expertise = $this->getExpertise($q['data'][$i]->user_id);
		 }

         return $q;
    }

	function getWorkType($id){
		$this->db->select('category_id,(SELECT display_name FROM project_category WHERE id = work_category.category_id) as category');
		$this->db->where('user_id',$id);
		$q = $this->db->get('work_category');
		if($q->num_rows() > 0){
			return $q->result();
		}
		return [];
	}
	
	function getExpertise($id){
		$this->db->select('skills_id,(SELECT title FROM skills WHERE id = skills_member.skills_id) as category');
		$this->db->where('user_id',$id);
		$q = $this->db->get('skills_member');
		if($q->num_rows() > 0){
			return $q->result();
		}
		return [];
	}

	function generateMembershipHistory(){
		$this->db->where('id > 580');
		$mem = $this->db->get('member');

		while($row = $mem->unbuffered_row()){
			$this->db->insert('membership_history',array(
				'member_id' => $row->id,
				'package_id' => $row->account_type,
				'history_hash' => md5(uniqid($row->id.$row->account_type.time(), true))
			));

			$this->db->where('id',$this->db->insert_id());
			$history = $this->db->get('membership_history')->row();

			$this->db->where("id",$row->id);
			$this->db->set("membership_hash",$history->history_hash);
			$this->db->set("account_type_due",'NOW() + INTERVAL 1 MONTH', false);
			$this->db->update('member');
		}
	}

    function getLatestActive(){
        $this->db->select('*');
        $this->db->order_by('last_login', DESC);
        $this->db->limit(3);
        $query = $this->db->get('user_details');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return array();
        }
    }
}
