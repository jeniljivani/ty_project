<?php
require_once 'admin/db.php';

$slider_data = "select * from slider where status=1";
$slider_res = mysqli_query($con, $slider_data);

$about_select = "select * from about";
$about_res = mysqli_query($con, $about_select);
$about_data = mysqli_fetch_assoc($about_res);

$servic_select = "select * from offer order by id desc limit 3";
$servic_res = mysqli_query($con, $servic_select);

$review_select = "select * from review order by id desc limit 6";
$review_res = mysqli_query($con, $review_select);
$date = date('Y-m-d');

$table_number_select = "SELECT table_number FROM tables WHERE table_number NOT IN 
        (SELECT table_number FROM reservations WHERE reservation_date = '$date' )";
$table_number_res = mysqli_query($con, $table_number_select);


include_once 'header.php';

?>

<section class="home-slider owl-carousel js-fullheight">
   <?php

   while ($slider = mysqli_fetch_assoc($slider_res)) {
   ?>
      <div class="slider-item js-fullheight" style="background-image: url('admin/image/slider/<?= $slider['image']; ?>');">

         <div class="overlay"></div>
         <div class="container">
            <div class="row slider-text js-fullheight justify-content-center align-items-center" data-scrollax-parent="true">

               <div class="col-md-12 col-sm-12 text-center ftco-animate">
                  <h1 class="mb-4 mt-5"><?= $slider['title'] ?></h1>
                  <p><a href="menu.php" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
               </div>

            </div>
         </div>
      </div>
   <?php } ?>

</section>


<section class="ftco-section ftco-wrap-about ftco-no-pb">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-sm-10 wrap-about ftco-animate text-center">
            <div class="heading-section mb-4 text-center">

               <h2 class="mb-4"><?= $about_data['title'] ?></h2>
            </div>
            <p><?= $about_data['description'] ?></p>

            <div class="video justify-content-center">
               <a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex justify-content-center align-items-center">
                  <span class="ion-ios-play"></span>
               </a>
            </div>
         </div>
      </div>
   </div>
</section>


<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_4.jpg);" data-stellar-background-ratio="0.5">
   <!-- <section class="ftco-section ftco-counter img ftco-no-pt" id="section-counter"> -->
   <div class="container">
      <div class="row d-md-flex align-items-center justify-content-center">
         <div class="col-lg-10">
            <div class="row d-md-flex align-items-center">
               <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                  <div class="block-18">
                     <div class="text">
                        <strong class="number" data-number="18">0</strong>
                        <span>Years of Experienced</span>
                     </div>
                  </div>
               </div>
               <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                  <div class="block-18">
                     <div class="text">
                        <strong class="number" data-number="15000">0</strong>
                        <span>Happy Customers</span>
                     </div>
                  </div>
               </div>
               <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                  <div class="block-18">
                     <div class="text">
                        <strong class="number" data-number="100">0</strong>
                        <span>Menus</span>
                     </div>
                  </div>
               </div>
               <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                  <div class="block-18">
                     <div class="text">
                        <strong class="number" data-number="20">0</strong>
                        <span>Staffs</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="ftco-section bg-light">
   <div class="container">
      <div class="row justify-content-center mb-5 pb-2">
         <div class="col-md-7 text-center heading-section ftco-animate">

            <h2 class="mb-4">Catering Services</h2>
         </div>
      </div>
      <div class="row">
         <?php
         while ($servic = mysqli_fetch_assoc($servic_res)) {
         ?>

            <div class="col-md-4 d-flex align-self-stretch ftco-animate text-center">
               <div class="media block-6 services d-block">
                  <div class="icon d-flex justify-content-center align-items-center">
                     <img style="width: 50%;" src="admin/image/services/<?= $servic['icon'] ?>" alt="">
                  </div>
                  <div class="media-body p-2 mt-3">
                     <h3 class="heading"><?= $servic['title'] ?></h3>
                     <p><?= $servic['description'] ?></p>
                  </div>
               </div>
            </div>

         <?php } ?>
         <!-- <div class="col-md-4 d-flex align-self-stretch ftco-animate text-center">
				<div class="media block-6 services d-block">
					<div class="icon d-flex justify-content-center align-items-center">
						<span class="flaticon-meeting"></span>
					</div>
					<div class="media-body p-2 mt-3">
						<h3 class="heading">Business Meetings</h3>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-flex align-self-stretch ftco-animate text-center">
				<div class="media block-6 services d-block">
					<div class="icon d-flex justify-content-center align-items-center">
						<span class="flaticon-tray"></span>
					</div>
					<div class="media-body p-2 mt-3">
						<h3 class="heading">Wedding Party</h3>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
					</div>
				</div>
			</div> -->
      </div>
   </div>
