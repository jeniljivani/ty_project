<?php

include 'db.php';


if (isset($_GET['id'])) {

  $id = $_GET['id'];
  $delete = "delete from `category` where `id`=" . $id;
  $res = mysqli_query($con, $delete);
}

$limit = 6;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
$start = ($page - 1) * $limit;

if (isset($_POST['search'])) {
  $search = trim($_POST['search']);
  $sql_page = "select * from `category` where category like '%$search%'  limit $start , $limit";
  $total_rec = "select * from `category` where category like '%$search%' ";
} else {
  $sql_page = "select * from `category` limit $start , $limit";
  $total_rec = "select * from `category`";
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
          <h1>category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">category</li>
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
              <h3 class="card-title">View admin data</h3>
            </div>
            <!-- search -->
            <div class=" ml-4 mt-2">
              <form method="post" id="srch">
                <label>Search category :-</label>
                <input type="text" id="srchbox" name="search" placeholder="search name">
                <input type="submit" name="submit" value="Search" class="btn btn-primary btn-sm">
              </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Delete</th>
                    <th>Update</th>
                  </tr>
                </thead>
                <tbody id="and">
                  <?php
                  while ($data = mysqli_fetch_assoc($res_page)) {
                  ?>
                    <tr>
                      <td><?php echo @$data['id']; ?></td>
                      <td><?php echo @$data['category']; ?></td>
                      <td><a href="view_categories.php?id=<?php echo @$data['id']; ?>">Delete</a> </td>
                      <td><a href="add_categories.php?id=<?php echo @$data['id']; ?>">Update</a> </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
              <!-- btn  -->
              <div class="mt-3">
                <a class="btn btn-primary btn-sm" href="view_categories.php">All</a>
                <?php
                if ($page > 1) {
                  echo "<a href='view_categories.php?page=" . $page - 1 . "' class='btn btn-primary btn-sm' >pre</a>";
                }
                for ($i = 1; $i <= $total_page; $i++) {
                ?>
                  <a class="btn btn-primary btn-sm" href="view_categories.php?page=<?php echo $i;
                                                                                    if (isset($_GET['search'])) { ?> &search=<?php echo $_GET['search'];
                                                                                                                            } ?>"><?php echo $i; ?></a>
                <?php
                }
                if ($page <= $total_page - 1) {
                  echo "<a href='view_categories.php?page=" . $page + 1 . "' class='btn btn-primary btn-sm' >next</a>";
                }
                ?>
              </div>
              <!-- / btn -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-body-->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="jquery-3.7.1.min.js"></script>

<?php
include 'footer.php';
?>