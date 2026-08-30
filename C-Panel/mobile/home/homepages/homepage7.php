<div class="page-content header-clear">

    <div class="card notch-clear rounded-0 mb-2 mt-0" data-card-height="260" style="background-color:<?php echo $sitecolor; ?>; border-bottom-left-radius: 1rem !important; border-bottom-right-radius: 1rem !important;">
        <div class="card-body pt-4 mt-2 mb-n2 text-center">
            <h1 class=" font-20 color-white"><?php echo "Hi, " . $data->sFname; ?> (<?php echo $controller->formatUserType($data->sType); ?>)</h1>
            <h2 class="font-30 ps-3 pt-2 color-white">

                <span id="hideEyeDiv" style="display:none;">&#8358;<?php echo number_format($data->sWallet); ?></span>
                <span id="openEyeDiv">&#8358; *********</span>

                <span id="hideEye"><i class="fa fa-eye-slash" style="margin-left:20px;" aria-hidden="true"></i></span>
                <span id="openEye" style="display:none; margin-left:20px;"><i class="fa fa-eye" aria-hidden="true"></i></span>

            </h2>
            <h2 class=" font-16 color-white">Commission: &#8358;<?php echo number_format($data->sRefWallet); ?></h2>

        </div>

        <div class="mt-0 mb-5">

            <div class="d-flex justify-content-center align-content-center mb-4">

                <div class="me-3">
                    <a href="fund-wallet" class="btn d-flex align-content-center font-13" style="border:2px solid #ffffff; border-radius:2rem;">
                        <ion-icon name="add-circle" class="font-18"></ion-icon> <b class="ps-1">Add Money</b>
                    </a>
                </div>

                <div>
                    <a href="contact-us" class="btn d-flex align-content-center font-13" style="border:2px solid #ffffff; border-radius:2rem;">
                        <ion-icon name="call" class="font-18"></ion-icon> <b class="ps-1">Contact Us</b>
                    </a>
                </div>

            </div>

        </div>

    </div>
</br>


<center>   <a type="button"href="https://play.google.com/store/apps/details?id=com.agdatasub.com"><img  style="height:100px;"src="https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png"/></a></center>

</br></br></br>



    <div class="d-flex justify-content-between align-content-center mb-2 mt-n5">

        <a href="buy-airtime" class="card text-center shadow-l" style="width:100% ; margin:10px; margin-top:-5px;">
            <span class="icon pt-2" style="color:#cc0066;">
                <i class="fa fa-phone font-25"></i>
            </span>
            <p class="mb-2 pt-1 font-13">Buy Airtime</p>
        </a>

        <a href="buy-data" class="card text-center shadow-l" style="width:100% ; margin:10px; margin-top:-5px;">
            <span class="icon pt-2" style="color:#0066ff;">
                <i class="fa fa-wifi font-25"></i>
            </span>
            <p class="mb-2 pt-1 font-13">Buy Data</p>
        </a>

        <a href="cable-tv" class="card text-center shadow-l" style="width:100% ; margin:10px; margin-top:-5px;">
            <span class="icon pt-2" style="color:#00cc00;">
                <i class="fa fa-tv font-25"></i>
            </span>
            <p class="mb-2 pt-1 font-13">Cable Tv</p>
        </a>

    </div>




    <div class="d-flex justify-content-between align-content-center mb-2">

        <a href="electricity" class="card text-center shadow-l" style="width:100% ; margin:10px; margin-top:-5px;">
            <span class="icon pt-2" style="color:#cc0066;">
                <i class="fa fa-bolt font-25"></i>
            </span>
            <p class="mb-2 pt-1 font-13">Electricity</p>
        </a>

        <a href="exam-pins" class="card text-center shadow-l" style="width:100% ; margin:10px; margin-top:-5px;">
            <span class="icon pt-2" style="color:#0066ff;">
                <i class="fa fa-graduation-cap font-25"></i>
            </span>
            <p class="mb-2 pt-1 font-13">Exam Pin</p>
        </a>

        <a href="buy-data-pin" class="card text-center shadow-l" style="width:100% ; margin:10px; margin-top:-5px;">
            <span class="icon pt-2" style="color:#00cc00;">
                <i class="fa fa-barcode font-25"></i>
            </span>
            <p class="mb-2 pt-1 font-13">Data Pin</p>
        </a>

    </div>

    <div class="d-flex justify-content-between align-content-center mb-2">

        <a href="airtime-to-cash" class="card text-center shadow-l" style="width:100% ; margin:10px; margin-top:-5px;">
            <span class="icon pt-2" style="color:#cc0066;">
                <i class="fa fa-mobile font-25"></i>
            </span>
            <p class="mb-2 pt-1 font-13">Airtime Swap</p>
        </a>

        <a href="referrals" class="card text-center shadow-l" style="width:100% ; margin:10px; margin-top:-5px;">
            <span class="icon pt-2" style="color:#0066ff;">
                <i class="fa fa-users font-25"></i>
            </span>
            <p class="mb-2 pt-1 font-13">Referrals</p>
        </a>

        <a href="logout" class="card text-center shadow-l" style="width:100% ; margin:10px; margin-top:-5px;">
            <span class="icon pt-2" style="color:#00cc00;">
                <i class="fa fa-lock font-25"></i>
            </span>
            <p class="mb-2 pt-1 font-13">Logout</p>
        </a>

    </div>



<div class="d-flex justify-content-between align-content-center mb-2 mt-n5">

        <a href="verify-bvn" class="card text-center shadow-l" style="width:100% ; margin:10px; margin-top:-5px;">
            <span class="icon pt-2" style="color:#cc0066;">
                <i class="fa fa-id-card font-25"></i>
            </span>
            <p class="mb-2 pt-1 font-13">Verify BVN</p>
        </a>

        <a href="verify-nin" class="card text-center shadow-l" style="width:100% ; margin:10px; margin-top:-5px;">
            <span class="icon pt-2" style="color:#0066ff;">
                <i class="fa fa-id-card font-25"></i>
            </span>
            <p class="mb-2 pt-1 font-13">Verify NIN</p>
        </a>

        <a href="verify-pnv" class="card text-center shadow-l" style="width:100% ; margin:10px; margin-top:-5px;">
            <span class="icon pt-2" style="color:#00cc00;">
                <i class="fa fa-id-card font-25"></i>
            </span>
            <p class="mb-2 pt-1 font-13">NIN With Phone</p>
        </a>

    </div>


</div>