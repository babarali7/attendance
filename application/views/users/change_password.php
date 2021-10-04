			
 <div class="content">
    <div class="container-fluid">     
        
        <?php if($this->session->flashdata('msg')){ 
          
          echo $this->session->flashdata('msg');
      
        } ?>	    
 
      
    
           <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Change Password</h4>
                  </div>
                </div>
                <form method="post" action="edit_password" class="form-horizontal" id="form_pass">
                 <div class="card-body">
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Username</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                         <input type="text" class="form-control" value="<?=$this->session->userdata('username');?>" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Current Password</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="password" name="old_password" class="form-control" required="true">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">New Password</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="password" name="new_password" id="idSource" class="form-control" required="true">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Re-enter New Password</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input type="password" name="re_enter_new_pass" id="idDestination" class="form-control" equalTo="#idSource" required="true">
                        </div>
                      </div>
                    </div>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-9">
                      <button type="submit" class="btn btn-fill btn-success">Update Password</button>
                    </div>
                  </div>
                </div>
               </form> 
              </div>
            </div>
   
    </div> <!--  container - fluid -->
 </div>

 <script type="text/javascript">
      

    function setFormValidation(id) {
      $(id).validate({
        highlight: function(element) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
          $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function(element) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
          $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function(error, element) {
          $(element).closest('.form-group').append(error);
        },
      });
    }
   

   $(document).ready(function() {
      setFormValidation('#form_pass');
    });

 </script>

    
