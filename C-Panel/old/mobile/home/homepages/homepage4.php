<div class="page-content header-clear-medium">

    <div class="mb-n3 splide single-slider slider-no-arrows slider-no-dots splide--loop splide--ltr splide--draggable is-active" id="single-slider-1" style="visibility: visible;">
                    <div class="splide__arrows"><button class="splide__arrow splide__arrow--prev" type="button" aria-controls="single-slider-1-track" aria-label="Go to last slide"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40"><path d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path></svg></button><button class="splide__arrow splide__arrow--next" type="button" aria-controls="single-slider-1-track" aria-label="Next slide"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40"><path d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path></svg></button></div>
                    <div class="splide__track" id="single-slider-1-track">
                        <div class="splide__list" id="single-slider-1-list" style="transform: translateX(-1356px);">
                            
                            <!-- Slide 1 -->
                            <?php if($controller->getConfigValue($data2,"monifyMoStatus") == "On"): ?>
                            <div class="splide__slide splide__slide--clone" aria-hidden="true" tabindex="-1" style="width: 678px;">
                                <div class="card card-style bg-20 " data-card-height="250" 
                                     style="height: 250px; background-image: linear-gradient(to top, <?php echo $sitecolor; ?> 0%, <?php echo $sitecolor; ?> 100%); ">
                                                <div class="card-top ps-3 pt-2">
                                                    <h1 class="color-white font-19"><?php echo "Hi, ".$data->sFname; ?></h1>
                                                </div>
                                                <div class="card-top pe-3 pt-2">
                                                    <h5 class="color-white float-end">(<?php echo $controller->formatUserType($data->sType); ?>)</h5>
                                                </div>
                                                <div class="card-center ps-3 pt-2">
                                                    <h4 class="color-white font-15">
                                                        Account Name: 
                                                        <br/> Account No: 
                                                        <br/> Bank Name: 
                                                    </h4>
                                                </div>
                                                <div class="card-center pe-3 pt-2">
                                                    <h4 class="color-white text-end font-15">
                                                        <?php echo $controller->formatUserEmail($data->sEmail); ?> 
                                                        <br/><?php echo $data->sRolexBank; ?>
                                                        <br/>Moniepoint Bank
                                                    </h4>
                                                </div>
                                                <div class="card-bottom ps-3 pb-2 bt-3">
                                                    <h5 class="color-white font-12">Note: Bank transfer attracts charges of <?php echo $controller->getConfigValue($data2,"monifyCharges"); ?>%</h5>
                                                </div>

                                                <div class="card-bottom ps-3 pb-2 bt-3">
                                                    <a href="#" onclick="copyToClipboard('<?php echo $data->sRolexBank; ?>')" class="btn float-end" style="background-color:<?php echo $sitecolor; ?>; border-radius:5rem; margin-right:7px"><b>Copy</b></a>
                                                </div>
                                                
                                                <div class="card-overlay bg-gradient"></div>
                                </div>
                            </div>
                            
                            <!-- Slide 2 -->
                            <?php endif; if($controller->getConfigValue($data2,"monifyWeStatus") == "On"): ?>
                            <div class="splide__slide" id="single-slider-1-slide02" aria-hidden="true" tabindex="-1" style="width: 678px;">
                                <div class="card card-style bg-20 " data-card-height="250" 
                                     style="height: 250px; background-image: linear-gradient(to top, <?php echo $sitecolor; ?> 0%, <?php echo $sitecolor; ?> 100%); ">
                                                <div class="card-top ps-3 pt-2">
                                                    <h1 class="color-white font-19"><?php echo "Hi, ".$data->sFname; ?></h1>
                                                </div>
                                                <div class="card-top pe-3 pt-2">
                                                    <h5 class="color-white float-end">(<?php echo $controller->formatUserType($data->sType); ?>)</h5>
                                                </div>
                                                <div class="card-center ps-3 pt-2">
                                                    <h4 class="color-white font-15">
                                                        Account Name: 
                                                        <br/> Account No: 
                                                        <br/> Bank Name: 
                                                    </h4>
                                                </div>
                                                <div class="card-center pe-3 pt-2">
                                                    <h4 class="color-white text-end font-15">
                                                        <?php echo $controller->formatUserEmail($data->sEmail); ?> 
                                                        <br/><?php echo $data->sBankNo; ?>
                                                        <br/>Wema Bank
                                                    </h4>
                                                </div>
                                                <div class="card-bottom ps-3 pb-2 bt-3">
                                                    <h5 class="color-white font-12">Note: Bank transfer attracts charges of <?php echo $controller->getConfigValue($data2,"monifyCharges"); ?>%</h5>
                                                </div>

                                                <div class="card-bottom ps-3 pb-2 bt-3">
                                                    <a href="#" onclick="copyToClipboard('<?php echo $data->sBankNo; ?>')" class="btn float-end" style="background-color:<?php echo $sitecolor; ?>; border-radius:5rem; margin-right:7px"><b>Copy</b></a>
                                                </div>
                                                
                                                <div class="card-overlay bg-gradient"></div>
                                </div>
                            </div>
                            <!-- Slide 3 -->
                            <?php endif; if($controller->getConfigValue($data2,"monifySaStatus") == "On"): ?>
                            <div class="splide__slide" id="single-slider-1-slide03" aria-hidden="true" tabindex="-1" style="width: 678px;">
                                <div class="card card-style bg-20 " data-card-height="250" 
                                     style="height: 250px; background-image: linear-gradient(to top, <?php echo $sitecolor; ?> 0%, <?php echo $sitecolor; ?> 100%); ">
                                                <div class="card-top ps-3 pt-2">
                                                    <h1 class="color-white font-19"><?php echo "Hi, ".$data->sFname; ?></h1>
                                                </div>
                                                <div class="card-top pe-3 pt-2">
                                                    <h5 class="color-white float-end">(<?php echo $controller->formatUserType($data->sType); ?>)</h5>
                                                </div>
                                                <div class="card-center ps-3 pt-2">
                                                    <h4 class="color-white font-15">
                                                        Account Name: 
                                                        <br/> Account No: 
                                                        <br/> Bank Name: 
                                                    </h4>
                                                </div>
                                                <div class="card-center pe-3 pt-2">
                                                    <h4 class="color-white text-end font-15">
                                                        <?php echo $controller->formatUserEmail($data->sEmail); ?> 
                                                        <br/><?php echo $data->sSterlingBank; ?>
                                                        <br/>Sterling Bank
                                                    </h4>
                                                </div>
                                                <div class="card-bottom ps-3 pb-2 bt-3">
                                                    <h5 class="color-white font-12">Note: Bank transfer attracts charges of <?php echo $controller->getConfigValue($data2,"monifyCharges"); ?>%</h5>
                                                </div>

                                                <div class="card-bottom ps-3 pb-2 bt-3">
                                                    <a href="#" onclick="copyToClipboard('<?php echo $data->sSterlingBank; ?>')" class="btn float-end" style="background-color:<?php echo $sitecolor; ?>; border-radius:5rem; margin-right:7px"><b>Copy</b></a>
                                                </div>
                                                
                                                <div class="card-overlay bg-gradient"></div>
                                </div>
                            </div>


                            <!-- Slide 4 -->
                            <?php endif; if($controller->getConfigValue($data2,"monifyFeStatus") == "On"): ?>
                            <div class="splide__slide" id="single-slider-1-slide04" aria-hidden="true" tabindex="-1" style="width: 678px;">
                                <div class="card card-style bg-20 " data-card-height="250" 
                                     style="height: 250px; background-image: linear-gradient(to top, <?php echo $sitecolor; ?> 0%, <?php echo $sitecolor; ?> 100%); ">
                                                <div class="card-top ps-3 pt-2">
                                                    <h1 class="color-white font-19"><?php echo "Hi, ".$data->sFname; ?></h1>
                                                </div>
                                                <div class="card-top pe-3 pt-2">
                                                    <h5 class="color-white float-end">(<?php echo $controller->formatUserType($data->sType); ?>)</h5>
                                                </div>
                                                <div class="card-center ps-3 pt-2">
                                                    <h4 class="color-white font-15">
                                                        Account Name: 
                                                        <br/> Account No: 
                                                        <br/> Bank Name: 
                                                    </h4>
                                                </div>
                                                <div class="card-center pe-3 pt-2">
                                                    <h4 class="color-white text-end font-15">
                                                        <?php echo $controller->formatUserEmail($data->sEmail); ?> 
                                                        <br/><?php echo $data->sFidelityBank; ?>
                                                        <br/>Fidelity Bank
                                                    </h4>
                                                </div>
                                                <div class="card-bottom ps-3 pb-2 bt-3">
                                                    <h5 class="color-white font-12">Note: Bank transfer attracts charges of <?php echo $controller->getConfigValue($data2,"monifyCharges"); ?>%</h5>
                                                </div>

                                                <div class="card-bottom ps-3 pb-2 bt-3">
                                                    <a href="#" onclick="copyToClipboard('<?php echo $data->sFidelityBank; ?>')" class="btn float-end" style="background-color:<?php echo $sitecolor; ?>; border-radius:5rem; margin-right:7px"><b>Copy</b></a>
                                                </div>
                                                
                                                <div class="card-overlay bg-gradient"></div>
                                </div>
                            </div>
                            <?php endif;  ?>

                        </div>
                    </div>

                <ul class="splide__pagination"><li><button class="splide__pagination__page is-active" type="button" aria-controls="single-slider-1-slide01" aria-label="Go to slide 1" aria-current="true"></button></li><li><button class="splide__pagination__page" type="button" aria-controls="single-slider-1-slide02" aria-label="Go to slide 2"></button></li><li><button class="splide__pagination__page" type="button" aria-controls="single-slider-1-slide03" aria-label="Go to slide 3"></button></li><li><button class="splide__pagination__page" type="button" aria-controls="single-slider-1-slide04" aria-label="Go to slide 4"></button></li></ul>
        </div>
        


        <div class="card card-style mt-2" style="height: 50px;">
                
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

        <div class="card card-style mt-2">
            <div class="content mb-2 mt-2">
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

        <div class="card card-style mt-2">
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

        <div class="card card-style mt-n3">
            <div class="content mb-3 mt-3">
               <div>
                <h5>Others</h5>
                <hr/>
               </div>

                <div class="row text-center mb-0">
                    
               

                    <a href="cable-tv" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:<?php echo $sitecolor; ?>;">
                            <i class="fa fa-tv font-18 "></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Cable TV</p>
                    </a>

                    <a href="electricity" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:<?php echo $sitecolor; ?>;">
                            <i class="fa fa-bolt font-18 "></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Electricity</p>
                    </a>

                    <a href="exam-pins" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:<?php echo $sitecolor; ?>;">
                            <i class="fa fa-graduation-cap font-18 "></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Exam Pins</p>
                    </a>
                    
                    <a href="transactions" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:<?php echo $sitecolor; ?>;">
                            <i class="fa fa-receipt font-18"></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Transactions</p>
                    </a>

                    
                    <a href="pricing" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:<?php echo $sitecolor; ?>;">
                            <i class="fa fa-list font-18"></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Pricing</p>
                    </a>

                    

                    <a href="profile" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:<?php echo $sitecolor; ?>;">
                            <i class="fa fa-user  font-18"></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Profile</p>
                    </a>
                    
                    <a href="contact-us" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:<?php echo $sitecolor; ?>;">
                            <i class="fa fa-envelope font-18"></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Contact</p>
                    </a>

                    

                    <a href="#agent-upgrade-modal" id="upgrade-agent-btn" data-menu="agent-upgrade-modal" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:<?php echo $sitecolor; ?>;">
                            <i class="fa fa-user-secret font-18"></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Agent</p>
                    </a>

                    <a href="logout" class="col-4 mt-2">
                        <span class="icon icon-l shadow-l rounded-sm" style="color:<?php echo $sitecolor; ?>;">
                            <i class="fa fa-lock  font-18"></i>
                        </span>
                        <p class="mb-0 pt-1 font-13">Logout</p>
                    </a>
                    
                </div>
            </div>
        </div>

</div>

