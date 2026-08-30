<?php

    class NIN extends ApiAccess{

        //Purchase Airtime
		public function verifyMyNIN($body,$networkDetails){

            $details=$this->model->getApiDetails();
 
          
            //Get Api Key Details
            //$host = $this->getConfigValue($details,$networkname.$name."Provider");
            //$apiKey = $this->getConfigValue($details,$networkname.$name."Key");
            $slip = $body->slip;
            $nin = $body->phone;
            
            $load = json_encode(
	            array(
	                "nin" => $body->phone,
					"consent" => true
				));
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.aspget.com/nin/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$load,
             
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "Authorization: Bearer lv_aspget_a9wmdkr15h3cex8z1q435fsgtb097n71"
            ),
            ));

            $exereq = curl_exec($curl);

            $err = curl_error($curl);
   
            if($err){
                $response["status"] = "fail";
                $response["msg"] = "Server Connection Error";
                file_put_contents("airtime_error_log2.txt",json_encode($response).$err);
                curl_close($curl);
                return $response;
            }

            $result=json_decode($exereq);
            curl_close($curl);

            if($result->status==true || $result->status=='success'){
                $response["status"] = "success";
                $placeholder = $result->data->firstname;
                $response2 = json_encode($result->data);
                $this->model->recordReport($body->userID,$body->ref,$placeholder,$result->data->nin,$response2,$slip,'YET');
                
                $conn = mysqli_connect("localhost","eplxbrcj_dataflex","N((.eN6)P)GX","eplxbrcj_dataflex");   
                
                $url = "https://webtopdf.com/Controllers/Convert.ashx";
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $headers = array(
                   "Content-Type: application/json",
                );
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                $uslip = "https://dataflex.ng/slips/nin/{$slip}/?reportID=".$body->ref."&preview=1";
                $data = '
                {
                    "filepath":"'.$uslip.'",
                    "pagesize":"A4",
                    "width":"",
                    "height":"",
                    "landscape":"false",
                    "leftmargin":"12",
                    "topmargin":"12",
                    "rightmargin":"12",
                    "bottommargin":"14",
                    "htmlzoom":"100",
                    "header":"",
                    "footer":"",
                    "pw":"",
                    "permissions":"011",
                    "type":"PDF",
                    "useprintmedia":"true",
                    "noscript":"false",
                    "nolink":"false",
                    "pagenumber":"false",
                    "grayscale":"false",
                    "bookmark":"false",
                    "minloadwaittime":"8",
                    "wmtext":"",
                    "wmfonttype":"0",
                    "wmfontsize":"14",
                    "wmfontbold":"false",
                    "wmfontitalic":"false",
                    "wmfontcolor":"000000",
                    "wmprefixtype":"0",
                    "wmopacity":"100",
                    "wmrotationtype":"0",
                    "wmbkmode":"0",
                    "curUrl":"/",
                    "zipmode":"0",
                    "convertemode":"00"
                }';
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                $resp = curl_exec($curl);
                //die($resp);
                curl_close($curl);
                $respJ = json_decode($resp);
                $pdfName = $body->ref.'.pdf';
                if($respJ->convertedFilePath){
                    $ch = curl_init();
                    $url = "https://webtopdf.com/RESULT/".$respJ->convertedFilePath;
                    curl_setopt($ch, CURLOPT_URL,$url);
                    $fp = fopen("../../slips/nin/{$slip}/".$pdfName, 'w+');
                    curl_setopt($ch, CURLOPT_FILE, $fp);
                    curl_exec ($ch);
                    curl_close ($ch);
                    fclose($fp);
                    $pdfURL = "https://dataflex.ng/slips/nin/{$slip}/".$pdfName;
                    mysqli_query($conn, "UPDATE reports SET pdf = '$pdfURL' WHERE transid = '$body->ref'");
                }
            }
            elseif($result->Status=='processing' || $result->Status=='process'){
                $response["status"] = "processing";
                file_put_contents("airtime_processing_log.txt",json_encode($result));
            }
            elseif($result->status==false || $result->status=='fail'){
                $response["status"] = "fail";
                $response["msg"] = "Unable to validate NIN number";
                file_put_contents("nin_failed.txt",json_encode($result));
            }
            else{
                $response["status"] = "processing";
                file_put_contents("airtime_processing_log.txt",json_encode($result));
            }

            return $response;
		}

     
    }

?>