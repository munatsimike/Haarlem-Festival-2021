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
		<li><a href="#" class = "cmsNav" data-target="#logoutModal" data-toggle = "modal" > <?php echo"Logout"." "."<i class='bi bi-box-arrow-right' style='font-size: 1.6rem'></i>";?></a></li>
		<li id = "loggedEmail"> <?php echo "<span>".$_SESSION['email']." "."<i class='bi bi-person-circle' style='font-size: 1.6rem'></i>";?></li>
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
			password:{
				required: true,
				minlength: 7
			},

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
			confirm_email: "Emails do not match",

			password: {
				require: "Please enter your password",
				minlength:jQuery.validator.format("At least {0} characters are required for a strong password!")
			},

			email: {
				required: "Please enter your email address",
				email: "Your email address must be in the format of name@domain.com"
			}
		},
		// Make sure the form is submitted to the destination defined
		submitHandler: function(form) {
		form.submit();
		}
	});

// do not sumit form if there is an error;
	$('#submitbtn').click(function(e){
		if ($('#response').attr('class') === "error") {
			e.preventDefault();
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
		}).done(function (response) {

			if(JSON.parse(response)) {
				styleEmailField("form_success", "error", "Email is taken");
			} else {
				styleEmailField("error", "form_success", "Email is available");
			}

        }).fail(function (jqXHR, textStatus, errorMessage) {
             alert(errorMessage);
        })
	});

	function styleEmailField(removeClass, addClass, message)
	{
		$('#response').removeClass(removeClass);
		$('#response').addClass(addClass);
		$('#response').text(message);
	}
});
</script>