</section>

<section class="ftco-section">
   <div class="container-fluid px-4">
      <div class="row justify-content-center mb-5 pb-2">
         <div class="col-md-7 text-center heading-section ftco-animate">

            <h2 class="mb-4">Our Menu</h2>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6 col-lg-4 menu-wrap">
            <div class="heading-menu text-center ftco-animate">
               <h3>Breakfast</h3>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/breakfast-1.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Beef with potatoes</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/breakfast-2.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Crab with Onion</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/breakfast-3.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Crab with Onion</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
         </div>

         <div class="col-md-6 col-lg-4 menu-wrap">
            <div class="heading-menu text-center ftco-animate">
               <h3>Lunch</h3>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/lunch-1.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Beef with potatoes</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/lunch-2.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Crab with Onion</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/lunch-3.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Crab with Onion</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
         </div>

         <div class="col-md-6 col-lg-4 menu-wrap">
            <div class="heading-menu text-center ftco-animate">
               <h3>Dinner</h3>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/dinner-1.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Beef with potatoes</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/dinner-2.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Crab with Onion</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/dinner-3.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Crab with Onion</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
         </div>

         <!--  -->
         <div class="col-md-6 col-lg-4 menu-wrap">
            <div class="heading-menu text-center ftco-animate">
               <h3>Desserts</h3>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/dessert-1.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Beef with potatoes</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/dessert-2.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Crab with Onion</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/dessert-3.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Crab with Onion</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
         </div>

         <div class="col-md-6 col-lg-4 menu-wrap">
            <div class="heading-menu text-center ftco-animate">
               <h3>Wine Card</h3>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/wine-1.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Beef with potatoes</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/wine-2.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Crab with Onion</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/wine-3.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Crab with Onion</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
         </div>

         <div class="col-md-6 col-lg-4 menu-wrap">
            <div class="heading-menu text-center ftco-animate">
               <h3>Drinks</h3>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/drink-1.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Beef with potatoes</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/drink-2.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Crab with Onion</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
            </div>
            <div class="menus d-flex ftco-animate">
               <div class="menu-img img" style="background-image: url(images/drink-3.jpg);"></div>
               <div class="text">
                  <div class="d-flex">
                     <div class="one-half">
                        <h3>Grilled Crab with Onion</h3>
                     </div>
                     <div class="one-forth">
                        <span class="price">$29</span>
                     </div>
                  </div>
                  <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
               </div>
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
               <h2 class="mb-4">Submit a Review</h2>
            </div>
            <form method="post" id="review-form" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name">
                        <span id="name-error" style="display: none; color: red">Enter a valid name</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Your Email">
                        <span id="email-error" style="display: none; color: red">Enter a valid email</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="review">Review</label>
                        <textarea name="review" id="review" class="form-control" placeholder="Your Review" rows="3"></textarea>
                        <span id="review-error" style="display: none; color: red">Enter your review</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="image">Upload Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept=".jpg, .jpeg, .png">
                        <span id="image-error" style="display: none; color: red">Only image files (jpg, png, jpeg) are allowed</span>
                     </div>
                  </div>
                  <div class="col-md-12 mt-3 d-flex justify-content-center">
                     <div class="form-group">
                        <input type="submit" name="submit" value="Submit Review" class="btn btn-primary py-3 px-5" id="submit-btn">
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</section>

