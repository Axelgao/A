/**
 * 159.339 Internet Programming Assignment 3
 * Student : Shenchuan Gao (16131180)
 */

$(document).ready(function () {


    var checkValidUserName = function (element) {
        var pattern = /^[a-z0-9A-Z_]*$/;
        if (pattern.test(element.val())) {
            element.css("border-color", "");
            return true;
        } else {
            element.css("border-color", "yellow");
            alert("Username must only contain alphanumeric characters");
            return false;
        }
    };

    var checkExisted = function (element) {
        if (element.val() !== "") {
            var url = "index.php?action=Register&method=checkExistedUser&userName=" + element.val();
            $.get(url, function (data) {
                if (data == "Invalid username!") {
                    element.css("border-color", "yellow");
                    alert(data);
                }
            });
        }
    };

    $("#userName").blur(function () {
            checkValidUserName($(this));
            checkExisted($(this));
        }
    );

    var password = $('#password');
    var checkPassword = function (element) {
        var pattern = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[@$%^&_]).{7,15}$/;
        if (pattern.test(element.val())) {
            element.css("border-color", "");
            return true;
        } else {
            element.css("border-color", "yellow");
            alert("Password must be between 7 and 15 characters and contain at least one upper case letter, at least one digit and at least one of @$%^&_");
            return false;
        }
    };

    password.blur(function () {
            checkPassword($(this));
        }
    );

    var rePassword = $('#rePassword');
    var checkRepeated = function () {
        if (rePassword.val() == password.val()) {
            if (rePassword.val() != "") {
                rePassword.css("border-color", "");
            }
            return true;
        } else {
            rePassword.css("border-color", "yellow");
            alert("Passwords must match");
            return false;
        }
    };

    $('input[name=userPassword]').on('input', function () {
            checkRepeated();
            checkPassword($(this));
        }
    );

    rePassword.blur(function () {
            checkRepeated();
        }
    );
});

