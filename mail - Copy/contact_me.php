<?php
// Check for empty fields
if(empty($_POST['fname'])      ||
   empty($_POST['lname'])      ||
   empty($_POST['email'])     ||
   //empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
   
$fname = strip_tags(htmlspecialchars($_POST['fname']));
$lname = strip_tags(htmlspecialchars($_POST['lname']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
//$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
   
// Create the email and send the message
$to = 'dmorgan@studiodm.net'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $fname $lname";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $fname $lname\n\nEmail: $email_address\n\nMessage: $message";
$headers = "From: noreply@studiodm.net.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";   
mail($to,$email_subject,$email_body,$headers);


$apikey = "f43e70540a654fd6f1ca4e2a4d451fff-us14";
$list_id = "e808b7b8c7";
$email = $email_address;
$f_name = $fname;
$l_name = $lname;
$auth = base64_encode( 'user:'.$apikey );
$data = array(
'apikey'        => $apikey,
'email_address' => $email,
'status'        => 'pending',
'merge_fields'  => array(
'FNAME' => $f_name,
'LNAME' => $l_name,
)
);

$json_data = json_encode($data);

$ch = curl_init();

// notice datacenter  "us11" comes after the // - make sure you update this to your datacenter (e.g. us2, us7 etc) or you'll get the "wrong datacenter" error.
$curlopt_url = "https://us14.api.mailchimp.com/3.0/lists/$list_id/members/";
curl_setopt($ch, CURLOPT_URL, $curlopt_url);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
    'Authorization: Basic '.$auth));
curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/3.0');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

$result = curl_exec($ch);
/*
// some debug statements 
var_dump($result);
print_r ($result);
*/


// here is simple way to determine status of a subscription
// $result is in JSON format
// this following loop is a simple JSON decode loop I found via google


 $status = "undefined";
    $msg = "unknown error occurred";
$myArray = json_decode($result, true);

foreach($myArray as $key => $value)
{

    // debug key<<< = >>>$value<<< <br>";

    if( $key == "status" )
    {
        $status=$value;
        //debug                 echo" status found $status<Br>";
    }
    else if ($key == "title")
    {
        $msg=$value;
        //debug                 echo" title found $msg<Br>";
    }


}

// create the output that gets displayed or returned if invoked by AJAX method
if( $status == "new" )
{
    $msg = "Success! <br>$email has been subscribed <Br>check your inbox for the confirmation email to complete your subscription";
}
else
{
    $msg = "Sorry can not subscribe email $email <br>$msg <Br>";
}


echo "$msg <br>";


die(' '); // frees up mem etc..


return true;         
?>
