<?php 
// Pear library includes
// You should have the pear lib installed
include_once('Mail.php');
include_once('Mail_Mime/mime.php');

//Settings 
$max_allowed_file_size = 100; // size in KB 
$allowed_extensions = array("jpg", "jpeg", "gif", "bmp");
$upload_folder = './uploads/'; //<-- this folder must be writeable by the script
$your_email = 'brianc.ayers@gmail.com';//<<--  update this to your email address

$errors ='';

if(isset($_POST['submit']))
{
	//Get the uploaded file information
	$name_of_uploaded_file =  basename($_FILES['uploaded_file']['name']);
	
	//get the file extension of the file
	$type_of_uploaded_file = substr($name_of_uploaded_file, 
		strrpos($name_of_uploaded_file, '.') + 1);
	
	$size_of_uploaded_file = $_FILES["uploaded_file"]["size"]/1024;
	
	///------------Do Validations-------------
	if(empty($_POST['name'])||empty($_POST['email']))
	{
		$errors .= "\n Name and Email are required fields. ";	
	}
	if(IsInjected($visitor_email))
	{
		$errors .= "\n Bad email value!";
	}
	
	if($size_of_uploaded_file > $max_allowed_file_size ) 
	{
		$errors .= "\n Size of file should be less than $max_allowed_file_size";
	}
	
	//------ Validate the file extension -----
	$allowed_ext = false;
	for($i=0; $i<sizeof($allowed_extensions); $i++) 
	{ 
		if(strcasecmp($allowed_extensions[$i],$type_of_uploaded_file) == 0)
		{
			$allowed_ext = true;		
		}
	}
	
	if(!$allowed_ext)
	{
		$errors .= "\n The uploaded file is not supported file type. ".
		" Only the following file types are supported: ".implode(',',$allowed_extensions);
	}
	
	//send the email 
	if(empty($errors))
	{
		//copy the temp. uploaded file to uploads folder
		$path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;
		$tmp_path = $_FILES["uploaded_file"]["tmp_name"];
		
		if(is_uploaded_file($tmp_path))
		{
			if(!copy($tmp_path,$path_of_uploaded_file))
			{
				$errors .= '\n error while copying the uploaded file';
			}
		}
		
		//send the email
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


		$to = $your_email;
		$subject="New form submission";
		$from = $your_email;
		$text = "A user  $name has sent you this message:\n 


		Personal Information:\n\n 
		Name: $name \n 
		Professional Title: $title \n 
		Email: $email \n 
		Phone: $phone \n 
		Referred by: $referred \n 
		City: $email \n  
		\n \n
		Property Data:\n \n
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
		Message: $message
		";
		
		$message = new Mail_mime(); 
		$message->setTXTBody($text); 
		$message->addAttachment($path_of_uploaded_file);
		$body = $message->get();
		$extraheaders = array("From"=>$from, "Subject"=>$subject,"Reply-To"=>$email);
		$headers = $message->headers($extraheaders);
		$mail = Mail::factory("mail");
		$mail->send($to, $headers, $body);
		//redirect to 'thank-you page
		header('Location: index.html');
	}
}
///////////////////////////Functions/////////////////
// Function to validate against any email injection attempts
function IsInjected($str)
{
	$injections = array('(\n+)',
		'(\r+)',
		'(\t+)',
		'(%0A+)',
		'(%0D+)',
		'(%08+)',
		'(%09+)'
		);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str))
	{
		return true;
	}
	else
	{
		return false;
	}
}
?>