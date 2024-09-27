<?php

require_once 'db.php';

if(isset($_GET['id'])) {
   $id = $_GET['id'];
   $select = "select * from `table_people` where `id`=".$id;
   $res = mysqli_query($con, $select);
 
   $data = mysqli_fetch_assoc($res);  
 }

 if (isset($_POST['submit'])) {
   $user_id = $_SESSION['user_id'];
   $table_number = $_POST['number'];
   $table_people = $_POST['people'];

   $cat_select = "select * from `table_people` where `table_number`='$table_number'";
   $cat_res = mysqli_query($con , $cat_select);
   $cat_rec = mysqli_num_rows($cat_res);

   if(isset($_GET['id'])) 
   {
     $update = "update `table_people` set `table_number`='$table_number' , `table_people`='$table_people' where `id`=".$id;
     mysqli_query($con, $update);
   }
   else {
     if($cat_rec==0) {
       $insert = "insert into `table_people`(`table_number`,`table_people)values('$table_number','$table_people')";
       mysqli_query($con ,$insert);
     }
     else
     {
       $error =" this table number already exits";
     }
   }
   header("location:add_table.php");
 }



include_once 'header.php';


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>table</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">table</li>
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
                     <h3 class="card-title">Add table</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="post"  id="frm">

                     <div class="card-body">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Table number</label>
                           <input type="number" name="number" value="<?php echo @$data['table_number']; ?>" class="form-control" id="table" placeholder="Enter table">
                           <h6>Enter your table number</h6>
                        </div>
                        <h5 style="color: red;"><?php echo @$error; ?></h5>
                        <div class="form-group">
                           <label for="exampleInputEmail1">Table people</label>
                           <input type="number" name="people " value="<?php echo @$data['table_people ']; ?>" class="form-control" id="table" placeholder="Enter people ">
                           <h6>Enter table people </h6>
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
      var table = $('#table').val();
      if (table == '') {
         $('#table').siblings('h6').css('display', 'inline');
         return false;
      }

   })
</script>
<?php
include_once 'footer.php';
?>