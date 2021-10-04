<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generals extends MY_Controller {
 
    public function __construct() {
        parent::__construct();
        
		if($this->session->userdata('user_id')){
				 
				 //
			
			}else{
			
			
			 redirect(base_url() . 'users/login');
		
		}
    }
	
    //GET PAGE/CONTROLLER/CONTROLLER-FUNCTION NAME............................
	public function getpage($page){
	
	    $Page   = $this->general->fetch_bysinglecol("MENU_ID", "usr_menu", $page);
	    foreach($Page as $pagerow)
		{        
		$getPage  = $pagerow->MENU_URL;
		//SET SESSION FOR PAGE ID................................................
		$this->session->set_userdata("menu_id",  $pagerow->MENU_ID);
		
        }
	    redirect(base_url().$getPage);
		
	}

	//ADD Company................
	public function addcompany(){
	
	
	    $this->header();
        $this->load->view('generals/company_profile');
        $this->footer();
	
	
	
	}

    //Add Group....
    public function add_group() {

        $this->header();
		$data['group_list'] = $this->general->fetch_records("usr_group");
        $this->load->view('generals/add_group', $data);
        $this->footer();
    }

    public function create_group() {
       
        extract($_POST);

              $dt = date("Y-m-d H:i:s");
                
                 if($this->input->post('grp_id') != "") {
                      // echo "updated";
                   $this->general->update_group($group_name, $grp_id);

                   $this->general->set_msg("Record Updated Successfully",3);

                

                 }  else {
                 
                 // echo "inserted";
                    $group_name = $this->input->post('group_name');

                    $record = $this->general->fetch_maxid("usr_group");

                    foreach ($record as $record) {

                        $MaxGroup = $record->GROUP_ID;
                    }


                    $group_no = $MaxGroup + 1;

                    $data = array(
                        "GROUP_ID"       => $group_no,
                        "GROUP_NAME"     => $group_name,
                        "CREATED_DATE"   => $dt,
                        "CREATED_USERID" => $this->session->userdata('user_id')

                    );
                    
                     $this->general->create_record($data, "usr_group");

                     $this->general->set_msg("Record Added Successfully",1);
    

                 }

        
                 redirect(base_url().'generals/add_group');



    }

   
    //Edit Group....
    public function edit_group() {
        extract($_POST);

        $group = $this->general->fetch_groupbyid($c_id);
        
        $data_events;
      
           foreach($group as $result):
          
          $data_events[] = array(
             "GROUP_NAME"            => $result->GROUP_NAME,
             "GROUP_ID"              => $result->GROUP_ID
             ); 


        endforeach;           
     
         
         print json_encode($data_events);
        

    }

    //Update Group......
    public function update_group() {

        extract($_POST);
        $this->general->update_group($group_name, $group_id);

        $this->add_group();
    }

    //Add menu....
    public function addmenu() {


        $this->header();
        
        $col = "PARENT_ID";
        $tbl = "usr_menu";
        $id  = 0; 
		
        
        $data['menus'] = $this->general->fetch_bysinglecol($col, $tbl, $id);
       
        $data['menulist'] = $this->general->fetch_CoustomQuery("SELECT um.*, umm.`MENU_TEXT` as par_tit
                                FROM `usr_menu` as um
                                LEFT JOIN
                                usr_menu as umm
                                ON 
                                um.`PARENT_ID` = umm.`MENU_ID`");
        
        $this->load->view('generals/add_menu', $data);
        
        $this->footer();
		
    }

    //Add menu....
    public function create_menu() {

        $menu = $this->input->post('menu');
        $url = $this->input->post('url');
        $parent = $this->input->post('parent');
        $sort = $this->input->post('sort');
        $d = date("Y-m-d H:i:s");
        $record = $this->general->fetch_maxid("usr_menu");

        foreach ($record as $record) {

            $MaxGroup = $record->MENU_ID;
        }

        $menu_no = $MaxGroup + 1;

        $data = array(
            "MENU_ID"        => $menu_no,
            "MENU_TEXT"      => $menu,
            "MENU_URL"       => $url,
            "PARENT_ID"      => $parent,
            "SORT_ORDER"     => $sort,
            "SHOW_IN_MENU"   => "1",
            "CREATED_USERID" => $this->session->userdata('user_id'),
            "CREATED_DATE"   => $d
        );


        $this->general->create_record($data, "usr_menu");
         
		$this->general->set_msg('Add Successfully',1);
        
		redirect(base_url().'generals/addmenu');
    }

    //Fetch All menus.........
    public function list_menu() {

        $menu['menus'] = $this->general->fetch_records("usr_menu");

        $this->header();
        $this->load->view('general/list_menu', $menu);
        $this->footer();
    }

    //Edit Menu....
    public function edit_menu($id) {

        $menu['menus'] = $this->general->fetch_menubyid($id);
        $this->header();
        $this->load->view('general/edit_menu', $menu);
        $this->footer();
        
    }

    //Update Menu....
    public function update_menu() {


        extract($_POST);
        $this->general->update_menu();

        $this->list_menu();
    }

    
    
    //Add permission.....
    public function add_permission($id) {

         $data['parentnav'] = $this->menus->fetch_parent_menu();
         $data['Generals'] = $this;
         $data['group_id'] = $id;
         $this->header();
         $this->load->view('generals/add_permission', $data);
         $this->footer();
    }

    public function create_permission() {

        extract($_POST);
        
        $menus = $this->menus->fetch_permission_navi();

        foreach ($menus as $menus) {

            $permission_max = $this->general->fetch_permissionmaxno();

            $permissionMax = $permission_max->PER_ID + 1;
			
            $d = date("Y-m-d H:i:s");

            $menuid = $menus->MENU_ID;
           
            if(isset($permission['view'][$menuid])){

               // if ($permission['view'][$menuid] == "on"){

                    $view = 1;
                //}
				
            }if(!isset($permission['view'][$menuid])){

                   $view = 0;
            }

            if(isset($permission['insert'][$menuid])){

                //if ($permission['insert'][$menuid] == "on") {

                    $insert = 1;
                //}
            }if(!isset($permission['insert'][$menuid])){

                $insert = 0;
            }

            if(isset($permission['update'][$menuid])) {

                //if ($permission['update'][$menuid] == "on") {

                    $update = 1;
                //}
            } if(!isset($permission['update'][$menuid])){
                $update = 0;
            }

            if (isset($permission['delete'][$menuid])) {

                //if ($permission['delete'][$menuid] == "on") {

                    $delete = 1;
                //}
            } if (!isset($permission['delete'][$menuid])){

                $delete = 0;
            }


            //check if Menu and Group is exist then update row...else insert
            $per_groupmenu = $this->general->fetch_per_groupmenu($group_id, $menus->MENU_ID);
            $permission_row = $this->general->fetch_groupmenu_id($group_id, $menus->MENU_ID);

            foreach ($permission_row as $permission_row) {

                $permission_id = $permission_row->PER_ID;
            }

            if ($per_groupmenu > 0) {

                $data = array(
                    "PER_SELECT"        => $view,
                    "PER_INSERT"        => $insert,
                    "PER_UPDATE"        => $update,
                    "PER_DELETE"        => $delete,
                    "UPDATED_USERID"    => '0',
                    "UPDATED_DATE"      => $d
                );
                 
                $this->general->update_permissionrecord($data, "usr_permission", $permission_id);
                
		        $this->session->set_flashdata('msg', 'Updated Successfully');
            } else {

                $data = array(
                    "PER_ID"         => $permissionMax,
                    "GROUP_ID"       => $group_id,
                    "MENU_ID"        => $menus->MENU_ID,
                    "PER_SELECT"     => $view,
                    "PER_INSERT"     => $insert,
                    "PER_UPDATE"     => $update,
                    "PER_DELETE"     => $delete,
                    "E_USER_ID"      => '0',
                    "E_DATE_TIME"    => $d
                );
                $this->general->create_record($data, "usr_permission");
				
		    }
//}
        }

         $this->general->set_msg('Add Successfully',1);
         redirect(base_url() . 'generals/add_permission/' . $group_id);
    }

	
    public function checkpermission($id, $group_id) {

		$whr = array(
		
		"GROUP_ID" => $group_id,
		"MENU_ID"  => $id
		
		);
	
		$this->db->where($whr);
		$this->db->order_by("PER_ID", "ASC");
		$this->db->from('usr_permission');
		return $this->db->count_all_results();
		
	}
    
	public function fetchRecordpermission($id, $group_id){
	
	
        $sql = $this->db->query("SELECT * FROM usr_permission WHERE GROUP_ID ='$group_id' AND MENU_ID='$id' ORDER BY PER_ID asc LIMIT 1");
        $r_sql= $sql->result();
	    return $r_sql;

	}
    
    public function fetch_child($parentid){
        
         $sql = $this->db->query("SELECT * FROM usr_menu WHERE MENU_ID='$parentid' ORDER BY ASC");

        return $sql;
        
    }
    
   
	 public function checkchildMenuCount($pmenuid){
	 
	 
	  $whr = array(
			
			"PARENT_ID" => $pmenuid
			
			);
		
			$this->db->where($whr);
			$this->db->from('usr_menu');
			return $this->db->count_all_results();
		 
	 
	 }
	 
	 

	  public function fetchchildMenu($pmenuid){
			 return $this->general->fetch_bysinglecol("PARENT_ID", "usr_menu", $pmenuid);
	 
	 }
	 
    
 
 public function getCategoryTreeForParentId($parent_id = 0) {
  $categories = array();
  $this->db->from('usr_menu');
  $this->db->where('PARENT_ID', $parent_id);
  $this->db->order_by('MENU_ID', 'DESC');
  $result = $this->db->get()->result();
  foreach ($result as $mainCategory) {
    $category = array();
    $category['id'] = $mainCategory->MENU_ID;
    $category['name'] = $mainCategory->MENU_TEXT;
    $category['parent_id'] = $mainCategory->PARENT_ID;
    $category['sub_categories'] = $this->getCategoryTreeForParentId($mainCategory->MENU_ID);
    $categories[$mainCategory->MENU_ID] = $category;
  }

  sort($categories);
    echo "<ul>";
   
   foreach($categories as $categoriess=>$k){
        
		echo $k['name'];
	   
   
   }
  
   echo "</ul>";
}
 

 public function add_designation() {
    
        $this->header();
        
        $data['list'] = $this->general->fetch_records("designations");
        
        $this->load->view('generals/add_designations', $data);
        
        $this->footer();

 }
  

  public function get_cat() {
      
     extract($_POST);
      
     $qry = $this->general->fetch_bysinglecol("DESIG_ID", "designations", $c_id);

      $data_events;

           foreach($qry as $result):
          
          $data_events[] = array(
             "DESIG_NAME"               => $result->DESIG_NAME,
             "DESIG_ID"                 => $result->DESIG_ID
             
            ); 


        endforeach;           

         
         print json_encode($data_events);
  

  }
 
   
   public function create_category() {
     extract($_POST);

      $dt = date("Y-m-d H:i:s");
                
                 if($this->input->post('desig_id') != "") {
                      // echo "updated";
                  $comapny_dataArray = array(
            
                                        "DESIG_NAME"               =>   $this->input->post('desig_name'),
                                        
                                   
                       
                       );

                $this->general->update_record($comapny_dataArray, array("DESIG_ID" => $this->input->post('desig_id')),"designations");

                $this->general->set_msg("Record Updated successfully",3);

                

                 }  else {
                 
                 // echo "inserted";
                          
                       $comapny_dataArray = array(
                       
                                    "DESIG_NAME"               =>   $this->input->post('desig_name'),
                                   
                       
                       );

                     $this->general->create_record($comapny_dataArray, "designations");

                     $this->general->set_msg("Record added successfully",1);
    

                 }

        
                 redirect(base_url().'generals/add_designation');
     


  }

  

}

?>