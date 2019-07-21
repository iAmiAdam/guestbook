<div id="smallGreeting" class="d-md-block d-lg-none col-sm-12">
    <?php include("application/views/shared/greeting.php"); ?>
    <div id="smallMenu">
        <div class="list-group list-group-horizontal flex-fill">
            <?php if(!$admin) : ?>
                <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#loginModal">
                    Admin Login
                </a>
            <?php else : ?>
                <a href="home" class="list-group-item list-group-item-action">
                    Home
                </a>
                <a href="approve" class="list-group-item list-group-item-action">
                    Approve Messages
                </a>
                <a href="settings" class="list-group-item list-group-item-action">
                    Settings
                </a>
                <a href="logout" class="list-group-item list-group-item-action">
                    Logout
                </a>
            <?php endif; ?>
        </div>
    </div>
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
                <a href="home" class="list-group-item list-group-item-action">
                    Home
                </a>
                <a href="approve" class="list-group-item list-group-item-action">
                    Approve Messages
                </a>
                <a href="settings" class="list-group-item list-group-item-action">
                    Settings
                </a>
                <a href="logout" class="list-group-item list-group-item-action">
                    Logout
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>