<div class="modal fade" id="newMessageModal" tabindex="-1" role="dialog" aria-labelledby="newMessageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMessageLabel">Leave New Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newMessageForm" action="newMessage" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your full name" required minlength="3" maxlength="40">
                        <small id="nameTips" class="form-text form-muted">Must be at least 3 characters and less than 40.</small>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" placeholder="Enter your message" required minlength="40" maxlength="500"></textarea>
                        <small id="messageTips" class="form-text form-muted">Minimum of 40 characters, maximum of 500</small>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit Message</button>
                </form>
            </div>
        </div>
    </div>
</div>