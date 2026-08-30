<div style="background-image:url(../../assets/img/bg/cc.png)">
<div class="header header-fixed mb-3 pt-2 pb-2" style="height: auto !important; transform: translateX(0px); background:linear-gradient(90deg, rgb(159, 5, 189) 25%, rgb(31, 16, 196) 75%); opacity:0.9;">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center">
                <div>
                    <a href="profile">
                        <img src="../../assets/img/avater.png" style="border-radius:5rem; width:45px; height:45px; margin-right:10px;">
                    </a>
                </div>
                <div>
                   <h5 class="my-0 py-0 mt-2  text-white" style="line-height: 10px;">Hi, <a href="profile" class=" text-white"><?php echo $profileDetails->sFname . " (".$controller->formatUserType($profileDetails->sType).")"; ?></a></h5>
                   
                </div>
            </div>

            <div class="d-flex align-items-center">
                <a href="contact-us" class="mr-2 bg-white text-center" style="border-radius:5rem; width:40px; height:40px; margin-right:20px;">
                    <i class="fa fa-phone font-25 pt-2" style="color:#1206c1"></i>
                </a>
                <a href="notifications" class="mr-2 bg-white text-center" style="border-radius:5rem; width:40px; height:40px;">
                    <i class="fa fa-bell font-25 pt-2" style="color:#1206c1"></i>
                </a>
            </div>

        </div>
    </div>
</div>
</div>
        
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
         <h2> ABOUT NEW USER!!!!!</h2>
               <p class="mb-0 font-600 color-highlight">YOU MUST VERIFY YOUR ACCOUNT BEFORE GET AUTOMATIC ACCOUNT NUMBERS</p>

        <a  href="kyc-verification" style="width: 100%; background-color:#730089;" class="btn btn-full btn-l font-600 font-15 mt-4 rounded-s">
                               <i class="fas fa-id-card mr-2"></i> YA ZAMA DOLE KAYI KYC KAFIN KASAMU ACCOUNT NUMBER
                            </a>
            </div>
            </div> </center>
        
       <div class="splide single-slider slider-no-arrows slider-no-dots visible-slider splide--loop splide--ltr splide--draggable is-active" id="single-slider-1" style="visibility: visible;">
<div class="splide__arrows"><button class="splide__arrow splide__arrow--prev" type="button" aria-controls="single-slider-1-track" aria-label="Previous slide"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40"><path d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path></svg></button><button class="splide__arrow splide__arrow--next" type="button" aria-controls="single-slider-1-track" aria-label="Next slide"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40"><path d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path></svg></button></div><div class="splide__track" id="single-slider-1-track">
<div class="splide__list" id="single-slider-1-list" style="transform: translate(-1062px, 0px); transition: transform 400ms cubic-bezier(0.42, 0.65, 0.27, 0.99) 0s;">
<div class="splide__slide splide__slide--clone" aria-hidden="true" tabindex="-1" style="width: 354px;">
<div data-card-height="150" class="card card-style shadow-xl mb-2 bg-18" style="height: 150px;">
<div class="card-top p-3">
<h5 class="font-monospace opacity-70 font-10 mb-0 color-black">Account</h5>
<h2 class="color-black font-30">9PSB Bank</h2>
</div>
<div class="card-bottom p-3">
<h5 class="font-monospace opacity-70 font-10 mb-n1 color-black">Account Number</h5>
<h5 class="font-monospace font-14 color-black" onclick="copyToClipboard('<?php echo $data->sPayvesselBank; ?>')"><?php echo $data->sPayvesselBank; ?></h5>
</div>
<div class="card-top p-3">
<h5 class="text-end font-monospace opacity-70 font-10 mb-n1 color-black">Charges</h5>
<h5 class="text-end font-monospace font-14 color-black">1.075%</h5>
</div>
<div class="card-overlay gradient-green" style="height: 150px; background-image: url('../../assets2/img/fidelity.png')"></div>



</div>
</div>







