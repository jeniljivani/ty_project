<?php
include 'db.php';

$limit = 10;

if (isset($_GET['page'])) {
   $page = $_GET['page'];
} else {
   $page = 1;
}
$start = ($page - 1) * $limit;

if (isset($_GET['search'])) {
   $search = $_GET['search'];
   $sql_page = "select * from `about` where title like '%$search%'  limit $start , $limit";
   $total_rec = "select * from `about` where title like '%$search%' ";
} else {
   $sql_page = "select * from `about` limit $start , $limit";
   $total_rec = "select * from `about`";
}

$res = mysqli_query($con, $total_rec);
$total_row = mysqli_num_rows($res);
$total_page = ceil($total_row / $limit);
$res_page = mysqli_query($con, $sql_page);

if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $select = "select * from `about` where `id`=" . $id;
   $res = mysqli_query($con, $select);
   $data = mysqli_fetch_assoc($res);
}

if (isset($_POST['submit'])) {
   $user_id = $_SESSION['user_id'];
   $title = $_POST['title'];
   $description = $_POST['description'];

   if (isset($_GET['id'])) {
      $update = "update about set title='$title' , description='$description' where id=" . $id;
      mysqli_query($con, $update);
      header("location:add_about.php");
   } else {
      $insert = "insert into about(title, description)values('$title' , '$description')";
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
               <h1>About</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">about</li>
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
                     <h3 class="card-title">Add about</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="post" enctype="multipart/form-data" id="frm">

                     <div class="card-body">
                        <div class="form-group">
                           <label for="exampleInputEmail1">About title</label>
                           <input type="text" name="title" value="<?php echo @$data['title']; ?>" class="form-control" id="about" placeholder="Enter title">
                           <h6>enter your about</h6>
                        </div>
                        <h5 style="color: red;"><?php echo @$error; ?></h5>

                        <div class="form-group">
                           <label for="exampleInputEmail1">Description</label>
                           <textarea name="description" class="form-control" id="description" placeholder="Enter description"><?php echo @$data['description']; ?></textarea>
                           <h6>Enter about description</h6>
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

   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">View about data</h3>
                  </div>

                  <div class=" ml-4 mt-2">
                     <form method="get">
                        <label>Search title :-</label>
                        <input type="text" name="search" placeholder="search title">
                        <input type="submit" name="submit" value="Search" class="btn btn-primary btn-sm">
                     </form>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <table id="example2" class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th>Id</th>
                              <th>title</th>
                              <th>Description</th>
                              <th>Update</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           while ($data = mysqli_fetch_assoc($res_page)) {
                           ?>
                              <tr>
                                 <td><?php echo @$data['id']; ?></td>
                                 <td><?php echo @$data['title']; ?></td>
                                 <td><?php echo @$data['description']; ?></td>
                                 <td><a href="add_about.php?id=<?php echo @$data['id']; ?>"">Update</a> </td>


                              </tr>
                           <?php
                           }
                           ?>
                        </tbody>
                     </table>
                     <div class="mt-3">
                        <label>Pages </label>
                        <a class="btn btn-primary btn-sm" href="add_about.php?page=1">All</a>
                        <?php
                        if ($page > 1) {
                           echo "<a href='add_about.php?page=" . $page - 1 . "' class='btn btn-primary btn-sm' >pre</a>";
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                        ?>
                           <a class="btn btn-primary btn-sm" href="add_about.php?page=<?php echo $i;
                                                                                       if (isset($_GET['search'])) { ?> &search=<?php echo $_GET['search'];
                                                                                                                                          } ?>"><?php echo $i; ?></a>
                        <?php
                        }
                        if ($page <= $total_page - 1) {
                           echo "<a href='add_about.php?page=" . $page + 1 . "' class='btn btn-primary btn-sm' >next</a>";
                        }
                        ?>
                     </div>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->

               <!-- /.card -->
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script type="text/javascript" src="jquery-3.7.1.min.js"></script>

<script>
   $('#frm').submit(function() {
      var about = $('#about').val();
      if (about == '') {
         $('#about').siblings('h6').css('display', 'inline');
         return false;
      }
      var description = $('#description').val();
      if (description == '') {
         $('#description').siblings('h6').css('display', 'inline');
         return false;
      }


   })
</script>
<?php
include 'footer.php';
?>