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
					<p><span>Address:</span><a> 198 Ring Road, Suite 721, Surat, Gujarat 395003</a></p>
				</div>
			</div>
			<div class="col-md-3 d-flex">
				<div class="dbox">
					<p><span>Phone:</span> <a href="tel://1234567920">+55115 17781</a></p>
				</div>
			</div>
			<div class="col-md-3 d-flex">
				<div class="dbox">
					<p><span>Email:</span> <a href="mailto:appetizer@gmail.com">appetizer@gmail.com</a></p>
				</div>
			</div>
			<div class="col-md-3 d-flex">
				<div class="dbox">
					<p><span>Website</span> <a href="index.php">Appetizer.com</a></p>
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
               <h2 class="mb-4">Make Review</h2>
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
                        <label for="image">Your Image</label>
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