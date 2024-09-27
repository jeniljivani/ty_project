<?php
include 'db.php';


if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $select = "select * from `slider` where `id`=" . $id;
  $res = mysqli_query($con, $select);
  $data = mysqli_fetch_assoc($res);
}


if (isset($_POST['submit'])) {
  $user_id = $_SESSION['username'];
  $title = $_POST['title'];
  $image = $_FILES['image']['name'];

  if ($image == "") {
    $imagename = @$data['image'];
  } else {
    if ($image == "") {
      unlink("image/slider/" . @$data['image']);
    }
    $imagename = rand(1, 10000) . $image;
    $path = "image/slider/" . $imagename;
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
  }
  if (isset($_GET['id'])) {
    $update = "update `slider` set `title`='$title',`image`='$imagename' where `id`=" . $_GET['id'];
    mysqli_query($con, $update);
    header("location:view_slider.php");
  } else {
    $insert = "insert into `slider`(`title`,`image`)values('$title','$imagename')";
    mysqli_query($con, $insert);
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
          <h1>Slider</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Slider</li>
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
              <h3 class="card-title">Add Slider</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" enctype="multipart/form-data" id="frm">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">title</label>
                  <input type="text" name="title" value="<?php echo @$data['title'] ?>" class="form-control" id="title" placeholder="Enter title">
                  <h6>enter your title</h6>

                </div>

                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <input type="file" name="image" value="<?php echo @$data['image']; ?>" class="custom-file-input" id="img">
                    <h6>enter slider image</h6>
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <?php if (isset($_GET['id'])) { ?>
                    <img style="width: 100px" id="fimg" src="image/slider/<?php echo @$data['image']; ?>">
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
    var title = $('#title').val();
    if (title == '') {
      // alert("please enter name");
      $('#title').next('h6').css('display', 'inline');
      return false;
    }


    var image = $('#img').val();
    var im = $('#fimg').attr('src');
    if (im != "image/slider/") {
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