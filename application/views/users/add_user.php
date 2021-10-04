<?php 

    foreach($userlist as $userlists){
    
          @$userlistRow .="<tr>
                <td>".$userlists->USER_NAME." 
                <td>".$userlists->GROUP_NAME."
                <td><a href='reset_pass/$userlists->USER_ID/$userlists->USER_NAME' onclick='return confirm(\"Are you sure you want to reset Password ?\");' class='btn btn-primary btn-sm'>Reset Password</a>";
    
    }

?>

<div class="content">
    <div class="container-fluid">     
        
        <?php if($this->session->flashdata('msg')){ 
          
          echo $this->session->flashdata('msg');
      
        } ?>    
     <div class="row"> 

       <div class="col-md-4">        
           <form method="post" action="create_user"> 
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">account_box</i>
                  </div>
                  <h4 class="card-title">Add User</h4>
                </div>
                <div class="card-body ">
                     
                     <div class="form-group">
                      <select class="selectpicker" data-live-search="true" data-style="btn btn-primary" title="Single Select" searchable="Search here.." name="group" id="district">
                            <option disabled selected>Select Group</option>
                             <?php foreach($grouplist as $gl): ?>
                               <option value="<?=$gl->GROUP_ID;?>"> <?=$gl->GROUP_NAME;?> </option>
                             <?php endforeach; ?>   

                      </select>
                    </div>
                    <div class="form-group">
                      
                      <input type="text" name="username" class="form-control" id="examplePass" placeholder="Username">
                    </div>

                    <div class="form-group">
                      
                      <input type="text" name="password" class="form-control" id="order" placeholder="Password">
                    </div>

                           
                </div>
                <div class="card-footer ">
                  <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                </div>
            </div>
        </form>
       </div>
       

        <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">List of Users</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Username</th>
                          
                          <th>Group</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Username</th>
                          
                          <th>Group</th>
                          <th></th>
                        </tr>
                      </tfoot>
                      <tbody>
                       <?=$userlistRow;?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>


     </div>
   </div>   
 </div> 


