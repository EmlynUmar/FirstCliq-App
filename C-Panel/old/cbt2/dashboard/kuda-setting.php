<div class="row">
<div class="col-12">
    
    <div class="box">
        <div class="box-header with-border d-flex align-items-center justify-content-between">
            <h4 class="box-title">Kuda API</h4>

            <div>
                        <a class="btn btn-info btn-rounded btn-sm text-white" href="kuda-withdrawal">
                            <i class="fa fa-download" aria-hidden="true"></i> Withdraw
                        </a>
                        <a class="btn btn-info btn-sm btn-rounded text-white ml-2" href="configurations">
                            <i class="fa fa-plug" aria-hidden="true"></i> Back
                        </a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form  method="post" class="form-submit">
                    
                <div class="form-group">
                    <label for="success" class="control-label">Kuda Api Email</label>
                    <div class="">
                    <input type="text" name="kudaEmail" value="<?php echo $controller->getConfigValue($data,"kudaEmail"); ?>" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="success" class="control-label">Kuda Api Key</label>
                    <div class="">
                    <input type="password" name="kudaApi" value="<?php echo $controller->getConfigValue($data,"kudaApi"); ?>" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="success" class="control-label">Kuda Webhook Username</label>
                    <div class="">
                    <input type="text" name="kudaWebhookUser" value="<?php echo $controller->getConfigValue($data,"kudaWebhookUser"); ?>" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="success" class="control-label">Kuda Webhook Password</label>
                    <div class="">
                    <input type="password" name="kudaWebhookPass" value="<?php echo $controller->getConfigValue($data,"kudaWebhookPass"); ?>" class="form-control" required="required">
                    </div>
                </div>

                <div class="form-group">
                    <label for="success" class="control-label">Topup Charges Type</label>
                    <div class="">
                        <select name="kudaChargesType" class="form-control" required="required">
                        <?php if($controller->getConfigValue($data,"kudaChargesType") == "flat"): ?>
                            <option value="flat" selected>Flat Rate</option>
                            <option value="per">Percentage</option>
                        <?php else: ?>
                            <option value="flat">Flat Rate</option>
                            <option value="per" selected>Percentage</option>
                        <?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="success" class="control-label">Wallet Topup Charges</label>
                    <div class="">
                    <input type="text" name="kudaCharges" pattern="^\d*(\.\d{0,3})?$" value="<?php echo $controller->getConfigValue($data,"kudaCharges"); ?>" class="form-control" required="required">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="success" class="control-label">Kuda Activation</label>
                    <div class="">
                        <select name="kudaStatus" class="form-control" required="required">
                        <?php if($controller->getConfigValue($data,"kudaStatus") == "On"): ?>
                            <option value="On" selected>On</option>
                            <option value="Off">Off</option>
                        <?php else: ?>
                            <option value="On">On</option>
                            <option value="Off" selected>Off</option>
                        <?php endif; ?>
                        </select>
                    </div>
                </div>

               
                    

                <div class="form-group">
                    <div class="">
                       <button type="submit" name="update-kuda-config" class="btn btn-info btn-submit"><i class="fa fa-save" aria-hidden="true"></i> Update Details</button>
                    </div>
                </div>
        </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
</div>
</div>



