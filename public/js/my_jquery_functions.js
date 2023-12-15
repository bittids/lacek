
$(document).ready(function() {
/// Checkbox change event ///

    $("#password-show-btn").click(function()
    {
 
        // get visibility status
        if($('#password').prop('type') == 'password')
        {
            $('#password').prop('type', 'text');
            $('#password_confirmation').prop('type', 'text');
            $('#password-show-btn').html("Hide password text");
        }
        else
        {
            $('#password').prop('type', 'password');
            $('#password_confirmation').prop('type', 'password');
            $('#password-show-btn').html("Show password text");
        }

    }); // end $("#password-show-btn").click
///End of checkbox change event//
}); // end document ready
