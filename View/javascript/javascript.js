/*start of login and singup form */

$(document).ready(function() {
    $("#login-button").click(function() {
        $("#white-background").fadeIn()
        $("#login-box").show(800)
        $("#signup-box").fadeOut()

    });

    $("#signup-button").click(function() {
        $("#white-background").fadeIn()
        $("#signup-box").show(800)
        $("#login-box").fadeout()

    });

    $("#close-login").click(function() {
        $("#login-box").hide(800)
        $("#white-background").fadeOut()

    });

    $("#close-signup").click(function() {
        $("#signup-box").hide(800)
        $("#white-background").fadeOut()

    });

    $("#go-to-login-form").click(function() {
        $("#signup-box").fadeOut()
        $("#login-box").fadeIn()

    });

    $("#go-to-singup-form").click(function() {
        $("#signup-box").fadeIn()
        $("#login-box").fadeOut()
    });

});