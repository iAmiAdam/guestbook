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
    })
});

function addAlert(text, type) {
    $('#alertBox').html("<div class='alert alert-"+type+"'>"+text+"</div>").fadeIn().delay(3000).fadeOut();
}

