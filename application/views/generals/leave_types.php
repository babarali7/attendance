<?php 

    foreach($list as $result){
    
          @$listRow .="<tr>
                <td>".$result->LEAVE_NAME."</td>
                <td>
                <a href='#' onClick='updateInfo($result->LEAVE_ID);'class='btn btn-primary'>Edit</a>
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
          <form method="post" action="create_leave">  
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Add Leave Type</h4>
                </div>
                <div class="card-body ">
                    <div class="form-group">
                      <input type="text" name="leave_name" class="form-control" id="leave_name" placeholder="Leave Title">
                    </div>
                   
                </div>
                <div class="card-footer ">
                  <input type="hidden" name="leave_id" id="leave_id">
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
                  <h4 class="card-title">List of Leave Type</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="desig" class="table table-striped table-no-bordered table-hover desig" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Leave Type</th>
                        
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Leave Type</th>
                          
                          <th>Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
                       <?=$listRow;?>
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
                            url: base_url()+'generals/get_leave/',
                            type: "post",
                            dataType:"json",
                            data: { c_id:id },
                            success: function(data) 
                            {
                                
                              $.each(data,function(i,j){ 
                              //  alert(j.inst_name);
                                $("#leave_name").val(j.LEAVE_NAME);
                               
                                $("#leave_id").val(j.LEAVE_ID);
                              
                              });
                                
                              
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

   
    $(document).ready(function(){ 
     
     oTable = $('#desig').DataTable(); 

         //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
        $('#leave_name').keyup(function(){
          oTable.search($(this).val()).draw() ;
       });


    });


    </script>