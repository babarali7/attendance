<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends MY_Controller {

   public function __construct() {
        parent::__construct();
		
		 	 if($this->session->userdata('user_id')){
					 //
				}else{
				 redirect(base_url() . 'users/login');
			}
    }


 public function info() {
     
    $this->header();
      
      $data['desig'] = $this->general->get_record('designations', "DESIG_ID ASC");
    

      $this->load->view('employee/info',$data);
    
    
    $this->footer();

 }

  

 function fetch_user(){  
 
   $this->load->model("crud_model");  
   $data = $row = array();
        
        // Fetch member's records
        $memData = $this->crud_model->getRows($_POST);
        
        $i = $_POST['start'];
        foreach($memData as $member){
            
            $i++;
          
            $edit = '<a onClick="updateInfo('.$member->EMP_ID.');" class="btn btn-link btn-warning btn-just-icon edit"> <i class="fa fa-edit"></i>';

            $image = '<img src="'.base_url().'assets/img/employee/'.$member->EMP_IMAGE.'" width="80" height="80">';
            
            $data[] = array($i, $member->EMP_DEVICE_ID, $member->EMP_NAME, $member->EMP_GENDER, $member->EMP_NIC, $member->DESIG_NAME, $member->EMP_BPS, $image, $edit);
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud_model->countAll(),
            "recordsFiltered" => $this->crud_model->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
   }  



 public function get_info() {
   extract($_POST);
    
   $qry = $this->general->fetch_bysinglecol("EMP_ID", "employee", $c_id);

   $data_events;
  
 
       foreach($qry as $result):
      
      $data_events[] = array(
         "emp_name"               => $result->EMP_NAME,
         "emp_gender"             => $result->EMP_GENDER,
         "emp_device_id"          => $result->EMP_DEVICE_ID,
         "emp_nic"                => $result->EMP_NIC,
         "desig_id"               => $result->DESIG_ID,
         "emp_bps"                => $result->EMP_BPS,
         "emp_img"                => $result->EMP_IMAGE,
         "emp_id"                 => $result->EMP_ID
        ); 


    endforeach;           
 
     
     print json_encode($data_events);


 }

 public function add_employee(){            
		
   extract($_POST);

          $dt = date("Y-m-d H:i:s");
        
         if($this->input->post('emp_id') != "") {
                  // echo "updated";

              if($_FILES['i']['name']) {
                    // echo "selected";

                     $path = "./assets/img/employee/";
                    
                     $file_name = $this->general->do_upload($path);

                     if(isset($file_name['error'])) {
                       
                        $this->general->set_msg($file_name['error'],2);

                        redirect(base_url().'employee/info');

                     } else {
                      
                      $file = $file_name['upload_data']['file_name'];

                    }

              } 


              $comapny_dataArray = array(
     
                          
                           "EMP_NAME"               =>   $this->input->post('e_name'),
                           "EMP_GENDER"             =>   $this->input->post('gender'),
                           "EMP_DEVICE_ID"          =>   $this->input->post('emp_device_id'),
                           "EMP_NIC"                =>   $this->input->post('cnic'),
                           "DESIG_ID"               =>   $group,
                           "EMP_BPS"                =>   $bps,
                           "UPDATED_DATE"           =>   $dt,
                           "UPDATED_USERID"         =>   $this->session->userdata('user_id')
              
              );

              if(isset($file)) {
                 $comapny_dataArray["EMP_IMAGE"] = $file;
              }

           $this->general->update_record($comapny_dataArray, array("emp_id" => $emp_id),"employee");

           $this->general->set_msg("Record Updated Successfully",1);

        

         }  else {
         
         //	echo "inserted";

              if($_FILES['i']['name']) {
                     //echo "selected";
                     $path = "./assets/img/employee/";
                    
                     $file_name = $this->general->do_upload($path);

                     if(isset($file_name['error'])) {
                       
                         $this->general->set_msg($file_name['error'],2);

                         redirect(base_url().'employee/info');

                     } else {
                      
                        $file = $file_name['upload_data']['file_name'];
                   
                     }

              }         
    
                  
              $comapny_dataArray = array(
              
                           "EMP_NAME"               =>   $this->input->post('e_name'),
                           "EMP_GENDER"             =>   $this->input->post('gender'),
                           "EMP_DEVICE_ID"          =>   $this->input->post('emp_device_id'),
                           "EMP_NIC"                =>   $this->input->post('cnic'),
                           "EMP_IMAGE"              =>   $file,
                           "DESIG_ID"               =>   $group,
                           "EMP_BPS"                =>   $bps,
                           "CREATED_DATE"           =>   $dt,
                           "CREATED_USERID"         =>   $this->session->userdata('user_id')
              
              );

               $this->general->create_record($comapny_dataArray, "employee");

              $this->general->set_msg("Record Added Successfully",1);


         }
  
         redirect(base_url().'employee/info');
           

}




 public function manual_attendance() {

    $this->header();
      
        $join = array("designations" => "employee.DESIG_ID = designations.DESIG_ID");

        $data['emp'] = $this->general->join_multiple_table("employee", $join);
         
         $list_join = array(
                            "designations" => "employee.DESIG_ID = designations.DESIG_ID",
                             "attendence"   => "employee.EMP_DEVICE_ID = attendence.EMP_DEVICE_ID"
                            );

        $data["list"] = $this->general->join_multiple_table("employee", $list_join, array("attendence.AT_MANUAL" => 1));
    

      $this->load->view('employee/manual_attendance',$data);
    
    
    $this->footer();




 }



   public function add_manual_attend() {
       extract($_POST);

       $data = array(
                   "EMP_DEVICE_ID"     => $emp_name,
                   "AT_DATE_TIME"      => date("Y-m-d H:i:s", strtotime($date_time)),
                   "AT_MANUAL"         => 1,
                   "AT_REMARKS"        => $remarks,
                   "CREATED_DATE"      => date("Y-m-d H:i:s"),
                   "CREATED_USERID"    => $this->session->userdata('user_id')

                );

      $this->general->create_record($data, "attendence");

      $this->general->set_msg("Record Added Successfully",1);
      

       redirect(base_url().'employee/manual_attendance');
      

   }


   public function emp_leave() {
     
     $this->header();
      
        $join = array("designations" => "employee.DESIG_ID = designations.DESIG_ID");

        $data['emp'] = $this->general->join_multiple_table("employee", $join);

        $data['leave_type'] = $this->general->fetch_records("leave_types");



        // if search form is submited
         
          extract($_GET);
      
      
        if( $this->input->get("s_emp_name") ) {
           //echo $this->input->get("s_emp_name");
           $em = " AND e.EMP_ID = ".$this->input->get("s_emp_name"); 

        } else {
           //  echo "not selected";
           $em = "";

        }


        if( $this->input->get("s_leave_name") ) {
           
           $ln = " AND lt.LEAVE_ID = ".$this->input->get("s_leave_name"); 

        } else {

           $ln = "";

        } 

        
        if($this->input->get("s_st_date") != NULL) {
            
            $dat = "";  $st_dt = " AND (";

            $str_d = $this->input->get("s_st_date");

            WHILE (strtotime($this->input->get("s_end_date")) >=  strtotime($str_d) ) {
              
               $dat = date("Y-m-d",  strtotime($str_d));

               $st_dt .= "'".$dat."' BETWEEN el.EL_START_DATE AND el.EL_END_DATE";

               $str_d = date('Y-m-d', strtotime($dat . " +1 days"));
        

                if( strtotime($str_d) <= strtotime($this->input->get("s_end_date")) ):

                    $st_dt .= " || ";
           
                else:
                   
                   $st_dt .= " )";

                endif;   

            }

                
        } else {
         
           $st_dt = "";  
       
        }
        
    
      $query = "SELECT el.EMP_ID, el.EL_START_DATE, el.EL_END_DATE, el.EL_REMARKS, e.EMP_NAME, lt.LEAVE_NAME, d.DESIG_NAME 
                FROM `emp_leave` as el, employee as e, leave_types as lt, designations as d 
                WHERE 
                el.EMP_ID = e.EMP_ID 
                AND 
                el.LEAVE_ID = lt.LEAVE_ID 
                AND 
                e.DESIG_ID = d.DESIG_ID".$em.$ln.$st_dt;


       $data['result'] = $this->general->fetch_CoustomQuery($query);


        // end of search form
         
      
      $this->load->view('employee/emp_leave',$data);
    
    
    $this->footer();


   }


   public function add_emp_leave() {
      
      extract($_POST);

       $data = array(
                   "EMP_ID"            => $emp_name,
                   "LEAVE_ID"          => $leave_name,
                   "EL_START_DATE"     => date("Y-m-d H:i:s", strtotime($st_date)),
                   "EL_END_DATE"       => date("Y-m-d H:i:s", strtotime($end_date)),
                   "EL_REMARKS"        => $remarks,
                   "CREATED_DATE"      => date("Y-m-d H:i:s") ,
                   "CREATED_USERID"    => $this->session->userdata('user_id')

                );

      $this->general->create_record($data, "emp_leave");

      $this->general->set_msg("Leave Added Successfully",1);
      

       redirect(base_url().'employee/emp_leave');



   } 



   public function search_emp_leave() {
    
     


        


   }


} // end class

