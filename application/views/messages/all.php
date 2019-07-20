<?php include("application/views/shared/header.php"); ?>
<body>
    <?php include("application/views/shared/alerts.php"); ?>
    <div class="container">
        <div id="contentRow" class="row">
            <div id="smallGreeting" class="d-md-block d-lg-none col-sm-12">
                <?php include("application/views/shared/greeting.php"); ?>
            </div>
            <div id="largeGreeting" class="d-md-none d-lg-block col-md-12 col-lg-3">
                <?php include("application/views/shared/greeting.php"); ?>
                <div id="largeMenu">
                    <div class="list-group">
                        <?php if(!$admin) : ?>
                        <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#loginModal">
                            Admin Login
                        </a>
                        <?php else : ?>
                        <a href="" class="list-group-item list-group-item-action">
                            Home
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            Approve Messages
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            Settings
                        </a>
                        <a href="logout" class="list-group-item list-group-item-action">
                            Logout
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
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
    <?php include("application/views/shared/loginModal.php"); ?>
</body>
<?php include("application/views/shared/footer.php"); ?>