<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

   public function __construct() {
        parent::__construct();
 
       
        $this->load->model("general");

    
     if($this->session->userdata('user_id')){
				 
				 //
			
			}else{
			
			
			 redirect(base_url() . 'users/login');
		
		}
		   
		
		
    }


   public function index(){
	  
	
		 $this->header();
			   
         //fetch institute and group name

       $group = $this->general->fetch_bysinglecol("GROUP_ID", "usr_group", $this->session->userdata("group_id"));
        
         foreach($group as $gr):
                $data['group_name'] = $gr->GROUP_NAME;
         endforeach; 
        
         //Set Admin View & Other users.....
			           // Principal and Administrator dashboard ..
           
             $this->load->view('dashboard',$data);

       
			   $this->footer();
    
	   
   }





}




?>