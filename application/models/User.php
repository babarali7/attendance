<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Model {

    function index() {
        
    }

    public function UserInsert($var) {
        $this->db->set($var);
        $this->db->insert('user');
        $email = $var['email'];
        return $this->AuthenticLogup("email", $email);
    }

    public function AuthenticLogup($feild, $var) {
        $where = array(
            $feild => $var
        );
        $this->db->select()->from('user')->where($where);
        $query = $this->db->get();
        return $result = $query->result();
    }

    public function AuthLogin($email, $password) {
         
        //Encrypt password... 
        //$email = mysql_real_escape_string($email);
        $pass = md5($password);
        $query = $this->db->query("SELECT  * 
                                    FROM 
                                    `usr_user` as uu
                                    WHERE 
                                    uu.USER_NAME = '$email'
                                    AND
                                    uu.U_PASSWORD = '$pass'
                                    AND
                                    uu.IS_ACTIVE ='1'
                                    ");

        return $query->first_row('array');
    }

    
   public function get_userinfo($var){
   
     $query =   $this->db->query("SELECT PI.INS_NAME, PI.INS_IMAGE, PT.THEMES_FILE  FROM hrm_emp_institute AS HEI , prm_institute AS PI, prm_themes AS PT
                            WHERE 
                            HEI.INS_ID = PI.INS_ID
                            AND
                            PI.THEME_ID = PT.THEMES_ID
                            AND
                            HEI.EMP_NO=$var");
       
        return $query->result(); 
       
   } 
    
    
    
    public function logout() {

        $this->session->sess_destroy();
        
        redirect(base_url());
    }

}

?>