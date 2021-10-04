<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General extends CI_Model {

    function index() {
        
    }

     
    //Pagintaion.....
    public function count_all($tbl){

       return $this->db->count_all($tbl);
    
    }
	public function fetch_countries($limit, $start, $tbl) {
        $this->db->limit($limit, $start);
        $query = $this->db->get($tbl);
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
	
	public function checkchildMenuCount($pmenuid){
	 
	  $whr = array(
			
			"PARENT_ID" => $pmenuid
			
			);
		
			$this->db->where($whr);
			$this->db->from('usr_menu');
			return $this->db->count_all_results();
		 
	 }
	 
    public function fetch_bysinglecol($col, $tbl, $id){
        
         $where = array(
            $col => $id
        );

        $this->db->select()->from($tbl)->where($where);
        $query = $this->db->get();
        return $result = $query->result();
    }
 
     public function fetch_CoustomQuery($sql){
          $query = $this->db->query($sql);
   
          return $query->result(); 
         
     }
     
     public function find_maxid($col, $tbl) {
        
        $query = $this->db->query("SELECT ifnull(max($col),'0')+1 
                             as $col FROM `$tbl`");
   
        return $query->result(); 
        }
 
        
    public function autofetch_record($col, $tbl, $data){
    
    
        $where = "WHERE $col LIKE '%$data%'";
        $query = $this->db->query("SELECT * FROM $tbl $where");
        return $query->result();
      
    }
    

    public function create_record($data, $tbl) {

        $this->db->set($data);
        $this->db->insert($tbl);
    }

    //Fetch New Entry with Increment......
    public function fetch_maxid($tbl) {

        $this->db->select()->from($tbl);
        $query = $this->db->get();

        return $query->result();
    }

    // Fetch List for records...
    public function fetch_records($tbl) {

        $this->db->select()->from($tbl);
        $query = $this->db->get();

        return $query->result();
    }

    //Update Groupe
    public function update_group($group_name, $group_id) {

        $update = array(
            "GROUP_NAME"     => $group_name,
            "UPDATED_DATE"   => date("Y-m-d H:i:s"),
            "UPDATED_USERID" => $this->session->userdata('user_id')
        );

        $this->db->where('GROUP_ID', $group_id);
        return $this->db->update('usr_group', $update);
    }

    //Fetch Group By Id...
    public function fetch_groupbyid($id) {
        $where = array(
            "GROUP_ID" => $id
        );
        $this->db->select()->from('usr_group')->where($where);
        $query = $this->db->get();

        return $query->result();
    }

    //Fetch Menu By Id...
    public function fetch_menubyid($id) {
        $where = array(
            "MENU_ID" => $id
        );
        $this->db->select()->from('usr_menu')->where($where);
        $query = $this->db->get();

        return $query->result();
    }

    //Update Menu
    public function update_menu() {

        extract($_POST);
        $d = date("Y-m-d H:i:s");
        $update = array(
            "MENU_TEXT" => $menu_name,
            "MENU_URL" => $menu_url,
            "PARENT_ID" => $parent_id,
            "SORT_ORDER" => $sort_order,
            "E_USER_ID" => "0",
            "U_DATE_TIME" => $d
        );

        $this->db->where('MENU_ID', $menu_id);
        return $this->db->update('usr_menu', $update);
    }

    function fetch_permissionmaxno() {

        $this->db->select_max('PER_ID');
        $q = $this->db->get('usr_permission');
        $data = $q->row();

        return $data;
    }
    
    public function fetch_permissionbygroup($id) {
        $where = array(
            "GROUP_ID" => $id
        );
        $this->db->select()->from('usr_permission')->where($where);
        $query = $this->db->get();

        return $query->result();
    }
    
	 
    public function fetch_per_groupmenu($group_id, $menu_id){
          $where = array(
            "GROUP_ID" => $group_id,
              "MENU_ID" => $menu_id
        );
        $query = $this->db->get_where('usr_permission', $where);
        
        return $query->num_rows();
         
        
    }
    
    
      public function fetch_groupmenu_id($group_id, $menu_id){
          $where = array(
            "GROUP_ID" => $group_id,
              "MENU_ID" => $menu_id
        );
        $query = $this->db->get_where('usr_permission', $where);
        
        return $query->result();
         
        
    }
    
    public function update_permissionrecord($data, $tbl, $where){
        
        $this->db->where('PER_ID', $where);
       $this->db->update($tbl, $data);
        return true;
        
        
    }
    
    

    //=== Image Uploading ===//

    public function do_upload($path)
    {
                $config['upload_path']          = $path;
                $config['allowed_types']        = 'pdf|jpeg|jpg|png';
                $config['max_size']             = 5000;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('i'))
                {
                        $error = array('error' => $this->upload->display_errors());

                     //   $this->load->view('upload_form', $error);
                         return $error;
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                       // $this->load->view('upload_success', $data);
                       return $data; 
                }
      }



  public function do_upload1($img_name) {
  
    extract($_POST);
    
    $gallery_path = realpath(APPPATH . "../img/user");
    $gallery_path_url = base_url()."img/user/thumbs";
      
    
     $fileExt = array_pop(explode(".", $img_name));
       $filename = md5(time()) . "." . $fileExt;
      
       //set filename in config for upload
     //     $config['file_name'] = $filename;

    
    
    
    $config = array(
       
     'file_name' => $filename,
     'allowed_types' => 'jpg|jpeg|gif|png',
     'upload_path' => $gallery_path,
     'max_size' => '3000',
       'width' => 270,
       'height' => 250         
       
     );
   
     
     $this->load->library("upload",$config);
     
     $this->upload->do_upload();
     
     $image_data = $this->upload->data();
    
     
     $config1 = array(
       
     'source_image' => $image_data['full_path'],
     'new_image' => $gallery_path."/thumbs",
     'maintain_ration' => true,
     'width' => 150,
     'height' => 150
     
     ); 
    
    
    $config2 = array(
       
     'source_image' => $image_data['full_path'],
     'new_image' => $gallery_path,
     'maintain_ration' => true,
     'width' => 270,
     'height' => 250
     
     ); 
    
    
    
    
     $this->load->library("image_lib",$config1);
     $this->image_lib->resize();
      
      $this->image_lib->clear();
     
     $this->image_lib->initialize($config2); 
     $this->image_lib->resize();
    
     return $filename;
    
  }


   public function set_msg($msg=NULL, $msg_type=NULL) {
    
         if ($msg_type == 1) {
           
            $message = "<div class='alert alert-success'>
                        <button type='button' data-dismiss='alert' class='close' aria-label='true'><i class='material-icons'>close</i>
                        </button>
                          <span>$msg</span>
                       </div>";
              
             $this->session->set_flashdata('msg',$message);               
     
         } elseif($msg_type == 2) {
         
              $message = "<div class='alert alert-danger'>
                        <button type='button' data-dismiss='alert' class='close' aria-label='true'><i class='material-icons'>close</i>
                        </button>
                          <span> $msg </span>
                       </div>";
              $this->session->set_flashdata('msg',$message);
         
         } elseif($msg_type == 3) {
         
              $message = "<div class='alert alert-info'>
                        <button type='button' data-dismiss='alert' class='close' aria-label='true'><i class='material-icons'>close</i>
                        </button>
                          <span> $msg </span>
                       </div>";
              $this->session->set_flashdata('msg',$message);
         }


         
         
   } 


     // validate by single column
    
    public function validate_value($column_name,$table_name,$value) {
    
        $where = array(
            $column_name => $value
        );
    
       $this->db->select()->from($table_name)->where($where);
       $query = $this->db->get();
       return $query->num_rows();
    
    }
    
      
      // validate by multiple columns
    
    public function validate_bymultipleconditions($table,$where) {
     
       $this->db->select()->from($table)->where($where);
       $query = $this->db->get();
       return $query->num_rows();
    
    
    }


 public function validate_byquery($sql) {
   
      $query = $this->db->query($sql);

      return $query->num_rows();

 }
 


 ////////////////// 03 START ////////////////////////////
   
     function get_record($tbl,$order) {
       $this->db->select('*');
       $this->db->from($tbl);
       $this->db->order_by($order);
       $query = $this->db->get();
       return $query->result();
 }
 
     public function getbyId($tbl,$where,$select){
     $this->db->select($select);
     $this->db->from($tbl);
     $this->db->where($where);
     $i = $this->db->get(); 
     return ($i->num_rows > 0) ? $i->row() : array();
 }
	   
	   
     function update_record($update,$where,$tbl) {
     $this->db->where($where);
     return $this->db->update($tbl, $update);     
 }
 
     public function delete_record($tbl, $whr){
	 
      $this->db->where($whr);
      $this->db->delete($tbl); 	 
	 
}


   function fetchby_multiplecolumns($table, $whr) {
         
         return $this->db->where($whr)->get($table)->result();

   }


   function get_notifications() {
      
           $now = date("Y-m-d");

           $day = date("Y-m-d", strtotime($now . "-7 days"));
           
          return  $result = $this->db->query("SELECT * FROM `booking` 
                                    WHERE 
                                    `BK_STATUS` = 'TEMPORARY' 
                                    AND 
                                    `CREATED_DATE` <='".$day."'");


   }


  function join_mutitple_table($first_table, $multiple_table, $where=NULL ) {
   
     $this->db->select();
     
     $this->db->from($first_table);
       
       foreach($multiple_table as $mt => $key):
         
         $this->db->join($mt, $key);     

       endforeach;

       if($where != NULL) {
           
           $this->db->where($where);

       }

     
     return $this->db->get()->result();

  }



}


 


?>