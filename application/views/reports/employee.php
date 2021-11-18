
<script type="text/javascript">
  
   $(document).ready(function() {
      
      $(".daterange").daterangepicker({
        
        "showDropdowns": true

      });

      $(".dataExport").click(function() {
        var exportType = $(this).data('type');    
        $('#customer_data').tableExport({
          type : exportType,      
          escape : 'false',
          ignoreColumn: []
        });   
      });

    $('#customer_data').DataTable();  

  });

</script>


<?php if($this->input->get('emp')) {

        foreach($emp_basic as $emp_b):
           
           $emp_name   = $emp_b->EMP_NAME;
           $desig_name = $emp_b->DESIG_NAME;
           $bps        = $emp_b->EMP_BPS;

        endforeach;  

      }

?>


<div class="content">
    <div class="container-fluid">
     
       <form class="navbar-form" action="<?=base_url();?>reports/employeeAttendance" method="GET"> 
        <div class="row">
           
              <div class="col-md-6 ml-auto mr-auto"> 
                  <div class="form-group input-group no-border">
                    <select class="selectpicker col-md-8" data-live-search="true" data-style="select-with-transition" title="Single Designation" searchable="Search here.." name="emp" id="emp">
                            <option disabled selected>Select Employee</option>
                             <?php foreach($emp as $des): 
                                      if( $des->EMP_DEVICE_ID == $this->input->get('emp') ) {
                                        $selected = " selected";
                                      } else {
                                        $selected = " ";
                                      }
                                ?>
                               <option value="<?=$des->EMP_DEVICE_ID;?>-<?=$des->EMP_ID;?>" <?=$selected;?>> <?=$des->EMP_NAME;?> (<?=$des->DESIG_NAME;?>) </option>
                             <?php endforeach; ?> 
                    </select>
                  </div>               
              </div>
              <div class="col-md-4 ml-auto mr-auto"> 
                  <div class="form-group input-group no-border">
                    <input type="text" value="<?php echo $start_date.' - '.$end_date;?>" name="date" class="form-control daterange" placeholder="">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                      <i class="material-icons">search</i>
                      <div class="ripple-container"></div>
                    </button>
                  </div>               
              </div>
            
        </div>  

       </form> 

      <?php if($this->input->get('emp')): ?>

        <div class="row">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Attendence Report</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar text-right">
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
                    <table id="customer_data" class="table table-striped table-bordered table-hover" cellspacing="0" width="100" style="width:100%" >
                      <thead>
                        <tr>
                           
                           <th colspan="5" class="text-center"><b><?=$emp_name;?> ( <?=$desig_name;?> ) - <?=date("d M Y",strtotime($start_date));?> To <?=date("d M Y",strtotime($end_date));?>  </b></th>
                           
                        </tr>
                        <tr>
                          <th>S#</th>
                          <th>Date</th>
                          <th>Day</th>
                          <th>Check IN</th>
                          <th>Check OUT</th>
                        </tr>
                      </thead>
                      
                      <tbody>
 
                       <?php $sno = 1; foreach($emp_result as $em): 
                              

                       ?>


                        
                        <tr>
                            <td> <?=$sno;?> </td>
                            <td> <?=date("d-m-Y",strtotime($em->dte));?> </td>
                            <td> <?=date("l",strtotime($em->dte));?> </td>
                            <?php                            
                            if($em->min_time == NULL && $em->max_time == NULL ) { 


                                if($em->leave_status != "NO-LEAVE") { ?>

                                 
                                 <td colspan="2" class="text-warning"> <?php echo $em->leave_status; ?> </td>
                              

                               <?php } else { ?>

                                
                                <td colspan="2" class="text-danger"> ABSENT </td>

                                <?php }

                                ?>

                            
                          <?php  } else { ?>

                            <td> <?=date("h:i A",strtotime($em->min_time));?> </td>

                            <td> <?=date("h:i A",strtotime($em->max_time));?> </td>

                           <?php } ?>
                       
                         </tr>   

                        <?php  $sno++;  endforeach; ?>

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

      <?php endif; ?>


    </div> <!-- container-fluid --> 
</div>    

