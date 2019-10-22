$(document).ready(function() {
    $("#send-message-to-admin").click(function() {
        var message = $("#user-message").val();
        var useremail = $("#email-user").val();

        if (message == "") {
            $("#message-info").text("Please type the message");
            $("#message-info").css({ "color": "rgb(226, 18, 37)" });
            $("#user-message").focus();
            $("#message-info").fadeIn();
            setTimeout(function() {
                $("#message-info").fadeOut();
            }, 2000);

        } else {
            $.ajax({
                url: "../../Controller/user_controller.php",
                type: "POST",
                async: false,
                data: {
                    "ru-message": 1,
                    "message": message,
                    "user_email": useremail
                },
                success: function() {
                    $("#message-info").text("Thank you for contacting us, we will contact you soon");
                    $("#message-info").css({ "color": "rgba(12, 150, 24)" });

                    setTimeout(function() {
                        $("#message-info").fadeIn();
                    }, 2000);

                    setTimeout(function() {
                        $("#user-message").val("");
                    }, 2000);


                    setTimeout(function() {
                        $("#message-info").fadeOut();
                    }, 4000);

                }

            })
        }

    });
})