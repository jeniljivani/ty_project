<?php
require_once 'admin/db.php';

$about_select = "select * from about";
$about_res = mysqli_query($con, $about_select);
$about_data = mysqli_fetch_assoc($about_res);

$servic_select = "select * from offer where status=1 order by id desc limit 3";
$servic_res = mysqli_query($con, $servic_select);


$review_select = "select * from review order by id desc limit 6";
$review_res = mysqli_query($con, $review_select);

$chef_select = "SELECT login.* , role.role from login join role on login.role_id=role.id WHERE login.role_id =role.id AND role.role = 'chef'  limit 4";
$chef_res = mysqli_query($con, $chef_select);

include_once 'header.php';
?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-end justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<h1 class="mb-2 bread">About</h1>
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About <i class="ion-ios-arrow-forward"></i></span></p>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-wrap-about ftco-no-pb">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-10 wrap-about ftco-animate text-center">
				<div class="heading-section mb-4 text-center">
					<span class="subheading">About</span>
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
								<strong class="number" data-number="5">0</strong>
								<span>Years of Experienced</span>
							</div>
						</div>
					</div>
					<div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
						<div class="block-18">
							<div class="text">
								<strong class="number" data-number="12000">0</strong>
								<span>Happy Customers</span>
							</div>
						</div>
					</div>
					<div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
						<div class="block-18">
							<div class="text">
								<strong class="number" data-number="30">0</strong>
								<span>Menus</span>
							</div>
						</div>
					</div>
					<div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
						<div class="block-18">
							<div class="text">
								<strong class="number" data-number="15">0</strong>
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
				<span class="subheading">Services</span>
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
		</div>
	</div>
</section>


<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-2">
			<div class="col-md-7 text-center heading-section ftco-animate">
				<span class="subheading">Chef</span>
				<h2 class="mb-4">Our Master Chef</h2>
			</div>
		</div>
		<div class="row">
			<?php while ($chef = mysqli_fetch_assoc($chef_res)) { ?>
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="staff">
						<div class="img" style="background-image: url(admin/image/admin/<?= $chef['image'] ?>);"></div>
						<div class="text pt-4">
							<h3><?= $chef['name'] ?></h3>
							<span class="position mb-2"><?= $chef['role'] ?></span>
							<p><?= $chef['email'] ?></p>
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
			<?php } ?>

		</div>
	</div>
</section>

<!-- <section class="ftco-section testimony-section" style="background-image: url(images/bg_5.jpg);" data-stellar-background-ratio="0.5"> -->
<section class="ftco-section testimony-section img" style="background-image: url(images/bg_5.jpg);">
	<div class="overlay"></div>
	<div class="container">
		<div class="row justify-content-center mb-5">
			<div class="col-md-7 text-center heading-section ftco-animate">
				<span class="subheading">Testimony</span>
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