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

  // Check if image is provided
  if (empty($image)) {
    $imagename = isset($data['image']) ? $data['image'] : 'default.png'; // Ensure $data is defined earlier or handle the default image
  } else {
    // Delete the old image if a new one is uploaded
    if (!empty($data['image'])) {
      unlink("image/admin/" . $data['image']);
    }
    // Generate new image name and upload it
    $imagename = rand(1, 10000) . $image;
    $path = "image/admin/" . $imagename;
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
  }

  // Check if email already exists
  $select = "SELECT * FROM `login` WHERE `email`='$email'";
  $select_res = mysqli_query($con, $select);
  $sel = mysqli_fetch_assoc($select_res);
  $rec = mysqli_num_rows($select_res);

  if (isset($_GET['id'])) {
    $id = $_GET['id']; // Ensure $id is defined properly

    if ($rec == 0 || $sel['id'] == $id) {
      // Update user details
      $update = "UPDATE `login` SET `name`='$name', `email`='$email', `image`='$imagename', `role_id`='$role_id' WHERE `id`='$id'";
      mysqli_query($con, $update);

      // If the logged-in user updated their own details, log them out to reflect changes
      if ($id == $user_id) {
        header("location:logout.php");
        exit(); // Always exit after header to prevent further execution
      } else {
        // Update session if the user is updating their own details
        $admin_select = "SELECT * FROM `login` WHERE `id`='$user_id'";
        $admin_res = mysqli_query($con, $admin_select);
        $admin_data = mysqli_fetch_assoc($admin_res);
        $_SESSION['username'] = $admin_data;
        header("location:view_admin.php");
        exit();
      }
    } else {
      $error = "This email already exists!";
    }
  } else {
    // Insert new user if no ID is provided
    if ($rec == 0) {
      $insert = "INSERT INTO `login`(`name`, `email`, `password`, `image`, `role_id`) VALUES ('$name', '$email', '$password', '$imagename', '$role_id')";
      mysqli_query($con, $insert);
      header("location:view_admin.php");
      exit();
    } else {
      $error = "This email already exists!";
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
                  <label for="name">Admin name</label>
                  <input type="text" name="name" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" class="form-control" id="name" placeholder="Enter name">
                  <h6>Enter your name</h6>
                </div>

                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" name="email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" class="form-control" id="email" placeholder="Enter email">
                  <h6>Enter your email</h6>
                  <?php if (isset($error)) { ?>
                    <h5 style="color: red"><?php echo $error; ?></h5>
                  <?php } ?>
                </div>

                <?php
                if (!isset($_GET['id'])) {
                ?>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>" class="form-control" id="password" placeholder="Password">
                    <h6>Enter your password</h6>
                  </div>
                <?php
                } else if ($_GET['id'] == $user_id) {
                ?>
                  <div class="form-group">
                    <label for="change_password">Change password </label>
                    <a href="change_password.php" class="btn btn-primary">Change your password</a>
                  </div>
                <?php
                }
                ?>

                <div class="form-group">
                  <label for="role">Role</label>
                  <select name="role" class="form-control" id="role">
                    <option selected disabled hidden value="">SELECT ROLE</option>
                    <?php
                    while ($role_data = mysqli_fetch_assoc($role_res)) {
                    ?>
                      <option value="<?php echo $role_data['id']; ?>" <?php echo (isset($data['role']) && $data['role'] == $role_data['role']) ? 'selected' : ''; ?>>
                        <?php echo $role_data['role']; ?>
                      </option>
                    <?php
                    }
                    ?>
                  </select>
                  <h6>Select your role</h6>
                </div>

                <div class="form-group">
                  <label for="img">File input</label>
                  <div class="input-group">
                    <input type="file" name="image" class="custom-file-input" id="img">
                    <label class="custom-file-label" for="img">Choose file</label>
                  </div>
                  <h6 id="img-error">Upload your image</h6>
                  <?php if (isset($_GET['id']) && isset($data['image'])) { ?>
                    <img style="width: 100px" id="fimg" src="image/admin/<?php echo $data['image']; ?>" alt="Admin Image">
                  <?php } ?>
                </div>
              </div>

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
<script type="text/javascript" src="jquery-3.7.1.min.js"></script>

<?php
include 'footer.php';
?>
<script>
  $(document).ready(function() {
    $('#frm').submit(function(e) {
      var isValid = true;

      // Validate Name
      var name = $('#name').val();
      if (name == '') {
        $('#name').next('h6').css('display', 'inline').text("Please enter your name");
        isValid = false;
      } else {
        $('#name').next('h6').css('display', 'none');
      }

      // Validate Email
      var email = $('#email').val();
      var e_pat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      if (!e_pat.test(email)) {
        $('#email').next('h6').css('display', 'inline').text("Please enter a valid email address");
        isValid = false;
      } else {
        $('#email').next('h6').css('display', 'none');
      }

      // Validate Password (Only if password field is present)
      var pass = $('#password').val();
      if ($('#password').length && pass == '') {
        $('#password').next('h6').css('display', 'inline').text("Please enter your password");
        isValid = false;
      } else {
        $('#password').next('h6').css('display', 'none');
      }

      // Validate Role
      var role = $('#role').val();
      if (role == null) {
        $('#role').siblings('h6').css('display', 'inline').text("Please select your role");
        isValid = false;
      } else {
        $('#role').siblings('h6').css('display', 'none');
      }

      // Validate File Input
      var image = $('#img').val();
      var im = $('#fimg').attr('src'); // Get current image if any
      if (!image && !im) { // No file selected and no existing image
        $('#img-error').css('display', 'inline').html("Please upload your image");
        isValid = false;
      } else {
        $('#img-error').css('display', 'none');
      }

      // Prevent form submission if any validation failed
      if (!isValid) {
        e.preventDefault();
      }
    });
  });
</script>