 <div class="sidebar" data-color="rose" data-background-color="black" data-image="<?=base_url();?>assets/img/sidebar-2.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
        </a>
        <a href="#" class="simple-text logo-normal">
          <img src="<?=base_url();?>assets/img/attendence_1.png" width="130" height="50">
        </a>
      </div>
      
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item ">
            <a class="nav-link" href="<?=base_url();?>">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p> 
            </a>
          </li>
         
           <?php $current_menu = $this->uri->segment(1)."/".$this->uri->segment(2); ?>        
 

         <?php foreach($parent_nav as $parent_navs):  ?>

          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#<?=$parent_navs->MENU_TEXT;?>">
              <i class="material-icons"><?php if($parent_navs->MENU_ICON != NULL) { echo $parent_navs->MENU_ICON; } else { echo "image"; } ?> </i>
              <p> <?php echo $parent_navs->MENU_TEXT; ?>
                <b class="caret"></b>
              </p>
            </a>
           
            <div class="collapse p_<?=$parent_navs->MENU_ID?>" id="<?=$parent_navs->MENU_TEXT?>">
              
              <ul class="nav">
               
                <?php  $child_menus = $My_Controller->fetchsidebar_childMenuById($parent_navs->MENU_ID); ?>  
                   <?php   foreach($child_menus as $child_menuss=>$val){ 
                              $words = explode(" ", $val->MENU_TEXT);
                              $acronym = "";

                                foreach ($words as $w) {
                                  $acronym .= $w[0];
                                }

                                if($current_menu == $val->MENU_URL) {
                                  $active = " active"; ?>
                                  <script type="text/javascript">                  
                                      $(document).ready(function() {
                                         var par = "<?=$parent_navs->MENU_ID;?>"; 
                                         $(".p_"+par).addClass('show');
                                      });
                                  </script>  
                                    
                         <?php       } else {
                                  $active = "";
                                  $show = ""; 
                                }

                    ?>
                

                <li class="nav-item <?=$active;?>">
                  <a class="nav-link" href="<?php echo base_url()."generals/getpage/".$val->MENU_ID; ?>">
                    <span class="sidebar-mini"> <?=$acronym;?> </span>
                    <span class="sidebar-normal"> <?=$val->MENU_TEXT;?> </span>
                  </a>
                </li>
              
              <?php  }  ?>
              
              </ul>
            </div>
          
          </li>
           
          <?php endforeach; ?>

        </ul>
      </div>
    </div>
  

  <div class="main-panel">    <!-- main panel of the page -->

      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round" style="position:fixed; opacity:0.5">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;"></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
            </form>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                    <?=$this->session->userdata('username');?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="<?=base_url('users/change_password');?>">Change Password</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?=base_url('users/logout');?>">Log out</a>
                </div>
              </li>
            </ul>
          </div>
         </div>
      </nav>
      <!-- End Navbar -->