<?php
class MX_Model extends CI_Model{

    protected $select = "";
    protected $likes;
    protected $where;
    protected $pos;

    function __construct(){
        parent::__construct();
        $this->load->database();
    }


    /**
     * getIndexData
     *
     * Function for get data for index page (support pageination)
     *
     * @param   string  $table    DB table
     * @param   string  $limit    DB limit
     * @param   string  $offset   DB offset
     * @param   string  $orderby  DB order by field. Default is 'timestamp_create'
     * @param   string  $sort     DB sort by asc or desc. Default is 'desc'
     * @param   string  $search_sql    DB where condition. NULL if not need. Example "name='Joe' AND status LIKE '%boss%' OR status1 LIKE '%active%" for string. And array('field'=>'value') for array
     * @param   string  $groupby    DB group by field. NULL if not need
     * @param   string  $join_db   Table to join or NULL
     * @param   string  $join_where   Join condition or NULL
     * @param   string  $join_type   Join type ('LEFT', 'RIGHT', 'OUTER', 'INNER', 'LEFT OUTER', 'RIGHT OUTER') or NULL
     * @param   string  $sel_field   DB field select. Default is (*)
     * @return  array
     */

    public function fields($sql){
        $this->select = $sql;
    }

    public function like($like,$position='both'){
        $this->likes = $like;
        $this->pos = $position;
    }

    public function rawWhere($where){
        $this->where = $where;
    }

    public function find($id){
        $this->db->where("id",$id);

        if(isset($this->table)){
            $q = $this->db->get($this->table);
        }else{
            $cl = get_called_class();
            $cl = str_replace("_model","",$cl);
            $q = $this->db->get($cl);
        }

        if($q->num_rows() > 0){
            return $q->row();
        }

        return [];
    }

    public function findBy($table,$id){
        $this->db->where("id",$id);
        $q = $this->db->get($table);

        if($q->num_rows() > 0){
            return $q->row();
        }

        return [];
    }

    public function getIndexData($table, $limit = 0, $offset = 0, $orderby = '', $sort = '', $search_sql = '', $groupby = '', $join_db = '', $join_where = '', $join_type = '', $sel_field = '*'){
        $q = $this->getData($table, $limit, $offset, $orderby, $sort, $search_sql, $groupby, $join_db, $join_where, $join_type, $sel_field);

        return $q["data"];
    }

    public function getIndexDataCount($table, $limit = 0, $offset = 0, $orderby = '', $sort = '', $search_sql = '', $groupby = '', $join_db = '', $join_where = '', $join_type = '', $sel_field = '*'){
        $q = $this->getData($table, $limit, $offset, $orderby, $sort, $search_sql, $groupby, $join_db, $join_where, $join_type, $sel_field);

        if($limit != 0 && $q['total'] > 0){
            $max_page = ceil($q['total'] / $limit);
        }else{
            $max_page = 0;
        }
        $q['count'] = $q['total'];
        $q['total'] = $max_page;
        return $q;
    }

    public function getData($table, $limit = 0, $offset = 0, $orderby = '', $sort = '', $search_sql = '', $groupby = '', $join_db = '', $join_where = '', $join_type = '', $sel_field = '*'){
        // Get a list of all user accounts
        $count = $this->countData($table, $search_sql, $groupby, $orderby, $sort, $join_db, $join_where, $join_type);

        if($this->select != ""){
            $sel_field = $this->select;
            $this->select = "";
        }

        $this->db->select($sel_field);
        if($join_db && $join_where){
            $this->db->join($join_db, $join_where, $join_type);
        }
        if($search_sql){
            if(is_array($search_sql)){
                foreach($search_sql as $key => $value){
                    $this->db->where($key, $value);
                }
            }else{
                $this->db->where($search_sql);
            }
        }

        if(!empty($this->where)){
            if(is_array($this->where)){
                foreach($this->where as $key => $value){
                    $this->db->where($key, $value);
                }
            }else{
                $this->db->where($this->where);
            }
            $this->where = null;
        }

        if(!empty($this->likes)){
            if(is_array($this->likes)){
                foreach($this->likes as $key => $value){
                    $this->db->like($key, $value, $this->pos);
                }
            }else{
                $this->db->like($this->likes);
            }
            $this->likes = null;
        }

        if($orderby && $sort){
            $this->db->order_by($orderby, $sort);
        }elseif($orderby){
            $this->db->order_by($orderby);
        }
        if($groupby)
            $this->db->group_by($groupby);
        if($limit && $limit != 0){
            if($offset > ceil((intval($count) / intval($limit))))
                $offset = ceil((intval($count) / intval($limit)));
            $start = (intval($offset) * intval($limit)) - intval($limit);
            if($start < 0)
                $start = 0;
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get($table);
        //$this->printLastQuery();
        if(!empty($query)){
            if($query->num_rows() !== 0){
                $row = $query->result();
                $tmp = array(
                    "total" => $count,
                    "data" => $row
                );
                return $tmp;
            }else{
                return array(
                    "total" => 0,
                    "data" => []
                );
            }
        }else{
            return [];
        }
        unset($query, $row);
    }

    public function countData($table, $search_sql = '', $groupby = '', $orderby = '', $sort = '', $join_db = '', $join_where = '', $join_type = '') {

        $this->db->select('*');
        if($join_db && $join_where){
            $this->db->join($join_db, $join_where, $join_type);
        }
        if ($search_sql) {
            if (is_array($search_sql)) {
                /* $search = array('field'=>'value') */
                foreach ($search_sql as $key => $value) {
                    $this->db->where($key, $value);
                }
            } else {
                /* $search = "name='Joe' AND status LIKE '%boss%' OR status1 LIKE '%active%'") */
                $this->db->where($search_sql);
            }
        }

        if(!empty($this->where)){
            if(is_array($this->where)){
                foreach($this->where as $key => $value){
                    $this->db->where($key, $value);
                }
            }else{
                $this->db->where($this->where);
            }
        }

        if(!empty($this->likes)){
            if(is_array($this->likes)){
                foreach($this->likes as $key => $value){
                    $this->db->like($key, $value, $this->pos);
                }
            }else{
                $this->db->like($this->likes);
            }
        }

        if ($groupby){
            $this->db->group_by($groupby);
        }
        if(is_array($orderby)){
            foreach ($orderby as $value) {
                $this->db->order_by($value, $sort);
            }
        }else{
            if ($orderby && $sort) {
                $this->db->order_by($orderby, $sort);
            }elseif($orderby){
                $this->db->order_by($orderby);
            }
        }
        $query = $this->db->get($table);
        //$this->printLastQuery();
        if (!empty($query)) {
            return $query->num_rows();
        } else {
            return FALSE;
        }
        unset($query);
    }

    public function printGetCompiledSelect(){
        echo $this->db->get_compiled_select();
    }

    public function printLastQuery(){
        echo $this->db->last_query();
    }

}


?>
