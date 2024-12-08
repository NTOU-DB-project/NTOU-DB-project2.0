$(document).ready(function() {
    const loginBtn = $("#btn-login");
    const errorLbl = $("#lbl-error");
    const emailInput = $("#input-email");
    const passwordInput = $("#input-password");

    loginBtn.click(function() {
        errorLbl.text("");
        $.ajax({
            url: '/php-simple-note-app/api/user/login.php',
            dataType: 'json',
            type: 'post',
            contentType: 'application/json',
            data: JSON.stringify({
                email: emailInput.val(),
                password: passwordInput.val(),
            }),
            success: function(data, textStatus, jQxhr) {
                window.location.replace('index.php');
            },
            error: function( jqXhr, textStatus, errorThrown ){
                try {
                    const data = JSON.parse(jqXhr.responseText);
                    if (!data.message) throw "";
                    errorLbl.text(data.message);
                } catch (e) {
                    errorLbl.text("An error occured while logging in");
                }
            }
        });
    })
})