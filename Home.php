<?php 
session_start();
if (!empty($_SESSION)) {
    $mt = $_SESSION["mbType"];
    // echo $mt;
    // header("location:Member_Dashboard.php");
    // echo '<script>alert("Success");</script>';
  
    if ($mt == "Member") {
      header("location:Member/Member_Dashboard.php");
    } elseif ($mt == "Secretary") {
      header("location:Secretary/Secretary_Dashboard.php");
    } elseif ($mt == "President") {
      header("location:President/President_Dashboard.php");
    } elseif ($mt == "Spresident") {
      header("location:SubPresident/SPresident_Dashboard.php");
    } elseif ($mt == "Guard") {
      header("location:Guard/Guard_Dashboard.php");
    } else {
      header("location:Home.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySociety</title>
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>

</head>
<body>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
   <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#">My<span>Society.</span></a></div>
            <ul class="menu">
                <li><a href="#home" class="menu-btn">Home</a></li>
                <li><a href="#about" class="menu-btn">About</a></li>
                <li><a href="#services" class="menu-btn">Services</a></li>
                <li><a href="#skills" class="menu-btn">Features</a></li>
                <li><a href="#teams" class="menu-btn">Teams</a></li>
                <li><a href="#contact" class="menu-btn">Contact</a></li>
                <li><a href="login.php" class="menu-btn">Login</a></li>
                <li><a href="Registration.php" class="menu-btn">Sign Up</a></li>
               
           
             </ul>
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- home section start -->
    <section class="home" id="home">
      <div class="max-width">
          <div class="row">
            <div class="home-content">
               
                <div class="text-3">now use MySociety to manage their <span class="typing"></span></div>
               
                <br>
                <br>
                <div class="text-3">How it works..? </div>
                <br>
                <p style="font-size: 25px;">All management committee members get access to a configurable dashboard from where accounts, expanses, visitors and amenities can be managed. Think of it as a control centre for your society that's accessible from anywhere.</p>
                <a href="#contact" >Contact Us</a>
                 
               
            </div>
          </div>
      </div>
    </section>

    <!-- about section start -->
    <section class="about" id="about">
        <div class="max-width">
            <h2 class="title">About Us</h2>
            <div class="about-content">
                <div class="column left">
                    <img src="Image/profile-1.jpg" alt="">
                </div>
                <div class="column right">
                    <div class="text">What is MySociety ?</div>
                    <div class="text">We are managing <span class="typing-2"></span></div>
                    <p>A website that simplifies life for everyone in a societal community, from residents and management committee members to security guards and facility managers. Packed with features, it reduces many hassles—authorising entry of delivery executives, paying maintenance bills and manage expanses to a single click.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- services section start -->
    <section class="services" id="services">
        <div class="max-width">
            <h2 class="title">Our services</h2>
            <div class="serv-content">
                <div class="card">
                    <div class="box">
                        <i class="fas fa-lock"></i>
                        <div class="text">Security Management</div>
                        <p>Ensure that every person entering the community is authorised by a resident. Effective security measures can be convenient, too! </p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-id-card"></i>
                        <div class="text">Community Management</div>
                        <p>Manage accounts and payments and keep the community up-to-date with all that’s going on in the society. Easy for the management committee and residents.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-calendar-alt"></i>
                        <div class="text">Maintenance payments</div>
                        <p>Your residents will appreciate our low payment charges and the multitude of payment options. Any credit or debit card, UPI  are accepted. Expect payment collection to be quicker and smoother.</p>
                    </div>
                </div>
               </div>
            </div>
        </div>
    </section>

    <!-- skills section start -->
    <section class="skills" id="skills">
        <div class="max-width">
            <h2 class="title">Modules & Features</h2>
            <div class="skills-content">
                <div class="column left">
                    <div class="text">Visitor Management</div>
                    <p>A long wait at the gate is frustrating for everyone involved—your guests, the guard and you. Now with a simple passcode, your guests can be at your door in minutes. No need for the register.</p>
                </div>
            <div class="column right">
                <span>Delivery Management</span>
                    <p>Get your deliveries sooner and without hassle. Not home? No problem. Simply instruct security to collect it for you via the website and pick it up at your convenience.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- teams section start -->
    <section class="teams" id="teams">
        <div class="max-width">
            <h2 class="title">My team</h2>
            <div class="carousel owl-carousel">
                <div class="card">
                    <div class="box">
                        <img src="Image/Jitusir.jpg" alt="">
                        <div class="text">DR. Jitendra Nasriwala</div>
                        <p>Project Guide</p>
                        <p>Associative Professor</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="Image/parth.jpg" alt="">
                        <div class="text">Parth Lunagariya</div>
                        <p>BscIT Student</p>
                        <p>201806100110070</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="Image/tushar.jpg" alt="">
                        <div class="text">Tushar Savaliya</div>
                        <p>BscIT Student</p>
                        <p>201806100110042</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- contact section start -->
    <section class="contact" id="contact">
        <div class="max-width">
            <h2 class="title">Contact us</h2>
            <div class="contact-content">
                <div class="column left">
                    <div class="text">Get in Touch</div>
                    <div class="icons">
                        <div class="row">
                            <i class="fas fa-user"></i>
                            <div class="info">
                                <div class="head">Name</div>
                                <div class="sub-title">Parth Lunagariya</div>
                                <div class="sub-title">Tushar Savaliya</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info">
                                <div class="head">Address</div>
                                <div class="sub-title">Gujrat, India</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-envelope"></i>
                            <div class="info">
                                <div class="head">Email</div>
                                <div class="sub-title">contact.mysociety@gmail.com</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column right">
                    <div class="text">Message us</div>
                    <form class="contact-form" action="#" method="POST">
                        <div class="fields">
                            <div class="field name">
                                <input type="text" class="fullname" placeholder="Name">
                            </div>
                            <div class="field email">
                                <input type="text" class="email-input" placeholder="Email">
                            </div>
                        </div>
                        <div class="field">
                            <input type="text" class="subject" placeholder="Subject">
                        </div>
                        <div class="field textarea">
                            <textarea class="message" cols="30" rows="10" placeholder="Message.."></textarea>
                        </div>
                        <div class="button-area">
                            <button class="send-msg" type="submit" name="send">Send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- footer section start -->
    <footer>
        <span>Created By Tushar Savaliya & Parth Lunagariya | <span class="far fa-copyright"></span> 2021 All rights reserved.</span>
        <style>
            #admin::hover{
    color: #35CEBE;
    background: none;
}
        </style>
        <a style="
           margin-left: 75px;
    display: inline-block;
    background: #35CEBE;
    color: #fff;
    font-size: 20px;
    font-weight: 500;
    padding: 10px 30px;
    border-radius: 6px;
    border: 2px solid #35CEBE;
    transition: all 0.3s ease; " id="admin" href="Admin_Login.php">Admin Login</a>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>