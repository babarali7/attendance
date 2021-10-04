<div class="content">
    <div class="container-fluid">
     
        <div class="row">
           <div class="col-md-2 ml-auto"> 
                <form class="navbar-form" action="<?=base_url();?>reports/daily" method="GET">
                  <div class="input-group no-border">
                    <input type="text" value="<?=date("d-m-Y",strtotime($rp_date));?>" name="date" class="form-control datepicker" placeholder="">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                      <i class="material-icons">search</i>
                      <div class="ripple-container"></div>
                    </button>
                  </div>
                </form>
            </div>
        </div>  

         

        <div class="row">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Daily Attendence Report ( <?=date("l, d M Y",strtotime($rp_date));?> )</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>S#</th>
                          <th>Image</th>
                          <th>Emp ID</th>  
                          <th>Name</th>
                          <th>Designation</th>
                          <th>BPS</th>
                          <th>TimeIn</th>
                          <th>TimeOut</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>S#</th>
                          <th>Image</th>
                          <th>Emp ID</th>  
                          <th>Name</th>
                          <th>Designation</th>
                          <th>BPS</th>
                          <th>TimeIn</th>
                          <th>TimeOut</th>
                          <th>Status</th>
                        </tr>
                      </tfoot>
                      <tbody>
 
                       <?php $sno = 1; foreach($daily as $rp): ?>
                           
                        <tr>
                            <td> <?=$sno;?> </td>
                            <td> <img src="<?=base_url();?>assets/img/employee/<?=$rp->EMP_IMAGE;?>" width="80" 
                                height="80"> </td>
                            <td> <?=$rp->EMP_DEVICE_ID;?> </td>
                            <td> <?=$rp->EMP_NAME;?> </td>
                            <td> <?=$rp->DESIG_NAME;?> </td>
                            <td> BPS-<?=$rp->EMP_BPS;?> </td>
                              
                              <?php if( $rp->min_time != NULL && $rp->max_time != NULL ) {
                                     
                                        if( date("H:i",strtotime($rp->min_time)) <= date("H:i", strtotime("9:15")) ) :
                                          $status = "<span class='badge badge-pill badge-success'>PRESENT</span>";
                                          $start_time = date("H:i",strtotime($rp->min_time));
                                          $end_time =   date("H:i",strtotime($rp->max_time));
                                        else:
                                          $status = "<span class='badge badge-pill badge-warning'>PRESENT / LATE</span>";
                                          $start_time = date("H:i",strtotime($rp->min_time));
                                          $end_time =   date("H:i",strtotime($rp->max_time));
                                        endif;

                                    } else if($rp->min_time != NULL && $rp->max_time == NULL) {

                                         if(date("H:i",strtotime($rp->min_time)) >= date("H:i", strtotime("4:00")) ):
                                           $status = "<span class='badge badge-pill badge-warning'>PRESENT</span>";
                                           $start_time = "<span class='alert alert-danger'>Time In Missing</span>";
                                           $end_time = date("H:i",strtotime($rp->min_time));
                                         elseif(date("H:i",strtotime($rp->min_time)) <= date("H:i", strtotime("9:15")) ):
                                           $status = "<span class='badge badge-pill badge-success'>PRESENT</span>";
                                           $start_time = date("H:i",strtotime($rp->min_time));
                                           $end_time = "<span class='alert alert-danger'>Time Out Missing</span>";  
                                         else:
                                           $status = "<span class='badge badge-pill badge-warning'>PRESENT / LATE</span>";
                                           $start_time = date("H:i",strtotime($rp->min_time));
                                           $end_time = "<span class='alert alert-danger'>Time Out Missing</span>";
                                         endif; 

                                    } else {
                                         
                                           $status = "<span class='badge badge-pill badge-danger'>ABSENT</span>";
                                           $start_time = " -- ";
                                           $end_time = " -- ";   

                                    } ?>


                            <td> <?=$start_time;?> </td>
                            <td> <?=$end_time;?> </td>
                            <td> <?=$status;?> </td>

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


    </div> <!-- container-fluid --> 
</div>    

