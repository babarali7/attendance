<div class="content">
    <div class="container-fluid">     
      
        <?php if($this->session->flashdata('msg')){ 
          
          echo $this->session->flashdata('msg');
      
        } 
        
        ?>
         
         <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">perm_identity</i>
                  </div>
                  <h4 class="card-title">Add Employee
                  </h4>
                </div>
                <div class="card-body">
                  <form method="post" action="<?=base_url();?>employee/add_employee" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="text" name="e_name" class="form-control" id="e_name" required="required" placeholder="Name">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="text" name="emp_device_id" id="emp_device_id" class="form-control" placeholder="Emp Device ID">
                        </div>
                      </div>
                      <div class="col-md-2">
                      <div class="checkbox-radios">
                        <div class="form-check form-check-inline" style="padding:0px 0px; margin:10px 0px;">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gender"  id="male" value="Male"> Male
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-inline" style="padding:0px 0px; margin:10px 0px;">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female"> Female
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                       </div>               
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="number" name="cnic" id="cnic" class="form-control" placeholder="CNIC (without dashses)">
                        </div>
                      </div>
                    
                       <div class="col-md-3">
                          <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail img-circle">
                          <img src="<?=base_url();?>assets/img/placeholder.jpg" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                        <div>
                          <span class="btn btn-round btn-rose btn-file">
                            <span class="fileinput-new">Add Photo</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="i" />
                          </span>
                          <br />
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                      </div>
                     </div>
                      <div class="col-md-1">  
                        <div class="insert-img">
                        </div>
                      </div> 
                    </div>

                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                         <select class="selectpicker" data-live-search="true" data-style="btn btn-primary" title="Single Designation" searchable="Search here.." name="group" id="designation">
                            <option disabled selected>Select Designation</option>
                             <?php foreach($desig as $des): ?>
                               <option value="<?=$des->DESIG_ID;?>"> <?=$des->DESIG_NAME;?> </option>
                             <?php endforeach; ?> 
                         </select>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <select class="selectpicker" data-live-search="true" data-style="btn btn-primary" title="Select  BPS" searchable="Search here.." name="bps" id="bps">
                            <option disabled selected>Select BPS</option>
                             <?php for($i=1;$i<=22;$i++): ?>
                               <option value="<?=$i;?>"> <?=$i;?> </option>
                             <?php endfor;?> 
                         </select>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                        </div>
                      </div>
                      <div class="col-md-4 col-md-offset-2">
                        <input type="hidden" name="emp_id" id="emp_id">
                        <input type="submit" class="btn btn-rose pull-left" value="Add Employee" id="save">
                        <button type="button" class="btn btn-fill" id="reset" onClick="resetValues();" style="display: none"> Cancel </button>
                       </div>   
                    </div>  
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>   
          
         <div class="row">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">List of All Employees</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="patien" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>S#</th>
                          <th>Emp Device ID</th>  
                          <th>Name</th>
                          <th>Gender</th>
                          <th>NIC</th>
                          <th>Designation</th>
                          <th>BPS</th>
                          <th>Image</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>S#</th>
                          <th>Emp Device ID</th>  
                          <th>Name</th>
                          <th>Gender</th>
                          <th>NIC</th>
                          <th>Designation</th>
                          <th>BPS</th>
                          <th>Image</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->   
            
            
           

          </div>

    </div>  <!-- container-fluid -->
</div>      

<script type="text/javascript">
       function base_url() {
         return "<?=base_url();?>";
       }
         
    
       function updateInfo(id) {
          
         // alert(id);
         var gend;
             
          $.ajax({
                            url: base_url()+'employee/get_info/',
                            type: "post",
                            dataType:"json",
                            data: { c_id:id },
                            success: function(data) 
                            {
                                
                              $.each(data,function(i,j){ 
                              //  alert(j.inst_name);
                                $("#e_name").val(j.emp_name);
                                $("#emp_device_id").val(j.emp_device_id);
                                gend = j.emp_gender;
                                $("#cnic").val(j.emp_nic);
                                $("#designation").val(j.desig_id);
                                $("#bps").val(j.emp_bps);
                                $(".insert-img").html("<img src='<?=base_url();?>assets/img/employee/"+j.emp_img+"' width='80' height='80'>");
                                $("#emp_id").val(j.emp_id);
                              
                              });

                               //alert(gend); 
                               if(gend == "Male") {
                                $("#male").prop("checked", true);
                               } else {
                                $("#female").prop("checked", true);
                               }
                                $('.selectpicker').selectpicker('refresh');
                                $("#save").val("UPDATE");
                                $("#reset").show();

                                    
                            }
                           
                    });           
     
          } 

     
   function resetValues() {
         // alert("reset clicked");
         $("input").val("");
         $("#save").val("Add Employee");
         $("#reset").hide();
         $(".form-check-input").prop('checked', false);
         $("select").val("");
         $('.selectpicker').selectpicker('refresh');
         $(".insert-img").html("");

   }

       


    </script>

<script>
   $(document).ready(function(){  
    $('#patien').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('employee/fetch_user/'); ?>",
            "type": "POST"
        },
        //Set column definition initialisation properties
        "columnDefs": [{ 
            "targets": [0],
            "orderable": false
        }]
    });
  

  oTable = $('#patien').DataTable();   //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
    $('#e_name').keyup(function(){
      oTable.search($(this).val()).draw() ;
   });

    $('#cnic').keyup(function(){
      oTable.search($(this).val()).draw() ;
   });
 

 });  
     
  
  </script>