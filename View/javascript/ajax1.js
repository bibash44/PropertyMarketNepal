$(document).ready(function() {
    $("#sendmessage").click(function() {
        var name = $("#username").val();
        var email = $("#useremail").val();
        var phone = $("#userphone").val();
        var message = $("#usermessage").val();


        if (name == "") {
            $("#errorvalidation").text("Please enter the name");
            $("#errorvalidation").css({ "background": "rgb(175, 53, 53)" });
            $("#username").focus();
            $("#errorvalidation").fadeIn();
            setTimeout(function() {
                $("#errorvalidation").fadeOut();
            }, 2000);

        } else if (!name.match('^[A-Z a-z a-z A-Z]{3,16}$')) {
            $("#errorvalidation").text("Please enter a valid name");
            $("#errorvalidation").css({ "background": "rgb(175, 53, 53)" });
            $("#username").focus();
            $("#username").val("");
            $("#errorvalidation").fadeIn();
            setTimeout(function() {
                $("#errorvalidation").fadeOut();
            }, 2000);

        } else if (email == "") {
            $("#errorvalidation").text("Please enter a your email");
            $("#errorvalidation").css({ "background": "rgb(175, 53, 53)" });
            $("#useremail").focus();
            $("#errorvalidation").fadeIn();
            setTimeout(function() {
                $("#errorvalidation").fadeOut();
            }, 2000);

        } else if (!email.match('[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$')) {
            $("#errorvalidation").text("Please enter a valid email");
            $("#errorvalidation").css({ "background": "rgb(175, 53, 53)" });
            $("#useremail").focus();
            $("#useremail").val("");
            $("#errorvalidation").fadeIn();
            setTimeout(function() {
                $("#errorvalidation").fadeOut();
            }, 2000);

        } else if (phone == "") {
            $("#errorvalidation").text("Please enter your phone number");
            $("#errorvalidation").css({ "background": "rgb(175, 53, 53)" });
            $("#userphone").focus();
            $("#userphone").val("");
            $("#errorvalidation").fadeIn();
            setTimeout(function() {
                $("#errorvalidation").fadeOut();
            }, 2000);


        } else if (!phone.match('([0-9 + -]+).{7,}')) {
            $("#errorvalidation").text("Please enter valid phone number");
            $("#errorvalidation").css({ "background": "rgb(175, 53, 53)" });
            $("#userphone").focus();
            $("#userphone").val("");
            $("#errorvalidation").fadeIn();
            setTimeout(function() {
                $("#errorvalidation").fadeOut();
            }, 2000);


        } else if (message == "") {
            $("#errorvalidation").text("Enter message you want to send");
            $("#errorvalidation").css({ "background": "rgb(175, 53, 53)" });
            $("#message").focus();
            $("#message").val("");
            $("#message").focus();
            $("#errorvalidation").fadeIn();
            setTimeout(function() {
                $("#errorvalidation").fadeOut();
            }, 2000);


        } else {
            $.ajax({
                url: "../Controller/user_controller.php",
                type: "POST",
                async: false,
                data: {
                    "uru-message": 1,
                    "name": name,
                    "email": email,
                    "phone": phone,
                    "message": message
                },
                success: function() {
                    $("#errorvalidation").text("Thank you for contacting us, we will contact you soon");
                    $("#errorvalidation").css({ "background": "rgb(23, 168, 100)" });

                    $("#errorvalidation").fadeIn();
                    setTimeout(function() {
                        $("#errorvalidation").fadeOut();
                    }, 2000);

                    setTimeout(function() {
                        location.reload(true);
                    }, 4000);
                }

            })
        }

    });
})