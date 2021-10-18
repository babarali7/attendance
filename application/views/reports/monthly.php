
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



   });

</script>



<div class="content">
    <div class="container-fluid">
     
        <div class="row">
           <div class="col-md-4 ml-auto"> 
                <form class="navbar-form" action="<?=base_url();?>reports/monthly" method="GET">
                  <div class="input-group no-border">
                    <input type="text" value="<?php echo $start_date.' - '.$end_date;?>" name="date" class="form-control daterange" placeholder="">
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
                  <h4 class="card-title"> Attendence Report ( <?=date("d M Y",strtotime($start_date));?> - <?=date("d M Y",strtotime($end_date));?>  )</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!-- <button id="exporttable" class="btn btn-primary float-right">Export</button> -->
                      <div class="btn-group pull-right">
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Export <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a class="dataExport" data-type="csv">CSV</a></li>
                          <li><a class="dataExport" data-type="excel">XLS</a></li>          
                          <li><a class="dataExport" data-type="txt">TXT</a></li>              
                        </ul>
                      </div>
                  </div>
                  <div class="material-datatables">
                    <table id="customer_data"  class="table table-striped table-bordered table-hover table-responsive" cellspacing="0">
                      <thead>
                        <tr>
                          <th>S#</th>
                          <th>Name</th>
                          <th>Designation</th>
                          <th>Date</th>

                          <?php

                            $he_start_date = $f_start_date = $in_start_date = $start_date;
                            $he_end_date = $f_end_date = $in_end_date =  $end_date;

                          while (strtotime($he_start_date) <= strtotime($he_end_date)) {
                                $timestamp = strtotime($he_start_date);
                                $hd = "";
                                $day = date('d', $timestamp);
                              //  echo "$start_date" . "  $day";                                 
                                $week = date('D', $timestamp);
                                $hd = "($week)";

                                                                 

                               echo "<th> $day <small>$hd</small> </th>";

                                $he_start_date = date ("Y-m-d", strtotime("+1 days", strtotime($he_start_date)));
                          }


                          ?>
                          


                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>S#</th>
                          <th>Name</th>
                          <th>Designation</th>
                          <th>Date</th>


                          <?php

                          while (strtotime($f_start_date) <= strtotime($f_end_date)) {
                                $timestamp = strtotime($f_start_date);
                                $hd = "";
                                $day = date('d', $timestamp);
                                $week = date('D', $timestamp);
                                $hd = "($week)";
                               //  echo "$start_date" . "  $day";
                               echo "<th> $day <small>$hd</small> </th>";

                                $f_start_date = date ("Y-m-d", strtotime("+1 days", strtotime($f_start_date)));
                          }


                          ?>
                          
                        </tr>
                      </tfoot>
                      <tbody>
 
                       <?php $sno = 1; foreach($emp as $em): 
                           
                               $in_start_date = $start_date;
                               $in_end_date = $end_date;
                               $st_d_time = $en_d_time = "";
                           while (strtotime($in_start_date) <= strtotime($in_end_date)) {
                             
                                $result =  $mycontroller->bring_emp_attend($em->EMP_DEVICE_ID,$in_start_date);

                              //  print_r($result);
                               
                                if($result['max_in'] == NULL && $result['max_out'] == NULL){
                               
                                  $st_d_time .= "<td class='text-danger'>A</td>";
                                  $en_d_time .= "<td class='text-danger'>A</td>"; 

                                } else {

                                
                                 $st_d_time .= "<td>".date("H:i",strtotime($result['max_in']))."</td>";
                                 $en_d_time .= "<td>".date("H:i",strtotime($result['max_out']))."</td>";
 

                                }
                                 

                                $in_start_date = date ("Y-m-d", strtotime("+1 days", strtotime($in_start_date)));
                          }
                           


                       ?>
                           
                           


                        <tr>
                            <td rowspan="2"> <?=$sno;?> </td>
                            <td rowspan="2"> <?=$em->EMP_NAME;?> </td>
                            <td rowspan="2"> <?=$em->DESIG_NAME;?> (BPS-<?=$em->EMP_BPS;?>) </td>
                            <td><b> IN </b></td>
                                                        
                            <?=$st_d_time;?>

                         </tr>

                         <tr>
                              <td><b> Out </b></td>
                              <?=$en_d_time;?>

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

