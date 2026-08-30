
        <div class="page-content header-clear-medium">
        
        
        <div class="card card-style bg-theme pb-0">
            <div class="content" id="tab-group-1">
                <div class="tab-controls tabs-small tabs-rounded" data-highlight="bg-highlight">
                    <a href="#" data-active data-bs-toggle="collapse" data-bs-target="#tab-1">Bank</a>
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#tab-2">Card</a>
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#tab-3">Manual</a>
                </div>
                <div class="clearfix mb-3"></div>
                <div data-bs-parent="#tab-group-1" class="collapse show" id="tab-1">
                <div class="text-center">
                    <p class="text-center">
                        <span class="icon icon-l gradient-blue shadow-l rounded-sm">
                            <i class="fa fa-arrow-up font-30 color-white"></i>
                        </span>
                    </p>
                   
                   
                    <h4 class="text-primary">FUND WALLET</h4>
                     <center>
        
        
             <div class="">
            <div class="content" id="tab-group-1">
          
                

        <a  href="payvessel-verify" style="width: 100%; background-color:#730089;" class="btn btn-full btn-l font-600 font-15 mt-4 rounded-s">
                               <i class="fas fa-id-card mr-2"></i>CLICK HERE TO KYC 9PSB
                            </a>
            </div>
            </div>
                    
         </center>
                   
                   
                    
                    <p class="mb-2 text-dark font-600 font-16"><b>Bank Name: </b>9Payment Service Bank (9PSB)</p> 
                    <p class="mb-2 text-dark font-600 font-16"><b>Account No: </b><?php echo $data->sPayvesselBank; ?></p> 
                    <p class="mb-2 text-danger font-600 font-15"><b>Note: </b> Automated bank transfer attracts additional charges of <?php echo $payvesChargesText; ?> only.</p> 
                    <button class="btn btn-primary font-700 rounded-xl mt-3" onclick="copyToClipboard('<?php echo $data->sPayvesselBank; ?>')">Copy Account No</button> 
                   
                    <hr/> 
                 
                    <!-- PAYVESSEL BANK END -->                  
                  
                  
 </br>
                    
                                                <?php
                    
                    //print_r($data2);
                    //die();
                    
                    if($controller->getConfigValue($data2,"asfiyStatus") == "On"): ?>
                    <?php 
                    $asfiyCharges = $controller->getConfigValue($data2,"asfiyCharges");
                    $asfiyChargesType = $controller->getConfigValue($data2,"asfiyChargesType"); ?>
                    <?php $asfiyChargesText = ($asfiyChargesType == "flat") ? "N".$asfiyCharges : $asfiyCharges."%"; ?>
                    <?php if(empty($data->sPaga)): ?>
                        <p class="mb-2 text-danger font-600 font-15">Get A Palmpay Account For Automated Transfer, Generate A Dedicated Account Number Now. Funding Attracts <?php echo $asfiyChargesText; ?> only.</p>
                        <form method="POST" id="aspfiyform1"><input type="hidden" name="generate-aspfiy-palmpay" value="YES" /></form>
                        <button class="btn btn-primary font-700 rounded-xl mt-3" id="aspfiybtn1" onclick="$('#aspfiybtn1').removeClass('btn-primary'); $('#aspfiybtn1').addClass('btn-secondary'); $('#aspfiybtn1').html('<i class=\'fa fa-spinner fa-spin\'></i> Processing ...'); $('#aspfiyform1').submit();">Generate Account</button>
                    <?php else: ?>
                    <p class="mb-2 text-dark font-600 font-16"><b>Bank Name: </b>Palmpay Microfinance Bank</p>
                    <p class="mb-2 text-dark font-600 font-16"><b>Account No: </b><?php echo $data->sPaga; ?></p>
                    <p class="mb-2 text-danger font-600 font-15"><b>Note: </b> Automated bank transfer attracts additional charges of <?php echo $asfiyChargesText; ?> only.</p>
                    <button class="btn btn-primary font-700 rounded-xl mt-3" onclick="copyToClipboard('<?php echo $data->sPaga; ?>')">Copy Account No</button>
                    <?php endif; ?>
                    <hr/>
                    <?php endif; ?>
                    <!-- ASPFIY BANK START-->
                    <?php
                    
                    //print_r($data2);
                    //die();
                    
                    if($controller->getConfigValue($data2,"asfiyStatus") == "On"): ?>
                    <?php 
                    $asfiyCharges = $controller->getConfigValue($data2,"asfiyCharges");
                    $asfiyChargesType = $controller->getConfigValue($data2,"asfiyChargesType"); ?>
                    <?php $asfiyChargesText = ($asfiyChargesType == "flat") ? "N".$asfiyCharges : $asfiyCharges."%"; ?>
                    <?php if(empty($data->sAsfiyBank)): ?>
                        <p class="mb-2 text-danger font-600 font-15">Get A Paga Account For Automated Transfer, Generate A Dedicated Account Number Now. Funding Attracts <?php echo $asfiyChargesText; ?> only.</p>
                        <form method="POST" id="kudaform"><input type="hidden" name="generate-aspfiy-account" value="YES" /></form>
                        <button class="btn btn-primary font-700 rounded-xl mt-3" id="kudabtn" onclick="$('#kudabtn').removeClass('btn-primary'); $('#kudabtn').addClass('btn-secondary'); $('#kudabtn').html('<i class=\'fa fa-spinner fa-spin\'></i> Processing ...'); $('#kudaform').submit();">Generate Account</button>
                    <?php else: ?>
                    <p class="mb-2 text-dark font-600 font-16"><b>Bank Name: </b>Paga Bank</p>
                    <p class="mb-2 text-dark font-600 font-16"><b>Account No: </b><?php echo $data->sAsfiyBank; ?></p>
                    <p class="mb-2 text-danger font-600 font-15"><b>Note: </b> Automated bank transfer attracts additional charges of <?php echo $asfiyChargesText; ?> only.</p>
                    <button class="btn btn-primary font-700 rounded-xl mt-3" onclick="copyToClipboard('<?php echo $data->sAsfiyBank; ?>')">Copy Account No</button>
                    <?php endif; ?>
                    <hr/>
                    <?php endif; ?>
                    <!-- KUDA BANK END -->
             
                <!-- MONNIFY  KYC START -->
                    
                    <?php  if($profileDetails->sKycStatus <> "verified" && $siteSettings->kycShouldEnable == "yes"): ?>
                        
                      <br> <div>
                          <p class="mb-0 font-600 color-highlight">KYC Verification Required To Get virtual Account</p>
                            
                            <p class="mb-1 font-600 text-danger">As Required By The Central Bank Of Nigeria (CBN), We Would Need To Verify Your Identity Using Your NIN or BVN. This Process Is Automatic And You Would Be Able To get an account Once Verified.</p>
                            
                            <a href="kyc-verification" style="width: 100%;" class="the-form-btn btn btn-full btn-l font-600 font-15 gradient-highlight mt-4 rounded-s">
                                            Start Verification
                            </a>
                            
                            
                            <br>  
                            
                            
                            </div><br>
                      <?php else: ?>
                   
              
                    
                      <!-- MONNIFY BANK START -->
                    <?php if($controller->getConfigValue($data2,"monifyStatus") == "On"): ?>
                        <?php $chargesText = $controller->getConfigValue($data2,"monifyCharges"); ?>
                        <?php if($chargesText == 50 || $chargesText == "50"){$chargesText = "N".$chargesText;} else {$chargesText = $chargesText."%";} ?>
                        <?php if($controller->getConfigValue($data2,"monifyGtStatus") == "On"): ?>
                        <?php if(empty($data->sGtBank)): ?>
                            <p class="mb-2 text-danger font-600 font-15">Get A GT Bank Account For Automated Transfer, Generate A Dedicated Account Number Now. Funding Attracts <?php echo $chargesText; ?> only.</p>
                            <form method="POST" id="gtbankform"><input type="hidden" name="generate-gtbank-account" value="YES" /></form>
                            <button class="btn btn-primary font-700 rounded-xl mt-3" id="gtbankbtn" onclick="$('#gtbankbtn').removeClass('btn-primary'); $('#gtbankbtn').addClass('btn-secondary'); $('#gtbankbtn').html('<i class=\'fa fa-spinner fa-spin\'></i> Processing ...'); $('#gtbankform').submit();">Generate Account</button>
                        <?php else: ?>
                            <p class="mb-2 text-dark font-600 font-16"><b>Bank Name: </b>GT Bank</p>
                            <p class="mb-2 text-dark font-600 font-16"><b>Account No: </b><?php echo $data->sGtBank; ?></p>
                            <p class="mb-2 text-danger font-600 font-15"><b>Note: </b> Automated bank transfer attracts additional charges of <?php echo $chargesText; ?> only.</p>
                            <button class="btn btn-primary font-700 rounded-xl mt-3" onclick="copyToClipboard('<?php echo $data->sGtBank; ?>')">Copy Account No</button>
                        <?php endif; ?>
                        <hr/>
                        <?php endif; if($controller->getConfigValue($data2,"monifyFeStatus") == "On"): ?>
                        <p class="mb-2 text-dark font-600 font-16"><b>Bank Name: </b>Fidelity  Bank</p>
                        <p class="mb-2 text-dark font-600 font-16"><b>Account No: </b><?php echo $data->sFidelityBank; ?></p>
                        <p class="mb-2 text-danger font-600 font-15"><b>Note: </b> Automated bank transfer attracts additional charges of <?php echo $chargesText; ?> only.</p>
                        <button class="btn btn-primary font-700 rounded-xl mt-3" onclick="copyToClipboard('<?php echo $data->sFidelityBank; ?>')">Copy Account No</button>
                        <hr/>
                        <?php endif; if($controller->getConfigValue($data2,"monifyMoStatus") == "On"): ?>
                        <p class="mb-2 text-dark font-600 font-16"><b>Bank Name: </b>Moniepoint Bank</p>
                        <p class="mb-2 text-dark font-600 font-16"><b>Account No: </b><?php echo $data->sRolexBank; ?></p>
                        <p class="mb-2 text-danger font-600 font-15"><b>Note: </b> Automated bank transfer attracts additional charges of <?php echo $chargesText; ?> only.</p>
                        <button class="btn btn-primary font-700 rounded-xl mt-3" onclick="copyToClipboard('<?php echo $data->sRolexBank; ?>')">Copy Account No</button>
                        <hr/>
                        <?php endif; if($controller->getConfigValue($data2,"monifyWeStatus") == "On"): ?>
                        <p class="mb-2 text-dark font-600 font-16"><b>Bank Name: Wema Bank</p>
                        <p class="mb-2 text-dark font-600 font-16"><b>Account No: </b><?php echo $data->sBankNo; ?></p>
                        <p class="mb-2 text-danger font-600 font-15"><b>Note: </b> Automated bank transfer attracts additional charges of <?php echo $chargesText; ?> only.</p>
                        <button class="btn btn-primary font-700 rounded-xl mt-3" onclick="copyToClipboard('<?php echo $data->sBankNo; ?>')">Copy Account No</button>
                        <hr/>
                        <?php endif; if($controller->getConfigValue($data2,"monifySaStatus") == "On"): ?>
                        <p class="mb-2 text-dark font-600 font-16"><b>Bank Name: </b>Sterling Bank</p>
                        <p class="mb-2 text-dark font-600 font-16"><b>Account No: </b><?php echo $data->sSterlingBank; ?></p>
                        <p class="mb-2 text-danger font-600 font-15"><b>Note: </b> Automated bank transfer attracts additional charges of <?php echo $chargesText; ?> only.</p>
                        <button class="btn btn-primary font-700 rounded-xl mt-3" onclick="copyToClipboard('<?php echo $data->sSterlingBank; ?>')">Copy Account No</button>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!-- MONNIFY BANK END -->

                    <?php endif; ?>
                </div>
                </div>

                <div data-bs-parent="#tab-group-1" class="collapse" id="tab-2">
                        <div class="text-center">
                            <p class="text-center">
                                <span class="icon icon-l gradient-blue shadow-l rounded-sm">
                                    <i class="fa fa-arrow-up font-30 color-white"></i>
                                </span>
                            </p>
                            <h4 class="text-primary">FUND WALLET</h4>
                            <p class="mb-2 text-dark font-600 font-16">
                                Pay with card, bank transfer, ussd, or bank deposit. Secured by Paystack
                            </p>
                    
                        </div>
                        
                        <?php if($controller->getConfigValue($data2,"paystackStatus") == "On"): ?>
                        <form  method="post">
                        <div class="mt-5 mb-3">
                            
                            <div class="input-style has-borders no-icon input-style-always-active mb-4">
                                <input type="hidden" value="<?php echo $controller->getConfigValue($data2,"paystackCharges"); ?>" id="paystackcharges" name="paystackcharges" />
                                <input type="number" onkeyup="calculatePaystackCharges()" class="form-control" id="amount" name="amount" placeholder="Amount" required>
                                <label for="amount" class="color-highlight">Amount</label>
                                <em>(required)</em>
                            </div>
                            <div class="input-style has-borders no-icon input-style-always-active  mb-4">
                                <input type="text" class="form-control" id="charges" placeholder="Charges" readonly>
                                <label for="charges" class="color-highlight">Charges</label>
                                <em>(required)</em>
                            </div>
                            <div class="input-style has-borders no-icon input-style-always-active  mb-4">
                                <input type="text" class="form-control" id="amounttopay" placeholder="You Would Get" readonly>
                                <label for="amounttopay" class="color-highlight">You Would Get</label>
                                <em>(required)</em>
                            </div>

                            <input type="hidden" name="email" value="<?php echo $data->sEmail; ?>" />
                        </div>

                        <div class="text-center"><img src="../../assets/img/paystack.png" /></div>
                        <button type="submit" id="fund-with-paystack" name="fund-with-paystack" style="width: 100%;" class="btn btn-full btn-l font-600 font-15 gradient-highlight mt-4 rounded-s">
                                Pay Now
                        </button>
                        </form>
                        <?php else : ?>
                            <h3 class="text-center text-danger">Opps!! Paystack Payment Is Disabled, Please Contact Admin</h3>
                        <?php endif; ?>
                </div>

                  <div data-bs-parent="#tab-group-1" class="collapse" id="tab-3">
                <div class="text-center">
                    <p class="text-center">
                        <span class="icon icon-l gradient-blue shadow-l rounded-sm">
                            <i class="fa fa-arrow-up font-30 color-white"></i>
                        </span>
                    </p>
                    <h4 class="text-primary">FUND WALLET</h4>
                    <p class="mb-2 text-dark font-600 font-16"><b>Bank Name: </b><?php echo $data3->bankname; ?></p>
                    <p class="mb-2 text-dark font-600 font-16"><b>Account Name: </b><?php echo $data3->accountname; ?></p>
                    <p class="mb-2 text-dark font-600 font-16"><b>Account No: </b><?php echo $data3->accountno; ?></p>
                    <p class="mb-2 text-danger font-600 font-15"><b>Note: </b> Check if admin is online before making any transfer.</p>
                    <button class="btn btn-primary font-700 rounded-xl mt-3" onclick="copyToClipboard('<?php echo $data3->accountno; ?>')">Copy Account No</button>
                    <a class="btn btn-success font-700 rounded-xl mt-3" href="https://wa.me/234<?php echo $data3->whatsapp; ?>">Contact Admin</a>
                    
                </div>
                </div>

                
                
            </div>
        </div> 

</div>

