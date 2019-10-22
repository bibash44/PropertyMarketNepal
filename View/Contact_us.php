<!DOCTYPE html>
<html>

<head>
    <title></title>

    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/contact_us.css">
    <script type="text/javascript" src="javascript/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="javascript/bootstrap.min.js"></script>
    <script type="text/javascript" src="javascript/javascript.js"></script>
    <script type="text/javascript" src="javascript/ajax1.js"></script>

    <div id="white-background"> </div>
</head>

<body>


    <header>
        <nav>
            <div id="nav-bar">
                <div id="site-logo">
                    <a href="index.php"><img src="photos/Logos/Homapagelogo.png"></a>
                </div>
            </div>
        </nav>
    </header>
    <!--Page heading-->
    <div id="contactuspage">
        <div id="pageheading">CONTACT</div>
    </div>

    <!--Scroll down button-->
    <div id="scrolldown">
        <a href="#footer" id="go-down"><span class=" glyphicon glyphicon-chevron-down " title="go down "></span> </a>
    </div>

    <!-- contact us form -->
    <div id="contact_us_form_wrapper">
        <div id="contact_us_from">
            <div id="contact_us_header">Be in touch</div>
            <div id="contact_us_main_from">

                <!-- check validation-->
                <div id="errorvalidation"> </div>


                <!--Main form with input types-->

                <p> <label id="name"> <span class="glyphicon glyphicon-user"></span> </label>
                    <input type="text" name="fullname" id="username" placeholder="Your name" required> </p>


                <p> <label id="email"><i class="fa fa-envelope" aria-hidden="true"></i></label>
                    <input type="email" name="email" id="useremail" placeholder="Youremail@gmail.com" required> </p>


                <p> <label id="phonenumber"><i class="fa fa-phone" aria-hidden="true"></i></label>
                    <input type="text" name="phonenumber" id="userphone" placeholder="+977981234568"> </p>

                <p><label id="message"> <i class="fa fa-pencil" aria-hidden="true"></i> </label> </p>
                <p><textarea name="message" id="usermessage" placeholder="Your message..." required></textarea> </p>

                <p> <button id="sendmessage"><i class="fa fa-paper-plane" aria-hidden="true"></i> </button> </p>

                <!--End of form-->
            </div>
        </div>
    </div>

    <!--Start of google map-->
    <div id="googlemapwrapper">
        <div id="map_header">LOCATION</div>
        <div id="mainmap">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.501126872951!2d85.32020495028763!3d27.70180973225853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19a8edf13b89%3A0x4cf23a68e858604b!2sNepal+Property+Market!5e0!3m2!1sen!2snp!4v1524474559971"
                width="800" height="780" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
    <!--End of google map-->




    <div id="footer">
        <div id="footer-header">
            <div id="footer-header-heading">Contact Our Team</div>
            <div id="contact-us-information">
                <div id="contact_us_icons">

                    <div id="icons1"><i class="fa fa-envelope" aria-hidden="true"></i> </div>
                    <div id="icons2"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                    <div id="icons3"><i class="fa fa-phone" aria-hidden="true"></i></div>
                    <div id="icons4"><i class="fa fa-whatsapp" aria-hidden="true"></i></div>

                </div>

                <div id="contact_us_icons-information">

                    <div id="icons1-info"> <a href="https://www.gmail.com" target="_blank"> propertymarketnepal@gmail.com </a> </div>
                    <div id="icons2-info"> <a href="https://www.facebook.com" target="_blank">www.fb.com/proerrtymarketnepal</a> </div>
                    <div id="icons3-info"> +9779862078511, 01234567 </div>
                    <div id="icons4-info"> <a href="https://www.whatsapp.com" target="_blank">+9779862078511</a> </div>

                </div>
                <div id="Copyright-text">
                    Property Markert Nepal pvt. Ltd. || Copyright &copy, <span id="CopyrightDate"></span> All right reserved
                </div>
            </div>
        </div>


    </div>


    <script type="text/javascript">
        //smooth scrolling of page
        $(document).ready(function() {
            $("#go-down").on('click', function(event) {

                if (this.hash !== "") {
                    event.preventDefault();

                    var hash = this.hash;

                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function() {

                        window.location.hash = hash;
                    });
                }
            });
        });

        var d = new Date();
        var y = d.getFullYear();
        var showDate = document.getElementById("CopyrightDate");
        showDate.innerHTML = y;
    </script>
</body>

</html>