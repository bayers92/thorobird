<?php 
$errors = '';
$myemail = 'tcampbell@thorobird.com';
if(empty($_POST['name'])  || 
	empty($_POST['email'])) 
{
	$errors .= "\n Error: Please fill out the name and email fields.";
}

$name = $_POST['name'];
$organization = $_POST['organization']; 
$title = $_POST['title']; 
$email = $_POST['email']; 
$phone = $_POST['phone']; 
$referred = $_POST['referred']; 
$city = $_POST['city']; 
$borough = $_POST['borough']; 
$state = $_POST['state']; 
$address1 = $_POST['address1'];
$block1 = $_POST['block1'];  
$lot1 = $_POST['lot1']; 
$address1 = $_POST['address2'];
$block1 = $_POST['block2'];  
$lot1 = $_POST['lot2']; 
$address1 = $_POST['address3'];
$block1 = $_POST['block3'];  
$lot1 = $_POST['lot3']; 
$address1 = $_POST['address4'];
$block1 = $_POST['block4'];  
$lot1 = $_POST['lot4']; 
$address1 = $_POST['address5'];
$block1 = $_POST['block5'];  
$lot1 = $_POST['lot5']; 
$message = $_POST['message']; 


if( empty($errors))
{
	$to = $myemail; 
	$email_subject = "Contact form submission: $name";
	$email_body = "You have received a new message. \n \n
	Personal Information - \n\n 
	Name: $name \n 
	Professional Title: $title \n 
	Email: $email \n 
	Phone: $phone \n 
	Referred by: $referred \n 
	\n \n
	Property Data - \n \n
	City: $city \n 
	Borough: $borough \n 
	State: $state \n  
	\n
	Address1: $address1 \n
	Block1: $block1 \n 
	Lot1: $lot1 \n 
	\n
	Address2: $address2 \n
	Block2: $block2 \n 
	Lot2: $lot2 \n
	\n
	Address3 : $address3 \n
	Block3: $block3 \n 
	Lot3: $lot3 \n 
	\n
	Address4: $address4 \n
	Block4: $block4 \n 
	Lot4: $lot4 \n 
	\n
	Address5: $address5 \n
	Block5: $block5 \n 
	Lot5: $lot5 \n 
	\n \n
	Message: $message"; 

	
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: thankyou.html');
} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	 <link rel="stylesheet" href="./stylesheets/app.css" />
	<title>Thorobird | Contact Form</title>
</head>

<body>
	<!-- This page is displayed only if there is some error -->
	<div class = "row">
		<div class = "small-12 columns small-centered text-center">
			<img src = "./img/Thorobird_Logo_gray.png" alt="Thorobird Logo"></img>
		</div>
		<div class = "small-12 columns small-centered">
			<h3>
				<a href="./index.html#contact"><i class="fa fa-long-arrow-left fa-1x"></i> Back</a>
				<?php
				echo nl2br($errors);
				?>
			</h3>
		</div>
	</div>

</body>
</html>