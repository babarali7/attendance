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
                  <h4 class="card-title">Add Manual Attendance
                  </h4>
                </div>
                <div class="card-body">
                  <form method="post" id="manual" action="<?=base_url();?>employee/add_manual_attend" enctype="multipart/form-data">
                   
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                         <select class="selectpicker" data-live-search="true" data-style="btn btn-primary" title="Single Designation" searchable="Search here.." name="emp_name" id="emp_name">
                            <option disabled selected>Select Employee</option>
                             <?php foreach($emp as $em): ?>
                               <option value="<?=$em->EMP_DEVICE_ID;?>"> <?=$em->EMP_NAME;?> ( <?=$em->DESIG_NAME;?>  )</option>
                             <?php endforeach; ?> 
                         </select>
                        </div>
                      </div>
                      <!-- <div class="col-md-1">
                        <div class="form-group">
                        </div>
                      </div> -->
                      <div class="col-md-3">
                        <div class="form-group">
                           <input type="text" class="form-control datetimepicker" name="date_time" placeholder="Select Date Time">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                           <textarea name="remarks" class="form-control" placeholder="Enter Remarks" rows="1"></textarea>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <input type="button" class="btn btn-rose pull-left" onclick="confirm_add();" value="Submit" id="save">
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
                  <h4 class="card-title">Manual Attendence List</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar text-center">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                     
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
                          <th>Date Time</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        <?php $s_no=1; foreach($list as $ls): ?>
                        
                         <tr>
                            <td> <?=$s_no;?> </td>
                            <td> <?=$ls->EMP_NAME;?> </td>
                            <td> <?=$ls->DESIG_NAME;?> ( BPS - <?=$ls->EMP_BPS;?> ) </td>
                            <td> <?=date("d-m-Y h:i A", strtotime($ls->AT_DATE_TIME));?> </td>
                            <td> <?=$ls->AT_REMARKS;?> </td>

                         </tr>  
                       
                        <?php $s_no++;  endforeach; ?>

                      </tbody>


                      <tfoot>
                        <tr>
                          <th>S#</th>
                          <th>Name</th>
                          <th>Designation</th>
                          <th>Date Time</th>
                          <th>Remarks</th>
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
  
  
    function confirm_add() {

        Swal.fire({
          title: 'Are You Sure ?',
          text: "You want to add manual Attendance for this employee ?",
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