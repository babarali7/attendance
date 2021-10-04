<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menus extends CI_Model {

    function index() {
        
    }

    public function fetch_all_countries() {

        $this->db->select()->from('prm_country');
        $query = $this->db->get();
        return $result = $query->result();
    }

    public function UserInsert($var) {
        $this->db->set($var);
        $this->db->insert('user');
        $email = $var['email'];
        return $this->AuthenticLogup("email", $email);
    }

    public function fetch_parent_menu() {

         $where = array(
             "PARENT_ID" => 0
        );

        $this->db->select()->from('usr_menu')->where($where)->order_by('MENU_ID', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    
    
     public function fetch_child_menu($menu_id) {

         $where = array(
             "PARENT_ID" => $menu_id,
          
        );

        $this->db->select()->from('usr_menu')->where($where)->order_by('MENU_ID', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    
    public function fetch_permission_navi(){
         $this->db->select()->from('usr_menu');
        $query = $this->db->get();
        return $query->result();
        
    }
    
    
    public function fetch_parent_navi() {

       if($this->session->userdata('group_id') == 1){ 
         
          $query =  $this->db->query("SELECT * FROM usr_menu WHERE PARENT_ID =0 ORDER BY SORT_ORDER ASC");
       
       }
       
        if($this->session->userdata('group_id') != 1){ 
                  $group = $this->session->userdata('group_id');

          $query =  $this->db->query("SELECT * FROM usr_menu AS UM , usr_permission UP
                                        WHERE
                                        UM.MENU_ID = UP.MENU_ID
                                        AND 
                                        UP.PER_SELECT =1 
                                        AND
                                        UP.GROUP_ID =$group      
                                        AND
                                        UM.PARENT_ID =0 ORDER BY UM.SORT_ORDER ASC");
       
       }
       
        return $query->result();
        
    }
    
    
    
     public function fetch_child_navi() {

       if($this->session->userdata('group_id') == 0){ 
         
          $query =  $this->db->query("SELECT * FROM usr_menu WHERE PARENT_ID !=0 ORDER BY SORT_ORDER ASC");
       
       }
       
        if($this->session->userdata('group_id') != 0){ 
         $group = $this->session->userdata('group_id');
          $query =  $this->db->query("SELECT * FROM usr_menu AS UM , usr_permission UP
                                        WHERE
                                        UM.MENU_ID = UP.MENU_ID
                                        AND 
                                        UP.PER_SELECT =1 
                                        AND
                                        UP.GROUP_ID = $group
                                        AND
                                        UM.PARENT_ID !=0 ORDER BY SORT_ORDER ASC");
       
       }
       
        return $query->result();
        
    }
    

    public function getCategoryTreeForParentId($parent_id = 0) {
         $categories = array();
        $this->db->from('usr_menu');
        $this->db->where('PARENT_ID', $parent_id);
        $result = $this->db->get()->result();
        foreach ($result as $mainCategory) {
            $category = array();
            $category['MENU_ID'] = $mainCategory->MENU_ID;
            $category['MENU_TEXT'] = $mainCategory->MENU_TEXT;
            $category['MENU_URL'] = $mainCategory->MENU_URL;
            $category['sub_menu'] = $this->getCategoryTreeForParentId($category['MENU_ID']);
            $categories[$mainCategory->MENU_ID] = $category;
        }
        return $categories;
    }

    public function AuthLogin($email, $password) {

        $where = array(
            "username" => $email,
            "Password" => $password
        );
        $this->db->select()->from('um_users')->where($where);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    public function fetch_institutedata($id) {


        $sql = "SELECT * FROM 
                    institute
				WHERE INS_ID =$id";


        $query = $this->db->query($sql);

        return $query->result();
    }

	
	
	public function checkgraph(){
	
	
	  echo "model is working";
	
	
	}
	
	
}

?>