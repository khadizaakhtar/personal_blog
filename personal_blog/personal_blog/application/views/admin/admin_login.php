<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootsrtap Free Admin Template - SIMINTA | Admin Dashboad Template</title>
    <!-- Core CSS - Include with every page -->
    <link href="<?php echo base_url();?>admin/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>admin/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>admin/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="<?php echo base_url();?>admin/css/style.css" rel="stylesheet" />
      <link href="<?php echo base_url();?>admin/css/main-style.css" rel="stylesheet" />

</head>

<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
              <img src="<?php echo base_url();?>admin/img/logo.png" alt=""/>
                </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div>
                        <h5 style="color:red " align="center">
                           <?php 
                           $exc=$this->session->userdata('exception');
                           if(isset($exc)){
                               echo $exc;
                               $this->session->unset_userdata('exception');
                           }
                           ?> 
                        </h5>
                    </div>
                    <div>
                        <h5 style="color:green " align="center">
                           <?php 
                           $msg=$this->session->userdata('message');
                           if(isset($msg)){
                               echo $msg;
                               $this->session->unset_userdata('message');
                           }
                           ?> 
                        </h5>
                    </div>
                    <div class="panel-body">
               <form role="form" action="<?php echo base_url();?>administrator/admin_login_check" method="post">
                            <fieldset>
                                <div class="form-group">
                <input class="form-control" placeholder="E-mail" name="admin_email_address" type="email" autofocus>
                                </div>
                                <div class="form-group">
                  <input class="form-control" placeholder="Password" name="admin_password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Core Scripts - Include with every page -->
    <script src="<?php echo base_url();?>admin/plugins/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url();?>admin/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>admin/plugins/metisMenu/jquery.metisMenu.js"></script>

</body>

</html>
