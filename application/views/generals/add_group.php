<?php 

	  foreach($group_list as $grouplists){
	  
	        @$grouplistRow .="<tr>
								<td>".$grouplists->GROUP_NAME."</td> 
								<td><a href='".base_url()."generals/add_permission/$grouplists->GROUP_ID' class='btn btn-warning'>Permission</a>&nbsp;&nbsp;
								<a href='#' onClick='updateInfo($grouplists->GROUP_ID);'class='btn btn-primary'>Edit</a>
								</td>";
	  
	  
	  }

?>

<div class="content">
    <div class="container-fluid">     
        
        <?php if($this->session->flashdata('msg')){ 
          
          echo $this->session->flashdata('msg');
      
          } ?>    
     <div class="row"> 
      
      <div class="col-md-4">        
          <form method="post" action="create_group">  
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Add Role</h4>
                </div>
                <div class="card-body ">
                    <div class="form-group">
                      <label for="exampleEmail" class="">Role Name</label>
                      <input type="text" name="group_name" class="form-control" id="grp_name">
                    </div>
                </div>
                <div class="card-footer ">
                  <input type="hidden" name="grp_id" id="grp_id">
                  <?php echo $My_Controller->savePermission;?>
                    <button type="button" class="btn btn-fill" id="reset" onClick="resetValues();" style="display: none"> Cancel </button>
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
                  <h4 class="card-title">List of Roles</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Role Name</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Role Name</th>
                          <th>Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
                       <?=$grouplistRow;?>
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

<script type="text/javascript">
       function base_url() {
         return "<?=base_url();?>";
       }
         
    
       function updateInfo(id) {
          
        //  alert(id);
                
          $.ajax({
                            url: base_url()+'generals/edit_group/',
                            type: "post",
                            dataType:"json",
                            data: { c_id:id },
                            success: function(data) 
                            {
                                
                              $.each(data,function(i,j){ 
                              //  alert(j.inst_name);
                                $("#grp_name").val(j.GROUP_NAME);
                               
                                $("#grp_id").val(j.GROUP_ID);
                              
                              });
                                
                                $('.selectpicker').selectpicker('refresh');

                                $("#save").val("UPDATE");
                                $("#reset").show();

                                    
                            }
                           
                    });
           
     
          } 

   function resetValues() {
         // alert("reset clicked");
         $("input").val("");
         $("#save").val("save");
         $("#reset").hide();

   }

    </script>