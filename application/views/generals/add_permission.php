<div class="content">
    <div class="container-fluid">     
        
        <?php if($this->session->flashdata('msg')){ 
          
          echo $this->session->flashdata('msg');
      
        } ?>    
      
      <div class="row"> 
      
             <div class="col-lg-12">
          <!-- col-lg-12 start here -->
          <div class="panel panel-default plain toggle panelClose panelRefresh">
            <!-- Start .panel -->
            <div class="panel-heading white-bg">
              <h4 class="panel-title">Add / Update Permission</h4>
            </div>
            <div class="panel-body">
       <form action="<?=base_url();?>generals/create_permission" method="post">
              <table class="table display" id="">
                <thead>
                  <tr>
                    <th>Menu Name
                    <th>View
                    <th>Insert
                    <th>Update
                    <th>Delete
                <tbody>

                        <input type="hidden"  value="<?php echo $group_id; ?>" name="group_id">


                        <?php //First, Level Menu....................
                 foreach ($parentnav as $parentnav_list_data):
                                //Count, First Row......
                 $permission_count = $Generals->checkpermission($parentnav_list_data->MENU_ID, $group_id);
                  //Fetch record for permissions..........
                  $permission_sql = $Generals->fetchRecordpermission($parentnav_list_data->MENU_ID, $group_id);
                   if ($permission_count > 0) {

                    foreach($permission_sql as $permission_sql_data){

                      $view = $permission_sql_data->PER_SELECT;
                   }
                  
                    } else {

                      $view = 0;
                    }
                            ?>



                            <tr>

                                <td>
                <?php echo "<span style='font-size:16px;'>".$parentnav_list_data->MENU_TEXT."</span>"; ?>
                </td>
                                <?php if ($parentnav_list_data->PARENT_ID != 0) { $menuid = $parentnav_list_data->MENU_ID; } else { ?>
                                <td>
                                <input type="checkbox"  <?php if ($view == 1) { echo "checked"; }?> name="permission[view][<?php echo $parentnav_list_data->MENU_ID; ?>]">
                                </td>
                                <td>
                                </td>
                                <td>
                </td>
                <td>
                </td>
                                <?php } ?>

                            </tr>

                    
                  <?php //Find , 2nd Level child Menus..................
                        $secondchild_count = $Generals->checkchildMenuCount($parentnav_list_data->MENU_ID);
                     //Count Parent Menu it has child ??...........
                           if ($secondchild_count > 0) {
                         //Fetch child menus of Parent Menu..............
                          $secondChildrow_data = $Generals->fetchchildMenu($parentnav_list_data->MENU_ID);
                           /* GET DATA OF CHILD MENU*/
                            foreach($secondChildrow_data as $secondChildrow_data){  
                         //Count child menu for Permissions....
                          $secondpermission_count_child = $Generals->checkpermission($secondChildrow_data->MENU_ID, $group_id);
                           //CHECK PERMISSIONS.........
                          $secondpermission_sql_child = $Generals->fetchRecordpermission($secondChildrow_data->MENU_ID, $group_id);
                        
                           if ($secondpermission_count_child > 0) {

                             foreach($secondpermission_sql_child as $secondpermission_sql_childdata){

                             $view   = $secondpermission_sql_childdata->PER_SELECT;
                             $insert = $secondpermission_sql_childdata->PER_INSERT;
                             $update = $secondpermission_sql_childdata->PER_UPDATE;
                             $delete = $secondpermission_sql_childdata->PER_DELETE;

                            }
                            
                          } else {
                          
                              $view = 0;
                              $insert = 0;
                              $update = 0;
                              $delete = 0;
                          }
                    ?>
                        
                    <tr>
                                        
                        <td>
                        <?php echo " - - " . $secondChildrow_data->MENU_TEXT; ?>
                        </td>
                        <td>
                          <input type="checkbox"  <?php  if($view == 1){   echo "checked"; }?> name="permission[view][<?php  echo $secondChildrow_data->MENU_ID; ?>]">
                         </td>
                         <td>
                          <input type="checkbox"  <?php if($insert == 1){ echo "checked";  }?> name="permission[insert][<?php echo $secondChildrow_data->MENU_ID; ?>]">
                         </td>
                         <td>
                          <input type="checkbox"  <?php if($update == 1){ echo "checked";  }?> name="permission[update][<?php echo $secondChildrow_data->MENU_ID; ?>]">

                         </td>
                         <td>
                          <input type="checkbox"  <?php if ($delete == 1){ echo "checked"; }?> name="permission[delete][<?php echo $secondChildrow_data->MENU_ID; ?>]">
                        </td>

                                        </tr>
                    
                    
                    
                    <?php //Find , 3rd Level child Menus..................
                        $thirdchild_count = $Generals->checkchildMenuCount($secondChildrow_data->MENU_ID);
                         //Count Parent Menu it has child ??...........
                           if ($thirdchild_count > 0) {
                           //Fetch child menus of Parent Menu..............
                            $thirdChildrow_data = $Generals->fetchchildMenu($secondChildrow_data->MENU_ID);
                             /* GET DATA OF CHILD MENU*/
                            foreach($thirdChildrow_data as $thirdChildrow_data){  
                             //Count child menu for Permissions....
                              $thirdpermission_count_child = $Generals->checkpermission($thirdChildrow_data->MENU_ID, $group_id);
                               //CHECK PERMISSIONS.........
                              $thirdpermission_sql_child = $Generals->fetchRecordpermission($thirdChildrow_data->MENU_ID, $group_id);
                            
                               if ($thirdpermission_count_child > 0) {

                                 foreach($thirdpermission_sql_child as $thirdpermission_sql_childdata){

                                 $view   = $thirdpermission_sql_childdata->PER_SELECT;
                                 $insert = $thirdpermission_sql_childdata->PER_INSERT;
                                 $update = $thirdpermission_sql_childdata->PER_UPDATE;
                                 $delete = $thirdpermission_sql_childdata->PER_DELETE;

                                }
                                
                              } else {
                              
                                  $view = 0;
                                  $insert = 0;
                                  $update = 0;
                                  $delete = 0;
                              }
                     ?>
                        
                    <tr>
                                        
                        <td>
                        <?php echo " - - - " . $thirdChildrow_data->MENU_TEXT; ?>
                        </td>
                        <td>
                          <input type="checkbox"  <?php  if($view == 1){   echo "checked"; }?> name="permission[view][<?php  echo $thirdChildrow_data->MENU_ID; ?>]">
                         </td>
                         <td>
                          <input type="checkbox"  <?php if($insert == 1){ echo "checked";  }?> name="permission[insert][<?php echo $thirdChildrow_data->MENU_ID; ?>]">
                         </td>
                         <td>
                          <input type="checkbox"  <?php if($update == 1){ echo "checked";  }?> name="permission[update][<?php echo $thirdChildrow_data->MENU_ID; ?>]">

                         </td>
                         <td>
                          <input type="checkbox"  <?php if ($delete == 1){ echo "checked"; }?> name="permission[delete][<?php echo $thirdChildrow_data->MENU_ID; ?>]">
                        </td>

                                        </tr>
                        
                    <?php   } // END, GET DATA OF CHILD MENU*...................../  ?>
                     
                    <?php       } // END, Count Parent Menu it has child ??........... ?>
                     
                    <?php ///////////////////////////////////////////////////////////////?>
                    
                                     <?PHP  //THIRD CHILD END ?>
                    
                    <?PHP ///////////////////////////////////////////////////////////////?>
                      
                    <?php   } // END, GET DATA OF CHILD MENU*...................../  ?>
                     
                     
                    <?php       } // END, Count Parent Menu it has child ??........... ?>
                     
                     
                                        <?php  endforeach; // END, Parent Loop..................... ?>


                        </tbody>
           
              </table>
        
                    <input type="submit" value="Save">
                </form>
            </div>
          </div>
          <!-- End .panel -->
        </div>
        <!-- col-lg-12 end here -->
      </div> 
   </div>
</div>