<section class="ftco-section">
   <div class="container">
      <div class="row justify-content-center mb-5 pb-2">
         <div class="col-md-7 text-center heading-section ftco-animate">

            <h2 class="mb-4">Our Master Chef</h2>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="staff">
               <div class="img" style="background-image: url(images/chef-4.jpg);"></div>
               <div class="text pt-4">
                  <h3>John Smooth</h3>
                  <span class="position mb-2">Restaurant Owner</span>
                  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                  <div class="faded">
                     <!-- <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p> -->
                     <ul class="ftco-social d-flex">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="staff">
               <div class="img" style="background-image: url(images/chef-2.jpg);"></div>
               <div class="text pt-4">
                  <h3>Rebeca Welson</h3>
                  <span class="position mb-2">Head Chef</span>
                  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                  <div class="faded">
                     <!-- <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p> -->
                     <ul class="ftco-social d-flex">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="staff">
               <div class="img" style="background-image: url(images/chef-3.jpg);"></div>
               <div class="text pt-4">
                  <h3>Kharl Branyt</h3>
                  <span class="position mb-2">Chef</span>
                  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                  <div class="faded">
                     <!-- <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p> -->
                     <ul class="ftco-social d-flex">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="staff">
               <div class="img" style="background-image: url(images/chef-1.jpg);"></div>
               <div class="text pt-4">
                  <h3>Luke Simon</h3>
                  <span class="position mb-2">Chef</span>
                  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                  <div class="faded">
                     <!-- <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p> -->
                     <ul class="ftco-social d-flex">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- <section class="ftco-section testimony-section" style="background-image: url(images/bg_5.jpg);" data-stellar-background-ratio="0.5"> -->
<section class="ftco-section testimony-section img" style="background-image: url(images/bg_5.jpg);">
   <div class="overlay"></div>
   <div class="container">
      <div class="row justify-content-center mb-5">
         <div class="col-md-7 text-center heading-section ftco-animate">

            <h2 class="mb-4">Happy Customer</h2>
         </div>
      </div>
      <div class="row ftco-animate justify-content-center">
         <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
               <?php
               while ($review = mysqli_fetch_assoc($review_res)) {
               ?>
                  <div class="item">
                     <div class="testimony-wrap text-center pb-5">
                        <div class="user-img mb-4" style="background-image: url('admin/image/review/<?= $review['image']; ?>'); background-size:cover; background-position:center;">
                           <span class="quote d-flex align-items-center justify-content-center">
                              <i class="icon-quote-left"></i>
                           </span>
                        </div>
                        <div class="text p-3">
                           <p class="mb-4"><?= $review['review']; ?></p>
                           <p class="name"><?= $review['name']; ?></p>
                           <span class="position">Customer</span>
                        </div>
                     </div>
                  </div>
               <?php
               }
               ?>

            </div>
         </div>
      </div>
   </div>
</section>

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
<script>
   $(document).ready(function() {
      $('#review-form').on('submit', function(e) {
     
         e.preventDefault(); // Prevent form submission for AJAX handling

         var valid = true;

         // Name validation
         var name = $('#name').val();
         if (name.trim() === '') {
            $('#name-error').show();
            valid = false;
         } else {
            $('#name-error').hide();
         }

         // Email validation
         var email = $('#email').val();
         var emailPattern = /^[^\s@]+@(gmail\.com|yahoo\.com)$/;
         if (!emailPattern.test(email)) {
            $('#email-error').show();
            valid = false;
         } else {
            $('#email-error').hide();
         }

         // Review validation
         var review = $('#review').val();
         if (review.trim() === '') {
            $('#review-error').show();
            valid = false;
         } else {
            $('#review-error').hide();
         }

         // Image validation
         var image = $('#image')[0].files[0];
         if (image) {
            var allowedTypes = ['image/jpg', 'image/jpeg', 'image/png'];
            if (!allowedTypes.includes(image.type)) {
               $('#image-error').show();
               valid = false;
            } else {
               $('#image-error').hide();
            }
         }

         // If validation fails, stop the AJAX request
         if (!valid) {
            return;
         }

         // Form data
         var formData = new FormData(this); // Using 'this' to refer to the form

         // Send AJAX request if form is valid
         $.ajax({
            url: 'review.php', // Replace with your PHP handler
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
               console.log(response);
               // Assuming response is JSON
               try {
                  const jsonResponse = JSON.parse(response);
                  if (jsonResponse.status === 'success') {
                     toastr.success(jsonResponse.message, 'Success');
                     $('#review-form')[0].reset(); // Reset the form
                  } else {
                     toastr.error(jsonResponse.message, 'Error');
                  }
               } catch (error) {
                  toastr.error('Invalid response from server.', 'Error');
               }
            },
            error: function(xhr, status, error) {
               toastr.error('An error occurred while submitting the review.', 'Error');
            }
         });
      });
   });
</script>
