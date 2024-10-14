<?php
require_once 'db.php';

$order_select = "select * from items_order";
$order_res = mysqli_query($con, $order_select);
$order_count = mysqli_num_rows($order_res);

$total_amount = "select sum(amount) as total from items_order";
$total_res = mysqli_query($con, $total_amount);
$total_data = mysqli_fetch_assoc($total_res);

$total_panding = "select status from items_order where status=0";
$total_panding_res = mysqli_query($con, $total_panding);
$total_panding_count = mysqli_num_rows($total_panding_res);

$total_reservation = "select status from reservations where status=1";
$total_reservation_res = mysqli_query($con, $total_reservation);
$total_reservation_count = mysqli_num_rows($total_reservation_res);

$total_review = "select * from review";
$total_review_res = mysqli_query($con, $total_review);
$total_review_count = mysqli_num_rows($total_review_res);
include_once 'header.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header)       -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row d-flex justify-content-center">
        <div class="col-lg-5 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $order_count ?></h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer py-3"> </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-5 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $total_panding_count ?></h3>

              <p>Pending Orders</p>
            </div>
            <div class="icon">
            <i class="fas fa-user-plus"></i> 
            </div>
            <a href="#" class="small-box-footer py-3"> </a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-5 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $total_data['total'] ?><span style="font-size: 30px" class="ml-2">₹</span></h3>

              <p>Total Amount</p>
            </div>
            <div class="icon">
            <i class="fas fa-chart-bar"></i> 
            </div>
            <a href="#" class="small-box-footer py-3"> </a>
          </div>
        </div>
        <!-- ./col -->
        
        
        <div class="col-lg-5 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $total_reservation_count ?></h3>

              <p>Total reservations</p>
            </div>
            <div class="icon">
            <i class="fas fa-chart-pie"></i> 
            </div>
            <a href="#" class="small-box-footer py-3"> </a>
          </div>
        </div>
         <!-- ./col -->
         <div class="col-lg-5 col-6">
          <!-- small box -->
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3><?= $total_review_count?><span style="font-size: 30px" class="ml-2"></span></h3>

              <p>Total Review</p>
            </div>
            <div class="icon">
            <i class="fas fa-chart-line"></i>
            </div>
            <a href="#" class="small-box-footer py-3"> </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once 'footer.php';
?>