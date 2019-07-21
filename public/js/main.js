$(document).ready(function(){
    $('#newMessageForm').submit(function(e){
        e.preventDefault();
        dataString = "name="+$('#name').val()+"&message="+$('#message').val();

        $.ajax({
            url: "newMessage",
            type: "POST",
            data: dataString,
            success: function(data){
                if(typeof data === "object" && "error" in data) {
                    addAlert(data["error"], "danger");
                } else {
                    addAlert("Message submitted, Thank you!", "success");
                    $('#newMessageModal').modal('hide');
                }
            }
        })
    });

    $('#loginForm').submit(function(e){
        e.preventDefault();
        dataString = "user_name="+$('#user_name').val()+"&user_password="+$('#user_password').val();

        $.ajax({
            url: "login",
            type: "POST",
            data: dataString,
            success: function(data){
                if(typeof data === "object" && "error" in data) {
                    addAlert(data["error"], "danger");
                } else {
                    location.reload();
                }
            }
        })
    });

    $('#deleteMessageModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let messageID = $(button).data('messageid');
        let messageContent = $('#message'+messageID+" > .messageContent").html();
        $('#deleteMessageContent').html(messageContent);
        $('#confirmDelete').data('messageid', messageID);
    });

    $('#confirmDelete').click(function(){
        let messageID = $(this).data('messageid');
        let dataString = "messageID="+messageID;

        $.ajax({
            url: "deleteMessage",
            type: "POST",
            data: dataString,
            success: function(data){
                if(typeof data === "object" && "error" in data) {
                    addAlert(data["error"], "danger");
                } else {
                    location.reload();
                }
            }
        })
    });

    $('#editMessageModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let messageID = $(button).data('messageid');
        let messageContent = $('#message'+messageID+" > .messageContent").text();
        let authorName = $('#authorName').text();
        $('#editMessage').val(messageContent);
        $('#editName').val(authorName);
        $('#message_id').val(messageID);
    });

    $('#editMessageForm').submit(function(e){
        e.preventDefault();
        let dataString = "message_id="+$('#message_id').val()+"&name="+$('#editName').val()+"&message="+$('#editMessage').val();

        $.ajax({
            url: "editMessage",
            type: "POST",
            data: dataString,
            success: function(data){
                if(typeof data === "object" && "error" in data) {
                    addAlert(data["error"], "danger");
                } else {
                    location.reload();
                }
            }
        });
    })
});

function addAlert(text, type) {
    $('#alertBox').html("<div class='alert alert-"+type+"'>"+text+"</div>").fadeIn().delay(3000).fadeOut();
}

