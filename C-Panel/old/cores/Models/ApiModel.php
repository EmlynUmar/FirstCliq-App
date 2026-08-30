<?php

	class ApiModel extends Model{ 

		//----------------------------------------------------------------------------------------------------------------
		// API Access Management
		//----------------------------------------------------------------------------------------------------------------

        //Send Email Notification
        public function sendEmailNotification($subject,$message,$email){
            $subject.= "(".$this->sitename.")";
			$this->sendMail($email,$subject,$message);
        }
        
		//Validate API Token
		public function validateAccessToken($token){
			$dbh=$this->connect();
			$sql = "SELECT * FROM subscribers WHERE sApiKey=:token AND sRegStatus='0'";
            $query = $dbh->prepare($sql);
            $query->bindParam(':token',$token,PDO::PARAM_STR);
            $query->execute();
            $result=$query->fetch(PDO::FETCH_OBJ);
            if($query->rowCount() > 0){return $result;} else{return 1;}
		}

        //Get User Details
		public function getUserDetails($token){
			$dbh=$this->connect();
			$sql = "SELECT * FROM subscribers WHERE sApiKey=:token AND sRegStatus='0'";
            $query = $dbh->prepare($sql);
            $query->bindParam(':token',$token,PDO::PARAM_STR);
            $query->execute();
            $result=$query->fetch(PDO::FETCH_OBJ);
            return $result;
		}
 
        //Verify Network Id
		public function verifyNetworkId($network){
			$dbh=$this->connect();
            $network = (int) $network;
			$sql = "SELECT * FROM  networkid WHERE nId=:network";
            $query = $dbh->prepare($sql);
            $query->bindParam(':network',$network,PDO::PARAM_INT);
            $query->execute();
            if($query->rowCount() > 0){
                $result=$query->fetch(PDO::FETCH_OBJ);
                return $result;
            } 
            else{return 1;}
            
		}

        //Verify Data Plan Id
		public function verifyDataPlanId($network,$data_plan){
			$dbh=$this->connect();
			$sql = "SELECT * FROM dataplans WHERE datanetwork=:network AND pId=:plan ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':network',$network,PDO::PARAM_STR);
            $query->bindParam(':plan',$data_plan,PDO::PARAM_STR);
            $query->execute();
            if($query->rowCount() > 0){
                $result=$query->fetch(PDO::FETCH_OBJ);
                return $result;
            } 
            else{return 1;}
            
		}

         //Verify Data Plan Id
		public function verifyDataPinId($network,$data_plan){
			$dbh=$this->connect();
			$sql = "SELECT * FROM datapins WHERE datanetwork=:network AND dpId=:plan ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':network',$network,PDO::PARAM_STR);
            $query->bindParam(':plan',$data_plan,PDO::PARAM_STR);
            $query->execute();
            if($query->rowCount() > 0){
                $result=$query->fetch(PDO::FETCH_OBJ);
                return $result;
            } 
            else{return 1;}
            
		}


        //Verify Electricity Id
		public function verifyElectricityId($provider){
			$dbh=$this->connect();
			$sql = "SELECT * FROM electricityid WHERE eId=:providers ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':providers',$provider,PDO::PARAM_STR);
            $query->execute();
            if($query->rowCount() > 0){
                $result=$query->fetch(PDO::FETCH_OBJ);
                return $result;
            } 
            else{return 1;}
             
		}

        //Verify Exam Id
		public function verifyExamId($provider){
			$dbh=$this->connect();
			$sql = "SELECT * FROM examid WHERE eId=:providers ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':providers',$provider,PDO::PARAM_STR);
            $query->execute();
            if($query->rowCount() > 0){
                $result=$query->fetch(PDO::FETCH_OBJ);
                return $result;
            } 
            else{return 1;}
            
		}

        //Verify Cable Id
		public function verifyCableId($provider){
			$dbh=$this->connect();
			$sql = "SELECT * FROM cableid WHERE cId=:providers ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':providers',$provider,PDO::PARAM_STR);
            $query->execute();
            if($query->rowCount() > 0){
                $result=$query->fetch(PDO::FETCH_OBJ);
                return $result;
            } 
            else{return 1;}
            
		}

        //Verify Cable Plan Id
		public function verifyCablePlanId($provider,$plan){
			$dbh=$this->connect();
			$sql = "SELECT * FROM cableplans WHERE cableprovider=:provider AND cpId=:plan ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':provider',$provider,PDO::PARAM_STR);
            $query->bindParam(':plan',$plan,PDO::PARAM_STR);
            $query->execute();
            if($query->rowCount() > 0){
                $result=$query->fetch(PDO::FETCH_OBJ);
                return $result;
            } 
            else{return 1;}
             
		}

        //Calculate Airtime Discount
		public function calculateAirtimeDiscount($network,$airtime_type){
			$dbh=$this->connect();
			$sql = "SELECT * FROM airtime WHERE aNetwork=:n AND aType=:ty";
            $query = $dbh->prepare($sql);
            $query->bindParam(':n',$network,PDO::PARAM_INT);
            $query->bindParam(':ty',$airtime_type,PDO::PARAM_STR);
            $query->execute();
            $result=$query->fetch(PDO::FETCH_OBJ);
            return $result;
		}
		
         // Calculate Recharge Pin Discount
       public function calculateRechargePinDiscount($network){
           $dbh = $this->connect();
           $sql = "SELECT * FROM airtimepinprice a, networkid b WHERE a.aNetwork=b.networkid AND a.aNetwork=:n";
           $query = $dbh->prepare($sql);
           $query->bindParam(':n', $network, PDO::PARAM_INT);
           $query->execute();
           $result = $query->fetch(PDO::FETCH_OBJ);
         return $result;
       }
       
       
        //Check If Transaction Exist
		public function checkIfTransactionExist($ref){
			$dbh=$this->connect();
			$sql = "SELECT * FROM transactions WHERE transref=:ref";
            $query = $dbh->prepare($sql);
            $query->bindParam(':ref',$ref,PDO::PARAM_STR);
            $query->execute();
            $result=$query->fetch(PDO::FETCH_OBJ);
            if($query->rowCount() > 0){return 0;} else{return 1;}
		}

        //Check For Transaction Duplicate
		public function checkTransactionDuplicate($servicename,$servicedesc){
			$dbh=$this->connect();
			$sql = "SELECT date FROM transactions WHERE servicename=:sn AND servicedesc=:sd ORDER BY tId DESC LIMIT 1";
            $query = $dbh->prepare($sql);
            $query->bindParam(':sn',$servicename,PDO::PARAM_STR);
            $query->bindParam(':sd',$servicedesc,PDO::PARAM_STR);
            $query->execute();
            $result=$query->fetch(PDO::FETCH_OBJ);
            if($query->rowCount() > 0){return $result;} else{return 1;}
		}

        //Get API Details
		public function getApiDetails(){
			$dbh=$this->connect();
			$sql = "SELECT * FROM apiconfigs";
            $query = $dbh->prepare($sql);
            $query->execute();
            $result=$query->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }

        //Get Site Settings Details
		public function getSiteSettings(){
			$dbh=$this->connect();
            $sqlA = "SELECT * FROM sitesettings WHERE sId=1";
            $queryA = $dbh->prepare($sqlA); $queryA->execute();
            $siteData=$queryA->fetch(PDO::FETCH_OBJ);
            return $siteData;
		}
 
        //Debit User BeforeTransaction
        public function debitUserBeforeTransaction($userid,$deibt){
            $dbh=$this->connect();
			$userid=(float) $userid;
            $sqlD = "UPDATE subscribers SET sWallet=:nb WHERE sId=:id";
            $queryD = $dbh->prepare($sqlD);
            $queryD->bindParam(':id',$userid,PDO::PARAM_INT);
            $queryD->bindParam(':nb',$deibt,PDO::PARAM_STR);
            if($queryD->execute()){return "success";}else{return "fail";}
        }

        //Save Profit
        public function saveProfit($ref,$profit){
            $dbh=$this->connect();
			$sqlD = "UPDATE transactions SET profit=:p WHERE transref=:ref";
            $queryD = $dbh->prepare($sqlD);
            $queryD->bindParam(':p',$profit,PDO::PARAM_STR);
            $queryD->bindParam(':ref',$ref,PDO::PARAM_STR);
            if($queryD->execute()){return "success";}else{return "fail";}
        }

        //Save Data Pin
        public function saveDataPin($userid,$ref,$business,$networkname,$dataplansize,$quantity,$serial,$pin,$load_pin,$check_balance){
            $dbh=$this->connect();
			$sql = "INSERT INTO datatokens SET sId=:user,tRef=:ref,business=:b,network=:net,datasize=:size,quantity=:q,serial=:s,tokens=:t,loadpin=:loadpin,checkbalance=:checkbalance";
            $query = $dbh->prepare($sql);
            $query->bindParam(':user',$userid,PDO::PARAM_INT);
            $query->bindParam(':ref',$ref,PDO::PARAM_STR);
            $query->bindParam(':q',$quantity,PDO::PARAM_STR);
            $query->bindParam(':s',$serial,PDO::PARAM_STR);
            $query->bindParam(':t',$pin,PDO::PARAM_STR);
            $query->bindParam(':b',$business,PDO::PARAM_STR);
            $query->bindParam(':net',$networkname,PDO::PARAM_STR);
            $query->bindParam(':size',$dataplansize,PDO::PARAM_STR);
            $query->bindParam(':loadpin',$load_pin,PDO::PARAM_STR);
            $query->bindParam(':checkbalance',$check_balance,PDO::PARAM_STR);
            $query->execute();

            $lastInsertId = $dbh->lastInsertId();
			if($lastInsertId){return 0;}else{return 1;}
        }

//Save Recharge Pin
        public function saveRechargePin($userid,$ref,$business,$networkname,$dataplansize,$quantity,$serial,$pin){
            $dbh=$this->connect();
			$sql = "INSERT INTO rechargetokens SET sId=:user,tRef=:ref,business=:b,network=:net,datasize=:size,quantity=:q,serial=:s,tokens=:t";
            $query = $dbh->prepare($sql);
            $query->bindParam(':user',$userid,PDO::PARAM_INT);
            $query->bindParam(':ref',$ref,PDO::PARAM_STR);
            $query->bindParam(':q',$quantity,PDO::PARAM_STR);
            $query->bindParam(':s',$serial,PDO::PARAM_STR);
            $query->bindParam(':t',$pin,PDO::PARAM_STR);
            $query->bindParam(':b',$business,PDO::PARAM_STR);
            $query->bindParam(':net',$networkname,PDO::PARAM_STR);
            $query->bindParam(':size',$dataplansize,PDO::PARAM_STR);
            $query->execute();

            $lastInsertId = $dbh->lastInsertId();
			if($lastInsertId){return 0;}else{return 1;}
        }

        //Record Monnify Transaction 
		public function recordMonnifyTransaction($userid,$servicename,$servicedesc,$ref,$amountopay,$oldbalance,$newbalance,$status){
			$dbh=$this->connect();
			$userid=(float) $userid;
			$status=(float) $status;
            $date=date("Y-m-d H:i:s");
            
            
            
            //Check If Discount Already Exist
			$queryC=$dbh->prepare("SELECT transref FROM transactions WHERE transref=:transref");
			$queryC->bindParam(':transref',$ref,PDO::PARAM_STR);
			$queryC->execute();
			if($queryC->rowCount() > 0){return 1;}
			
            //If transaction was successful, debit user wallet
            $sqlD = "UPDATE subscribers SET sWallet=:nb WHERE sId=:id";
            $queryD = $dbh->prepare($sqlD);
            $queryD->bindParam(':id',$userid,PDO::PARAM_INT);
            $queryD->bindParam(':nb',$newbalance,PDO::PARAM_STR);
            $queryD->execute();

            //Record Transaction
			$sql = "INSERT INTO transactions SET sId=:user,transref=:ref,servicename=:sn,servicedesc=:sd,amount=:a,status=:s,oldbal=:ob,newbal=:nb,date=:d";
            $query = $dbh->prepare($sql);
            $query->bindParam(':user',$userid,PDO::PARAM_INT);
            $query->bindParam(':ref',$ref,PDO::PARAM_STR);
            $query->bindParam(':sn',$servicename,PDO::PARAM_STR);
            $query->bindParam(':sd',$servicedesc,PDO::PARAM_STR);
            $query->bindParam(':a',$amountopay,PDO::PARAM_STR);
            $query->bindParam(':s',$status,PDO::PARAM_INT);
            $query->bindParam(':ob',$oldbalance,PDO::PARAM_STR);
            $query->bindParam(':nb',$newbalance,PDO::PARAM_STR);
            $query->bindParam(':d',$date,PDO::PARAM_STR);
            $query->execute();

            $lastInsertId = $dbh->lastInsertId();
			if($lastInsertId){return 0;}else{return 1;}
		}

        //Record Paystack Transaction 
		public function recordPaystackTransaction($userid,$servicename,$servicedesc,$ref,$amountopay,$oldbalance,$newbalance,$status){
			$dbh=$this->connect();
			$userid=(float) $userid;
			$status=(float) $status;
            $date=date("Y-m-d H:i:s");
            
            //Check If Ref Already Exist
			$queryC=$dbh->prepare("SELECT transref FROM transactions WHERE transref=:transref");
			$queryC->bindParam(':transref',$ref,PDO::PARAM_STR);
			$queryC->execute();
			if($queryC->rowCount() > 0){return 1;}
			
            //If transaction was successful, debit user wallet
            $sqlD = "UPDATE subscribers SET sWallet=:nb WHERE sId=:id";
            $queryD = $dbh->prepare($sqlD);
            $queryD->bindParam(':id',$userid,PDO::PARAM_INT);
            $queryD->bindParam(':nb',$newbalance,PDO::PARAM_STR);
            $queryD->execute();

            //Record Transaction
			$sql = "INSERT INTO transactions SET sId=:user,transref=:ref,servicename=:sn,servicedesc=:sd,amount=:a,status=:s,oldbal=:ob,newbal=:nb,date=:d";
            $query = $dbh->prepare($sql);
            $query->bindParam(':user',$userid,PDO::PARAM_INT);
            $query->bindParam(':ref',$ref,PDO::PARAM_STR);
            $query->bindParam(':sn',$servicename,PDO::PARAM_STR);
            $query->bindParam(':sd',$servicedesc,PDO::PARAM_STR);
            $query->bindParam(':a',$amountopay,PDO::PARAM_STR);
            $query->bindParam(':s',$status,PDO::PARAM_INT);
            $query->bindParam(':ob',$oldbalance,PDO::PARAM_STR);
            $query->bindParam(':nb',$newbalance,PDO::PARAM_STR);
            $query->bindParam(':d',$date,PDO::PARAM_STR);
            $query->execute();

            $lastInsertId = $dbh->lastInsertId();
			if($lastInsertId){return 0;}else{return 1;}
		}
		
			//Add Report
	
		public function recordReport($userid,$ref,$placeholder,$idNumber,$response,$slip,$pdf){
			$dbh=$this->connect();
			$userid=(float) $userid;
			$status=(float) $status;
            $date=date("Y-m-d H:i:s");

            //If transaction was successful, debit user wallet
           
            //Record Transaction
			$sql = "INSERT INTO reports SET user=:user,transid=:ref,placeholder=:placeholde,idNumber=:idnumber,response=:r,slip=:sli,pdf=:pdf,date_created=:d";
            $query = $dbh->prepare($sql);
            $query->bindParam(':user',$userid,PDO::PARAM_INT);
            $query->bindParam(':ref',$ref,PDO::PARAM_STR);
            $query->bindParam(':placeholde',$placeholder,PDO::PARAM_STR);
            $query->bindParam(':idnumber',$idNumber,PDO::PARAM_STR);
            $query->bindParam(':r',$response,PDO::PARAM_STR);
            $query->bindParam(':sli',$slip,PDO::PARAM_STR);
            $query->bindParam(':pdf',$pdf,PDO::PARAM_STR);
            $query->bindParam(':d',$date,PDO::PARAM_STR);
            $query->execute();

            $lastInsertId = $dbh->lastInsertId();
			if($lastInsertId){return 0;}else{return 1;}
		}

        //Record Transaction ANd Debit User
		public function recordTransaction($userid,$servicename,$servicedesc,$ref,$amountopay,$oldbalance,$newbalance,$status){
			$dbh=$this->connect();
			$userid=(float) $userid;
			$status=(float) $status;
            $date=date("Y-m-d H:i:s");

            //If transaction was successful, debit user wallet
            if($status == 1){ $newbalance=$oldbalance; }
            $sqlD = "UPDATE subscribers SET sWallet=:nb WHERE sId=:id";
            $queryD = $dbh->prepare($sqlD);
            $queryD->bindParam(':id',$userid,PDO::PARAM_INT);
            $queryD->bindParam(':nb',$newbalance,PDO::PARAM_STR);
            $queryD->execute();

            //Record Transaction
			$sql = "INSERT INTO transactions SET sId=:user,transref=:ref,servicename=:sn,servicedesc=:sd,amount=:a,status=:s,oldbal=:ob,newbal=:nb,date=:d";
            $query = $dbh->prepare($sql);
            $query->bindParam(':user',$userid,PDO::PARAM_INT);
            $query->bindParam(':ref',$ref,PDO::PARAM_STR);
            $query->bindParam(':sn',$servicename,PDO::PARAM_STR);
            $query->bindParam(':sd',$servicedesc,PDO::PARAM_STR);
            $query->bindParam(':a',$amountopay,PDO::PARAM_STR);
            $query->bindParam(':s',$status,PDO::PARAM_INT);
            $query->bindParam(':ob',$oldbalance,PDO::PARAM_STR);
            $query->bindParam(':nb',$newbalance,PDO::PARAM_STR);
            $query->bindParam(':d',$date,PDO::PARAM_STR);
            $query->execute();

            $lastInsertId = $dbh->lastInsertId();
			if($lastInsertId){return 0;}else{return 1;}
		}

        //Update Transaction Status
        public function updateTransactionStatus($userid,$ref,$amountopay,$status){
            $dbh=$this->connect();
			$userid=(float) $userid;
			$status=(float) $status;
			$amountopay=(float) $amountopay;

            //If Transaction Failed, Refund User Since He Ha Been Debited Already
            if($status == 1){
                $sqlW = "SELECT sWallet FROM subscribers WHERE sId=$userid";
                $queryW = $dbh->prepare($sqlW);
                $queryW->execute();
                $resultW=$queryW->fetch(PDO::FETCH_OBJ);
                $oldbalance = (float) $resultW->sWallet;
                $newbalance = $oldbalance + $amountopay;

                $sqlS = "UPDATE subscribers SET sWallet=:nb WHERE sId=:id";
                $queryS = $dbh->prepare($sqlS);
                $queryS->bindParam(':id',$userid,PDO::PARAM_INT);
                $queryS->bindParam(':nb',$newbalance,PDO::PARAM_STR);
                $queryS->execute();

                //Update Transaction Status
                $sqlD = "UPDATE transactions SET status=:status,newbal=:nb WHERE sId=:user AND transref=:ref";
                $queryD = $dbh->prepare($sqlD);
                $queryD->bindParam(':user',$userid,PDO::PARAM_INT);
                $queryD->bindParam(':nb',$newbalance,PDO::PARAM_STR);
                $queryD->bindParam(':status',$status,PDO::PARAM_INT);
                $queryD->bindParam(':ref',$ref,PDO::PARAM_STR);
                $queryD->execute();
            }
            else{
                //Update Transaction Status
                $sqlD = "UPDATE transactions SET status=:status WHERE sId=:user AND transref=:ref";
                $queryD = $dbh->prepare($sqlD);
                $queryD->bindParam(':user',$userid,PDO::PARAM_INT);
                $queryD->bindParam(':status',$status,PDO::PARAM_INT);
                $queryD->bindParam(':ref',$ref,PDO::PARAM_STR);
                $queryD->execute();
            }
        }

        //----------------------------------------------------------------------------------------------------------------
		// Referal Bonus
		//----------------------------------------------------------------------------------------------------------------
		 
		public function creditReferalBonus($referal,$referalname,$refearedby,$service){
            $dbh=$this->connect();

            //Get Site Details
            $sqlA = "SELECT * FROM sitesettings WHERE sId=1";
            $queryA = $dbh->prepare($sqlA); $queryA->execute();
            $siteData=$queryA->fetch(PDO::FETCH_OBJ);

            //Determine Referal Bonus
            if($service == "Airtime"){$refbonus = (float) $siteData->referalairtimebonus;}
            elseif($service == "Data"){$refbonus = (float) $siteData->referaldatabonus;}
            elseif($service == "Cable TV"){$refbonus = (float) $siteData->referalcablebonus;}
            elseif($service == "Exam Pin"){$refbonus = (float) $siteData->referalexambonus;}
            elseif($service == "Electricity Bill"){$refbonus = (float) $siteData->referalmeterbonus;}
            else{$refbonus = 0;}

            //If bonus is not activates or set to 0, terminate operation
            if($refbonus == 0){return 1;}

			$sql = "SELECT sId,sRefWallet FROM subscribers WHERE sPhone=:phone";
            $query = $dbh->prepare($sql);
			$query->bindParam(':phone',$refearedby,PDO::PARAM_STR);
			$query->execute();
            $result=$query->fetch(PDO::FETCH_OBJ);
			
			if($query->rowCount() > 0){

				//Get User Balance
				$userId= $result->sId;
				$balance = (float) $result->sRefWallet;
				$oldbalance = $balance;
				$amount = (float) $refbonus;
            	$newbalance = $oldbalance + $amount;
				$servicename = "Referral Bonus";
    			$servicedesc = "Referral Bonus Of N{$amount} For Referring {$referalname} ({$referal}). Bonus For {$service} Purchase.";
				$status = 0;
				$date=date("Y-m-d H:i:s");
				$ref = "REF-".time();

				//Record Transaction
				$sql2 = "INSERT INTO transactions SET sId=:user,transref=:ref,servicename=:sn,servicedesc=:sd,amount=:a,status=:s,oldbal=:ob,newbal=:nb,date=:d";
				$query2 = $dbh->prepare($sql2);
				$query2->bindParam(':user',$userId,PDO::PARAM_INT);
				$query2->bindParam(':ref',$ref,PDO::PARAM_STR);
				$query2->bindParam(':sn',$servicename,PDO::PARAM_STR);
				$query2->bindParam(':sd',$servicedesc,PDO::PARAM_STR);
				$query2->bindParam(':a',$amount,PDO::PARAM_STR);
				$query2->bindParam(':s',$status,PDO::PARAM_INT);
				$query2->bindParam(':ob',$oldbalance,PDO::PARAM_STR);
				$query2->bindParam(':nb',$newbalance,PDO::PARAM_STR);
				$query2->bindParam(':d',$date,PDO::PARAM_STR);
				$query2->execute();

				$lastInsertId = $dbh->lastInsertId();
				if($lastInsertId){
					//Update Account Type & Balance
					$sql3 = "UPDATE subscribers SET sRefWallet=:bal WHERE sId=:id";
					$query3 = $dbh->prepare($sql3);
					$query3->bindParam(':id',$userId,PDO::PARAM_INT);
					$query3->bindParam(':bal',$newbalance,PDO::PARAM_STR);
					$query3->execute();
					return 0;
				}
			
			}
		}


        //Validate Monnify Transaction
		public function verifyMonnifyRef($email,$monnifyhash,$token){
			$dbh=$this->connect();
			
            //Get Api Key
            $sql = "SELECT value FROM apiconfigs WHERE name='monifySecrete'";
            $query = $dbh->prepare($sql);
            $query->execute(); 
            $result=$query->fetch(PDO::FETCH_OBJ);
            $monifySecrete=$result->value;
            $hash=$this->computeMonnifyHash($token, $monifySecrete);

            //Get Api Status
            $sql2 = "SELECT value FROM apiconfigs WHERE name='monifyCharges'";
            $query2 = $dbh->prepare($sql2);
            $query2->execute(); 
            $result2=$query2->fetch(PDO::FETCH_OBJ);
            $charges=$result2->value;
           
            if($hash == $monnifyhash){
                $sqlA = "SELECT * FROM subscribers WHERE sEmail=:e";
                $queryA = $dbh->prepare($sqlA);
                $queryA->bindParam(':e',$email,PDO::PARAM_STR);
                $queryA->execute();
                $resultA=$queryA->fetch(PDO::FETCH_OBJ);
                $resultA = (array) $resultA;
                $resultA["charges"] = $charges;
                $resultA = (object) $resultA;
                return $resultA;
            }
            else{return 1;}
		}
		
		//Compute Monnify Hash
		 public function computeMonnifyHash($stringifiedData, $clientSecret) {
          $computedHash = hash_hmac('sha512', $stringifiedData, $clientSecret);
          return $computedHash;
        }
        

        //Validate Paystack Transaction
		public function verifyPaystackRef($email,$reference){
			$dbh=$this->connect();

			//Get Api Key
            $sql = "SELECT value FROM apiconfigs WHERE name='paystackApi'";
            $query = $dbh->prepare($sql);
            $query->execute(); 
            $result=$query->fetch(PDO::FETCH_OBJ);
            $apiKey=$result->value;

            //Get Api Status
            $sql2 = "SELECT value FROM apiconfigs WHERE name='paystackCharges'";
            $query2 = $dbh->prepare($sql2);
            $query2->execute(); 
            $result2=$query2->fetch(PDO::FETCH_OBJ);
            $charges=$result2->value;
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => [
                        "accept: application/json",
                        "authorization: Bearer ".$apiKey,
                        "cache-control: no-cache"
                    ],
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            if($err){
                    return 'Curl Returned Error: ' . $err;
            }

            $tranx = json_decode($response);
            
            if(!$tranx->status){
                    // there was an error from the API
                    return 'API Returned Error: ' . $tranx->message;
            }

            if('success' == $tranx->data->status){
                $sqlA = "SELECT sId,sWallet FROM subscribers WHERE sEmail=:e";
                $queryA = $dbh->prepare($sqlA);
                $queryA->bindParam(':e',$email,PDO::PARAM_STR);
                $queryA->execute();
                $resultA=$queryA->fetch(PDO::FETCH_OBJ);
                $resultA = (array) $resultA;
                $resultA["amount"] = $tranx->data->amount;
                $resultA["charges"] = $charges;
                $resultA = (object) $resultA;
                return $resultA;
            }
            else{
                return "Transaction Not Verified";
                
            }
		}
		
		//----------------------------------------------------------------------------------------------------------------
		// Alpha Topup Management
		//----------------------------------------------------------------------------------------------------------------
		
		//Get All Alpha Topup Plans
		public function getAlphaTopupPlans(){
			$dbh=$this->connect();
			$sql = "SELECT * FROM alphatopupprice";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            return $results;
		}

		//Alpha Topup 
		public function sendAlphaNotification($amount,$servicedesc){
			$dbh=$this->connect();
            $contact = $this->getSiteSettings();
			$subject="Alpha Topup Request (".$this->sitename.")";
			$message="This is to notify you that there is a new request for Alpha Topup on your website ".$this->sitename.". Order Details : {$servicedesc}";
			$email=$contact->email;
			$check=$this->sendMail($email,$subject,$message);
			return 0;
			
		}
		
		//Calculate Alpha Topup Discount
		public function calculateAlphaTopupDiscountDiscount($amount){
			$dbh=$this->connect();
			$sql = "SELECT * FROM alphatopupprice WHERE buyingPrice=:a";
            $query = $dbh->prepare($sql);
            $query->bindParam(':a',$amount,PDO::PARAM_INT);
            $query->execute();
            $result=$query->fetch(PDO::FETCH_OBJ);
            return $result;
		}

        //Update Transaction Status With Real Time Response
        public function updateTransactionWithRealResponse($ref,$response){
            //Update Transaction Status
            $dbh=$this->connect();
            $sqlD = "UPDATE transactions SET servicedesc=:servicedesc WHERE transref=:ref";
            $queryD = $dbh->prepare($sqlD);
            $queryD->bindParam(':servicedesc',$response,PDO::PARAM_STR);
            $queryD->bindParam(':ref',$ref,PDO::PARAM_STR);
            $queryD->execute();
        }


        public function verifyAspfiyNotification($key,$email){
			$dbh=$this->connect();
			
            //Get Configuration Details
            $sql = "SELECT * FROM apiconfigs";
            $query = $dbh->prepare($sql);
            $query->execute(); 
            $result=$query->fetchAll(PDO::FETCH_OBJ);
            
            $asfiyKey = $this->getConfigValue($result,"asfiyApi");
            
            $asfiyCharges = (float) $this->getConfigValue($result,"asfiyCharges");
            $asfiyChargesType = $this->getConfigValue($result,"asfiyChargesType");
            
            //Verify Notification Details
            if($key == md5($asfiyKey)):
            
                $sqlA = "SELECT * FROM subscribers WHERE sEmail=:e";
                $queryA = $dbh->prepare($sqlA);
                $queryA->bindParam(':e',$email,PDO::PARAM_STR);
                $queryA->execute();
                $resultA=$queryA->fetch(PDO::FETCH_OBJ);
                if($queryA->rowCount() > 0):
                    $response = array();
                    $response["status"] = "success";
                    $response["userid"] = $resultA->sId;
                    $response["name"] = $resultA->sLname ." ". $resultA->sFname;
                    $response["balance"] = $resultA->sWallet;
                    $response["useremail"] = $resultA->sEmail;
                    $response["charges"] = $asfiyCharges;
                    $response["chargestype"] = $asfiyChargesType;
                    return (object) $response;
                endif;
            
            else:
                $response = array();
                $response["status"] = "fail";
                $response["message"] = "Not Found";
                return (object) $response;
            endif;
            
            
            
           
            
		}

        //Validate Kuda Notification
		public function verifyKudaNotification($username,$key,$useraccount){
			$dbh=$this->connect();
			
            //Get Configuration Details
            $sql = "SELECT * FROM apiconfigs";
            $query = $dbh->prepare($sql);
            $query->execute(); 
            $result=$query->fetchAll(PDO::FETCH_OBJ);
            
            $kudaWebhookUser = $this->getConfigValue($result,"kudaWebhookUser");
            $kudaWebhookPass = $this->getConfigValue($result,"kudaWebhookPass");
            $kudaWebhookPass = base64_encode($kudaWebhookPass);
            $kudaCharges = (float) $this->getConfigValue($result,"kudaCharges");
            $kudaChargesType = $this->getConfigValue($result,"kudaChargesType");
            
            //Verify Notification Details
            if($kudaWebhookUser == $username && $kudaWebhookPass == $key):
            
                $sqlA = "SELECT * FROM subscribers WHERE sKudaBank=:e";
                $queryA = $dbh->prepare($sqlA);
                $queryA->bindParam(':e',$useraccount,PDO::PARAM_STR);
                $queryA->execute();
                $resultA=$queryA->fetch(PDO::FETCH_OBJ);
                if($queryA->rowCount() > 0):
                    $response = array();
                    $response["status"] = "success";
                    $response["userid"] = $resultA->sId;
                    $response["name"] = $resultA->sLname ." ". $resultA->sFname;
                    $response["balance"] = $resultA->sWallet;
                    $response["useremail"] = $resultA->sEmail;
                    $response["charges"] = $kudaCharges;
                    $response["chargestype"] = $kudaChargesType;
                    return (object) $response;
                endif;
            
            else:
                $response = array();
                $response["status"] = "fail";
                $response["message"] = "Not Found";
                return (object) $response;
            endif;
            
            
            
           
            
		}

        //Record KUDA Transaction 
		public function recordKudaTransaction($userid,$servicename,$servicedesc,$ref,$amountopay,$oldbalance,$newbalance,$status){
			$dbh=$this->connect();
			$userid=(float) $userid;
			$status=(float) $status;
            $date=date("Y-m-d H:i:s");
            
            //Check If Discount Already Exist
			$queryC=$dbh->prepare("SELECT transref FROM transactions WHERE transref=:transref");
			$queryC->bindParam(':transref',$ref,PDO::PARAM_STR);
			$queryC->execute();
			if($queryC->rowCount() > 0){return 1;}
			
            //If transaction was successful, debit user wallet
            $sqlD = "UPDATE subscribers SET sWallet=:nb WHERE sId=:id";
            $queryD = $dbh->prepare($sqlD);
            $queryD->bindParam(':id',$userid,PDO::PARAM_INT);
            $queryD->bindParam(':nb',$newbalance,PDO::PARAM_STR);
            $queryD->execute();

            //Record Transaction
			$sql = "INSERT INTO transactions SET sId=:user,transref=:ref,servicename=:sn,servicedesc=:sd,amount=:a,status=:s,oldbal=:ob,newbal=:nb,date=:d";
            $query = $dbh->prepare($sql);
            $query->bindParam(':user',$userid,PDO::PARAM_INT);
            $query->bindParam(':ref',$ref,PDO::PARAM_STR);
            $query->bindParam(':sn',$servicename,PDO::PARAM_STR);
            $query->bindParam(':sd',$servicedesc,PDO::PARAM_STR);
            $query->bindParam(':a',$amountopay,PDO::PARAM_STR);
            $query->bindParam(':s',$status,PDO::PARAM_INT);
            $query->bindParam(':ob',$oldbalance,PDO::PARAM_STR);
            $query->bindParam(':nb',$newbalance,PDO::PARAM_STR);
            $query->bindParam(':d',$date,PDO::PARAM_STR);
            $query->execute();

            $lastInsertId = $dbh->lastInsertId();
			if($lastInsertId){return 0;}else{return 1;}
		}
		
		


	}

?>