<?php
include_once 'header.php';
?>


<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-end justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<h1 class="mb-2 bread">Contact Us</h1>
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section contact-section bg-light">
	<div class="container">
		<div class="row d-flex contact-info">
			<div class="col-md-12 mb-4">
				<h2 class="h4 font-weight-bold">Contact Information</h2>
			</div>
			<div class="w-100"></div>
			<div class="col-md-3 d-flex">
				<div class="dbox">
					<p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
				</div>
			</div>
			<div class="col-md-3 d-flex">
				<div class="dbox">
					<p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
				</div>
			</div>
			<div class="col-md-3 d-flex">
				<div class="dbox">
					<p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
				</div>
			</div>
			<div class="col-md-3 d-flex">
				<div class="dbox">
					<p><span>Website</span> <a href="#">yoursite.com</a></p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb">
   <div class="container-fluid px-0">
      <div class="row d-flex no-gutters">
         <div class="container ftco-animate makereservation p-4 p-md-5 pt-5 pt-md-0">
            <div class="heading-section ftco-animate mb-5">

               <h2 class="mb-4">ake ReservationM</h2>
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
                            //   while ($table_number = mysqli_fetch_assoc($table_number_res)) {
                            //      echo '<option value="' . $table_number['table_number'] . '">' . $table_number['table_number'] . '</option>';
                            //   }
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
 
                  <div class="col-md-12 mt-3">
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

<section class="ftco-section ftco-no-pt ftco-no-pb contact-section">
	<div class="container">
		<div class="row d-flex align-items-stretch no-gutters">
			<div class="col-md-6 p-5 order-md-last">
				<h2 class="h4 mb-5 font-weight-bold">Contact Us</h2>
				<form action="#">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Your Name">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Your Email">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Subject">
					</div>
					<div class="form-group">
						<textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
					</div>
					<div class="form-group">
						<input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
					</div>
				</form>
			</div>
			<!-- <div class="col-md-6 d-flex align-items-stretch">
				<div id="map"></div>
			</div> -->
		</div>
	</div>
	</div>

	<section class="ftco-section ftco-no-pt ftco-no-pb">
		<div class="container-fluid px-0">
			<div class="row no-gutters">
				<div class="col-md">
					<a href="#" class="instagram img d-flex align-items-center justify-content-center" style="background-image: url(images/insta-1.jpg);">
						<span class="ion-logo-instagram"></span>
					</a>
				</div>
				<div class="col-md">
					<a href="#" class="instagram img d-flex align-items-center justify-content-center" style="background-image: url(images/insta-2.jpg);">
						<span class="ion-logo-instagram"></span>
					</a>
				</div>
				<div class="col-md">
					<a href="#" class="instagram img d-flex align-items-center justify-content-center" style="background-image: url(images/insta-3.jpg);">
						<span class="ion-logo-instagram"></span>
					</a>
				</div>
				<div class="col-md">
					<a href="#" class="instagram img d-flex align-items-center justify-content-center" style="background-image: url(images/insta-4.jpg);">
						<span class="ion-logo-instagram"></span>
					</a>
				</div>
				<div class="col-md">
					<a href="#" class="instagram img d-flex align-items-center justify-content-center" style="background-image: url(images/insta-5.jpg);">
						<span class="ion-logo-instagram"></span>
					</a>
				</div>
			</div>
		</div>
	</section>


	<?php
	include_once 'footer.php';
	?>