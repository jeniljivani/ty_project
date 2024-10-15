<?php
require_once 'db.php';

if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $delete = "select * from `items_order` where `id` =" . $id;
   $res = mysqli_query($con, $delete);
   $data = mysqli_fetch_assoc($res);
   $orderlist_arr = $data['item_list'];
   $orderlist_arr = explode(',', $orderlist_arr);
}



if (isset($_POST['submit'])) {
   $list = $_POST['orderlist'];
   $table_number = $_POST['table_number'];
   $orderlist = implode(',', $list);
   $amount = $_POST['amount'];
   $count = $_POST['count'];
   $discount = $_POST['discount'];

   if(isset($_GET['id'])) {
      $update = "UPDATE `items_order` SET `item_list`='$orderlist', `table_number`='$table_number', `amount`='$amount', `count`='$count' ,`discount`='$discount' WHERE `id`=" . $_GET['id'];
      mysqli_query($con, $update);
      header('location:view_order.php');
   }else {
      $insert = "INSERT INTO `items_order`(`item_list`,`table_number`, `amount`, `count` ,`discount`) VALUES ('$orderlist','$table_number', '$amount', '$count' , '$discount') ";
      mysqli_query($con, $insert);
      header('location:view_order.php');

   }

}

if (!isset($_GET['id'])) {
   $table_number_select = " SELECT tables.table_number as table_no, items_order.table_number FROM 
                           tables JOIN items_order 
                           ON tables.table_number = items_order.table_number
                           WHERE tables.table_number 
                           NOT IN ( SELECT table_number FROM items_order WHERE is_deleted = 0 ) 
                           GROUP BY tables.table_number ORDER BY tables.table_number ASC;";
} else {
   $table_number_select = " SELECT table_number as table_no FROM tables ";
}
$table_number_res = mysqli_query($con, $table_number_select);



$menu_list = "SELECT menu.* , category.category FROM menu JOIN category ON menu.cat_id = category.id ";
$menu_res = mysqli_query($con, $menu_list);
$drink_list = " SELECT menu.*, category.category FROM menu JOIN category ON menu.cat_id = category.id WHERE category.category = 'Drinks'";
$drink_res = mysqli_query($con, $drink_list);

include 'header.php';

?>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Order</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Order</li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>


   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <!-- left column -->
            <div class="col-md-6">
               <form method="post" id="frm" enctype="multipart/form-data">
                  <div class="card card-primary">
                     <div class="card-header">
                        <h3 class="card-title">Add Order</h3>
                     </div>
                     <!-- /.card-header -->
                     <!-- form start -->
                     <div class="card-body">
                        <div class="form-group">
                           <label for="table_number">Table</label>
                           <div class="select-wrap one-third">
                              <select name="table_number" class="form-control" id="table_number">
                                 <option value="">Select table</option>
                                 <?php
                                 // Fetch and display each table number as an option
                                 while ($table_number = mysqli_fetch_assoc($table_number_res)) { ?>
                                    <option value="<?= $table_number['table_no']; ?>" <?php if ($table_number['table_no'] == @$data['table_number']) { ?> selected <?php } ?>><?= $table_number['table_no']; ?></option>
                                 <?php } ?>
                              </select>
                              <h6 id="table-error"></h6>
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="exampleInputTitel1">Menu list :- </label>
                           <div style="height: 300px;" class="itme border overflow-auto col-md-12">
                              <?php while ($menu = mysqli_fetch_assoc($menu_res)) { ?>
                                 <div class="border-bottom my-2 d-flex align-items-center justify-content-between">
                                    <input type="checkbox" name="orderlist[]" <?php if (isset($_GET['id'])) {
                                                                                 if (in_array($menu['title'], @$orderlist_arr)) { ?> checked <?php }
                                                                                                                                                                     } ?> style="height: 15px; width: 15px;" class="ml-3" id="<?= $menu['id'] ?>" value="<?= $menu['title'] ?>">
                                    <label for="<?= $menu['id'] ?>"><?= $menu['title'] ?></label>
                                    <label class="text-muted mr-5" style="min-width: 50px;"><?= $menu['price'] ?></label>
                                 </div>
                              <?php } ?>
                              <h6 id="menu-error"></h6>
                           </div>
                        </div>
                        <div class="form-group">
                           <input type="hidden" name="amount" id="amount">
                           <input type="hidden" name="count" id="count">
                           <input type="hidden" name="discount" id="discount">
                        </div>
                     </div>
                     <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                     </div>
                  </div>
               </form>
            </div>
            <div class="col-md-6 " id="orderDeteles">
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Oder Deteles </h3>
                  </div>

                  <div class="card-body">
                     <div class="form-group">
                        <div class="d-flex justify-content-between mr-5">
                           <div>
                              <p id="selectedItems"></p>
                           </div>
                           <div>
                              <p id="totalCount"></p>
                              <p id="originalTotalAmount"></p>
                              <p id="discountPercentage"></p>
                              <p id="discountAmount"></p>
                              <p id="finalTotalAmount"></p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- /.card-body -->
                  <div class="card-footer">
                  </div>
               </div>
            </div>
         </div>
         <!-- /.row -->
      </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>


