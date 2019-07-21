<?php include("application/views/shared/header.php"); ?>
<body>
    <?php include("application/views/shared/alerts.php"); ?>
    <div class="container">
        <div id="contentRow" class="row">
            <?php include("application/views/shared/sidebar.php"); ?>
            <div id="allMessages" class="mainContent col-md-12 col-lg-9">
                <div class="tab-content" id="pages">
                <?php foreach($allMessages AS $page => $messages): ?>
                    <div class="tab-pane fade <?= $page == 0 ? "show active": "" ?>" id="page<?= $page+1 ?>" role="tabpanel" aria-labelledby="">
                        <div class="row">
                        <?php foreach($messages AS $message) {
                            include("application/views/messages/message.php");
                        }
                        ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
                    <div id="pagination">
                        <nav>
                            <ul class="nav nav-pills justify-content-center">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#page1" role="tab">1</a></li>

                                <?php for($i = 2; $i <= count($allMessages); $i++) :?>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#page<?= $i ?>" role="tab"><?= $i ?></a></li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div>
            </div>
        </div>
    </div>
    <?php include("application/views/messages/newMessageModal.php"); ?>
    <?php include("application/views/messages/expandMessageModal.php"); ?>
    <?php if($admin) : ?>
        <?php include("application/views/messages/editMessageModal.php"); ?>
        <?php include("application/views/messages/deleteModal.php"); ?>
    <?php endif; ?>
    <?php include("application/views/shared/loginModal.php"); ?>
</body>
<?php include("application/views/shared/footer.php"); ?>