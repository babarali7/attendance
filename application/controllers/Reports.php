<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MY_Controller {

   public function __construct() {
        parent::__construct();
		
		 date_default_timezone_set('Asia/Karachi');

			 if($this->session->userdata('user_id')){
					 //
				}else{
				 redirect(base_url() . 'users/login');
			}
    }

 


  public function daily() {
      
     
      if($this->input->get("date")) { 
         $rp_date = date("Y-m-d",strtotime($this->input->get("date")));
         } else { 
      	$rp_date = date("Y-m-d");
         }

      $this->header();
      
      $data['daily'] = $this->general->fetch_CoustomQuery("SELECT e.EMP_NAME, e.EMP_DEVICE_ID, e.EMP_IMAGE, e.EMP_BPS, 
						     	d.DESIG_NAME, (SELECT MIN(a.AT_DATE_TIME) FROM attendence as a WHERE 
						     	a.EMP_DEVICE_ID = e.EMP_DEVICE_ID AND DATE(a.AT_DATE_TIME) = '".$rp_date."' ) as min_time,
						     	(SELECT MAX(b.AT_DATE_TIME) FROM attendence as b WHERE b.EMP_DEVICE_ID = e.EMP_DEVICE_ID 
						     	AND DATE(b.AT_DATE_TIME) = '".$rp_date."' ) as max_time
								FROM `employee` as e
								LEFT JOIN
								designations as d
								ON
								e.DESIG_ID = d.DESIG_ID");

      $data['rp_date'] = $rp_date;
    
      $this->load->view('reports/daily',$data);
     
      $this->footer();
    


  }
   

   public function monthly() {
        
       if($this->input->get("date")) { 
         
         //$rp_date = date("Y-m-d",strtotime($this->input->get("date")));
            
            echo $this->input->get("date");

            exit();


         } else { 
       
         	$rp_date = date("Y-m-d");
         
         }

      $this->header();
      
      $data['daily'] = $this->general->fetch_CoustomQuery("SELECT e.EMP_NAME, e.EMP_DEVICE_ID, e.EMP_IMAGE, e.EMP_BPS, 
						     	d.DESIG_NAME, (SELECT MIN(a.AT_DATE_TIME) FROM attendence as a WHERE 
						     	a.EMP_DEVICE_ID = e.EMP_DEVICE_ID AND DATE(a.AT_DATE_TIME) = '".$rp_date."' ) as min_time,
						     	(SELECT MAX(b.AT_DATE_TIME) FROM attendence as b WHERE b.EMP_DEVICE_ID = e.EMP_DEVICE_ID 
						     	AND DATE(b.AT_DATE_TIME) = '".$rp_date."' ) as max_time
								FROM `employee` as e
								LEFT JOIN
								designations as d
								ON
								e.DESIG_ID = d.DESIG_ID");

      $data['rp_date'] = $rp_date;
    
      $this->load->view('reports/monthly',$data);
     
      $this->footer();




   }

 

 } // end class   