<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends My_controller {

    public function __construct() {
        parent::__construct();
      
       date_default_timezone_set('Asia/Karachi');

    }

	
    public function login() {
       
     
        $this->load->view('users/login');
		
    }
	 
	 public function Logout() {
	 
         $this->user->logout();
		 
    }


    public function login_authen() {

        $email    = $this->input->post('u_email');
        $password = $this->input->post('u_password');
         // exit();
        $login    = $this->user->AuthLogin($email, $password);
			 
			 if($login){
					
						//DEFINE, VARIABLES IN SESSIONS.................
						$this->session->set_userdata("user_id",  $login['USER_ID']);	
						$this->session->set_userdata("group_id", $login['GROUP_ID']);	
						$this->session->set_userdata("username", $login['USER_NAME']);	
					//	$this->session->set_userdata("ins_id", $login['INS_ID']);
						
					
							//Set Admin View & Other users.....
							 if($login['GROUP_ID'] == 1){
							 
								   redirect(base_url() . 'dashboard');
							 
							 }else{
							 
								  redirect(base_url() . 'dashboard');
								  
							 }
					
				} else {

				   $this->session->set_flashdata('msg', 'Username & Password is Invalid');
				   redirect(base_url() . 'users/login');
				
				}
		
		
    }

	//Load View Form For User Creation.........
	public function add_user(){
	
	    //Get employee list for drop down menu..................................
	    $data['ins'] = $this->general->fetch_records("clinic_profile");
	    $data['grouplist']    = $this->general->fetch_records("usr_group");
        //Get user's list........................................................
		$data['userlist']     = $this->general->fetch_CoustomQuery("SELECT uu.*, i.clinic_name, ug.GROUP_NAME 
								FROM 
								`usr_user` as uu, clinic_profile as i, usr_group as ug 
								WHERE
								uu.`GROUP_ID` = ug.GROUP_ID
								AND
								uu.`INS_ID` = i.clinic_id");
        $this->header();
        $this->load->view('users/add_user', $data);
        $this->footer();
	
	}
	
	//Get values and Create User................
	public function create_user() {

        $record    = $this->general->fetch_maxid("usr_user");
        foreach ($record as $record) {  $MaxGroup = $record->USER_ID; }
        $user_no   = $MaxGroup + 1;
        $dt        = date("Y-m-d H:i:s");
        
        $userid    = $this->session->userdata('user_id');
        $password  = md5($this->input->post('password'));
        $username  = $this->input->post('username');
		  
		$whr_grp   = array("INS_ID" => 1,"GROUP_ID" => $this->input->post('group'));
		
		$validate_grp = $this->general->validate_bymultipleconditions("usr_user",$whr_grp);
		 
		if($validate_grp == 1 ) {
			$this->general->set_msg('Account already exist of the selected Institute and Group !',2);
			redirect(base_url()."users/add_user");
		}

		

        $validate = $this->general->validate_value("USER_NAME","usr_user",$username);
     
           if($validate == 0 ) {

         	$data_user = array(
				 
				 'USER_ID'            => $user_no,
				 "USER_NAME"          => $username,
				 "U_PASSWORD"         => $password,
				 "GROUP_ID"           => $this->input->post('group'),
				 "IS_ACTIVE"          => 1,
				 "INS_ID"             => 1,
				 "CREATED_DATE"       => $dt,
				 "CREATED_USERID"     => $userid
			 
			 );
			 
				$this->db->insert('usr_user', $data_user); 
				$this->general->set_msg('User Added Successfully',1);

            } else {
		
               $this->general->set_msg('Username already exist',2);               
				
            }
          
          redirect(base_url()."users/add_user");
    
    }
    

   public function reset_pass($id,$username) {
     
     $pass = md5("12345678");

     $update = array("U_PASSWORD" => $pass );
     $whr    = array("USER_ID" => $id);

       $this->general->update_record($update,$whr,"usr_user");

       $this->general->set_msg("The password has been reset to default for username : {$username}", 3);

       redirect(base_url()."users/add_user");   


   }

   public function change_password() {
    if(!$this->session->userdata('user_id')){ 
        
        	 redirect(base_url() . 'users/login');

       }
         $this->header();
			  // $data['inst'] = $this->general->fetch_records("institutes");
	      $this->load->view('users/change_password');
	
	    $this->footer();


   }
   
   
   public function edit_password() {
     
    extract($_POST);
     
    $username = $this->session->userdata("username");

     $whr = array(
                   "USER_NAME"  => $this->session->userdata("username"),
                   "U_PASSWORD" => md5($this->input->post('old_password'))
     	         );

    $validate = $this->general->validate_bymultipleconditions("usr_user",$whr);
   
    
	    if($validate == 0 ) {

	         $this->general->set_msg('The current password is incorrect ! Please enter correct password',2);

	     
	    } else {
		 
		  	$data_user = array(
					 
					 "U_PASSWORD"         => md5($this->input->post('new_password')),
					 "UPDATED_DATE"       => date("Y-m-d H:i:s"),
					 "UPDATED_USERID"     => $this->session->userdata('user_id')
				 
				 );
				 
					$this->general->update_record($data_user,array("USER_NAME" => $this->session->userdata('username')),'usr_user'); 
					$this->general->set_msg('Password Updated Successfully',1);	
	                      
					
	    } 
    

      redirect(base_url()."users/change_password");


    } 

  
   public function update_db() {
     
         
	// $ip  = "59.103.27.194:81";
	 $ip = "192.168.10.140:81";
    
     // get last date time from the table

    //  $destroy_finder_5 = "http://192.168.10.140:81/cgi-bin/mediaFileFind.cgi?action=close&object=".$val."";
     

     $this->db->limit(1);
     $this->db->order_by("AT_ID", "DESC");
     $query =  $this->db->get("attendence")->result();
         
    foreach($query as $qr):
        
       $time = $qr->AT_DATE_TIME; 
       
       // for future validation
       $emp_dev_id_c = $qr->EMP_DEVICE_ID;
       $similarity_c = $qr->AT_SIMILARITY;
      

    endforeach;	
 
    $start_date = str_replace(" ", "%20", $time);
    
    $end_date = date("Y-m-d%20H:i:s");
    
	$create_finder_1 = 'http://'.$ip.'/cgi-bin/mediaFileFind.cgi?action=factory.create';

	$headers = array(
	   "Content-Type: application/json"
	);

	 $ch =  curl_init();
	        curl_setopt($ch, CURLOPT_URL, $create_finder_1);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
	        curl_setopt($ch, CURLOPT_USERPWD, "admin" . ":" . "0000abcd");     
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	        $resp = curl_exec($ch);
	        
	        curl_close($ch);

	        $data = explode("=",$resp);

	       $val = (int)$data[1];
           


           echo $val;
           exit();

	     /// now apply filters with the code
	     
	$search_2 = "http://".$ip."/cgi-bin/mediaFileFind.cgi?action=findFile&object=".$val."&condition.Channel=1&condition.StartTime=".$start_date."&condition.EndTime=".$end_date."&condition.Types[0]=jpg&condition.Flags[0]=Event&condition.Events[0]=FaceRecognition&condition.DB.FaceRecognitionRecordFilter.RegType=RecSuccess&condition.DB.FaceRecognitionRecordFilter.StartTime=".$start_date."&condition.DB.FaceRecognitionRecordFilter.EndTime=".$end_date."&condition.DB.FaceRecognitionRecordFilter.SimilaryRange[0]=80";

	 
	  
	   $ch_1 = curl_init();
	        curl_setopt($ch_1, CURLOPT_URL, $search_2);
	        curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch_1, CURLOPT_HTTPHEADER, $headers);
	        curl_setopt($ch_1, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
	        curl_setopt($ch_1, CURLOPT_USERPWD, "admin" . ":" . "0000abcd");     
	        curl_setopt($ch_1, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch_1, CURLOPT_FOLLOWLOCATION, true);
	        curl_setopt($ch_1, CURLOPT_TIMEOUT, 30);
	        $resp_1 = curl_exec($ch_1);
	       
	       curl_close($ch_1);
	        
	       // echo $resp_1;
	       // exit(); 

	   $search_3 = "http://".$ip."/cgi-bin/mediaFileFind.cgi?action=findNextFile&object=".$val."&count=200";
	   

	    $ch_2 = curl_init();
	        curl_setopt($ch_2, CURLOPT_URL, $search_3);
	        curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch_2, CURLOPT_HTTPHEADER, $headers);
	        curl_setopt($ch_2, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
	        curl_setopt($ch_2, CURLOPT_USERPWD, "admin" . ":" . "0000abcd");     
	        curl_setopt($ch_2, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch_2, CURLOPT_FOLLOWLOCATION, true);
	        curl_setopt($ch_2, CURLOPT_TIMEOUT, 30);
	        $resp_2 = curl_exec($ch_2);
	        curl_close($ch_2);
	      
	       
	       $data = explode("items",$resp_2);
           
          // echo "<pre>"; 
          // print_r($data);
          // exit();
	      
	      $total_result = explode("found=", $resp_2);
	     
	      $tot_val = $total_result[1];

	      $new_array = array();

	       $j = 0;
	     foreach($data as $val):
	            $i = (string) $j;
	            $time_val = "~\[".$i."].StartTime=\b~";
	            $time_ex = "[".$i."].StartTime=";

	            $id_val = "~\Person.ID=\b~";
	            $id_ex = "[".$i."].SummaryNew[0].Value.Candidates[0].Person.ID=";

	            $name_val = "~\Person.Name=\b~";
	            $name_ex = "[".$i."].SummaryNew[0].Value.Candidates[0].Person.Name=";

	            $similarity_val = "~\Similarity=\b~";
	            $similarity_ex = "[".$i."].SummaryNew[0].Value.Candidates[0].Similarity=";

	            $j = (int) $i;
	       
	            if ( preg_match($time_val,$val) ){

	                // echo "Match found.";

	                 $explode_time = explode($time_ex,$val);

	                 $new_array[$j]["AT_DATE_TIME"] =  $explode_time[1];             
	                            
	            } 
	            
	         

	           else if( preg_match($id_val, $val) ) {

	               $explode_id = explode($id_ex,$val);

	               $new_array[$j]["EMP_DEVICE_ID"] =  $explode_id[1]; 
	             
	            }


	            else if( preg_match($name_val,$val)  ) {

	               $explode_name = explode($name_ex,$val);

	               $new_array[$j]["AT_EMP_NAME"] =  $explode_name[1]; 

	            }

	           else if( preg_match($similarity_val,$val)  ) {

	               $explode_simi = explode($similarity_ex,$val);

	               $new_array[$j]["AT_SIMILARITY"] =  $explode_simi[1];

	               $new_array[$j]["CREATED_DATE"] =  date("Y-m-d H:i:s");

	               $new_array[$j]["CREATED_USERID"] =  $this->session->userdata('user_id');
	           
	               $j++;                  
	 
	            }

	     endforeach;  

	   // echo "<pre>";
	   // print_r($new_array);
   
        $count = count($new_array);
       
         if($count == 1) {
           
            // now check whether its the same record
             
             if(trim($new_array[0]['AT_DATE_TIME']) == trim($time) && trim($new_array[0]['EMP_DEVICE_ID']) == trim($emp_dev_id_c) && trim($new_array[0]['AT_SIMILARITY']) == trim($similarity_c) ):
             	
             	// its the same record so no need to insert record 

             	echo "No record to update";

             	exit();

             else:
              
              // its means only one record , but different one.

              $this->db->insert_batch('attendence', $new_array); 
            
             endif;	

         
         } else {

	        // it means more than one record.

	      $this->db->insert_batch('attendence', $new_array);

	    } 
      
      if ($this->db->affected_rows() >= 1) { 
        
        echo "Database updated";  

      } else {

      	echo "Please Try Again";

      }


   }


}  // end of class
 
?>