<div class="splide__slide splide__slide--clone" style="width: 354px;">
<div data-card-height="150" class="card card-style shadow-xl mb-2 bg-21" style="height: 100px;">
<div class="card-top p-3">
<h5 class="font-monospace opacity-70 font-10 mb-0 color-black">Account</h5>
<h2 class="color-black font-30">Sterling Bank</h2>
</div>
<div class="card-bottom p-3">
<h5 class="font-monospace opacity-70 font-10 mb-n1 color-black">Account Number</h5>
<h5 class="font-monospace font-14 color-black" onclick="copyToClipboard('<?php echo $data->sSterlingBank; ?>')"><?php echo $data->sSterlingBank; ?></h5>
</div>
<div class="card-top p-3">
<h5 class="text-end font-monospace opacity-70 font-10 mb-n1 color-black">Charges</h5>
<h5 class="text-end font-monospace font-14 color-black">1.075%</h5>
</div>
<div class="card-overlay gradient-green" style="height: 150px; background-image: url('../../assets2/img/sterling.png')"></div>
</div>
</div><div class="splide__slide is-active is-visible" id="single-slider-1-slide01" aria-hidden="false" tabindex="0" style="width: 354px;">
<div data-card-height="150" class="card card-style shadow-xl mb-2 bg-14" style="height: 150px;">
<div class="card-top p-3">
<h5 class="font-monospace opacity-70 font-10 mb-0 color-white">Account</h5>
<h2 class="color-white font-30">Wema Bank</h2>
</div>
<div class="card-bottom p-3">
<h5 class="font-monospace opacity-70 font-10 mb-n1 color-white">Account Number</h5>
<h5 class="font-monospace font-14 color-white" onclick="copyToClipboard('<?php echo $data->sBankNo; ?>')"><?php echo $data->sBankNo; ?></h5>
</div>
<div class="card-top p-3">
<h5 class="text-end font-monospace opacity-70 font-10 mb-n1 color-white">Charges</h5>
<h5 class="text-end font-monospace font-14 color-white">1.075%</h5>
</div>
<div class="card-overlay gradient-green" style="height: 150px; background-image: url('../../assets2/img/wema.png')"></div>
</div>
</div>






<div class="splide__slide" id="single-slider-1-slide02" aria-hidden="true" tabindex="-1" style="width: 354px;">
<div data-card-height="150" class="card card-style shadow-xl mb-2 bg-18" style="height: 150px;">
<div class="card-top p-3">
<h5 class="font-monospace opacity-70 font-10 mb-0 color-white">Account</h5>
<h2 class="color-white font-30">Moniepoint</h2>
</div>
<div class="card-bottom p-3">
<h5 class="font-monospace opacity-70 font-10 mb-n1 color-white">Account Number</h5>
<h5 class="font-monospace font-14 color-white" onclick="copyToClipboard('<?php echo $data->sRolexBank; ?>')"><?php echo $data->sRolexBank; ?></h5>
</div>
<div class="card-top p-3">
<h5 class="text-end font-monospace opacity-70 font-10 mb-n1 color-white">Charges</h5>
<h5 class="text-end font-monospace font-14 color-white">1.075%</h5>
</div>
<div class="card-overlay gradient-green" style="height: 150px; background-image: url('../../assets2/img/moniepoint.png')"></div>
</div>
</div>

<div class="splide__slide splide__slide--clone" style="width: 354px;">
<div data-card-height="150" class="card card-style shadow-xl mb-2 bg-14" style="height: 150px;">
<div class="card-top p-3">
<h5 class="font-monospace opacity-70 font-10 mb-0 color-white">Account</h5>
<h2 class="color-white font-30">Kuda Bank</h2>
</div>
<div class="card-bottom p-3">
<h5 class="font-monospace opacity-70 font-10 mb-n1 color-white">Account Number</h5>
<h5 class="font-monospace font-14 color-white" onclick="copyToClipboard('<?php echo $data->sAsfiyBank; ?>')"><?php echo $data->sAsfiyBank; ?></h5>
</div>
<div class="card-top p-3">
<h5 class="text-end font-monospace opacity-70 font-10 mb-n1 color-white">Charges</h5>
<h5 class="text-end font-monospace font-14 color-white">1%</h5>
</div>
<div class="card-overlay gradient-green" style="height: 150px; background-image: url('../../assets2/img/kuda.png')"></div>
</div>

