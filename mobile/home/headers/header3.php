<div class="header header-fixed pt-2 pb-2" style="height: auto !important; transform: translateX(0px); background-color:#4f0047;">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center">
                <div>
                    <a href="profile">
                        <img src="../../assets/img/logodark.png" style="border-radius:5rem; width:45px; height:45px; margin-right:10px;">
                    </a>
                </div>
                <div>
                    <h5 class="my-0 py-0 mt-2" style="line-height: 10px;"><a href="profile" style="color:white">Good day, <?php echo $profileDetails->sFname; ?></a></h5>
                    <p class="my-0 py-0  text-dark"><strong> <font color="white">  <?php echo " (" . $controller->formatUserType($profileDetails->sType) . ")"; ?></font></strong></p>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <a href="notifications" class="mr-2">
                    <h3><ion-icon class="font-25" style="color:white" name="notifications"></ion-icon></h3>
                </a>
            </div>

        </div>
    </div>
</div>