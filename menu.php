<?php


require_once 'admin/db.php';

$date = date('Y-m-d');

$table_number_select = "SELECT table_number FROM tables WHERE table_number NOT IN 
        (SELECT table_number FROM reservations WHERE reservation_date = '$date' )";
$table_number_res = mysqli_query($con, $table_number_select);

$manu_select = "select * from menu ";
$menu_res = mysqli_query($con, $manu_select);


include_once 'header.php';
?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
   <div class="overlay"></div>
   <div class="container">
      <div class="row no-gutters slider-text align-items-end justify-content-center">
         <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">Our Specialties</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Menu <i class="ion-ios-arrow-forward"></i></span></p>
         </div>
      </div>
   </div>
</section>

<section class="ftco-section">
   <div class="container-fluid px-4">
      <div class="row justify-content-center mb-5 pb-2">
         <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">Specialties</span>
            <h2 class="mb-4">Our Menu</h2>
         </div>
      </div>
      <div class="row">
         <?php
         while ($menu = mysqli_fetch_assoc($menu_res)) {
         ?>
            <div class="col-md-6 col-lg-4 menu-wrap">
               <div class="menus d-flex ftco-animate">
                  <div class="menu-img img" style="background-image: url(admin/image/menu/<?= $menu['image'] ?>);"></div>
                  <div class="text">
                     <div class="d-flex">
                        <div class="one-half">
                           <h3><?= $menu['title'] ?></h3>
                        </div>
                        <div class="one-forth">
                           <span class="price">$<?= $menu['price'] ?></span>
                        </div>
                     </div>
                     <p><?= $menu['description'] ?></p>
                  </div>
               </div>
            </div>
         <?php } ?>
 
      </div>
   </div>
</section>
<section class="ftco-section ftco-no-pt ftco-no-pb">
	<div class="container-fluid px-0">
		<div class="row d-flex  no-gutters">
			<div class="container ftco-animate makereservation p-4 p-md-5 pt-5 pt-md-0">
				<div class="heading-section ftco-animate mb-5 d-flex   justify-content-center">

					<h2 class="mb-4">Make Reservation</h2>
				</div>
				<form method="post" id="review-form" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" id="name" class="form-control " placeholder="Your Name">
								<span id="name-error" style="display: none; color: red">Enter valid name</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" id="email" class="form-control" placeholder="Your Email">
								<span id="email-error" style="display: none; color: red">Enter valid email</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="phone">Phone</label>
								<input type="text" name="phone" class="form-control" placeholder="Your Phone" id="phone">
								<span id="phone-error" style="display: none; color: red">Enter valid phone number</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="table_number">Table</label>
								<div class="select-wrap one-third">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select name="table" class="form-control" id="table_number">
										<option value="">Select table</option>
										<?php
										  while ($table_number = mysqli_fetch_assoc($table_number_res)) {
										     echo '<option value="' . $table_number['table_number'] . '">' . $table_number['table_number'] . '</option>';
										  }
										?>
									</select>

								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="time">Time</label>
								<input type="time" name="time" class="form-control" id="time">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="date">Date</label>
								<input type="date" name="date" class="form-control" id="date">
							</div>
						</div>

						<div class="col-md-12 mt-3 d-flex justify-content-center">
							<div class="form-group">
								<input type="submit" name="submit" value="Make a Reservation" class="btn btn-primary py-3 px-5">
							</div>
						</div>
					</div>
				</form>

			</div>

		</div>
	</div>
</section>

<?php
include_once 'footer.php';
?>
<script>
	$(document).ready(function() {
		document.getElementById('date').addEventListener('focus', function() {
			this.showPicker(); // Opens the date picker when the field is focused (clicked)
		});
		document.getElementById('time').addEventListener('focus', function() {
			this.showPicker(); // Opens the time picker when the field is clicked or focused
		});
		document.getElementById('phone').addEventListener('input', function(e) {
			// Allow only numbers and an optional leading '+'
			this.value = this.value.replace(/[^0-9+]/g, '');
		});
		window.onload = function() {
			const now = new Date();
			const hours = String(now.getHours()).padStart(2, '0');
			const minutes = String(now.getMinutes()).padStart(2, '0');
			const currentTime = `${hours}:${minutes}`;
			document.getElementById('time').value = currentTime;


			const today = new Date();
			const year = today.getFullYear();
			const month = String(today.getMonth() + 1).padStart(2, '0');
			const day = String(today.getDate()).padStart(2, '0');
			const currentDate = `${year}-${month}-${day}`;

			const dateInput = document.getElementById('date');
			dateInput.setAttribute('min', currentDate);
			dateInput.setAttribute('value', currentDate); // Set default value to today's date

		};
		$("#date").change(function() {
			var date = $("#date").val();
			var time = $("#time").val();

			if (date != "") {
				$.ajax({
					url: 'get_tables.php',
					type: 'POST',
					data: {
						date: date,
						time: time
					},
					success: function(response) {
						console.log(response);

						$("#table_number").html(response); // Update the table options
					}
				});
			}
		});

		$('#review-form').submit(function(e) {
			e.preventDefault();

			var name = $('#name').val().trim();
			var email = $('#email').val().trim();
			var phone = $('#phone').val().trim();
			var flag = true;

			// Basic email pattern validation
			var emailPattern = /^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com)$/;
			var phonePattern = /^\+?[0-9]+$/;


			if (name === '') {
				$('#name-error').css('display', 'inline').html('Name is required.');
				flag = false;
			} else {
				$('#name-error').css('display', 'none').html('');
			}

			if (email === '') {
				$('#email-error').css('display', 'inline').html('Email is required.');
				flag = false;
			} else if (!emailPattern.test(email)) {
				$('#email-error').css('display', 'inline').html('Please enter a valid email address (gmail.com or yahoo.com).');
				flag = false;
			} else {
				$('#email-error').css('display', 'none').html('');
			}


			if (phone === '') {
				$('#phone-error').css('display', 'inline').html('Phone number is required.');
				flag = false;
			} else if (!phonePattern.test(phone)) {
				$('#phone-error').css('display', 'inline').html('Phone number can only contain numbers and an optional leading +.');
				flag = false;
			} else {
				$('#phone-error').css('display', 'none').html('');
			}

			if (!flag) {
				return false;
			} else {
				var formdata = new FormData(this);

				$.ajax({
					type: 'POST',
					url: 'reservation_table.php',
					data: formdata,
					dataType: 'json',
					processData: false,
					contentType: false,
					success: function(response) {
						if (response.status === true) {
							toastr.success(response.message);
							// Optionally, you can clear the form or perform other actions here
							$('#review-form')[0].reset();
						} else {
							toastr.error(response.message);
						}
					},
					error: function(xhr, status, error) {
						toastr.error('An error occurred: ' + error);
					}
				});
			}
		});

	});
</script>
