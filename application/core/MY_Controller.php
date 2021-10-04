<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

   //Set Global Variable, For Permissions...
	   var $savePermission;
	   var $editPermission;
	   var $deletePermission;
  
   
   public function __construct() {
        parent::__construct();
		
			//Load Models.............
			
			date_default_timezone_set("Asia/Karachi");

			 $this->load->model('menus');
			 $this->load->model('general');
			 $this->load->model('user');
			 $this->load->helper("url");
			 $this->load->library("pagination");
		
	}
   
   //Header for Applications...................................		
   
   public function header() {
       
       
        $data['parent_nav']    = $this->menus->fetch_parent_navi();
		$data['My_Controller'] = $this;
	    
        	   
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar', $data);
    
    }
    
    public function footer() {
        $this->load->view('template/footer');
    }
	
	public function fetchsidebar_childMenuById($child_id){
	  
	   if($this->session->userdata('group_id') == 1){ 
          $query  =  $this->db->query("SELECT * FROM usr_menu WHERE PARENT_ID =$child_id ORDER BY SORT_ORDER ASC");
       }
       
        if($this->session->userdata('group_id') != 1){ 
         $group   =  $this->session->userdata('group_id');
          $query  =  $this->db->query("SELECT * FROM usr_menu AS UM , usr_permission UP
                                        WHERE
                                        UM.MENU_ID = UP.MENU_ID
                                        AND 
                                        UP.PER_SELECT =1 
                                        AND
                                        UP.GROUP_ID = $group
                                        AND
                                        UM.PARENT_ID =$child_id ORDER BY SORT_ORDER ASC");
       }
	   
       return $query->result();
	   
	   
	}
	
	
    //SET SAVE, DELETE, UPDATE, PERMISSIONS FOR PAGES.........................
    public function Getsave_up_delPermissions(){
	
	$menu_id   = $this->session->userdata("menu_id");
	if(!empty($menu_id) && $this->session->userdata("group_id") != 1){
	
			$menu_id          = $this->session->userdata("menu_id");$group_id = $this->session->userdata("group_id");
			$permissionResult = $this->general->fetch_CoustomQuery("SELECT * FROM `usr_permission` 
												  WHERE    GROUP_ID=$group_id   AND 
												  MENU_ID=$menu_id");
												  
			foreach($permissionResult as $permissionResults){
			
					//SET SAVE BUTTON PERMISSION...............................................................
					if($permissionResults->PER_INSERT == 1){
					
						  $this->savePermission = "<input type='submit' value='save' class='btn btn-success' id='save' >";
					
					}elseif($permissionResults->PER_INSERT == 0){
					
						  $this->savePermission = "<input type='button' value='save' class='btn btn-success' id='save' >";
					
					}
					
					//SET UPDATE BUTTON PERMISSION...............................................................
					if($permissionResults->PER_UPDATE == 1){
					
						  $this->editPermission = "";
					
					}elseif($permissionResults->PER_UPDATE == 0){
					
						  $this->editPermission = "style='display:none;'";
					
					}
					
					//SET DELETE BUTTON PERMISSION...............................................................
					if($permissionResults->PER_DELETE == 1){
					
						  $this->deletePermission = "";
					
					}elseif($permissionResults->PER_DELETE == 0){
					
						  $this->deletePermission = "style='display:none;'";
					
					}
	
	
	  }
	
	}elseif($this->session->userdata("group_id") == 1){
	       
	   //    <input type='submit' value='save' class='btn btn-fill btn-rose' id='save' >
		   
		  $this->savePermission   = "<input type='submit' value='save' class='btn btn-fill btn-rose' id='save'>";
	       $this->editPermission   = "";
	       $this->deletePermission = "";
	
	
	}//End Condition......
									 	  
										  
	
	}	
	
	
    }

	

	?>