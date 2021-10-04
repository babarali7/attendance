
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Attendance Management System
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?=base_url();?>assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
 
</head>

<body class="off-canvas-sidebar">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
      <!-- <div class="navbar-wrapper"> -->
       
           <div class="col-md-3">
            <img src="<?=base_url();?>assets/img/attendance.png" width="40%" height="40%">  
           </div>
           <div class="col-md-9">
             <h2> Attendance Management System </h2> 
          </div>
        <!-- </div> -->
      
    
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper wrapper-full-page">
  <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('<?=base_url();?>assets/img/login.jpg'); background-size: cover; background-position: top center;">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      <div class="container">
       
        <?php if($this->session->flashdata('msg')){ ?>
     
        
        <div class="alert alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="material-icons">close</i>
          </button>
          <span> <?=$this->session->flashdata('msg');?> </span>
        
         </div>
        
        <?php  } ?>

        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
            <form class="form" method="post" action="<?=base_url();?>users/login_authen">
              <div class="card card-login card-hidden">
                <div class="card-header card-header-rose text-center">
                  <h4 class="card-title">Login</h4>
                 
                </div>
                <div class="card-body ">
                  <p class="card-description text-center">Welcome</p>
                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">email</i>
                        </span>
                      </div>
                      <input type="text" name="u_email" class="form-control" placeholder="username...">
                    </div>
                  </span>
                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                        </span>
                      </div>
                      <input type="password" name="u_password" class="form-control" placeholder="Password...">
                    </div>
                  </span>
                </div>
                <div class="card-footer justify-content-center">
                  <button  type="submit" class="btn btn-rose btn-link btn-lg">Lets Go</button> 
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container">
         
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, All Rights Reserved
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="<?=base_url();?>assets/js/core/jquery.min.js"></script>
  <script src="<?=base_url();?>assets/js/core/popper.min.js"></script>
  <script src="<?=base_url();?>assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="<?=base_url();?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="<?=base_url();?>assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?=base_url();?>assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  
  <script>
    $(document).ready(function() {
      md.checkFullPageBackgroundImage();
      setTimeout(function() {
        // after 1000 ms we add the class animated to the login/register card
        $('.card').removeClass('card-hidden');
      }, 700);
    });
  </script>
</body>

</html>