<?php 

	  //foreach($group_list as $grouplists){
	  /*
	        @$grouplistRow .="<tr class=gradeX>
								<td>".$grouplists->GROUP_NAME." 
								<td><a href='".base_url()."generals/add_permission/$grouplists->GROUP_ID' class='btn btn-warning'>Permission</a>&nbsp;&nbsp;<a href='".base_url()."generals/edit_group/$grouplists->GROUP_ID' class='btn btn-primary'>Edit</a>";
	  
	  */
	  //}


?>

<?php if($this->session->flashdata('msg')){ ?>
			
			
			<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="fa-ok alert-icon s24"></i> <strong><?=$this->session->flashdata('msg');?></strong>
			</div>

			
			
<?php } ?>
			
			
<div class=row>
        <!-- Start .row -->
        <div class=col-lg-12>
          <!-- Start col-lg-12 -->
          <div class="panel panel-default toggle">
            <!-- Start .panel -->
            <div class=panel-heading>
              <h3 class=panel-title>Update Group</h3>
            </div>
            <div class=panel-body>
              <form class="form-horizontal group-border hover-stripped" action="<?php echo base_url(); ?>generals/update_group" method="post">
                <div class=form-group>
                  <label class="col-lg-2 col-md-2 col-sm-12 control-label">Group Name</label>
                  <div class="col-lg-4 col-md-4">
				      <?php foreach($groups as $group){ ?>
                            <input class=form-control name="group_name" placeholder="" value="<?php echo $group->GROUP_NAME;;?>" autofocus>
					  
                            <input type="hidden" class=form-control name="group_id" placeholder="" value="<?php echo $group->GROUP_ID;;?>" autofocus>
					  <?php } ?>
                  </div>
                </div>
				 <div class=form-group>
				 <label class="col-lg-2 col-md-2 col-sm-12 control-label"></label>
                  <div class="col-lg-2 col-md-2">
				   <input type="submit" value="update" class="btn btn-success" >
                  </div>
				 </div>
              </form>
            </div>
          </div>
          <!-- End .panel -->
        </div>
        <!-- End col-lg-12 -->
      </div>
	  
	  
	
	 