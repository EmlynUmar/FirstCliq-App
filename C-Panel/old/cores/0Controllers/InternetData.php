<?php

    class InternetData extends ApiAccess{
        

         //Purchase Data
		public function purchaseData($body,$networkDetails,$datagroup,$actualPlanId){

			$response = array();
            $details=$this->model->getApiDetails();

             //Check Data Group Type
        if ($datagroup == "SME") {
            $name = "Sme";
            $thenetworkId = $networkDetails["smeId"];
        } elseif ($datagroup == "SME2") {
            $name = "Sme2";
            $thenetworkId = $networkDetails["sme2Id"];
        } elseif ($datagroup == "Gifting") {
            $name = "Gifting";
            $thenetworkId = $networkDetails["giftingId"];
       
        } elseif ($datagroup == "Corporate") {
            $name = "Corporate";
            $thenetworkId = $networkDetails["corporateId"];
        } else {
            $name = "Coupon";
            $thenetworkId = $networkDetails["couponId"];
        }
            //Get Api Key Details
            $networkname = strtolower($networkDetails["network"]);
            $host = $this->getConfigValue($details,$networkname.$name."Provider");
            $apiKey = $this->getConfigValue($details,$networkname.$name."Api");

            //Check If API Is Is Using N3TData Or Bilalsubs
            if(strpos($host, 'n3tdata247') !== false){
                $hostuserurl="https://n3tdata247.com/api/user/";
                return $this->purchaseDataWithBasicAuthentication($body,$host,$hostuserurl,$apiKey,$thenetworkId,$actualPlanId);
            }

            if(strpos($host, 'n3tdata') !== false){
                $hostuserurl="https://n3tdata.com/api/user/";
                return $this->purchaseDataWithBasicAuthentication($body,$host,$hostuserurl,$apiKey,$thenetworkId,$actualPlanId);
            }

           
            if(strpos($host, 'bilalsadasub') !== false){
                $hostuserurl="https://bilalsadasub.com/api/user/";
                return $this->purchaseDataWithBasicAuthentication($body,$host,$hostuserurl,$apiKey,$thenetworkId,$actualPlanId);
            }
            
            if(strpos($host, 'legitdataway') !== false){
                $hostuserurl="https://legitdataway.com/api/user/";
                return $this->purchaseDataWithBasicAuthentication($body,$host,$hostuserurl,$apiKey,$thenetworkId,$actualPlanId);
            }
            
            if(strpos($host, 'nabatulusub') !== false){
                $hostuserurl="https://nabatulusub.com/api/user/";
                return $this->purchaseDataWithBasicAuthentication($body,$host,$hostuserurl,$apiKey,$thenetworkId,$actualPlanId);
            }
            
            if(strpos($host, 'azaravtu') !== false){
                return $this->purchaseDataWithAzaravtu($body,$host,$apiKey,$thenetworkId,$actualPlanId,$networkDetails["network"]);
            }
            
            // ------------------------------------------
            //  Purchase Data maskawa/abbatech
            // ------------------------------------------
            
            if($body->ported_number == "true"){$ported_number="true";} else{$ported_number="true";}

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
                "mobile_number": "'.$body->phone.'",
                "Ported_number":'.$ported_number.',
                "request-id" : "'.$body->ref.'",
                "plan": "'.$actualPlanId.'"
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
                file_put_contents("abbatec/data_error_log2.txt",json_encode($response)." ".$err." ".$host);
                curl_close($curl);
                return $response;
            }

            $result=json_decode($exereq);
            curl_close($curl);
            

            if ($result->Status == 'successful' || $result->Status == 'processing') {
            $response["status"] = "success";
                if(isset($result->api_response)){$response["api_response"] = $result->api_response;}
                 file_put_contents("maskawa_abbatech_data_succeful_log.txt", json_encode($result));
            } elseif ($result->Status == 'failed') {
            $response["status"] = "fail";
            $response["msg"] = "Network Error, Please Try Again Later.....";
        } else {
            $response["status"] = "fail";
            $response["msg"] = "Server/Network Error-   ".$result->error[0];
            file_put_contents("maskawa_abbatech_data_error_log.txt", json_encode($result));
        }

            return $response;
		}

        //Purchase Data
		public function purchaseDataWithBasicAuthentication($body,$host,$hostuserurl,$apiKey,$thenetworkId,$actualPlanId){

			$response = array();
            

            // ------------------------------------------
            //  Get User Access Token
            // ------------------------------------------
            
            if($body->ported_number == "false"){$ported_number=false;} else{$ported_number=true;}

            $curlA = curl_init();
                curl_setopt($curlA, CURLOPT_URL, $hostuserurl);
                curl_setopt($curlA, CURLOPT_POST, 1);
                curl_setopt($curlA, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt(
                   $curlA, CURLOPT_HTTPHEADER, [
                        "Authorization: Basic $apiKey",
                    ]
                );
            
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
            //  Purchase Data n3tdata
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
                "phone": "'.$body->phone.'",
                "bypass":true,
                "request-id" : "'.$body->ref.'",
                "data_plan": "'.$actualPlanId.'"
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
                file_put_contents("n3t_basic_error_log2.txt",json_encode($response));
                curl_close($curl);
                return $response;
            }

            $result=json_decode($exereq);
            curl_close($curl);
            

                        if ($err) {
            $response["status"] = "fail";
            $response["msg"] = "Server Connection Error"; //.$err;
            file_put_contents("basic_error_log2.txt", json_encode($response));
            curl_close($curl);
            return $response;
        }

        $result = json_decode($exereq);
        curl_close($curl);


        if ($result->status == 'success' || $result->status == 'success') {
            $response["status"] = "success";
            if(isset($result->message)){$response["message"] = $result->message;}
                 file_put_contents("n3tdata_data_succeful_log.txt", json_encode($result));
        } elseif ($result->status == 'fail') {
            $response["status"] = "fail";
            $response["msg"] = "Network Error, Please Try Again Later";
        } else {
            $response["status"] = "fail";
            $response["msg"] = "Server/Network Error";
            file_put_contents("basic_data_error_log.txt", json_encode($result));
        }

        return $response;
    }

        public function purchaseDataSMEPlug($body,$host,$apiKey,$thenetworkId,$actualPlanId){
		    
		    $response = array();
		    
		    
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
                "network_id": "'.$thenetworkId.'",
                "plan_id": "'.$actualPlanId.'",
                "phone": "'.$body->phone.'",
                "customer_reference": "'.$body->ref.'"
            }',
            
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "Authorization: Bearer $apiKey"
            ),
            ));

            $exereq = curl_exec($curl);
            $err = curl_error($curl);
            
            if($err){
                $response["status"] = "fail";
                $response["msg"] = "Server Connection Error: ".$err;
                file_put_contents("data_error_log2.txt",json_encode($response));
                curl_close($curl);
                return $response;
            }

            $result=json_decode($exereq);
            curl_close($curl);
            

            if($result->status == true || $result->status == "true"){
                if($result->data->current_status == "processing"){$response["status"] = "processing";}
                elseif($result->data->current_status == "failed"){$response["status"] = "fail";}
                else{$response["status"] = "success";}
                file_put_contents("smeplug_data_response.txt",json_encode($result));
            }
            else{
                $response["status"] = "fail";
                $response["msg"] = "Server/Network Error";
                file_put_contents("smeplug_data_error_log.txt",json_encode($result));
            }

            return $response;
		}
		
			//Purchase Airtime
		public function purchaseDataSimhost($body,$network,$dataplan,$apiKey){

			$host = "https://simhostng.com/api/sms/";
            $callbackUrl ="https://website.com/webhook/hostmasterresponse/";
            
            if($network == 1){
                $message="";
                if($dataplan == 1){$message ="SMEB ".$body->phone." 500 5818";}
                if($dataplan == 2){$message ="SMEC ".$body->phone." 1000 5818";}
                if($dataplan == 3){$message ="SMED ".$body->phone." 2000 5818";}
                if($dataplan == 4){$message ="SMEF ".$body->phone." 3000 5818";}
                if($dataplan == 5){$message ="SMEE ".$body->phone." 5000 5818";}
                if($dataplan == 6){$message ="SMEG ".$body->phone." 10000 5818";}
                $message=urlencode($message);
                $network = "MOMTNBPVR"; $sim=1; $number="131"; 
            }
            
            $postfields="?apikey=$apiKey&server=$network&sim=$sim&ref=$body->ref&number=$number&message=$message";
            $host.=$postfields;
            
            // ------------------------------------------
            //  Purchase Airtime
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
            CURLOPT_POSTFIELDS => array(
                "apikey" => $apiKey,
                "server" => $network,
                "sim" => $sim,
                "number" => $number,
                "message" => $message,
                "ref" => $body->ref
            ),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
            ));

            $exereq = curl_exec($curl);

            $err = curl_error($curl);
            
            if($err){
                $response["status"] = "fail";
                $response["msg"] = "Server Connection Error: ".$err;
                file_put_contents("data_simhost_error_logo2.txt",json_encode($response));
                curl_close($curl);
                return $response;
            }

            $result=json_decode($exereq);
            curl_close($curl);

            if($result->data[0]->response == "Ok"){
                $response["status"] = "processing";
            }
            else{
                $response["status"] = "fail";
                $response["msg"] = "Server/Network Error";
                file_put_contents("data_simhost_error_logo.txt",json_encode($result).":".$host.":".$exereq);
            }

            return $response;
		}

        //Purchase Data From Azaravtu
		public function purchaseDataWithAzaravtu($body,$host,$apiKey,$thenetworkId,$actualPlanId,$networkname){

			$response = array();
            

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
                "network_id": "'.$thenetworkId.'",
                "number": "'.$body->phone.'",
                "pin":"5027",
                "id": "'.$actualPlanId.'"
            }',
            
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "Authorization: Bearer $apiKey"
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
            

            if($result->status=='success'){
                $response["status"] = "success";
                if(isset($result->remark)){$response["api_response"] = $networkname." ".$body->phone.": ".$result->remark;}
            }
            elseif($result->status=='pending'){
                $response["status"] = "processing";
                if(isset($result->remark)){$response["api_response"] = $networkname." ".$body->phone.": ".$result->remark;}
                file_put_contents("data_processing_log.txt",json_encode($result));
            }
            else{
                $response["status"] = "fail";
                $response["msg"] = "Server/Network Error";
                if(isset($result->remark)){$response["api_response"] = $networkname." ".$body->phone.": ".$result->remark;}
                file_put_contents("basic_data_error_log.txt",json_encode($result));
            }

            return $response;
		}

        
        

    }

?>