<?php
// Auto Load Classes
require_once("../autoloader.php");

// Allowed API Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Allow: POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

$headers = apache_request_headers();
$response = array();
$controller = new ApiAccess;
$controller2 = new bulksms;
date_default_timezone_set('Africa/Lagos');

// -------------------------------------------------------------------
// Check Request Method
// -------------------------------------------------------------------

$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod !== 'POST') {
    header('HTTP/1.0 400 Bad Request');
    $response["status"] = "fail";
    $response["msg"] = "Only POST method is allowed";
    echo json_encode($response);
    exit();
}

// -------------------------------------------------------------------
// Check For Api Authorization
// -------------------------------------------------------------------

if ((isset($headers['Authorization']) || isset($headers['authorization'])) || (isset($headers['Token']) || isset($headers['token']))) {
    if ((isset($headers['Authorization']) || isset($headers['authorization']))) {
        $token = trim(str_replace("Token", "", (isset($headers['Authorization'])) ? $headers['Authorization'] : $headers['authorization']));
    }
    if ((isset($headers['Token']) || isset($headers['token']))) {
        $token = trim(str_replace("Token", "", (isset($headers['Token'])) ? $headers['Token'] : $headers['token']));
    }
    $result = $controller->validateAccessToken($token);
    if ($result["status"] == "fail") {
        // tell the user no products found
        header('HTTP/1.0 401 Unauthorized');
        $response["status"] = "fail";
        $response["msg"] = "Authorization token not found $token";
        echo json_encode($response);
        exit();
    } else {
        $usertype = $result["usertype"];
        $userbalance = (float)$result["balance"];
        $userid = $result["userid"];
        $refearedby = $result["refearedby"];
        $referal = $result["phone"];
        $referalname = $result["name"];
    }
} else {
    header('HTTP/1.0 401 Unauthorized');
    // tell the user no products found
    $response["status"] = "fail";
    $response["msg"] = "Your authorization token is required.";
    echo json_encode($response);
    exit();
}

// -------------------------------------------------------------------
// Get The Request Details
// -------------------------------------------------------------------

$input = @file_get_contents("php://input");
// decode the json file
$body = json_decode($input);

// Support Other API Format
$body2 = array();
if (!isset($body->ref)) {
    $body2["ref"] = time();
}
if (isset($body->sender)) {
    $body2["sender"] = $body->sender;
}
$body = (object)array_merge((array)$body, $body2);

$phone = (isset($body->phone)) ? $body->phone : "";
$message = (isset($body->message)) ? $body->message : "";
$amount = (isset($body->amount)) ? $body->amount : "";
$ref = (isset($body->ref)) ? $body->ref : "";
$sender = (isset($body->sender)) ? $body->sender : "";

// -------------------------------------------------------------------
// Check Inputs Parameters
// -------------------------------------------------------------------

$requiredField = "";
if ($ref == "") {
    $requiredField = "Ref Is Required";
}
if ($amount == "") {
    $requiredField = "Amount Is Required";
}
if ($message == "") {
    $requiredField = "Message Is Required";
}
if ($phone == "") {
    $requiredField = "Phone Number Is Required";
}
if ($sender == "") {
    $requiredField = "Sender Name Is Required";
}

if ($requiredField <> "") {
    header('HTTP/1.0 400 Parameters Required');
    $response['status'] = "fail";
    $response['msg'] = $requiredField;
    echo json_encode($response);
    exit();
}

//Compute Amount To Pay
$quantity = (int)$quantity;
$amount = (float)$amount;

$buyprice = $buyprice * $quantity;
$discount = 99 / 100 * $amount;
//Compute Profit
$amountopay = $amount;
$profit = 0;

$plandesc = "Send of Bulk SMS with the sender name: " . $sender . ".";

$thedatasize = "tyyuuiibbh";

// -------------------------------------------------------------------
// Check Id User Balance Can Perform The Transaction
// -------------------------------------------------------------------

if ($amountopay > $userbalance || $amountopay < 0) {
    header('HTTP/1.0 400 Insufficient Balance');
    $response['status'] = "fail";
    $response['msg'] = "Insufficient balance fund your wallet and try again";
    echo json_encode($response);
    exit();
}

// -------------------------------------------------------------------
// Check For Api Authorization
// -------------------------------------------------------------------

$result = $controller->checkIfTransactionExist($ref);
if ($result["status"] == "fail") {
    header('HTTP/1.0 400 Transaction Ref Already Exist');
    $response['status'] = "fail";
    $response['msg'] = "Transaction Ref Already Exist";
    echo json_encode($response);
    exit();
}

// -------------------------------------------------------------------
// Purchase Data
// -------------------------------------------------------------------
// -------------------------------------------------------------------

$servicename = "Bulk SMS";
$servicedesc = $plandesc;

$result = $controller->checkTransactionDuplicate($servicename, $servicedesc);
if ($result["status"] == "fail") {
    header('HTTP/1.0 400 Possible Transaction Duplicate, Please Verify Transaction & Try Again After 60 Seconds');
    $response['status'] = "fail";
    $response['msg'] = "Possible Transaction Duplicate, Please Verify Transaction & Try Again After 60 Seconds";
    echo json_encode($response);
    exit();
}

// Debit User Before Performing The Transaction
$oldbalance = (float)$userbalance;
$deibt = $oldbalance - $amountopay;

$checkDebit = $controller->debitUserBeforeTransaction($userid, $deibt);

if ($checkDebit <> "success") {
    header('HTTP/1.0 400 Could Not Complete Transaction');
    $response['status'] = "fail";
    $response['msg'] = "Could Not Complete Transaction";
    echo json_encode($response);
    exit();
}

// -------------------------------------------------------------------
// Record Transaction As Processing With Status 5
// -------------------------------------------------------------------
$transRecord = $controller->recordTransaction($userid, $servicename, $servicedesc, $amountopay, $userbalance, $body->ref, "5");

// -------------------------------------------------------------------
// Send Request To Purchase Recharge Pin
// -------------------------------------------------------------------
$result = $controller2->purchasebulksms($body);

// -------------------------------------------------------------------
// Debit User Wallet & Record Transaction
// -------------------------------------------------------------------

if ($result["status"] == "success") {
    if ($refearedby <> "") {
        $controller->creditReferalBonus($referal, $referalname, $refearedby, $servicename);
    }
    $controller->updateTransactionStatus($userid, $body->ref, $amountopay, "0");
    $controller->saveProfit($body->ref, $profit);
    $controller->savebulksms($userid, $body->ref, $result["sender_name"], $result["numbers"], $result["message"], $result["total_correct_number"], $result["total_wrong_number"], $result["total_number"]);
    $response['status'] = "success";
    $response['Status'] = "successful";
    $response["amount"] = $result->amount;
    $response["total_number"] = $result->total_number;
    $response["total_correct_number"] = $result->total_correct_number;
    $response["total_wrong_number"] = $result->total_wrong_number;
    $response["message"] = $result->message;
    $response["sender_name"] = $result->sender_name;
    $response["numbers"] = $result->numbers;
    header('HTTP/1.0 200 Transaction Successful');
    echo json_encode($response);
    exit();
} else {
    header('HTTP/1.0 400 Transaction Failed');
    $response['status'] = "fail";
    $response['Status'] = "failed";
    $response['msg'] = $result["msg"];
    $controller->updateTransactionStatus($userid, $body->ref, $amountopay, "1");
    echo json_encode($response);
    exit();
}
?>
