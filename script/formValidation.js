var validPatterns = {
    username : /^([^0-9])([\w_]{3,})/,
    email : /[@]{1}/,
    passwordReqChars : /([\w@#$%^&+=]{6,})/,
    passwordSpecialChars : /([@#$%^&+=]{1,})/,
};

// client side validation of join form
function joinFormButtonClick() {
    var msgUsername = document.getElementById('join-username-error');
    var msgEmail = document.getElementById('join-email-error');
    var msgPassword = document.getElementById('join-password-error');

    msgUsername.innerHTML = '';
    msgEmail.innerHTML = '';
    msgPassword.innerHTML = '';

    if (isUsernameValid() && isEmailValid() && isPasswordValid() && doPasswordsMatch()) {
        document.getElementById('join-form').submit();
    }

    if (!isUsernameValid()) {
        msgUsername.innerHTML = "Username Invalid";
    }
    if (!isEmailValid()) {
       msgEmail.innerHTML = "Email Invalid";
    }
    if (!isPasswordValid()) {
        msgPassword.innerHTML = "Password Invalid"
    }
    if (!doPasswordsMatch()) {
        msgPassword.innerHTML = "Passwords do not match";
    }

    function isEmailValid() {
        var value = document.getElementById('email-join').value;
        return validPatterns.email.test(value);
    }

    function isUsernameValid() {
        var value = document.getElementById('username-join').value;
        return validPatterns.username.test(value);
    }

    function isPasswordValid() {
        var value = document.getElementById('password-join').value;
        var p1 = validPatterns.passwordReqChars.test(value);
        var p2 = validPatterns.passwordSpecialChars.test(value);
        return p1 && p2;
    }

    function doPasswordsMatch() {
        return document.getElementById('password-join').value == document.getElementById('passwordconfirm-join').value;
    }
}