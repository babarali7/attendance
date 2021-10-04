<?php 


    foreach($menulist as $menulists){
    
          @$menulistRow .="<tr>
                <td>".$menulists->MENU_TEXT."</td>
                <td>".$menulists->MENU_URL."</td>
                <td>".$menulists->SORT_ORDER."</td>
                <td>".$menulists->par_tit."</td></tr>";
    
    }


?>


<div class="content">
    <div class="container-fluid">     
        
        <?php if($this->session->flashdata('msg')){ 
          
          echo $this->session->flashdata('msg');
      
        } ?>    
     <div class="row"> 
       
       <div class="col-md-4">        
           <form method="post" action="create_menu"> 
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Add Menu</h4>
                </div>
                <div class="card-body ">
                   
                    <div class="form-group">
                      <label for="exampleEmail" class="bmd-label-floating">Menu Name</label>
                      <input type="text" name="menu" class="form-control" id="exampleEmail">
                    </div>
                    <div class="form-group">
                      <label for="examplePass" class="bmd-label-floating">Menu Url</label>
                      <input type="text" name="url" class="form-control" id="examplePass">
                    </div>

                    <div class="form-group">
                      <label for="order" class="bmd-label-floating">Sort Order</label>
                      <input type="text" name="sort" class="form-control" id="order">
                    </div>

                    <div class="form-group">
                      <select class="selectpicker" data-live-search="true" data-style="btn btn-primary" title="Single Select" searchable="Search here.." name="parent" id="parent">
                            <option disabled selected>Select Parent Menu</option>
                             <?php foreach($menus as $menu): ?>
                               <option value="<?=$menu->MENU_ID;?>"> <?=$menu->MENU_TEXT;?> </option>
                             <?php endforeach; ?>   

                      </select>
                    </div>          
                </div>
                <div class="card-footer ">
                  <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                </div>
            </div>
        </form>
       </div>

            <!-- Lisf of menu -->

            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">List of Menus</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Menu Name</th>
                          <th>Menu Url</th>
                          <th>Sort Order</th>
                          <th>Parent Menu</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Menu Name</th>
                          <th>Menu Url</th>
                          <th>Sort Order</th>
                          <th>Parent Menu</th>
                        </tr>
                      </tfoot>
                      <tbody>
                       <?=$menulistRow;?>
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