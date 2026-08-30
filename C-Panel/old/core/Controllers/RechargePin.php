
<?php

class RechargePin extends ApiAccess{
    

     //Purchase Data
    public function purchaseRechargePin($body,$networkDetails,$planid,$networkk){

        $response = array();
        $details=$this->model->getApiDetails();
        //$thenetworkId=$networkDetails["networkid"];
        $thenetworkId = $networkk;
        //Get Api Key Details
       $host = $this->getConfigValue($details,"rechargePinProvider");
      $apiKey = $this->getConfigValue($details,"rechargePinApi");
       // $host = "https://bilalsadasub.com/api/recharge_card/";
        //$apiKey ="86caeae13501931f89e4119c3c68963d224304c37ec02036f1beab35f79d";
 //$host = "https://subarena.com/api/rechargepin/";
//$apiKey = "406f14e062198e163707674be42b801a330d650a" ;
        //Check If API Is Is Using N3TData Or Bilalsubs
        if(strpos($host, 'n3tdata247') !== false){
            $hostuserurl="https://n3tdata247.com/api/user/";
            return $this->purchaseDataWithBasicAuthentication($body,$host,$hostuserurl,$apiKey,$thenetworkId,$actualPlanId,$planid);
        }

        if(strpos($host, 'bilalsaudasub') !== false){
            $hostuserurl="https://bilalsadasub.com/api/user/";
            return $this->purchaseDataWithBasicAuthentication($body,$host,$hostuserurl,$apiKey,$thenetworkId,$actualPlanId,$planid);
        }

        if(strpos($host, 'nabatulusub') !== false){
            $hostuserurl="https://nabatulusub.com/api/user/";
            return $this->purchaseDataWithBasicAuthentication($body,$host,$hostuserurl,$apiKey,$thenetworkId,$actualPlanId);
        }
        
        // ------------------------------------------
        //  Purchase Data
        // ------------------------------------------
        
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $host,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "network": "'.$thenetworkId.'",
            
            "network_amount" : "'.$planid.'",
            "quantity": "'.$body->quantity.'", 
             
            "name_on_card": "'.$body->name_on_card.'"
        }',
        
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            "Authorization: Token $apiKey"
        ),
        ));

        $exereq = curl_exec($curl);
        $err = curl_error($curl);
        
        if($err){
            $response["status"] = "fail";
            $response["msg"] = "Server Connection Error"; //.$err;
            file_put_contents("data_error_log2.txt",json_encode($response)." ".$err." ".$host);
            curl_close($curl);
            return $response;
        }

        $result=json_decode($exereq);
        curl_close($curl);
        

        if ($result->Status == 'successful' || $result->status == 'processing') {
$response["Status"] = "successful";
$response["status"] = "success";
$response["quantity"] = $result->quantity;
$response["network"] = $result->network_name;

// Initialize empty strings for serial, pin, and a single load_pin
$response["serial"] = "";
$response["pin"] = "";
$load_pin = ""; // Variable to store a single load_pin

// Loop through the data_pin array
foreach ($result->data_pin as $index => $pinData) {
    // Concatenate serial and pin with commas
    $response["serial"] .= $pinData->fields->serial . ($index < count($result->data_pin) - 1 ? "," : "");

    // Check if data_pin contains more than one array before applying str_replace
    if (count($result->data_pin) > 1) {
        $response["pin"] .= str_replace('\\r', '', $pinData->fields->pin) . ($index < count($result->data_pin) - 1 ? "," : "");
    } else {
        $response["pin"] .= $pinData->fields->pin . ($index < count($result->data_pin) - 1 ? "," : "");
    }

    // Store the load_pin for the same network only once
    if ($index == 0) {
        $load_pin = $pinData->fields->load_code;
    }
}

// Set the load_pin value
$response["load_pin"] = $load_pin;

} elseif ($result->status == 'fail') {
    $response["status"] = "fail";
    $response["msg"] = "Network Error, Please Try Again Later";
} else {
    $response["status"] = "fail";
    $response["msg"] = "Server/Network Error: ".$result->error[0];
    file_put_contents("data_error_log.txt", json_encode($result));
}

return $response;

    }

    //Purchase Data
    public function purchaseDataWithBasicAuthentication($body,$host,$hostuserurl,$apiKey,$thenetworkId,$actualPlanId,$planid){

        $response = array();
        
        // ------------------------------------------
        //  Get User Access Token
        // ------------------------------------------
        
        
        $curlA = curl_init();
        curl_setopt_array($curlA, array(
            CURLOPT_URL => $hostuserurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => 1,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Token $apiKey",
            ),
        ));
    
        $exereqA = curl_exec($curlA);
        $err = curl_error($curlA);
        
        if($err){
            $response["status"] = "fail";
            $response["msg"] = "Server Connection Error"; //.$err;
            curl_close($curlA);
            return $response;
        }
        $resultA=json_decode($exereqA);
        $apiKey=$resultA->AccessToken;
        curl_close($curlA);
    
        
        // ------------------------------------------
        //  Purchase Data
        // ------------------------------------------
    
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $host,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "network": "'.$thenetworkId.'",
            "card_name": "'.$body->business.'",
            "plan_type" : "'.$planid.'",
            "quantity": "'.$body->quantity.'"
            
        }',
        
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            "Authorization: Token $apiKey"
        ),
        ));

        $exereq = curl_exec($curl);
        $err = curl_error($curl);
        
        if($err){
            $response["status"] = "fail";
            $response["msg"] = "Server Connection Error"; //.$err;
            file_put_contents("basic_error_log2.txt",json_encode($response));
            curl_close($curl);
            return $response;
        }

        $result=json_decode($exereq);
        curl_close($curl);
        
        if($result->status=='successful' || $result->status=='success'){
            $response["status"] = "success";
            $response["load_pin"] = $result->load_pin ;
            $response["quantity"] = $result->quantity;
            $response["serial"] = $result->serial;
            $response["network"] = $result->network;
            $response["pin"] = $result->pin;
        }
        elseif($result->status=='fail'){
            $response["status"] = "fail";
            $response["msg"] = "Network Error, Please Try Again Later";
             file_put_contents("rechargepin_error_log.txt",json_encode($result));
        }
        else{
            $response["status"] = "fail";
            $response["msg"] = "Servcer Error: ".$result->message;
            file_put_contents("basic_data_error_log.txt",json_encode($result));
        }

        return $response;
    }
    

}

?>