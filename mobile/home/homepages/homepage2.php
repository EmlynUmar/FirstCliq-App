<div class="page-content header-clear">

<div class="card notch-clear rounded-0 mb-n5 mt-0" data-card-height="200" style="background-color:<?php echo $sitecolor; ?>;">
            <div class="card-body pt-4 mt-2 mb-n2">
                <h1 class=" font-20 float-start color-white"><?php echo "Hi, ".$data->sFname; ?>!</h1>
                <h3 class=" font-17 float-end color-white">(<?php echo $controller->formatUserType($data->sType); ?>)</h3>
                <div class="clearfix"></div>
            </div>
            <div class="card card-style mt-0 mb-5" style="height: 50px;">
                
               <div class="card-center ">
               
                    <h3 class="float-start font-16 ps-3 pt-2">
                    <span style="margin-right:10px;">Balance</span> 
                    <span id="hideEyeDiv" style="display:none;">&#8358;<?php echo number_format($data->sWallet); ?></span>
                    <span id="openEyeDiv" >&#8358; *********</span>
                
                    <span id="hideEye"><i class="fa fa-eye-slash" style="margin-left:20px;" aria-hidden="true"></i></span>
                    <span id="openEye" style="display:none; margin-left:20px;"><i class="fa fa-eye" aria-hidden="true"></i></span>
                    
                    </h3>
                    <a href="fund-wallet" class="btn float-end" style="background-color:<?php echo $sitecolor; ?>; border-radius:5rem; margin-right:7px"><b>Fund</b></a>
                
               </div>

                

            </div>

        </div>

        <div class="card card-style mt-3">
            <div class="content mb-2 mt-3">
                <div>
                    <h5>Airtime</h5>
                    <hr/>
                </div>
                <div class="row text-center mb-0">
                <a href="buy-airtime?network=MTN" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/mtn.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="buy-airtime?network=AIRTEL" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/airtel.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="buy-airtime?network=GLO" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/glo.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="buy-airtime?network=9MOBILE" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/9mobile.png" width="45" height="45" />
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="card card-style mt-3">
            <div class="content mb-2 mt-3">
                <div>
                    <h5>Data</h5>
                    <hr/>
                </div>
                <div class="row text-center mb-0">
                <a href="buy-data?network=MTN" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/mtn.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="buy-data?network=AIRTEL" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/airtel.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="buy-data?network=GLO" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/glo.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="buy-data?network=9MOBILE" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/9mobile.png" width="45" height="45" />
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="card card-style mt-3">
            <div class="content mb-2 mt-3">
                <div>
                    <h5>Cable TV</h5>
                    <hr/>
                </div>
                <div class="row text-center mb-0">
                
                    <a href="cable-tv?network=DSTV" class="col-4 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/dstv.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="cable-tv?network=GOTV" class="col-4 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/gotv.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="cable-tv?network=STARTIMES" class="col-4 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/startimes.png" width="45" height="45" />
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="card card-style mt-3">
            <div class="content mb-2 mt-3">
                <div>
                    <h5>Exam Pin</h5>
                    <hr/>
                </div>
                <div class="row text-center mb-0">
                    <a href="exam-pins?network=WAEC" class="col-4 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/waec.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="exam-pins?network=NECO" class="col-4 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/neco.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="exam-pins?network=NABTEB" class="col-4 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/nabteb.png" width="45" height="45" />
                        </span>
                    </a>
                    
                </div>
            </div>
        </div>

        <div class="card card-style mt-3">
            <div class="content mb-2 mt-3">
                <div>
                    <h5>Electricity</h5>
                    <hr/>
                </div>
                <div class="row text-center mb-0">
                
                <a href="electricity?network=Abuja  Electricity (AEDC)" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/aedc.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="electricity?network=Eko Electricity (EKEDC)" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/ekedc.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="electricity?network=Kaduna Electricity (KEDC)" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/kaduna.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="electricity?network=Kano Electricity (KEDCO)" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/kedco.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="electricity?network=Jos Electricity (JED)" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/jos.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="electricity?network=Ikeja Electricity (IE)" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/ikeja.png?v=1" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="electricity?network=Ibadan Electricity (IBEDC)" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/ibedc.png" width="45" height="45" />
                        </span>
                    </a>
                    
                    <a href="electricity?network=Port Harcourt Electricity (PHEDC)" class="col-3 mt-2">
                        <span class="icon icon-l rounded-sm py-2 px-2" style="background:#f2f2f2;">
                            <img src="../../assets/images/icons/phedc.png?v=1" width="45" height="45" />
                        </span>
                    </a>
                    
                </div>
            </div>
        </div>


        
        <div class="card card-style mt-n3">
            <div class="content mb-3 mt-3">
               <div>
                <h5>Others</h5>
                <hr/>
               </div>

                <div class="row text-center mb-0">
                    
                    <a href="transactions" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:#cc0066;">
                            <i class="fa fa-receipt font-18"></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Transactions</p>
                    </a>

                    
                    <a href="pricing" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:#0066ff;">
                            <i class="fa fa-list font-18"></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Pricing</p>
                    </a>


                    <a href="profile" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:#0066ff;">
                            <i class="fa fa-user  font-18"></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Profile</p>
                    </a>
                    
                    <a href="contact-us" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:#ff6600;">
                            <i class="fa fa-envelope font-18"></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Contact</p>
                    </a>

                    

                    <a href="#agent-upgrade-modal" id="upgrade-agent-btn" data-menu="agent-upgrade-modal" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:#00cc00;">
                            <i class="fa fa-user-secret font-18"></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Agent</p>
                    </a>

                    <a href="logout" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:#ff6600;">
                            <i class="fa fa-lock  font-18"></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Logout</p>
                    </a>
                    
                </div>
            </div>
        </div>
          

</div>