<?php
include 'footer.php';
?>

<script>
   $(document).ready(function() {
      document.getElementById('frm').addEventListener('submit', function(e) {
         let valid = true;

         // Clear previous error messages
         document.getElementById('table-error').textContent = '';
         document.getElementById('menu-error').textContent = '';

         // Validate Table Selection
         const tableSelect = document.getElementById('table_number');
         if (tableSelect.value === '') {
            valid = false;
            document.getElementById('table-error').textContent = 'Please select a table.';
            document.getElementById('table-error').style.color = 'red';
         }

         // Validate Menu Selection
         const menuItems = document.querySelectorAll('input[name="orderlist[]"]:checked');
         if (menuItems.length === 0) {
            valid = false;
            document.getElementById('menu-error').textContent = 'Please select at least one menu item.';
            document.getElementById('menu-error').style.color = 'red';
         }

         // Prevent form submission if invalid
         if (!valid) {
            e.preventDefault();
         }
      });

      $(document).ready(function() {
         makeAjaxCall(); // Call AJAX when checkbox is checked 
         $("input[type='checkbox']").on('change', function() {
            makeAjaxCall(); // Call AJAX when checkbox state changes
         });

      });

      function makeAjaxCall() {
         var selectedItems = [];
         var totalCount = 0;
         var totalAmount = 0;

         $("input[type='checkbox']:checked").each(function() {
            var title = $(this).val();
            var price = parseFloat($(this).closest('div').find('.text-muted').text());

            selectedItems.push({
               title: title,
               price: price
            });

            totalAmount += price;
            totalCount++;
         });

         if (totalCount > 0) {
            $.ajax({
               url: 'order.php',
               type: 'POST',
               data: {
                  items: selectedItems,
                  totalCount: totalCount,
                  totalAmount: totalAmount
               },
               success: function(response) {
                  var data = JSON.parse(response);
                  var titles = data.selectedItems.map(function(item) {
                     return item.title;
                  });

                  $('#selectedItems').html("<b>Menu list</b> :- <br>" + titles.join(',<br> '));

                  var totalAmount = parseFloat(data.totalAmount);
                  var discountPercentage = 0;

                  if (totalAmount >= 3000) {
                     discountPercentage = 15;
                  } else if (totalAmount >= 2000) {
                     discountPercentage = 12;
                  } else if (totalAmount >= 1500) {
                     discountPercentage = 8;
                  } else if (totalAmount >= 1000) {
                     discountPercentage = 5;
                  }

                  var discountAmount = (totalAmount * discountPercentage) / 100;
                  var finalAmount = totalAmount - discountAmount;

                  $('#totalCount').html('<b>Total Count</b> :- ' + data.totalCount);
                  $('#originalTotalAmount').html('<b>Original Total Amount</b> :- <br> <h4>' + totalAmount.toFixed(2) + '</h4>');
                  $('#discountPercentage').html('<b>Discount Applied</b> :- ' + discountPercentage + '%');
                  $('#discountAmount').html('<b>Discount Amount</b> :- ' + discountAmount.toFixed(2));
                  $('#finalTotalAmount').html('<b>Final Amount after Discount</b> :-<br> <h3 class="text-success"><b>' + finalAmount.toFixed(2) + '</b></h3>');

                  $('#amount').val(finalAmount.toFixed(2));
                  $('#count').val(data.totalCount);
                  $('#discount').val(discountAmount);
               },
               error: function(xhr, status, error) {
                  console.error("An error occurred: " + error);
               }
            });
         }
      }

   });
</script>