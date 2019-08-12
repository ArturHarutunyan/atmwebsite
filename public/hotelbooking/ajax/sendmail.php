<?php
if (!isset($_POST['data'])) {
	exit("0");
}
ini_set("display_errors", true);
error_reporting(E_ALL);

require_once "./phpmayler/PHPMailerAutoload.php";
$data = json_decode($_POST['data']);

$text= "								MERIDIAN EXPO CONTACT FROM SUBMITED 					<br><br>";

$text.= "								CONTACTS 					<br><br>";
$text.=" --------------------------------------------------------------- <br>";

$text.= "|		Name 			: ".$data->contacts->Name."<br>";
$text.= "|		Surname			: ".$data->contacts->Surname."<br>";
$text.= "|		Phone			: ".$data->contacts->Phone."<br>";
$text.= "|		Email 			: ".$data->contacts->Email."<br>";
$text.= "|		Organization 	: ".$data->contacts->Organization."<br>";
$text.= "|		Comments 		: ".$data->contacts->Comments."<br>";

$text.=" --------------------------------------------------------------- <br>";



$hotelsPrices = array(
	array(65,80),
	array(62,72),
	array(72,95),
	array(65,72),
);
$ExcursionsPrice = array(
	45,
	37.5,
	37.5,
	37.5,
	50,
	50
);
$room = array('SGL','DBL' );
$price = 0;
if (is_array($data->allOrders->hotelOrders)) {
	$text.= "								HOTELS 					<br><br>";
	$text.=" --------------------------------------------------------------- <br>";

	foreach ($data->allOrders->hotelOrders as  $value) {
		$price+= $hotelsPrices[$value->index][$value->room]*$value->nights*$value->qty;

		$text.= "|		Hotel 			: ".$value->hotelName."<br>";
		$text.= "|		days 			: ".substr($value->startDate,0,10)." - ".substr($value->endDate,0,10)."<br>";
		$text.= "|		room 			: ".$room[$value->room]."<br>";
		$text.= "|		PRICE PER DAY 	: ".$hotelsPrices[$value->index][$value->room]."<br>";
		$text.= "|		NIGHT COUNT 	: ".$value->nights."<br>";
		$text.= "|		PRICE 		 	: ".$hotelsPrices[$value->index][$value->room]*$value->nights*$value->qty."<br>";


		$text.= "|		qty 			: ".$value->qty."<br>";
		$text.=" --------------------------------------------------------------- <br>";

	}
}

//test
if (is_array($data->allOrders->carOrders)) {
	$text.= "								CARS 					<br><br>";
	$text.=" --------------------------------------------------------------- <br>";

	foreach ($data->allOrders->carOrders as  $value) {
		$value->totalPrice = intval(substr($value->price, 1));
		$price+= $value->totalPrice;
		$text.= "|		service		: ".$value->event."<br>";
		if (!is_array(json_decode($value->date))) {
		$text.= "|		days 		: ".substr($value->date,0,10)."<br>";
		}else{
			$value->date = json_decode($value->date);
		$text.= "|		days 		: ".substr($value->date[0],0,10)." - ".substr($value->date[1],0,10)."<br>";

		}
		if(isset($value->carType))
			$text.= "|		carType 	: ".$value->carType."<br>";
		if(isset($value->flight))
			$text.= "|		flight 		: ".$value->flight."<br>";
		$text.= "|		price 		: ".$value->price."<br>";

		
		$text.=" --------------------------------------------------------------- <br>";

	}

}

if (is_array($data->allOrders->ExcursionOrders)) {
	$text.= "								Excursions 					<br><br>";
	$text.=" --------------------------------------------------------------- <br>";

	foreach ($data->allOrders->ExcursionOrders as  $value) {
		$text.= "|		Name 		: ".$value->turName."<br>";
		$text.= "|		quantity 	: ".$value->Qty."<br>";
		$text.= "|		date 		: ".substr($value->date,1,10)."<br>";
		$text.= "|		Price FOR ONE: ".$ExcursionsPrice[$value->index]."<br>";
		$text.= "|		price 		: ".$ExcursionsPrice[$value->index]*$value->Qty."<br>";


		
		$text.=" --------------------------------------------------------------- <br>";
		$price+=$ExcursionsPrice[$value->index]*$value->Qty;

	}
}
		$text.=" --------------------------------------------------------------- <br>";
		$text.=" total : ".$price." <br>";

$mail = new PHPMailer();

$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;   // set the SMTP port for the GMAIL server
$mail->Username   = "admin@epic.study";  // username
$mail->Password   = "dir.!!2266";            // password

$mail->SetFrom($data->contacts->Email, $data->contacts->Name." ".$data->contacts->Surname );

$mail->Subject    = "MERIDIAN EXPO REQUEST BY SITE";
$message = $text;
$mail->IsHTML(true); 
$mail->MsgHTML($message);

$address = $data->contacts->Email;
$mail->AddAddress("soft@armeniatravel.am", $data->contacts->Name." ".$data->contacts->Surname );
$mail->AddAddress("hotel_reservation@armeniatravel.am", $data->contacts->Name." ".$data->contacts->Surname );


if(!$mail->Send()) {
	exit("0");
}
exit("1");
?>