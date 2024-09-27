<?php
include 'db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $user_id = $_SESSION['user_id'];
  $select = "SELECT login.* , role.role from login join role on login.role_id=role.id where login.id='$id'";
  $res = mysqli_query($con, $select);
  $data = mysqli_fetch_assoc($res);
}
$role_select = "select * from `role`";
$role_res = mysqli_query($con, $role_select);


if (isset($_POST['submit'])) {
  $user_id = $_SESSION['user_id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $role_id = $_POST['role'];
  $image = $_FILES['image']['name'];

  if ($image == "") {
    $imagename = @$data['image'];
  } else {
    if ($image == "") {
      unlink("image/admin/" . @$data['image']);
    }
    $imagename = rand(1, 10000) . $image;
    $path = "image/admin/" . $imagename;
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
  }


  $select = "select * from `login` where `email`='$email'";
  $select_res = mysqli_query($con, $select);
  $sel = mysqli_fetch_assoc($select_res);
  $rec = mysqli_num_rows($select_res);

  if (isset($_GET['id'])) {
    if ($rec == 0) {
      $update = "update `login` set `name`='$name',`email`='$email',`image`='$imagename',`role_id`='$role_id' where `id`=" . $_GET['id'];
      mysqli_query($con, $update);
      // header("location:view_admin.php");
      if ($id == $user_id) {
        header("location:logout.php");
      }
    } else {
      if ($sel['id'] == $id) {
        $update = "update `login` set `name`='$name',`image`='$imagename',`role_id`='$role_id' where `id`=" . $_GET['id'];
        mysqli_query($con, $update);

        $admin_select = "select * from `login` where `id`='$user_id'";
        $admin_res = mysqli_query($con, $admin_select);
        $admin_data = mysqli_fetch_assoc($admin_res);
        $_SESSION['username'] = $admin_data;
        header("location:view_admin.php");
      } else {
        $error = "this email alrady exist...!";
      }
    }
  } else {
    if ($rec == 0) {
      $insert = "insert into `login`(`name`,`email`,`password`,`image`,`role_id`)values('$name','$email','$password','$imagename','$role_id')";
      mysqli_query($con, $insert);
    } else {
      $error = "this email alrady exist..!";
    }
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
          <h1>Admin</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Admin</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <style type="text/css">
    h6 {
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
              <h3 class="card-title">Add Admin</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" enctype="multipart/form-data" id="frm">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Admin name</label>
                  <input type="text" name="name" value="<?php echo @$data['name']; ?>" class="form-control" id="name" placeholder="Enter name">
                  <h6>enter your name</h6>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" value="<?php echo @$data['email']; ?>" class="form-control" id="email" placeholder="Enter email">
                  <h6>enter your email</h6>
                  <h5 style="color: red"><?php echo @$error; ?></h5>
                  <!-- <?php echo $sel['id']; ?> -->

                </div>
                <?php
                if (!isset($_GET['id'])) {
                ?>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" value="<?php echo @$data['password']; ?>" class="form-control" id="password" placeholder="Password">
                    <h6>enter your password</h6>
                  </div>
                <?php
                } else if ($id == $user_id) {
                ?>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Change password </label>
                    <a href="change_password.php" class="btn btn-primary">Change admin password</a>
                  </div>
                <?php
                }
                ?>
                <div class="form-group">
                  <label for="exampleInputcategori1">Role</label>
                  <select name="role" class="form-control" id="role">
                    <option selected disabled hidden value="">SELECT ROLE</option>
                    <?php
                    while ($role_data = mysqli_fetch_assoc($role_res)) {
                    ?>
                      <option value="<?php echo @$role_data['id']; ?>" <?php if (@$data['role'] == @$role_data['role']) { ?> selected <?php } ?>><?php echo @$role_data['role']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                  <h6>enter your role</h6>

                </div>
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <input type="file" name="image" value="<?php echo @$data['image']; ?>" class="custom-file-input" id="img">
                    <h6>enter your image</h6>
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <?php if(isset($_GET['id'])) { ?>
                  <img style="width: 100px" id="fimg" src="image/admin/<?php echo @$data['image']; ?>">
                  <?php } ?>
                </div>
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
  $('#frm').submit(function() {
    var name = $('#name').val();
    if (name == '') {
      // alert("please enter name");
      $('#name').next('h6').css('display', 'inline');
      return false;
    }
    var email = $('#email').val();
    var e_pat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
    if (e_pat.test(email) == false) {

      $('#email').next('h6').css('display', 'inline');
      return false;
    }
    var pass = $('#password').val();
    // var p_pat = /^[a-zA-Z0-9!@#\$%\^\&*_=+-]{8,12}/

    if (pass == '') {
      $('#password').next('h6').css('display', 'inline');
      return false;
    }
    var role = $('#role').val();

    if (role == null) {
      $('#role').siblings('h6').css('display', 'inline');
      return false;
    }

    var image = $('#img').val();
    var im = $('#fimg').attr('src');
    if (im != "image/admin/") {
      $('#img').val(im);
    }
    if (image == '') {
      $('#img').next('h6').css('display', 'inline');
      return false;
    }


  })
</script>


<?php
include 'footer.php';
?>