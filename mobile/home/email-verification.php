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
        <div class="page-content header-clear-medium">
        
        
        <div class="card card-style">

            <div class="content text-center">
                <img src="../../assets/images/icons/email-verification.png" style="width:250px; height:200px;" />
           
                <p class="mb-0 font-600 color-highlight">Email Verification</p>
                <h1>Verification</h1>
                <p class="mb-1 font-600 text-danger">A Verification Code Has Been Sent To Your Email. Please Provide The Code Below To Verify Your Account.</p>
                <p class="mb-3 font-600 text-danger">If You Can't Find The Verification Code, Please Do Check Your Spam Folder.</p>
                
                <form method="post" class="contactForm the-submit-form">
                        <fieldset>
                            <input type="hidden" name="email" value="<?php echo $data->sEmail; ?>" />
                            <div class="form-field form-name">
                                <input type="number" name="code" placeholder="Code" value="" class="round-small" id="contactNameField" required />
                            </div>
                            
                            <div class="form-button">
                            <button type="submit" name="email-verification" style="width: 100%;" class="the-form-btn btn btn-full btn-l font-600 font-15 gradient-highlight mt-4 rounded-s">
                                    Verify
                            </button>
                            </div>
                        </fieldset>
                    </form>        
            </div>

        </div>

</div>

