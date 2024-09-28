<?php
include 'db.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = "select * from `menu` where `id`=" . $id;
    $res = mysqli_query($con, $select);
    $data = mysqli_fetch_assoc($res);
}

$cat_select = "select * from category";
$cat_res = mysqli_query($con, $cat_select);


if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $titel = $_POST['titel'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $cat_id = $_POST['cat_id'];
    $image = $_FILES['image']['name'];

    if ($image == "") {
        $imagename = @$data['image'];
    } else {
        if ($image == "") {
            unlink("image/menu/" . @$data['image']);
        }
        $imagename = rand(1, 10000) . $image;
        $path = "image/menu/" . $imagename;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
    }
    if (isset($_GET['id'])) {
        $update = "update `menu` set `titel`='$titel',`description`='$description',`image`='$imagename' , `price`='$price' , `cat_id`='$cat_id' where `id`=" . $_GET['id'];
        mysqli_query($con, $update);
        header("location:view_menu.php");
    } else {
        $insert = "insert into `menu`(`title`,`description`,`image`,`price`,`cat_id`)values('$titel','$description','$imagename','$price','$cat_id')";
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
                    <h1>menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">menu</li>
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
                            <h3 class="card-title">Add menu</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" enctype="multipart/form-data" id="frm">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titel</label>
                                    <input type="text" name="titel" value="<?php echo @$data['titel'] ?>" class="form-control" id="title" placeholder="Enter titel">
                                    <h6>enter your title</h6>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <input type="text" name="description" value="<?php echo @$data['description'] ?>" class="form-control" id="description" placeholder="Description">
                                    <h6>enter your description</h6>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">price</label>
                                    <input type="number" name="price" value="<?php echo @$data['price'] ?>" class="form-control" id="price" placeholder="price">
                                    <h6>enter your price</h6>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputcategori1">category</label>
                                    <select name="cat_id" class="form-control" id="category">
                                        <option selected disabled hidden value="">SELECT category</option>
                                        <?php
                                        while ($role_data = mysqli_fetch_assoc($cat_res)) {
                                        ?>
                                            <option value="<?php echo @$role_data['id']; ?>"><?php echo @$role_data['category']; ?></option>
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
                                        <h6>enter menu image</h6>
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <?php if(isset($_GET['id'])) { ?>
                                    <img style="width: 100px" id="fimg" src="image/menu/<?php echo @$data['image']; ?>">
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


<script type="text/javascript" src="jquery-3.7.1.min.js"></script>

<script>
    $('#frm').submit(function() {
        var title = $('#title').val();
        if (title == '') {
            // alert("please enter name");
            $('#title').next('h6').css('display', 'inline');
            return false;
        }
        var description = $('#description').val();
        
        if (description == '') {
            $('#description').next('h6').css('display', 'inline');
            return false;
        }
        var price = $('#price').val();
        
        if (price == '') {
            $('#price').next('h6').css('display', 'inline');
            return false;
        }
        var image = $('#img').val();
        var im = $('#fimg').attr('src');
        if (im != "image/menu/") {
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