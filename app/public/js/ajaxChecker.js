$(document).ready(function(){
    $("#send").click(function(event){
        event.preventDefault();
        // check if password is correct
        var data = $('#password_old').val();
        $.ajax({
            url: '/ajax/checkPassword',
            type: 'POST',
            data: { password_old: data },
            success: function(response){
                alert("Response: " + response + " Data: " + data);
            }
        })
    })

})