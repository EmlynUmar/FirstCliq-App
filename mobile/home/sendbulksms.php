<div class="page-content header-clear-medium">

        <div class="card card-style">
            
            <div class="content">
                <p class="mb-0 text-center font-600 color-highlight">SMS For All Network</p>
                <h1 class="text-center">Send Bulk SMS</h1>


                <form method="post" id="bulkSMSForm" action="send-bulk-sms.php">
                    <fieldset>
<hr/>
                <div class="d-flex">
                    <h5 style="background:<?php echo $sitecolor; ?>; color:#ffffff; padding:9px;  margin-right:5px;">Info: </h5>
                    <marquee direction="left" scrollamount="5" style="background:#f2f2f2; padding:3px; border-radius:5rem;">
                        <h5 class="py-2">
                        Type or Paste up to 10,000 phone numbers here (080... or 23480...) separate with comma ,NO SPACES!
                        </h5>
                    </marquee>
                </div>
                <hr/>
                <div class="input-style input-style-always-active has-borders  validate-field mb-4">
                            <label for="phoneNumbers" class="color-theme opacity-80 font-700 font-12  ">Sender Name</label>
                            <input type="text" id="senderName" name="senderName" placeholder="Must not exceed 10 characters" class="round-small" maxlength="10" required />
                        </div>
                        
                        

                        <div class="input-style input-style-always-active has-borders mb-4">
                            <label for="message" class="color-theme opacity-80 font-700 font-12">Message</label>
                            <textarea id="message" name="message" placeholder="Enter your message here" class="round-small" rows="3" required></textarea>
                        </div>
                        
                        
                        <div class="input-style input-style-always-active has-borders mb-4">
                            <label for="phoneNumbers" class="color-theme opacity-80 font-700 font-12 rows="80" ">Phone Numbers</label>
                            <textarea type=" number" id="phoneNumbers" name="phoneNumbers" placeholder="Enter phone numbers here seperated by a comma" class="round-small" rows="14" minlength="11" required></textarea>
                        </div>
                        
                        <div class="input-style input-style-always-active has-borders mb-4">
                                <label for="amount" class="color-theme opacity-80 font-700 font-12">Amount</label>
                                <input type="number" name="amount" placeholder="Amount" value="" class="round-small" id="amount" readonly required  />
                            </div>



                        <!-- Add any other relevant options or settings for sending SMS here -->
                        
                        <input name="transref" type="hidden" value="<?php echo $transRef; ?>" />
                            <input name="transkey" id="transkey" type="hidden" />


                        <div class="form-button">
                            <button type="submit" id="btnsubmit" name="send-bulk-sms" style="width: 100%;" class="btn btn-full btn-l font-600 font-15 gradient-highlight mt-4 rounded-s">
                                Proceed
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div>

        </div>

    </div>