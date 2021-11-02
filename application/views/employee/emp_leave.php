<script type="text/javascript">
 
  $(document).ready(function() {    

    $(".dataExport").click(function() {
       var exportType = $(this).data('type');    
          $('#datatable').tableExport({
            type : exportType,      
            escape : 'false',
            ignoreColumn: []
          });   
    });

  });


</script>

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
                  <h4 class="card-title">Employee Leave Information
                  </h4>
                </div>
                <div class="card-body">
                  <form method="post" id="manual" action="<?=base_url();?>employee/add_emp_leave">
                   
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                         <select class="selectpicker" data-live-search="true" data-style="btn btn-primary" title="Single Designation" searchable="Search here.." name="emp_name" id="emp_name" required="required">
                            <option disabled selected>Select Employee</option>
                             <?php foreach($emp as $em): ?>
                               <option value="<?=$em->EMP_ID;?>"> <?=$em->EMP_NAME;?> ( <?=$em->DESIG_NAME;?>  )</option>
                             <?php endforeach; ?> 
                         </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                         <select class="selectpicker" data-live-search="true" data-style="btn btn-primary" title="Single Leave" searchable="Search here.." name="leave_name" id="leave_name" required="required">
                            <option disabled selected>Select Leave Type</option>
                             <?php foreach($leave_type as $lt): ?>
                               <option value="<?=$lt->LEAVE_ID;?>"><?=$lt->LEAVE_NAME;?></option>
                             <?php endforeach; ?> 
                         </select>
                        </div>
                      </div>
                      <!-- <div class="col-md-1">
                        <div class="form-group">
                        </div>
                      </div> -->
                      <div class="col-md-1">
                        <div class="form-group">
                           <input type="text" class="form-control datepicker" name="st_date" placeholder="FROM" required="required">
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                           <input type="text" class="form-control datepicker" name="end_date" placeholder="TO" required="required">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                           <textarea name="remarks" class="form-control" placeholder="Enter Remarks" rows="1"></textarea>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <input type="submit" class="btn btn-rose pull-left" value="Submit" id="save">
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
                  <h4 class="card-title">Search Employee Attendance</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar text-right">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                     
                   
                  </div>

                  <form method="get" id="manual" action="<?=base_url();?>employee/emp_leave">
                   
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                         <select class="selectpicker" data-live-search="true" data-style="btn btn-primary" title="Single Designation" searchable="Search here.." name="s_emp_name" id="s_emp_name">
                            <option disabled selected>Select Employee</option>
                             <?php foreach($emp as $em): ?>
                               <option value="<?=$em->EMP_ID;?>"> <?=$em->EMP_NAME;?> ( <?=$em->DESIG_NAME;?>  )</option>
                             <?php endforeach; ?> 
                         </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                         <select class="selectpicker" data-live-search="true" data-style="btn btn-primary" title="Single Leave" searchable="Search here.." name="s_leave_name" id="s_leave_name">
                            <option disabled selected>Select Leave Type</option>
                             <?php foreach($leave_type as $lt): ?>
                               <option value="<?=$lt->LEAVE_ID;?>"><?=$lt->LEAVE_NAME;?></option>
                             <?php endforeach; ?> 
                         </select>
                        </div>
                      </div>
                      <!-- <div class="col-md-1">
                        <div class="form-group">
                        </div>
                      </div> -->
                      <div class="col-md-1">
                        <div class="form-group">
                           <input type="text" class="form-control datepicker" id="ss_st" name="s_st_date" placeholder="FROM">
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                           <input type="text" class="form-control datepicker" id="ss_ed" name="s_end_date" placeholder="TO">
                        </div>
                      </div>
                     
                      <div class="col-md-3">
                        <input type="submit" class="btn btn-info pull-left" onclick="return check_date();" name="search" value="Search" id="save">
                       </div>   
                    </div>  
                    <div class="clearfix"></div>
                  </form>
                 
                <?php if($this->input->get("search")): ?> 
                    <div class="text-right">  
                      <div class="btn-group" >
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Export <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a class="dataExport" data-type="csv">CSV</a></li>
                          <li><a class="dataExport" data-type="excel">XLS</a></li>          
                          <li><a class="dataExport" data-type="txt">TXT</a></li>
                        </ul>
                      </div> 
                    </div>  
                  <div class="material-datatables">
                    <table id="datatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>S#</th>
                          <th>Name</th>
                          <th>Designation</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Leave Type</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        <?php $s_no=1; foreach($result as $ls): ?>
                        
                         <tr>
                            <td> <?=$s_no;?> </td>
                            <td> <?=$ls->EMP_NAME;?> </td>
                            <td> <?=$ls->DESIG_NAME;?></td>
                            <td> <?=date("d-m-Y", strtotime($ls->EL_START_DATE));?> </td>
                            <td> <?=date("d-m-Y", strtotime($ls->EL_END_DATE));?> </td>
                            <td> <?=$ls->LEAVE_NAME;?> </td>
                            <td> <?=$ls->EL_REMARKS;?> </td>

                         </tr>  
                       
                        <?php $s_no++;  endforeach; ?>

                      </tbody>


                      <tfoot>
                        <tr>
                          <th>S#</th>
                          <th>Name</th>
                          <th>Designation</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Leave Type</th>
                          <th>Remarks</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      </tbody>
                    </table>
                  </div>

                <?php endif; ?>
                



                </div>
                <!-- end card body-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->   
            
            
           

          </div>

    </div>  <!-- container-fluid -->
</div>      


<script type="text/javascript">
  
   function check_date() {
      var x = $("#ss_st").value;
      var y = $("#ss_ed").value;
      if( x != "" && y != "" ) {
  
        return true;

      } else {
          
        alert($("#ss_st").val());

        alert($("#ss_ed").val());
        
            Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Please Enter From and To Date',
                        showConfirmButton: false,
                        timer: 3000
                      });
        return false;

      }
   
   }

  
    function confirm_add() {

        Swal.fire({
          title: 'Are You Sure ?',
          text: "You want to add leave for this employee ?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes!'
        }).then((result) => {
          if (result.isConfirmed) {
           
            $("#manual").submit();
   
          }

        });
         
     
     }



</script>