</div></div>
</div>
<ul class="splide__pagination"><li><button class="splide__pagination__page" type="button" aria-controls="single-slider-1-slide01" aria-label="Go to slide 1"></button></li><li><button class="splide__pagination__page is-active" type="button" aria-controls="single-slider-1-slide02" aria-label="Go to slide 2" aria-current="true"></button></li><li><button class="splide__pagination__page" type="button" aria-controls="single-slider-1-slide03" aria-label="Go to slide 3"></button></li></ul></div>
</br>


        
        
        <center>
        
        
             <div class="">
            <div class="content" id="tab-group-1">
          <h2> ACTION REQUIRED!!!!!</h2>
                <p class="mb-0 font-600 color-highlight">Important: CBN has mandated that all virtual accounts should have   BVN link to it to prevent fraud click the button below to update your nin or bvn</p>
              

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
            <a href="recharge-pin" class="col-3">
                <span class="icon icon-l rounded-sm" style="background-color: #ffffff; color :#730089;">
                   <i class="fas fa-wifi" style="font-size: 20px;"></i>
                </span>
                <p class="mb-0 pt-1 font-13" style="color: white ;">Recha pin </p>
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

 <div class="">
            <div class="content" id="tab-group-1">
         

        <a  href="transactions" style="width: 100%; background-color:#730089;" class="btn btn-full btn-l font-600 font-15 mt-4 rounded-s">
                               <i class="fas fa-id-card mr-2"></i> STATISTICS 
                            </a>
            </div>
            </div>




    

            <table class="table">
            
                <tr>
                  <td><b id="sta"><i class="fa fa-bar-chart"></i>  Total Transactions</b></td>
                   <td><b><?php echo $controller->TotalTransactions();?></b></td>
                </tr>
            
                <tr>
                 <td><b><i class="fa fa-line-chart"></i>  Amount Spent This Week</b></td>
                 <td><b>N<?php echo number_format($controller->weeklySpent()); ?></b></td>
                 </tr>
             
                <tr>
                 <td><b><i class="fa fa-line-chart"></i>  Amount Spent This Month</b></td>
                 <td><b>N<?php echo number_format($controller->monthlySpent()); ?></b></td>
                 </tr>
                
                 <tr>
                 <td><b><i class="fa fa-line-chart"></i>  Total Spent</b></td>
                 <td><b>N<?php 
                 
                 $totalFund = $controller->getTotalFund();
                 $balance = $data->sWallet;
                 $totalSpent = $totalFund - $balance;
                 
                  echo number_format($totalSpent); ?></b></td>
                 </tr>
            
                  <tr>
                    <td><b><i class="fa fa-money"></i>   Total Funding</b></td>
                    <td><b>N<?php echo number_format($controller->getTotalFund());?></b></td>
                 </tr>

                
                  <tr>
                    <td><b><i class="fa fa-money"></i>  Available Balance </b></td>
                    <td><b>N<?php echo number_format($data->sWallet); ?>  </b></td>
                  </tr>

                
            </table> 
    

<center>

       
                            <div class="splide__slide" id="single-slider-1-slide03" aria-hidden="true" tabindex="-1" style="width: 350px;">
                               <div class="card card-style bg-20" data-card-height="150" style="height: 450px;">
                                    <img class="img-fluid" style="height: 450px;" src="../../assets2/img/ads/ads7.png" />
                                </div>
                            </div> <center>
                    
        
         
          
        
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
             <a href="https://play.google.com/store/apps/details?id=com.Expressdata.app"  <div class="text-center"><img src="../../assets2/images/dapp.png" style="width:512px; height:250px;" /></div></a>
        </div>
                </div>
                </div>

                    
                </div>
            </div>
        </div>

</div>

   

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets2/scripts/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="../assets2/scripts/custom.js?v=1.8"></script
</body>
</html>