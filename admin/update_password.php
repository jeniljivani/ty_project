<?php 

  include 'db.php';

  if(isset($_POST['submit'])) {
    // print_r($_POST);
    $newpass = $_POST['newpass'];
    $conpass = $_POST['conpass'];
    $user_id = $_SESSION['user_id'];

    if($newpass==$conpass) {
      $newcon = md5($conpass);
      $update = "update `login` set `password`='$newcon' where `id`=".$user_id;
      mysqli_query($con , $update);
      header("location:view_admin.php");
    }
    else {
      $msg = "password is not mech";
    }
    

  }


  include 'header.php';
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">change password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<style type="text/css">    
    h6
    {
      color: red;
      display: none;
    }  
</style>    
<!-- Main content -->
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">update password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data" id="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">New password</label>
                    <input type="password" name="newpass"  value="<?php echo @$newpass; ?>" class="form-control" id="newpass" placeholder="Enter new password">
                    <h6>Enter new password</h6>
                  </div>                 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Confirm new password</label>
                    <input type="password" name="conpass"  value="<?php echo @$conpass; ?>" class="form-control" id="conpass" placeholder="Enter confirm new password">
                    <h6>Enter confrim password</h6>
                  </div>                 
                <h5 style="color: red;"><?php echo @$msg; ?></h5>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit"  class="btn btn-primary">Submit</button>
                </div>
              </form>
              <!-- <h5 style="color: green;"><?php @$set; ?></h5> -->

            </div>            
          </div>      
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript" src="../../jquery-3.7.1.min.js"></script>

<script>
    
    $('#frm').submit(function(){      
      var newpass = $('#newpass').val();
      // var p_pat = /^[a-zA-Z0-9!@#\$%\^\&*_=+-]{8,12}/

      if(newpass == '') {
        $('#newpass').next('h6').css('display','inline');
        return false;
      }
      var conpass = $('#conpass').val();
      // var p_pat = /^[a-zA-Z0-9!@#\$%\^\&*_=+-]{8,12}/

      if(conpass == '') {
        $('#conpass').next('h6').css('display','inline');
        return false;
      }    

    })

</script>


<?php 
  include 'footer.php';
?>
