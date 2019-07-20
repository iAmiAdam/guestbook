<div class="modal fade" id="deleteMessageModal" tabindex="-1" role="dialog" aria-labelledby="deleteMessageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMessageLabel">Delete Message?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you wish to delete the following message?
                <div id="deleteMessageContent">

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <button id="confirmDelete" type="submit" class="btn btn-danger">Delete Message</button>
            </div>
        </div>
    </div>
</div>