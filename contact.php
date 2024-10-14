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


<style>
   .form-group {
      margin-bottom: 20px;
   }

   .form-control+.text-danger {
      margin-top: 5px;
      font-size: 16px;
      color: #e3342f;
      /* Red color */
   }

   .form-control.error {
      border: 2px solid #e3342f;
      /* Red border */
   }
</style>

<section class="ftco-section ftco-no-pt ftco-no-pb contact-section">
   <div class="container">
      <div class="row d-flex align-items-stretch no-gutters">
         <div class="col-md-12 p-5 order-md-last">
            <h2 class="h4 mb-5 font-weight-bold">Contact Us</h2>
            <form id="contactForm" action="#">
               <div class="form-group d-flex flex-column">
                  <label class="col-md-2" for="name">Your Name :-</label>
                  <input type="text" class="form-control" id="name" placeholder="Your Name">
                  <span class="text-danger" id="nameError"></span> <!-- Validation error message -->
               </div>
               <div class="form-group d-flex flex-column">
                  <label class="col-md-2" for="email">Email :-</label>
                  <input type="text" class="form-control" id="email" placeholder="Your Email">
                  <span class="text-danger" id="emailError"></span> <!-- Validation error message -->
               </div>
               <div class="form-group d-flex flex-column">
                  <label class="col-md-2" for="subject">Subject :-</label>
                  <input type="text" class="form-control" id="subject" placeholder="Subject">
                  <span class="text-danger" id="subjectError"></span> <!-- Validation error message -->
               </div>
               <div class="form-group d-flex flex-column">
                  <label class="col-md-2" for="message">Message :-</label>
                  <textarea id="message" cols="30" rows="5" class="form-control" placeholder="Message"></textarea>
                  <span class="text-danger" id="messageError"></span> <!-- Validation error message -->
               </div>
               <div class="form-group d-flex justify-content-center">
                  <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
               </div>
            </form>

         </div>

      </div>
   </div>
   </div>
</section>

<?php
include_once 'footer.php';
?>




<script>
   $(document).ready(function() {
      $('#contactForm').on('submit', function(e) {
         e.preventDefault();

         // Clear previous error messages and remove error borders
         $('#nameError, #emailError, #subjectError, #messageError').text('');
         $('.form-control').removeClass('error');

         // Get form values
         var name = $('#name').val();
         var email = $('#email').val();
         var subject = $('#subject').val();
         var message = $('#message').val();
         var valid = true;

         // Validate name
         if (!name) {
            $('#nameError').text("Name is required.");
            $('#name').addClass('error'); // Add red border
            valid = false;
         } else {
            $('#name').removeClass('error'); // Remove red border when valid
            $('#nameError').text(''); // Clear error message
         }

         // Validate email
         if (!email) {
            $('#emailError').text("Email is required.");
            $('#email').addClass('error'); // Add red border
            valid = false;
         } else {
            // Regular expression to validate Gmail and Yahoo emails only
            var emailPattern = /^[^ ]+@(gmail\.com|yahoo\.com)$/;
            if (!email.match(emailPattern)) {
               $('#emailError').text("Only Gmail and Yahoo emails are allowed.");
               $('#email').addClass('error'); // Add red border
               valid = false;
            } else {
               $('#email').removeClass('error'); // Remove red border when valid
               $('#emailError').text(''); // Clear error message
            }
         }

         // Validate subject
         if (!subject) {
            $('#subjectError').text("Subject is required.");
            $('#subject').addClass('error'); // Add red border
            valid = false;
         } else {
            $('#subject').removeClass('error'); // Remove red border when valid
            $('#subjectError').text(''); // Clear error message
         }

         // Validate message
         if (!message) {
            $('#messageError').text("Message is required.");
            $('#message').addClass('error'); // Add red border
            valid = false;
         } else {
            $('#message').removeClass('error'); // Remove red border when valid
            $('#messageError').text(''); // Clear error message
         }

         // Stop if validation fails
         if (!valid) return;

         var form = $('#contactForm')[0]; // Get the form element

         // Create a FormData object
         var data = new FormData(form);

         // Append additional fields if needed
         data.append('name', name);
         data.append('email', email);
         data.append('subject', subject);
         data.append('message', message);

         // Send data via AJAX if validation passes
         $.ajax({
            url: 'contactus.php',
            type: 'POST',
            data: data,
            processData: false, // Important: Tell jQuery not to process the data
            contentType: false, // Important: Tell jQuery not to set contentType
            success: function(response) {
               console.log(response);
               toastr.success(response.message || "Message sent successfully!");
               $('#contactForm')[0].reset(); // Clear the form on success
            },
            error: function(xhr, status, error) {
               toastr.error("An error occurred. Please try again.");
            }
         });
      });
   });
</script>