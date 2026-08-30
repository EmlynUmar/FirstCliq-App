
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<link rel="apple-touch-icon" sizes="180x180" href="../../assets2/img/favicon.png">
<link rel="icon" type="image/png" href="../../assets2/img/favicon.png" />
<title>Homepage</title>
<link rel="stylesheet" type="text/css" href="../assets2/styles/bootstrap.css" media="all">
<link rel="stylesheet" type="text/css" href="../assets2/styles/style.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../assets2/fonts/css/fontawesome-all.min.css">    
<!--link rel="manifest" href="../assets2/scripts/_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js"-->
<link rel="apple-touch-icon" sizes="180x180" href="../assets2/app/icons/icon-192x192.png">
<link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet" />
<!-- Fantasy -->
<link href="https://unpkg.com/@videojs/themes@1/dist/sea/index.css" rel="stylesheet">
<style>
.radio-view{
  margin: auto;
  padding: 0;
  position:relative;
  max-width:520px;

}


.iphone {
  background: #ffffff;
  border-radius: 1em;
  box-sizing: border-box;
  padding: 2em;
  display: flex;
  flex-direction: column;
}
.iphone .title {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  font-size: 0.75em;
  margin-bottom: 2em;
}
.iphone .album-cover {
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.iphone .album-cover img {
  width: 160px;
  height: 156px;
  border-radius: 50%;
}
.iphone .album-cover .song-title {
  
  margin-top:10px;
  text-align: center;
  padding-bottom: 0;
  margin-bottom: 0;
  color: #65717e;
}
.iphone .album-cover .artist-title {
  text-align: center;
  margin-top: 1em;
  padding: 3px 20px 3px 20px;
  font-size: 1em;
  color: #ffffff;
  background-color: #3333ff;
  border-radius: 5px;
}
.iphone .track {
  margin-top: 1em;
  height: 10px;
}
.iphone .track div {
  width: 5%;
  height: 100%;
  background: #3333ff;
  opacity: 0.75;
  border-radius: 15px;
}
.iphone .buttons {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 1em 0;
}
.iphone .lyrics {
  color: #7e8a98;
  margin-top: 2em;
  text-align: center;
  font-size: 0.75em;
  display: flex;
  flex-direction: column;
}

.neu {
  box-shadow: -5px -5px 15px 0px #ffffff9e, 5px 5px 15px 0px #a3b1c6a8;
  background: #e0e5ec;
  border-radius: 2em;
  border: 0;
}

.btn-r {
  padding: 15px 20px 15px 20px;
  border-radius: 30px;
  color: #7e8a98;
  outline: none;
  cursor: pointer;
  margin:0 25px 0px 25px;
}
.btn-r.lg {
  font-size: 1em;
}
.btn-r:hover {
  cursor: pointer;
  background: #eff2f5;
}

.red {
  color: #e22d49;
}
.spin {
  -webkit-animation-name: spin;
  -webkit-animation-duration: 20000ms;
  -webkit-animation-iteration-count: infinite;
  -webkit-animation-timing-function: linear;
  -moz-animation-name: spin;
  -moz-animation-duration: 20000ms;
  -moz-animation-iteration-count: infinite;
  -moz-animation-timing-function: linear;
  -ms-animation-name: spin;
  -ms-animation-duration: 20000ms;
  -ms-animation-iteration-count: infinite;
  -ms-animation-timing-function: linear;
  -o-transition: rotate(3600deg);
}
@-moz-keyframes spin {
    from { -moz-transform: rotate(0deg); }
    to { -moz-transform: rotate(360deg); }
}
@-webkit-keyframes spin {
    from { -webkit-transform: rotate(0deg); }
    to { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
    from {transform:rotate(0deg);}
    to {transform:rotate(360deg);}
}

</style></head>
    
<body class="theme-light">

</hr>
    
<div id="page">
    


      
		
    <!-- Page content start here-->
        <div class="page-content header-clear-medium">
       
        <div class="card card-style bg-20" data-card-height="200" 
           
            style="height: 130px; background-image: url('../../assets2/img/locker55.png')">
            <div class="card-top ps-3 pt-2">
                <h2 class="mb-2 color-white font-12"  style="text-shad: 2px 2px 2px #000000;">Card  Holder: <?php echo $profileDetails->sFname . " (".$controller->formatUserType($profileDetails->sType).")"; ?></h2>
                <!--<h4 class="btn float-end color-white ps-3 pb-2 bt-3"><i class="fa fa-wifi" aria-hidden="true"></i></h4>-->
            </div>
            <div class="card-center ">
               
                    <h3 class="color-white font-16 ps-3 pt-2">
                    <span style="margin-right:10px;">Balance : </span> 
                    <span id="hideEyeDiv" style="display:none;">&#8358;<?php echo number_format($data->sWallet); ?></span>
                    <span id="openEyeDiv" >&#8358; ****</span>
                    <span id="hideEye"><i class="fa fa-eye-slash" style="margin-left:20px;" aria-hidden="true"></i></span>
                    <span id="openEye" style="display:none; margin-left:20px;"><i class="fa fa-eye" aria-hidden="true"></i></span>
                    </h3>
                    <a href="fund-wallet" class="btn float-end font-16" style="background-color:#730089; border-radius:5rem; margin-right:7px"><b>+ Add Money</b></a>
            </div>
            <div class="card-bottom ps-3 pb-2 bt-3">
               <img src="../../assets2/images/Mastercardd.png" 
                width="60" height="40" 
                style="border-radius:5rem;" />
                <p class="mb-2 color-white font-8"><b> Powered by DAN-AYU BROWSER </b>
            </div>
            
            <div class="card-overlay bg-gradient"></div>

        </div>
        <center>
        
        
             <div class="">
            <div class="content" id="tab-group-1">
          <h2> ACTION REQUIRED!!!!!</h2>
                <p class="mb-0 font-600 color-highlight">Important: CBN has mandated that all virtual accounts should have NIN or BVN link to it to prevent fraud click the button below to update your nin or bvn</p>
              

        <a  href="kyc-verification" style="width: 100%; background-color:#730089;" class="btn btn-full btn-l font-600 font-15 mt-4 rounded-s">
                               <i class="fas fa-id-card mr-2"></i> UPDATE KYC NOW
                            </a>
            </div>
            </div>
                    
         </center>
         
        <div class="card card-style mt-0" style="height: 55px;">
        <div class="card-center ">
            <h3 class="float-start font-16 ps-3 pt-2">
                <span style="margin-right:10px;">Commissions:</span>
                <span style="margin-right:10px;">&#8358;<?php echo $data->sRefWallet; ?></span>
                <!--<span &#8358;0</span>-->
                <!--<span id="openEyeDiv">₦ *********</span>-->
            
                <!--<span id="hideEye"><i class="fa fa-eye-slash" style="margin-left:20px;" aria-hidden="true"></i></span>-->
                <!--<span id="openEye" style="display:none; margin-left:20px;"><i class="fa fa-eye" aria-hidden="true"></i></span>-->
                
            </h3>
            <a href="transfer" class="btn float-end" style="background-color:#730089; border-radius:5rem; margin-right:6px"><b>Withraw</b></a>
        
        </div>
    </div>
        <div class="card card-style mt-3" style="background-color:#730089; 
; border-radius: 20px; margin-bottom: 10px;">
    <div class="content mb-2 mt-3">
        <div class="row text-center mb-0">
            <a href="buy-data" class="col-3">
                <span class="icon icon-l rounded-sm" style="background-color: #ffffff; color:#730089;">
                    <i class="fas fa-wifi" style="font-size: 20px;"></i>
                </span>
                <p class="mb-0 pt-1 font-13" style="color: white ;">Data</p>
            </a>
            <a href="buy-airtime" class="col-3">
                <span class="icon icon-l rounded-sm" style="background-color: #ffffff; color:#730089;">
                    <i class="fas fa-mobile-alt" style="font-size: 20px;"></i>
                </span>
                <p class="mb-0 pt-1 font-13 " style="color: white ;">Airtime</p>
            </a>
            <a href="electricity" class="col-3">
                <span class="icon icon-l rounded-sm" style="background-color: #ffffff; color:#730089;">
                    <i class="fas fa-bolt" style="font-size: 20px;"></i>
                </span>
                <p class="mb-0 pt-1 font-13" style="color: white ;">Bills</p>
            </a>
            <a href="buy-data-pin" class="col-3">
                <span class="icon icon-l rounded-sm" style="background-color: #ffffff; color :#730089;">
                   <i class="fas fa-wifi" style="font-size: 20px;"></i>
                </span>
                <p class="mb-0 pt-1 font-13" style="color: white ;">Data pin</p>
            </a>
        </div>
    </div>
</div>

</hr>



        <div class="card card-style mt-3" style="background-color:#730089; 
; border-radius: 20px; margin-bottom: 10px;">
    <div class="content mb-2 mt-3">
        <div class="row text-center mb-0">
            <a href="cable-tv" class="col-3">
                <span class="icon icon-l rounded-sm" style="background-color: #ffffff; color:#730089;">
                    <i class="fa fa-tv" style="font-size: 20px;"></i>
                </span>
                <p class="mb-0 pt-1 font-13" style="color: white ;">Tv</p>
            </a>
            <a href="pricing" class="col-3">
                <span class="icon icon-l rounded-sm" style="background-color: #ffffff; color:#730089;">
                    <i class="fas fa-wifi" style="font-size: 20px;"></i>
                </span>
                <p class="mb-0 pt-1 font-13 " style="color: white ;">Data Price</p>
            </a>
            <a href="airtime-to-cash" class="col-3">
                <span class="icon icon-l rounded-sm" style="background-color: #ffffff; color:#730089;">
                    <i class="fas fa-wifi" style="font-size: 20px;"></i>
                </span>
                <p class="mb-0 pt-1 font-13" style="color: white ;">sell airtime</p>
            </a>
            <a href="kyc-verification" class="col-3">
                <span class="icon icon-l rounded-sm" style="background-color: #ffffff; color :#730089;">
                   <i class="fas fa-wifi" style="font-size: 20px;"></i>
                </span>
                <p class="mb-0 pt-1 font-13" style="color: white ;">KYC </p>
            </a>
        </div>
    </div>
</div>

</hr>






        <div class="card card-style mt-3" style="background-color:#730089; 
; border-radius: 20px; margin-bottom: 10px;">
    <div class="content mb-2 mt-3">
        <div class="row text-center mb-0">
            <a href="verify-nin" class="col-3">
                <span class="icon icon-l rounded-sm" style="background-color: #ffffff; color:#730089;">
                   <i class="fas fa-id-card" style="font-size: 20px;"></i>
                </span>
                <p class="mb-0 pt-1 font-13" style="color: white ;">Verify NIN</p>
            </a>
            <a href="verify-pnv" class="col-3">
                <span class="icon icon-l rounded-sm" style="background-color: #ffffff; color:#730089;">
                   <i class="fas fa-id-card" style="font-size: 20px;"></i>
                </span>
                <p class="mb-0 pt-1 font-13 " style="color: white ;">Nin  Phone</p>
            </a>
            <a href="verify-bvn" class="col-3">
                <span class="icon icon-l rounded-sm" style="background-color: #ffffff; color:#730089;">
                    <i class="fas fa-id-card" style="font-size: 20px;"></i>
                </span>
                <p class="mb-0 pt-1 font-13" style="color: white ;">Verify BVN</p>
            </a>
            <a href="logout" class="col-3">
                <span class="icon icon-l rounded-sm" style="background-color: #ffffff; color :#730089;">
                    <i class="fas fa-id-card" style="font-size: 20px;"></i>
                </span>
                <p class="mb-0 pt-1 font-13" style="color: white ;">Logout</p>
            </a>
        </div>
    </div>
</div>
<!--        </div>-->
        <div class="mt-3 splide single-slider slider-no-arrows slider-no-dots splide--loop splide--ltr splide--draggable is-active mb-1" id="single-slider-1" style="visibility: visible;">
            <div class="splide__arrows"><button class="splide__arrow splide__arrow--prev" type="button" aria-controls="single-slider-1-track" aria-label="Go to last slide"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40"><path d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path></svg></button><button class="splide__arrow splide__arrow--next" type="button" aria-controls="single-slider-1-track" aria-label="Next slide"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40"><path d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path></svg></button></div>
            <div class="splide__track" id="single-slider-1-track">
                    <div class="splide__list" id="single-slider-1-list" style="transform: translateX(-624px);">
                            
                            <div class="splide__slide splide__slide--clone" aria-hidden="true" tabindex="-1" style="width: 312px;">
                                <div class="card card-style bg-20" data-card-height="120" style="height: 190px;">
                                    <img class="img-fluid" style="height: 190px;" src="../../assets2/img/ads/ads8.png" />
                                </div>
                            </div>
                           
                            <div class="splide__slide" id="single-slider-1-slide02" aria-hidden="true" tabindex="-1" style="width: 312px;">
                               <div class="card card-style bg-20" data-card-height="120" style="height: 190px;">
                                    <img class="img-fluid" style="height: 190px;" src="../../assets2/img/ads/ads7.png" />
                                </div>
                            </div>
                            
                            <div class="splide__slide" id="single-slider-1-slide03" aria-hidden="true" tabindex="-1" style="width: 312px;">
                               <div class="card card-style bg-20" data-card-height="120" style="height: 190px;">
                                    <img class="img-fluid" style="height: 190px;" src="../../assets2/img/ads/D3.png" />
                                </div>
                            </div>
                            
                    </div>
            </div>
        
        <!--<div class="card card-style mt-3">-->
            
            
        <!--    <div class="content" style="color:#730089; mb-2 mt-3">-->
        <!--    <div>-->
        <!--        <h5>Payments</h5>-->
        <!--        <hr/>-->
        <!--       </div>-->
        <!--        <div class="row text-center mb-0">-->
        <!--            <a href="buy-data" class="col-3">-->
        <!--                <span class="icon icon-l rounded-sm" style="color:#730089;">-->
        <!--                    <i class="fa fa-wifi font-25"></i>-->
        <!--                </span>-->
        <!--                <p class="badge " style="background-color:#730089; mb-0 pt-1 font-11">Buy Data</p>-->
        <!--            </a>-->
        <!--            <a href="buy-airtime" class="col-3">-->
        <!--                <span class="icon icon-l rounded-sm" style="color:#730089; color:#730089;">-->
        <!--                    <i class="fa fa-signal font-25"></i>-->
        <!--                </span>-->
        <!--                <p class="badge " style="background-color:#730089; mb-0 pt-1 font-11">Buy Airtime</p>-->
        <!--            </a>-->
        <!--            <a href="electricity" class="col-3">-->
        <!--                <span class="icon icon-l rounded-sm" style="color:#730089;">-->
        <!--                    <i class="fa fa-bolt font-25"></i>-->
        <!--                </span>-->
        <!--                <p class="badge " style="background-color:#730089; mb-0 pt-1 font-11">Nepa Bills</p>-->
        <!--            </a>-->
        <!--            <a href="transfer" class="col-3">-->
        <!--                <span class="icon icon-l rounded-sm" style="color:#730089;">-->
        <!--                    <i class="fa fa-wallet font-25"></i>-->
        <!--                </span>-->
        <!--                <p class="badge " style="background-color:#730089; mb-0 pt-1 font-11">Transfers</p>-->
        <!--            </a>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        
          <div class="card card-style mt-3">
            
           
                    <!--<a href="exam-pins" class="col-3">-->
                    <!--    <span class="icon icon-l rounded-sm" style="color:#730089;">-->
                    <!--        <i class="fas fa-graduation-cap font-25"></i>-->
                    <!--    </span>-->
                    <!--    <p class="mb-0 pt-1 font-11">Exam pin</p>-->
                    <!--</a>-->
                    <!--<a href="electricity" class="col-3">-->
                    <!--    <span class="icon icon-l rounded-sm" style="color:#730089;">-->
                    <!--        <i class="fa fa-power-off font-25"></i>-->
                    <!--    </span>-->
                    <!--    <p class="mb-0 pt-1 font-11">Electricity</p>-->
                    <!--</a>-->
                    <!-- <a href="" class="col-3">-->
                    <!--    <span class="icon icon-l rounded-sm" style="color:#730089;">-->
                    <!--        <i class="fa fa-tv font-25"></i>-->
                    <!--    </span>-->
                    <!--    <p class="mb-0 pt-1 font-11">Cable</p>-->
                    <!--</a>-->
                    <!--<a href="" class="col-3">-->
                    <!--    <span class="icon icon-l rounded-sm" style="color:#730089;">-->
                    <!--        <i class="fa fa-barcode font-25"></i>-->
                    <!--    </span>-->
                    <!--    <p class="mb-0 pt-1 font-11">Data Card</p>-->
                    <!--</a>-->
                
            </div>
        </div>
         <div class="card card-style">
            
            <div class="content">
            <div>
                <h5>Referrals Link</h5>
                <hr/>
            </div>
               
               <div>
                    <input type="text" class="form-control" readonly value="<?php echo $siteurl."/mobile/register.php?referral=".$data->sPhone; ?>" />
                    <button class="btn btn-danger btn-sm mt-2" style="border-radius:5rem;" onclick="copyToClipboard('<?php echo $siteurl."mobile/register.php?referral=".$data->sPhone; ?>" />Copy Link</button>
                    <!--<a href="transfer" class="btn btn-success btn-sm mt-2" style="border-radius:5rem; margin-left:5px;">Withdraw</a>-->
                    </div>
            </div>
             <a href="https://play.google.com/store/apps/details?id=com.azonetech.resellerr"  <div class="text-center"><img src="../../assets2/images/dapp.png" style="width:512px; height:250px;" /></div></a>
        </div>
                </div>
                </div>

                    
                </div>
            </div>
        </div>

</div>

    <!-- Page content ends here-->

    <!-- Notification Message -->
            <!-- Notification Message -->

    <!-- Models -->
    
    <button id="continue-transaction-prompt-btn" data-menu="continue-transaction-prompt" class="d-none"></button>

    <!-- Verify transaction Prompt Model -->
    <div id="continue-transaction-prompt" 
         class="menu menu-box-modal rounded-m" 
         data-menu-height="350" 
         data-menu-width="300">
        <h1 class="text-center mt-4"><i class="fa fa-3x fa-info-circle scale-box color-blue-dark shadow-xl rounded-circle"></i></h1>
        <h3 class="text-center mt-3 font-700">Are you sure?</h3>
        <p class="boxed-text-xl" id="continue-transaction-prompt-msg"></p>
        <div class="row mb-0 me-3 ms-3">
            <div class="col-6">
                <a href="#" class="btn close-menu btn-full btn-m color-red-dark border-red-dark font-600 rounded-s">No</a>
            </div>
            <div class="col-6">
                                <a href="#" data-menu="pin-modal" class="btn btn-full btn-m color-green-dark border-green-dark font-600 rounded-s">Yes</a>
                            </div>
        </div>
    </div> 
    
    <!-- Confirm Trasaction Pin Model -->
    <div id="pin-modal" 
         class="menu menu-box-modal rounded-m bg-theme" 
         data-menu-width="300"
         data-menu-height="350">
        <div class="menu-title">
            <p class="color-highlight">Confirm Transaction </p>
            <h1 class="font-800">Continue?</h1>
            <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
        </div>
        
        <div class="content">
            <div class="divider mt-n2"></div>
            
            <div class="row mb-0">
                <div class="col-12">
                    <div class="input-style input-style-always-active has-borders mb-4">
                        <label for="form1" class="color-highlight">Transaction Pin</label>
                        <input type="password" id="thetranspin" maxlength="4" class="form-control" placeholder="****" required>
                    </div>
                </div>
            </div>
            <button action-btn="" id="transpinbtn" style="width:100%" class="btn btn-full btn-l font-600 font-15 btn-dark mt-4 rounded-s">Continue</button>
        </div>
    </div>

    <!-- Agent Account Upgrade Model -->
    <div id="agent-upgrade-modal" 
         class="menu menu-box-modal rounded-m bg-theme" 
         data-menu-width="300"
         data-menu-height="450">
        <div class="menu-title">
            <p class="color-highlight">Confirm Transaction </p>
            <h1 class="font-800">Upgrade</h1>
            <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
        </div>
        
        <div class="content">
            <div class="divider mt-n2"></div>
            <div id="agent-upgrade-msg" class="text-danger mb-3">
            You are about to upgrade to an Agent Account. 
            You can view our pricing page for details about the discounts available for Agents. 
            <br/> You would be charged a total of N2000 for this service. 
            To continue, enter your transaction pin below.            </div>
            <form action="./" method="POST" >
            <div class="row mb-0">
                                <div class="col-12">
                    <div class="input-style input-style-always-active has-borders mb-4">
                        <input type="password" name="kpin" maxlength="4" class="form-control" placeholder="****" required>
                        <label for="form1" class="color-highlight">Transaction Pin</label>
                    </div>
                </div>
                            </div>
            <button type="submit" name="upgrade-to-agent" id="agent-upgrade-btn" style="width:100%" class="btn btn-full btn-l font-600 font-15 btn-dark mt-4 rounded-s">Continue</button>
            </form>
        </div>
    </div>

    <!-- Vendor Account Upgrade Model -->
    <div id="vendor-upgrade-modal" 
         class="menu menu-box-modal rounded-m bg-theme" 
         data-menu-width="300"
         data-menu-height="450">
        <div class="menu-title">
            <p class="color-highlight">Confirm Transaction </p>
            <h1 class="font-800">Enter Pin</h1>
            <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
        </div>
        
        <div class="content">
            <div class="divider mt-n2"></div>
            <div id="vendor-upgrade-msg" class="text-danger mb-3">
            You are about to upgrade to a Vendor Account. 
            You can view our pricing page for details about the discounts available for Vendors. 
            <br/> You would be charged a total of N3000 for this service. 
            To continue, enter your transaction pin below.
            </div>
            <form action="./" method="POST" >
            <div class="row mb-0">
                <div class="col-12">
                    <div class="input-style input-style-always-active has-borders mb-4">
                        <input type="password" name="kpin" maxlength="4" class="form-control" placeholder="1234" required>
                        <label for="form1" class="color-highlight">Transaction Pin</label>
                    </div>
                </div>
            </div>
            <button type="submit" name="upgrade-to-vendor" id="vendor-upgrade-btn" style="width:100%" class="btn btn-full btn-l font-600 font-15 btn-dark mt-4 rounded-s">Continue</button>
            </form>
        </div>
    </div>



    
    
    <!-- Main Menu--> 
    <div id="menu-main" class="menu menu-box-left rounded-0" data-menu-width="280" data-menu-active="nav-pages">
        <div class="mt-4"></div>
<div class="list-group list-custom-small list-menu">

    <a href="./">
        <i class="fa fa-home color-white" style="background-color:#730089"></i>
        <span>Home</span>
        <i class="fa fa-angle-right"></i>
    </a>
    <a href="fund-wallet">
        <i class="fa fa-arrow-up color-white" style="background-color:#730089"></i>
        <span>Fund Wallet</span>
        <i class="fa fa-angle-right"></i>
    </a>
    <a href="buy-data">
        <i class="fa fa-wifi color-white" style="background-color:#730089"></i>
        <span>Buy Data</span>
        <i class="fa fa-angle-right"></i>
    </a>
    <a href="buy-airtime">
        <i class="fa fa-mobile color-white" style="background-color:#730089"></i>
        <span>Buy Airtime</span>
        <i class="fa fa-angle-right"></i>
    </a>
    <a href="transactions">
        <i class="fa fa-receipt color-white" style="background-color:#730089"></i>
        <span>Transactions</span>
        <i class="fa fa-angle-right"></i>
    </a>
    <a href="pricing">
        <i class="fa fa-list-alt color-white" style="background-color:#730089"></i>
        <span>Pricing</span>
        <i class="fa fa-angle-right"></i>
    </a>
    <a href="notifications">
        <i class="fa fa-list color-white" style="background-color:#730089"></i>
        <span>Notifications</span>
        <i class="fa fa-angle-right"></i>
    </a>
    <a href="profile">
        <i class="fa fa-user color-white" style="background-color:#730089"></i>
        <span>Profile</span>
        <i class="fa fa-angle-right"></i>
    </a>
    <a href="referrals">
        <i class="fa fa-users color-white" style="background-color:#730089"></i>
        <span>Referrals</span>
        <i class="fa fa-angle-right"></i>
    </a>
    <a href="logout">
        <i class="fa fa-lock color-white" style="background-color:#730089"></i>
        <span>Logout</span>
        <i class="fa fa-angle-right"></i>
    </a>
    
</div>

    </div>
    
    <!-- Share Menu-->
    <div id="menu-share" class="menu menu-box-bottom rounded-m" data-menu-load="../menu/menu-share.php" data-menu-height="370"></div>  
    
    <!-- Colors Menu-->
    <div id="menu-colors" class="menu menu-box-bottom rounded-m" data-menu-load="../menu/menu-colors.php" data-menu-height="480"></div> 
     
    
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets2/scripts/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="../assets2/scripts/custom.js?v=1.8"></script
</body>
</html>