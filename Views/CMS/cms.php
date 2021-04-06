<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/Views/myAutoLoader.php';
	if (!isset($_SESSION)) session_start();

	// Check if the user is logged in, if not then redirect to index page
	if ( ! isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
		header("location: ../../index.php");
		exit;
	}

	
	$CMSController = new CMSController();

	try {
		$CMSEvents = $CMSController->fetchEvents();
	} catch (Exception $error) {
		new ErrorLog($error->getMessage());
		echo "<script> showAlert('Error ! failed to connect to remote server. Try again or contact support','error');</script>";
		return;
	}
?>

<html>
	<head>
		<?php 
			require_once '../partials/head.php'; 
			require_once '../alert.php';
			require_once 'CMSEventOptions.php';
			require_once '../ti.php';
		?>
		<title>Haarlem festival CMS</title>
	</head>
	<img class="Logoright" src="/Img/logo.png" alt="logo"  title ="logo"/>
	<ul>
		<li><a href="#" class = "cmsNav" data-target="#logoutModal" data-toggle = "modal" > <?php echo"Logout"." "."<i class='bi bi-box-arrow-right' style='font-size: 1.6rem'></i>";?></a></li>
		<li id = "loggedEmail"> <?php echo "<span>".$_SESSION['email']." "."<i class='bi bi-person-circle' style='font-size: 1.6rem'></i>";?></li>
		<?php
			if (isset($_SESSION['employeeType']) && $_SESSION['employeeType'] === EmployeeType::ADMIN()->getValue()) {
				echo "<li><a href='#' data-target='#passwordResetModal' data-toggle='modal'>Reset Password</a></li>
					  <li><a href='#' data-target='#registration-modal' data-toggle='modal'>Add Volunteer</a></li>";
			}
		?>
	</ul>
		<header class="header">
		<!--for background image-->
			<?php
				// check if volunteer acc is created and display appropriate message
				if (isset($_GET['registration']) && $_GET['registration'] === "true") {
						echo "<script> showAlert('Success ! Account successfully created','success');</script>";
				} 

				if (isset($_GET['registration']) && $_GET['registration'] === "false")
				{
						echo "<script> showAlert('Internal error ! account not created contact support','error');</script>";
				}

				if (isset($_GET['linkSent']) && $_GET['linkSent'] === "false")
				{
						echo "<script> showAlert('internal error password reset link not sent. try again','error');</script>";
				}

				if (isset($_GET['tokenFound']) && $_GET['tokenFound'] === "false")
				{
						echo "<script> showAlert('Token not found send another reset link','error');</script>";
				}
			?>
		</header>
		
	<body>
			
			<div class = "row justify-content-center">
				<div class = "col-7 single-tickets">
					<?php CMSEventOptions::displayTickets($CMSEvents);?>
				</div>
			</div>
		<?php 
			require_once "logout-modal.php"; 
			/// account registration form
			require_once "registration-modal.php"; 
			require_once "password-reset.php"; 
		?>

	</body>
</html>

<script>
// pass data for editing djs
/*$('#djs-modal').click(function ($event) {
	$var = JSON.stringify({'djs':$cartId});
        
		$.ajax({
			url: '../../Service/CMS/',
			type: 'post',
			data: {'var': $var},
		}).done(function (response) {
			if(JSON.parse(response)) {
				DisplayAlert("form_success", "error", "djs could not be edited, refresh page or try again later");
			} else {
				DisplayAlert("error", "form_success", "");
			}

        }).fail(function (jqXHR, textStatus, errorMessage) {
             alert(errorMessage);
        })
});*/

$('.save, .reset, .delete').click(function ($event) {
	$var = JSON.stringify({'djs':$cartId});
	if ($(this).attr('name') === 'savebtn') {
		
		$.ajax({
			url: '../../Service/CMS/',
			type: 'post',
			data: {'var': $var},
		}).done(function (response) {
			if(JSON.parse(response)) {
				DisplayAlert("form_success", "error", "djs could not be edited, refresh page or try again later");
			} else {
				DisplayAlert("error", "form_success", "");
			}

        }).fail(function (jqXHR, textStatus, errorMessage) {
             alert(errorMessage);
        })
});
$(function() {
	

	$("#registration-form, #password-reset").validate({
		// Specify validation rules
		rules: {
			password: {
				required: true,
			   minlength: 7
			},

			  email: {
				required: true,
				   email: true
			},

  	 confirm_password: {
				required: true,
				 equalTo: "#password"
			},
		},

		// Specify validation error messages
	 messages: {
			confirm_email: {
								required: "Confirm your Password",
								 equalTo: "Passwords do not much"
						   },

			     password: {
								required: "Password field cannot be empty.",
							   minlength:  jQuery.validator.format("At least {0} characters are required for a strong password!")
						},

					email: {
								required: "Email field cannot be empty",
								   email: "Your email address must be in the format of name@domain.com"
						}
		},

		// Make sure the form is submitted to the destination defined
		submitHandler: function(form) {
		form.submit();
		}
	});

	// do not sumit form if there is an error;
	$('#submitbtn').click(function(e) {
		//#response: span that displays errors
		if ($('#response').attr('class') === "error") {
			e.preventDefault();
		}
	});

	// clear span if email field is empty
	$("#email").change(function() {
		const email = $(this).val().trim();

		if (email.length === 0) {
			$('#response').empty();
			return;
		}

		// check if account exist
		$.ajax({
			url: '../../Service/CMS/login-registration.php',
			type: 'post',
			data: {'email': email},
		}).done(function (response) {
			if(JSON.parse(response)) {
				DisplayAlert("form_success", "error", "Account already exist");
			} else {
				DisplayAlert("error", "form_success", "");
			}

        }).fail(function (jqXHR, textStatus, errorMessage) {
             alert(errorMessage);
        })
	});

	// email span alert
	function DisplayAlert(removeClass, addClass, message)
	{
		$('#response').removeClass(removeClass);
		$('#response').addClass(addClass);
		$('#response').text(message);
	}
});

</script>