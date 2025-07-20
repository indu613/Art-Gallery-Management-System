<?php
session_start(); // Start the session, if not already started
if (!isset($_SESSION['s_id'])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit();
}
?>
<html>
   <head>
        <title>Home</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>        
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head> 
    <body>
        <div class="container">
            <div class="navbar">
                <img src="images/logo3.png" class="logo">
                <nav>
                    <ul class="tab-links">
                        <li class="active"><a href="#tab1" id="home">Home</a></li>
                        <li><a href="#tab2" id="artworks">Artworks</a></li>
                        <li><a href="#tab3" id="artist">Artists</a></li>
                        <li><a href="#tab4" id="aboutus">About Us</a></li>
                        <li><a href="#tab5" id="contactus" >Contact Us</a></li>
                        
                        <li class="auth-buttons">
                            <button class="sign-btn" onclick="window.location.href='custprofile.php' "><i class='bx bx-user' type="solid"></i></button>
                        </li>
                        
                    </ul> 
                </nav>
            </div>
        
            <div class="content1" id="tab1">
                <div class="tab1parent">
                    <section>
                    <div class="content11">
                        <h1><b><div class="anmt">Art for every walk of life.</div></b></h1><br>
                    </div>    
                </section>
                   
                </div>
            </div>

            <div class="content1" id="tab2">
                <div class="artwork">
                    <h1><b>Dive into the depths of artistry.<b></h1>
                        <br><br>
                    <button class="custom-button" target="_blank">
                        <a href="artworks.php">Explore Artworks</a>
                    </button>
                </div>
            </div>
            
            <div class="content1" id="tab3">
                <div class="artist">
                    <h1><b>Behind the Brush:<br>The Artists' Profiles<b></h1>
                        <br><br>
                    <button class="custom-button" target="_blank">
                        <a href="artists.php">Explore Artists</a>
                    </button>
                </div>
            </div>

            <div class="content1" id="tab4">
                <div class="about-us">
                    <div class="about-us-image">
                        <img src="images/artg1.jpg" alt="Art Gallery Building">
                    </div>
                    <div class="about-us-text">
                        <div class="heading">
                            <h1>About Us</h1>
                        </div>
                        <p>Welcome to Art Haven, where art meets inspiration. We are dedicated to showcasing the finest artworks from renowned and emerging artists. <p>Our gallery is a space where creativity flourishes, and we invite you to immerse yourself in the world of art. <p>With a rich history and a commitment to supporting artists, we strive to bring you a diverse range of artistic expressions. Our exhibitions and collections are curated with a passion for artistic excellence.<p>Explore the beauty and depth of art at Art House art gallery and join us in celebrating the incredible talents of artists worldwide.</p>
                    </div>
                </div>
            </div>

            <div class="content1" id="tab5">
                <div class="contact">
                    <div class="content">
                        <h2>Contact Us</h2>
                    </div>
                    <div class="container2">
                        <div class="contactinfo">
                            <div class="box">
                                <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                <div class="text">
                                    <h3>Address</h3>
                                    <p>
                                        27WW+H26, Old NH17, Edappally North, <br>Amrita Nagar, Brahmasthanam, 
                                        Kochi, <br>Ernakulam, Kerala 682024
                                    </p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                <div class="text">
                                    <h3>Phone</h3>
                                    <p>+91 9998887776<br>+91 9889766755</p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                <div class="text">
                                    <h3>Email</h3>
                                    <p>abc123@gmail.com<br>pqr456@gmail.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15714.565777265356!2d76.2950208!3d10.0464173!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b080dc26c6734a5%3A0x80f344b602935780!2sAmrita%20School%20of%20Arts%20and%20Sciences!5e0!3m2!1sen!2sin!4v1697993630539!5m2!1sen!2sin" width="450" height="320" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>      <!--previously section-->
            </div>
            <div class="social-links">
                <a href="https://x.com/amritakochi?s=20" target="_blank"><img src="images/twt_icon.png" alt="Twitter"></a><br><br>
                <a href="https://in.pinterest.com/" target="_blank"><img src="images/pin_icon.png" alt="Facebook"></a><br><br>
                <a href="https://www.facebook.com/kochicampus/" target="_blank"><img src="images/fb_icon.png" alt="Facebook"></a><br><br>
                <a href="https://www.instagram.com/amritakochicampus/" target="_blank"><img src="images/ig_icon.png" alt="Instagram"></a>
            </div>
        </div>   
    <footer class="footr">
        <div class="footer-container">
            <div class="footer-logo">Art Haven<br>Art gallery</div>
            <div class="footer-contact">
                <p>B123 Gallery Lane</p>
                <p>Kochi, Kerala 683111</p>
                <p>Email: info@artgallery.com</p>
                <p>Phone: +91 9876543210</p>
            </div>
            <div class="social-icons">
                <a href="https://x.com/amritakochi?s=20" target="_blank"><img src="images/twt_icon.png" alt="Twitter"></a>
                <a href="https://in.pinterest.com/" target="_blank"><img src="images/pin_icon.png" alt="Facebook"></a>
                <a href="https://www.facebook.com/kochicampus/" target="_blank"><img src="images/fb_icon.png" alt="Facebook"></a>
                <a href="https://www.instagram.com/amritakochicampus/" target="_blank"><img src="images/ig_icon.png" alt="Instagram"></a>
            </div>
        </div>
    </footer>
   </body>
</html>