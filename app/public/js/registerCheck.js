$(document).ready(function(){
    /** Disable Form Send button from start */
    $('#send').attr('disabled', true);
    $('.error').hide();

    /** check if Password and Mail == same */
    $('#password2, #email2').change(function(){
        var pass = $('#password1').val();
        var pass2 = $('#password2').val();

        var email = $('#email1').val();
        var email2 = $('#email2').val();

        /** Highlight missing/invalid input fields */
        // check if input is identical
        if(pass != pass2 || email != email2){
            if(pass != pass2){
                $('#password2').css('border-color', 'red');
                $('#send').attr('disabled', true);
            } else {
                $('#email2').css('border-color', 'red');
                $('#send').attr('disabled', true);
            }
        } else {
            $('#password2').css('border-color', '#ced4da');
            $('#email2').css('border-color', '#ced4da');
            $('#send').attr('disabled', false);
        };
    });

    // Check if password exists in Database and throw according errors
    $("#email1").focusout(function(event){
        event.preventDefault();
        // check if password is correct
        var data = $('#email1').val();
        $.ajax({
            url: '/user/checkEmail',
            type: 'POST',
            data: { email: data },
            success: function(response){
                if(response == 1){
                    $('.error').show();
                    $('#send').attr('disabled', true);
                } else {
                    $('.error').hide();
                }                
            }
        })
    });
});