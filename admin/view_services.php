<?php

include 'db.php';


$user_id = $_SESSION['user_id'];
$user_select = "SELECT login.* , role.role from login join role on login.role_id=role.id WHERE login.id ='$user_id'";
$user_res = mysqli_query($con, $user_select);
$user_data = mysqli_fetch_assoc($user_res);


if (isset($_GET['aid'])) {
  $s_update = "update offer set status=0 where id=" . $_GET['aid'];
  mysqli_query($con, $s_update);
  header('location:view_services.php');
}
if (isset($_GET['did'])) {
  $s_update = "update offer set status=1 where id=" . $_GET['did'];
  mysqli_query($con, $s_update);
  header('location:view_services.php');
}



if (isset($_GET['id'])) {

  $id = $_GET['id'];
  $select = "select * from `offer` where `id`=" . $id;
  $res = mysqli_query($con, $select);
  $data = mysqli_fetch_assoc($res);
  $img_file = @$data['image'];

  unlink("image/services/" . $img_file);

  $delete = "delete from `offer` where `id`=" . $id;
  $res = mysqli_query($con, $delete);
}

$limit = 10;

if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
$start = ($page - 1) * $limit;

if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $sql_page = "select * from `offer` where titel like '%$search%'  limit $start , $limit";
  $total_rec = "select * from `offer` where titel like '%$search%' ";
} else {
  $sql_page = "select * from `offer` limit $start , $limit";
  $total_rec = "select * from `offer`";
}

$res = mysqli_query($con, $total_rec);
$total_row = mysqli_num_rows($res);
$total_page = ceil($total_row / $limit);
$res_page = mysqli_query($con, $sql_page);

include 'header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>WHAT WE OFFER</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">WHAT WE OFFER</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">View offer data</h3>
            </div>

            <div class=" ml-4 mt-2">
              <form method="get">
                <label>Search titel :-</label>
                <input type="text" name="search" placeholder="search titel">
                <input type="submit" name="submit" value="Search" class="btn btn-primary btn-sm">
              </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Icon</th>
                    <th>Titel</th>
                    <th>Description</th>
                    <!-- <th>Image</th> -->
                    <th>Status</th>
                    <?php if ($user_data['role'] == 'admin') { ?>
                    <th>Delete</th>
                    <th>Update</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($data = mysqli_fetch_assoc($res_page)) {
                  ?>
                    <tr>
                      <td><?php echo @$data['id']; ?></td>
                      <td><img style="background-color: lightgrey; padding:10px;" width="100px" src="image/services/<?php echo @$data['icon']; ?>" alt=""></td>
                      <td><?php echo @$data['title']; ?></td>
                      <td><?php echo @$data['description']; ?></td>
                      <!-- <td><img src="image/slider/<?php echo @$data['image']; ?>" width="100px"height="50px"> </td> -->
                      <td>
                        <?php
                        if (@$data['status'] == 1) {
                          echo "<a href=view_services.php.?aid=" . @$data['id'] . " class='btn btn-outline-success btn-sm'>Active</a>";
                        } else {
                          echo "<a href=view_services.php.?did=" . @$data['id'] . " class='btn btn-outline-danger btn-sm'>Deactive</a>";
                        }
                        ?>
                      </td>
                      <?php if ($user_data['role'] == 'admin') { ?>
                      <td><a href="view_services.php?id=<?php echo @$data['id']; ?>">Delete</a> </td>
                      <td><a href="add_services.php?id=<?php echo @$data['id']; ?>">Update</a> </td>
                      <?php } ?>


                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
              <div class="mt-3">
                <label>Pages </label>
                <a class="btn btn-primary btn-sm" href="view_services.php?page=1">All</a>
                <?php
                if ($page > 1) {
                  echo "<a href='view_services.php?page=" . $page - 1 . "' class='btn btn-primary btn-sm' >pre</a>";
                }
                for ($i = 1; $i <= $total_page; $i++) {
                ?>
                  <a class="btn btn-primary btn-sm" href="view_services.php?page=<?php echo $i;
                                                                                  if (isset($_GET['search'])) { ?> &search=<?php echo $_GET['search'];
                                                                                                                                      } ?>"><?php echo $i; ?></a>
                <?php
                }
                if ($page <= $total_page - 1) {
                  echo "<a href='view_services.php?page=" . $page + 1 . "' class='btn btn-primary btn-sm' >next</a>";
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

<?php
include 'footer.php';
?>