<div id="message<?= $message->message_id ?>" class="message col-sm-6 col-lg-5 offset-lg-1">
    <div class="messageBackground"><i class="fas fa-quote-left fa-5x"></i></div>
    <div class="messageContent"><p><?= $message->message; ?></p></div>
    <div class="messageFooter">
        <div class="author float-left">
            <span id="authorName"><?= htmlspecialchars($message->name); ?></span><br />
            <?php $dt = new DateTime($message->date_created); ?>
            <span class="small"><?= $dt->format("jS M, Y \a\\t g:ia") ?></span>
        </div>
        <?php if($admin): ?>
        <div class="controls float-right">
            <button type="button" class="btn btn-danger"><i class="fas fa-pencil-alt"></i></button>
            <button type="button" class="btn btn-danger deleteMessage" data-toggle="modal" data-target="#deleteMessageModal" data-messageid="<?= $message->message_id ?>"><i class="fas fa-trash"></i></button>
        </div>
        <?php endif; ?>
    </div>
</div>