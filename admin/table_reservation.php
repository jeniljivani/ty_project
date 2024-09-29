<?php
include 'db.php';


if (isset($_GET['aid'])) {
    $s_update = "update reservations set status=0 where id=" . $_GET['aid'];
    mysqli_query($con, $s_update);
    header('location:table_reservation.php');
}
if (isset($_GET['did'])) {
    $s_update = "update reservations set status=1 where id=" . $_GET['did'];
    mysqli_query($con, $s_update);
    header('location:table_reservation.php');
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $detele = "delete from `reservations` where `id`=" . $id;
  $res = mysqli_query($con, $detele);
  
}

$limit = 10;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start = ($page - 1) * $limit;

if (isset($_POST['search'])) {
    $search = trim($_POST['search']);
    $sql_page = "SELECT *, DATE_FORMAT(reservation_date, '%d-%m-%Y') as formatted_date FROM `reservations` WHERE name LIKE '%$search%' ORDER BY id DESC, reservation_date DESC LIMIT $start, $limit";
    $total_rec = "select * from `reservations` where name like '%$search%' ";
} else {
    $sql_page = "SELECT *, DATE_FORMAT(reservation_date, '%d-%m-%Y') as formatted_date FROM `reservations` ORDER BY id DESC, reservation_date DESC LIMIT $start, $limit";
    $total_rec = "select * from `reservations`";
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
                    <h1>Reservation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Reservation</li>
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
                            <h3 class="card-title">View Reservation Data</h3>
                        </div>

                        <div class=" ml-4 mt-2">
                            <form method="post">
                                <label>Search name :-</label>
                                <input type="text" name="search" placeholder="search name">
                                <input type="submit" name="submit" value="Search" class="btn btn-primary btn-sm">
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Table No.</th>
                                        <th>Time</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($data = mysqli_fetch_assoc($res_page)) {
                                    ?>
                                        <tr>
                                            <td><?php echo @$data['id']; ?></td>
                                            <td><?php echo @$data['name']; ?></td>
                                            <td><?php echo @$data['email']; ?></td>
                                            <td><?php echo @$data['phone']; ?></td>
                                            <td><?php echo @$data['table_number']; ?></td>
                                            <td><?php echo @$data['reservation_time']; ?></td>
                                            <td><?php echo @$data['formatted_date']; ?></td>
                                            <td>
                                                <?php
                                                if (@$data['status'] == 1) {
                                                    echo "<a href=table_reservation.php?aid=" . @$data['id'] . " class='btn btn-outline-success btn-sm'>Approve</a>";
                                                } else {
                                                    echo "<a href=table_reservation.php?did=" . @$data['id'] . " class='btn btn-outline-danger btn-sm'>Disapprove</a>";
                                                }
                                                ?>
                                            </td>
                                            <td><a href="table_reservation.php?id=<?php echo @$data['id']; ?>">Remove</a> </td>                                        

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <label>Pages </label>
                                <a class="btn btn-primary btn-sm" href="view_slider.php?page=1">All</a>
                                <?php
                                if ($page > 1) {
                                    echo "<a href='view_slider.php?page=" . $page - 1 . "' class='btn btn-primary btn-sm' >pre</a>";
                                }
                                for ($i = 1; $i <= $total_page; $i++) {
                                ?>
                                    <a class="btn btn-primary btn-sm" href="view_slider.php?page=<?php echo $i;
                                                                                                    if (isset($_GET['search'])) { ?> &search=<?php echo $_GET['search'];
                                                                                                                        } ?>"><?php echo $i; ?></a>
                                <?php
                                }
                                if ($page <= $total_page - 1) {
                                    echo "<a href='view_slider.php?page=" . $page + 1 . "' class='btn btn-primary btn-sm' >next</a>";
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
include_once 'footer.php';
?>