<div class="row">
<div class="col-12">
    
    <div class="box">
        <div class="box-header with-border d-flex align-items-center justify-content-between">
            <h4 class="box-title">Wallet API</h4>
            <a class="btn btn-info btn-rounded text-white" href="configurations">
                <i class="fa fa-plug" aria-hidden="true"></i> Back
            </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form  method="post" class="form-submit">
                    
                <div class="form-group">
                    <label for="success" class="control-label">Wallet One Api Provider Name</label>
                    <div class="">
                    <input type="text" name="walletOneProviderName" value="<?php echo $controller->getConfigValue($data[0],"walletOneProviderName"); ?>" placeholder="Provider Name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="success" class="control-label">Wallet One Api Key</label>
                    <div class="">
                    <input type="text" name="walletOneApi" value="<?php echo $controller->getConfigValue($data[0],"walletOneApi"); ?>" placeholder="API Key" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="success" class="control-label">Wallet One Api Provider</label>
                    <div class="">
                    <select name="walletOneProvider" class="form-control" required>
                        <option value="">Select Api Provider</option>
                        <?php $walletOneProvider=$controller->getConfigValue($data[0],"walletOneProvider"); ?>
                        
                        <?php foreach($data[1] AS $apiLinks): if($apiLinks->type == "Wallet"): ?>
                        <?php if($walletOneProvider == $apiLinks->value): ?>
                            <option value="<?php echo $apiLinks->value; ?>" selected><?php echo $apiLinks->name; ?></option>
                        <?php else: ?>
                            <option value="<?php echo $apiLinks->value; ?>"><?php echo $apiLinks->name; ?></option>
                        <?php endif; endif; endforeach; ?>

                    </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="success" class="control-label">Wallet Two Api Provider Name</label>
                    <div class="">
                    <input type="text" name="walletTwoProviderName" value="<?php echo $controller->getConfigValue($data[0],"walletTwoProviderName"); ?>" placeholder="Provider Name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="success" class="control-label">Wallet Two Api Key</label>
                    <div class="">
                    <input type="text" name="walletTwoApi" value="<?php echo $controller->getConfigValue($data[0],"walletTwoApi"); ?>" placeholder="API Key" class="form-control" required>
                    </div>
                </div>
                

                <div class="form-group">
                    <label for="success" class="control-label">Wallet Two Api Provider</label>
                    <div class="">
                    <select name="walletTwoProvider" class="form-control" required>
                        <option value="">Select Api Provider</option>
                        <?php $walletTwoProvider=$controller->getConfigValue($data[0],"walletTwoProvider"); ?>
                        
                        <?php foreach($data[1] AS $apiLinks): if($apiLinks->type == "Wallet"): ?>
                        <?php if($walletTwoProvider == $apiLinks->value): ?>
                            <option value="<?php echo $apiLinks->value; ?>" selected><?php echo $apiLinks->name; ?></option>
                        <?php else: ?>
                            <option value="<?php echo $apiLinks->value; ?>"><?php echo $apiLinks->name; ?></option>
                        <?php endif; endif; endforeach; ?>

                    </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="success" class="control-label">Wallet Three Api Provider Name</label>
                    <div class="">
                    <input type="text" name="walletThreeProviderName" value="<?php echo $controller->getConfigValue($data[0],"walletThreeProviderName"); ?>" placeholder="Provider Name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="success" class="control-label">Wallet Three Api Key</label>
                    <div class="">
                    <input type="text" name="walletThreeApi" value="<?php echo $controller->getConfigValue($data[0],"walletThreeApi"); ?>" placeholder="API Key" class="form-control" required>
                    </div>
                </div>
                

                <div class="form-group">
                    <label for="success" class="control-label">Wallet Three Api Provider</label>
                    <div class="">
                    <select name="walletThreeProvider" class="form-control" required>
                        <option value="">Select Api Provider</option>
                        <?php $walletThreeProvider=$controller->getConfigValue($data[0],"walletThreeProvider"); ?>
                        
                        <?php foreach($data[1] AS $apiLinks): if($apiLinks->type == "Wallet"): ?>
                        <?php if($walletThreeProvider == $apiLinks->value): ?>
                            <option value="<?php echo $apiLinks->value; ?>" selected><?php echo $apiLinks->name; ?></option>
                        <?php else: ?>
                            <option value="<?php echo $apiLinks->value; ?>"><?php echo $apiLinks->name; ?></option>
                        <?php endif; endif; endforeach; ?>

                    </select>
                    </div>
                </div>

                <!-- Wallet Four Start -->
                <div class="form-group">
                    <label for="success" class="control-label">Wallet Four Api Provider Name</label>
                    <div class="">
                    <input type="text" name="walletFourProviderName" value="<?php echo $controller->getConfigValue($data[0],"walletFourProviderName"); ?>" placeholder="Provider Name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="success" class="control-label">Wallet Four Api Key</label>
                    <div class="">
                    <input type="text" name="walletFourApi" value="<?php echo $controller->getConfigValue($data[0],"walletFourApi"); ?>" placeholder="API Key" class="form-control" required>
                    </div>
                </div>
                

                <div class="form-group">
                    <label for="success" class="control-label">Wallet Four Api Provider</label>
                    <div class="">
                    <select name="walletFourProvider" class="form-control" required>
                        <option value="">Select Api Provider</option>
                        <?php $walletFourProvider=$controller->getConfigValue($data[0],"walletFourProvider"); ?>
                        
                        <?php foreach($data[1] AS $apiLinks): if($apiLinks->type == "Wallet"): ?>
                        <?php if($walletFourProvider == $apiLinks->value): ?>
                            <option value="<?php echo $apiLinks->value; ?>" selected><?php echo $apiLinks->name; ?></option>
                        <?php else: ?>
                            <option value="<?php echo $apiLinks->value; ?>"><?php echo $apiLinks->name; ?></option>
                        <?php endif; endif; endforeach; ?>

                    </select>
                    </div>
                </div>
                <!-- Wallet Four End -->

                <!-- Wallet Five Start -->
                <div class="form-group">
                    <label for="success" class="control-label">Wallet Five Api Provider Name</label>
                    <div class="">
                    <input type="text" name="walletFiveProviderName" value="<?php echo $controller->getConfigValue($data[0],"walletFiveProviderName"); ?>" placeholder="Provider Name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="success" class="control-label">Wallet Five Api Key</label>
                    <div class="">
                    <input type="text" name="walletFiveApi" value="<?php echo $controller->getConfigValue($data[0],"walletFiveApi"); ?>" placeholder="API Key" class="form-control" required>
                    </div>
                </div>
                

                <div class="form-group">
                    <label for="success" class="control-label">Wallet Five Api Provider</label>
                    <div class="">
                    <select name="walletFiveProvider" class="form-control" required>
                        <option value="">Select Api Provider</option>
                        <?php $walletFiveProvider=$controller->getConfigValue($data[0],"walletFiveProvider"); ?>
                        
                        <?php foreach($data[1] AS $apiLinks): if($apiLinks->type == "Wallet"): ?>
                        <?php if($walletFiveProvider == $apiLinks->value): ?>
                            <option value="<?php echo $apiLinks->value; ?>" selected><?php echo $apiLinks->name; ?></option>
                        <?php else: ?>
                            <option value="<?php echo $apiLinks->value; ?>"><?php echo $apiLinks->name; ?></option>
                        <?php endif; endif; endforeach; ?>

                    </select>
                    </div>
                </div>
                <!-- Wallet Five End -->

                <!-- Wallet Six Start -->
                <div class="form-group">
                    <label for="success" class="control-label">Wallet Six Api Provider Name</label>
                    <div class="">
                    <input type="text" name="walletSixProviderName" value="<?php echo $controller->getConfigValue($data[0],"walletSixProviderName"); ?>" placeholder="Provider Name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="success" class="control-label">Wallet Six Api Key</label>
                    <div class="">
                    <input type="text" name="walletSixApi" value="<?php echo $controller->getConfigValue($data[0],"walletSixApi"); ?>" placeholder="API Key" class="form-control" required>
                    </div>
                </div>
                

                <div class="form-group">
                    <label for="success" class="control-label">Wallet Six Api Provider</label>
                    <div class="">
                    <select name="walletSixProvider" class="form-control" required>
                        <option value="">Select Api Provider</option>
                        <?php $walletSixProvider=$controller->getConfigValue($data[0],"walletSixProvider"); ?>
                        
                        <?php foreach($data[1] AS $apiLinks): if($apiLinks->type == "Wallet"): ?>
                        <?php if($walletSixProvider == $apiLinks->value): ?>
                            <option value="<?php echo $apiLinks->value; ?>" selected><?php echo $apiLinks->name; ?></option>
                        <?php else: ?>
                            <option value="<?php echo $apiLinks->value; ?>"><?php echo $apiLinks->name; ?></option>
                        <?php endif; endif; endforeach; ?>

                    </select>
                    </div>
                </div>
                <!-- Wallet Six End -->

                
                <div class="form-group">
                    <div class="">
                       <button type="submit" name="update-api-config" class="btn btn-info btn-submit"><i class="fa fa-save" aria-hidden="true"></i> Update Details</button>
                    </div>
                </div>
        </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
</div>
</div>



