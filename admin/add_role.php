<?php 
    include 'db.php';


    if(isset($_GET['id'])) {
      $id = $_GET['id'];
      $select = "select * from `role` where `id`=".$id;
      $res = mysqli_query($con, $select);
      $data = mysqli_fetch_assoc($res);  
    }

    if (isset($_POST['submit'])) {
      $user_id = $_SESSION['user_id'];
      $role = $_POST['role'];

      $cat_select = "select * from `role` where `role`='$role'";
      $cat_res = mysqli_query($con , $cat_select);
      $cat_rec = mysqli_num_rows($cat_res);

      if(isset($_GET['id'])) 
      {
        $update = "update `role` set `role`='$role' where `id`=".$id;
        mysqli_query($con, $update);
      }
      else {
        if($cat_rec==0) {
          $insert = "insert into `role`(`role`)values('$role')";
          mysqli_query($con ,$insert);
        }
        else
        {
          $error =" this role already exits";
        }
      }
      header("location:view_role.php");
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
            <h1>role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">role</li>
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
                <h3 class="card-title">Add role</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data" id="frm">
                
                  <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">role name</label>
                    <input type="text" name="role"  value="<?php echo @$data['role']; ?>" class="form-control" id="role" placeholder="Enter role">
                    <h6>enter your role</h6>                    
                  </div>
                  <h5 style="color: red;"><?php echo @$error; ?></h5>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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
      var role = $('#role').val();
      if(role == '') {
        $('#role').siblings('h6').css('display','inline');
        return false;
      }    

    })

</script>
<?php 
  include 'footer.php';
?>