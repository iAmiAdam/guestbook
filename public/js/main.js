$(document).ready(function(){
    $('#newMessageForm').submit(function(e){
        e.preventDefault();
        dataString = "name="+$('#name').val()+"&message="+$('#message').val();

        $.ajax({
            url: "newMessage",
            type: "POST",
            data: dataString,
            success: function(data){
                if("error" in data) {
                    addAlert(data["error"], "danger");
                } else {
                    addAlert("Message submitted, Thank you!", "success");
                    $('#newMessageModal').modal('hide');
                }
            }
        })
    });
});

function addAlert(text, type) {
    $('#alertBox').html("<div class='alert alert-"+type+"'>"+text+"</div>").fadeIn().delay(3000).fadeOut();
}

