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
            
         //   echo $this->input->get("date");
             
             $dat = explode("-", $this->input->get("date"));
              
             // echo $dat[0];

            $start  = date("m/d/Y",strtotime($dat[0]));
            //echo "<br/>";
            $finish =  date("m/d/Y", strtotime($dat[1]));  

         

         } else { 
       
         //	$rp_date = date("Y-m-d");

         //	$start = (date('D') != 'Mon') ? date('m/d/Y', strtotime('last Monday')) : date('m/d/Y');
           // $finish = (date('D') != 'Sat') ? date('m/d/Y', strtotime('next Saturday')) : date('m/d/Y');
            
             $start = date("m/01/Y");
             $finish = date("m/t/Y");

         
         }

      $this->header();
      
       
      // $this->db->query("CALL emp_attendance(2021-08-15, 21)");
      
      $data['mycontroller'] = $this;


      $data['emp'] = $this->general->fetch_CoustomQuery("SELECT E.`EMP_ID`,E.`EMP_NAME`,E.`EMP_DEVICE_ID`, 
				      					d.DESIG_NAME, e.EMP_BPS
											FROM `employee` E
											LEFT JOIN
											designations as d 
											ON
											e.DESIG_ID = d.DESIG_ID");

      $data['start_date'] = $start;
      $data['end_date'] = $finish;
    
      $this->load->view('reports/monthly',$data);
     
      $this->footer();


   }

    
    public function bring_emp_attend($emp_id, $date) {

        //  echo $emp_id, "-", $date;

         $dat =  "SELECT MIN(`AT_DATE_TIME`) as min_time, MAX(`AT_DATE_TIME`) as max_time
                   FROM `attendence` B
                   WHERE DATE_FORMAT(B.AT_DATE_TIME,'%Y-%m-%d') = '$date'
                   AND B.`EMP_DEVICE_ID` = $emp_id";

    	   $query = $this->db->query($dat);

    	   $result = $query->result();


    	    foreach($result as $rs):
              
              $data['max_in'] = $rs->min_time;
              $data['max_out'] = $rs->max_time;

    	    endforeach;	

         
         return $data;

    }

   
    public function weekly() {
       
        if($this->input->get("date")) { 
            
            $dat = explode("-", $this->input->get("date"));
        
            $start  = date("m/d/Y",strtotime($dat[0]));
            //echo "<br/>";
            $finish =  date("m/d/Y", strtotime($dat[1]));  


         } else { 
       
           $start = (date('D') != 'Mon') ? date('m/d/Y', strtotime('last Monday')) : date('m/d/Y');
           $finish = (date('D') != 'Sat') ? date('m/d/Y', strtotime('next Saturday')) : date('m/d/Y');
         
         }

      $this->header();
      
      $data['mycontroller'] = $this;


      $data['emp'] = $this->general->fetch_CoustomQuery("SELECT E.`EMP_ID`,E.`EMP_NAME`,E.`EMP_DEVICE_ID`, 
                                 d.DESIG_NAME, e.EMP_BPS
                                 FROM `employee` E
                                 LEFT JOIN
                                 designations as d 
                                 ON
                                 e.DESIG_ID = d.DESIG_ID");

      $data['start_date'] = $start;
      $data['end_date'] = $finish;
    
      $this->load->view('reports/weekly',$data);
     
      $this->footer();   


    }

    
    public function employeeAttendance() {
        
        if($this->input->get("date")) { 
            
            $dat = explode("-", $this->input->get("date"));
        
            $start  = date("m/d/Y",strtotime($dat[0]));
            //echo "<br/>";
            $finish =  date("m/d/Y", strtotime($dat[1]));  
          
           if($this->input->get("emp")) {

               $emp = $this->input->get("emp");

               $start_dd = date("Y-m-d",strtotime($dat[0]));
               $end_dd = date("Y-m-d", strtotime($dat[1]));
            
              $query = "SELECT '{$start_dd}' + INTERVAL a + b DAY dte , 
              (SELECT MIN(a.AT_DATE_TIME) as checkin  FROM `attendence` as a WHERE a.EMP_DEVICE_ID = {$emp} AND 
              DATE(a.AT_DATE_TIME) = dte) as min_time, 
              (SELECT MAX(a.AT_DATE_TIME) as checkin FROM `attendence` as a WHERE a.EMP_DEVICE_ID = {$emp} AND 
              DATE(a.AT_DATE_TIME) = dte) as max_time  
              FROM 
              (SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3 
              UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 
              UNION SELECT 8 UNION SELECT 9 ) d, 
              (SELECT 0 b UNION SELECT 10 UNION SELECT 20 
              UNION SELECT 30 UNION SELECT 40) m 
              WHERE '{$start_dd}' + INTERVAL a + b DAY  <=  '{$end_dd}' 
              ORDER BY a + b";

              $data['emp_result'] = $this->general->fetch_CoustomQuery($query);

              // also get emp basic info

               $join = array("designations" => "employee.DESIG_ID = designations.DESIG_ID");

              $data['emp_basic'] = $this->general->join_multiple_table("employee", $join, array("employee.EMP_DEVICE_ID" => $emp));

           }



         } else { 
       
           $start = (date('D') != 'Mon') ? date('m/d/Y', strtotime('last Monday')) : date('m/d/Y');
           $finish = (date('D') != 'Sat') ? date('m/d/Y', strtotime('next Saturday')) : date('m/d/Y');
         
         }

      $this->header();

       $data['emp'] = $this->general->fetch_CoustomQuery("SELECT E.`EMP_ID`,E.`EMP_NAME`,E.`EMP_DEVICE_ID`, 
                                 d.DESIG_NAME, e.EMP_BPS
                                 FROM `employee` E
                                 LEFT JOIN
                                 designations as d 
                                 ON
                                 e.DESIG_ID = d.DESIG_ID");
      
    //  $data['mycontroller'] = $this;

      $data['start_date'] = $start;
      $data['end_date'] = $finish;
    
      $this->load->view('reports/employee',$data);
     
      $this->footer();


    }



 } // end class   