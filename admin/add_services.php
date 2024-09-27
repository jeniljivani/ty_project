<?php
include 'db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $select = "SELECT * FROM `offer` WHERE `id`=" . $id;
  $res = mysqli_query($con, $select);
  $data = mysqli_fetch_assoc($res);
}

if (isset($_POST['submit'])) {
  $user_id = $_SESSION['username']['id'];
  $image = $_FILES['image']['name'];
  $titel = $_POST['titel'];
  $description = $_POST['description'];

  if (empty($image)) {
    $imagename = @$data['icon'];
  } else {
    if (!empty(@$data['image'])) {
      unlink("image/services/" . @$data['icon']);
    }
    $imagename = rand(1, 10000) . $image;
    $path = "image/services/" . $imagename;
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
  }

  if (isset($_GET['id'])) {
    $update = "UPDATE `offer` SET `icon`='$imagename', `title`='$titel', `description`='$description' WHERE `id`=" . $_GET['id'];
    mysqli_query($con, $update);
    header("Location: view_services.php");
    exit();
  } else {
    $insert = "INSERT INTO `offer`(`user_id`, `icon`, `title`, `description`) VALUES ('$user_id', '$imagename', '$titel', '$description')";
    mysqli_query($con, $insert);
    header("Location: view_services.php");
    exit();
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
          <h1>SERVICES</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">services</li>
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
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add services</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" id="frm" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <input type="file" name="image" class="custom-file-input" id="img">
                    <h6>enter services icon image</h6>
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <?php if (isset($_GET['id'])) { ?>
                    <img style="width: 100px" id="fimg" src="image/services/<?php echo @$data['icon']; ?>">
                  <?php } ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputTitel1">Titel</label>
                  <input type="text" name="titel" value="<?php echo @$data['title']; ?>" class="form-control" id="title" placeholder="Enter titel">
                  <h6>enter your title</h6>
                </div>
                <div class="form-group">
                  <label for="exampleInputDescription1">Description</label>
                  <textarea name="description" class="form-control" id="description" placeholder="Description"><?php echo @$data['description']; ?></textarea>
                  <h6>enter your description</h6>
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
    var image = $('#img').val();
    var im = $('#fimg').attr('src');
    if (im !== undefined && image === '') {
      $('#img').val(im);
    }
    if (image === '') {
      $('#img').next('h6').css('display', 'inline');
      return false;
    }
    var title = $('#title').val();
    if (title === '') {
      $('#title').next('h6').css('display', 'inline');
      return false;
    }
    var description = $('#description').val();
    if (description === '') {
      $('#description').next('h6').css('display', 'inline');
      return false;
    }
  });
</script>
<?php
include 'footer.php';
?>