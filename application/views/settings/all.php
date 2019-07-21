<?php include("application/views/shared/header.php"); ?>
<body>
    <?php include("application/views/shared/alerts.php"); ?>
    <div class="container">
        <div id="contentRow" class="row">
            <?php include("application/views/shared/sidebar.php"); ?>
            <div id="allSettings" class="mainContent col-md-12 col-lg-9">
                <div class="row">
                <?php foreach($settings AS $setting): ?>
                    <?php
                    $value = $setting->default_value;
                    if(!is_null($setting->value) && $setting->value != "")
                        $value = $setting->value;
                    ?>
                    <div class="col-sm-12 col-md-6">
                        <h6 class="settingName"><?= $setting->name ?></h6>
                        <?php include("application/views/settings/$setting->name.php"); ?>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php include("application/views/messages/newMessageModal.php"); ?>
</body>
<?php include("application/views/shared/footer.php"); ?>