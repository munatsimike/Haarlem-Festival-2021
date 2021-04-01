<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/Views/myAutoLoader.php';
if (!isset($_SESSION)) session_start();

// Check if the user is logged in, if not then redirect to index page
if ( ! isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../../index.php");
    exit;
}

?>
<html>
	<head>
		<?php 
			require_once '../partials/head.php'; 
			require_once '../alert.php';
		?>
		<title>Haarlem festival CMS</title>
	</head>
	<img class="Logoright" src="/Img/logo.png" alt="logo"  title ="logo"/>
	<ul>
		<li><a href="#" data-target="#logoutModal" data-toggle = "modal" > <?php echo"Logout"." "."<i class='bi bi-box-arrow-right' style='font-size: 1.6rem'></i>";?></a></li>
		<li><a href="#"> <?php echo "<span>".$_SESSION['username']." "."<i class='bi bi-person-circle' style='font-size: 1.6rem'></i>";?></a></li>
		<li><a href="#"  data-target="#registration-modal" data-toggle = "modal" >Add Volunteer</a></li>
	</ul>
		<header class="header">
		<!--for background image-->
			<?php
			// check if volunteer acc is created and display appropriate message
				if (isset($_SESSION['registration'])) {
				   if ($_SESSION['registration'] === true) {
						echo "<script> showAlert('Success ! Account successfully created','success');</script>";
				   }else {
					   // log exception message to email;
						error_log($_SESSION['registration'], 1, "hfestival21@gmail.com");
						echo "<script> showAlert('Internal error ! account not created contact support','error');</script>";
				   }
					unset($_SESSION['registration']);
				} 
			?>
		</header>
	<body>
			 
		<?php 
		require_once "logout-modal.php"; 
		/// account registration form
		require_once "registration-modal.php"; 
		?>
	</body>
</html>
<script>
$(function() {

	$("#registration-form").validate({
		// Specify validation rules
		rules: {
			password: "required",
			email: {
				required: true,
				email: true
			},

			confirm_email: {
				required: true,
				equalTo: "#email"
			},
		},
		// Specify validation error messages
		messages: {
				password: "Please enter your password",
				email: "Please enter a valid email",
				confirm_email: "Emails do not match"
		},
		// Make sure the form is submitted to the destination defined
		submitHandler: function(form) {
		form.submit();
		}
	});

	$("#email").change(function(){

		const email = $(this).val().trim();
		
		if(email.length === 0){
			$('#response').empty();
			return;
		}

		$.ajax({
			url: '../../Service/CMS/admin.php',
			type: 'post',
			data: {'email': email},
		}).done(function (response, status, xhr) {

			if(JSON.parse(response)) {
				$('#response').addClass("error");
				$('#response').text('Email is taken');
			} else {
				$('#response').addClass("form_success");
				$('#response').text('Email is available');
			}
        }).fail(function (jqXHR, textStatus, errorMessage) {
             alert(errorMessage);
        })
	});

});
</script>