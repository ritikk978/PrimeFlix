<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP POST Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_REQUEST['user_id']) && isset($_REQUEST['planid']) && isset($_REQUEST['addamount']) && isset($_REQUEST['days']) && isset($_REQUEST['instaorderid']) && isset($_REQUEST['instatxnid']) && isset($_REQUEST['instapaymentid']) && isset($_REQUEST['instatoken']) && isset($_REQUEST['status'])) {

    $userid= $_REQUEST['user_id'];
    $planid= $_REQUEST['planid'];
    $days= $_REQUEST['days'];
    $addamount= $_REQUEST['addamount'];
    $instaorderid= $_REQUEST['instaorderid'];
    $instatxnid= $_REQUEST['instatxnid'];
    $instapaymentid= $_REQUEST['instapaymentid'];
    $instatoken= $_REQUEST['instatoken'];
    $status= $_REQUEST['status'];
    
    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
	$db = new DB_CONNECT();
	$conn = $db->connect();

    date_default_timezone_set("Asia/Calcutta");
	$cur = date("Y-m-d H:i:s");
	
	//increment 1 days
    $Today=date('y:m:d');

    // add 1 days to date
    $NewDate=Date('Y-m-d H:i:s', strtotime("+".$days." days"));
    // echo $NewDate;
    
	// mysql inserting a new row
	$result = mysqli_query($conn,"UPDATE tbl_users SET planid = '$planid', planactive = 'Y', plandays = '$days', planstart = '$cur' , planend = '$NewDate' WHERE tbl_users.id = '$userid' ");

	// check if row inserted or not
	if ($result) {
    	// successfully inserted into database
    	$response["success"] = 1;
    	$response["message"] = "Product successfully created.";

    	// echoing JSON response
    	echo json_encode($response);
	} else {
    	// failed to insert row
    	$response["success"] = 0;
    	$response["message"] = "Oops! An error occurred.";
    
    	// echoing JSON response
    	echo json_encode($response);
	}
	
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>