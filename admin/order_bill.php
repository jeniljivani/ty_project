<?php
require_once 'db.php';

if (isset($_GET['did'])) {
   $s_update = "UPDATE items_order SET status = 1, is_deleted = 1 WHERE id = " . $_GET['did'];
   mysqli_query($con, $s_update);
   header('location:order_bill.php');
}

if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $delete = "delete from `items_order` where `id`=" . $id;
   $res = mysqli_query($con, $delete);
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
   $sql_page = "select * from `items_order` where table_number like '%$search%' order by id desc , is_deleted desc  limit $start , $limit";
   $total_rec = "select * from `items_order` where table_number like '%$search%' ";
} else {
   $sql_page = "select * from `items_order` ORDER BY `items_order`.`is_deleted` ASC limit $start , $limit";
   $total_rec = "select * from `items_order`";
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
               <h1>Bill</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">bill</li>
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
                     <h3 class="card-title">View bill data</h3>
                  </div>

                  <div class=" ml-4 mt-2">
                     <form method="post">
                        <label>Search Table Number :-</label>
                        <input type="text" name="search" placeholder="search table number">
                        <input type="submit" name="submit" value="Search" class="btn btn-primary btn-sm">
                     </form>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <table id="example2" class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th>Id</th>
                              <th>Tbale Number</th>
                              <th>Amount</th>
                              <th>Count</th>
                              <th>Status</th>
                              <th>Delete</th>
                                
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           while ($data = mysqli_fetch_assoc($res_page)) {
                           ?>
                              <tr>
                                 <td><?php echo @$data['id']; ?></td>
                                 <td><?php echo @$data['table_number']; ?></td>
                                 <td><?php echo @$data['amount']; ?></td>
                                 <td><?php echo @$data['count']; ?></td>
                                 <?php
                                 if (@$data['status'] == 1) { ?>
                                    <td><a class="btn btn-success btn-sm" >Done</a></td>
                                 <?php
                                 } else {
                                    ?>
                                    <td><a class="btn btn-primary btn-sm" href="order_bill.php?did=<?php echo @$data['id']; ?>">Pending</a></td>
                                 <?php }
                                 ?>

                                 <td><a href="view_order.php?id=<?php echo @$data['id']; ?>">Delete</a> </td>
                              
                              </tr>
                           <?php
                           }
                           ?>
                        </tbody>
                     </table>
                     <div class="mt-3">
                        <label>Pages </label>
                        <a class="btn btn-primary btn-sm" href="order_bill.php?page=1">All</a>
                        <?php
                        if ($page > 1) {
                           echo "<a href='order_bill.php?page=" . $page - 1 . "' class='btn btn-primary btn-sm' >pre</a>";
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                        ?>
                           <a class="btn btn-primary btn-sm" href="order_bill.php?page=<?php echo $i;
                                                                                          if (isset($_GET['search'])) { ?> &search=<?php echo $_GET['search'];
                                                                                                                                          } ?>"><?php echo $i; ?></a>
                        <?php
                        }
                        if ($page <= $total_page - 1) {
                           echo "<a href='order_bill.php?page=" . $page + 1 . "' class='btn btn-primary btn-sm' >next</a>";
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