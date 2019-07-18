<?php include("application/views/shared/header.php"); ?>
<body>
    <div class="container">
        <div id="contentRow" class="row">
            <div id="smallGreeting" class="d-md-block d-lg-none col-sm-12">
                <?php include("application/views/shared/greeting.php"); ?>
            </div>
            <div id="largeGreeting" class="d-md-none d-lg-block col-md-12 col-lg-3">
                <?php include("application/views/shared/greeting.php"); ?>
            </div>
            <div id="allMessages" class="col-md-12 col-lg-9">
                <div class="row">
                    <?php foreach($allMessages AS $message) {
                            include("application/views/messages/message.php");
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include("application/views/messages/newMessageModal.php"); ?>
</body>
<?php include("application/views/shared/footer.php"); ?>