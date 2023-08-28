<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="mainpage.js"></script>
    <link rel="stylesheet" href="mainpage.css">
</head>

<body>
    <header>
        <div class="navbar">
            <div class="leftside">
                <h2>Get the App</h2>
            </div>
            <div class="rightside">
                <ul class="ullist">
                    <li onclick="openLogin()" id="openlogin">Log in</li>
                    <li onclick="openModal()" id="opensignin">Sign up</li>
                </ul>
            </div>
        </div>
        <div class="serchbar">
           <span id=""></span>
            <img src="images/redfood.png" alt="">
            <p class="serchp">Find the best restaurants, cafés and bars in India</p>
        </div>
    </header>

    <div id="signup" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModalSignin">&times;</span>
            <span id="ckeckeror"></span>
            <h2>Sign Up</h2>
            <form id="signupform" method="post">
                <div class="form-group">
                    <input type="text" id="username" name="username" placeholder="Username">
                    <span id="usernameerror"></span>
                </div>
                <div class="form-group">
                    <input type="text" id="name" name="name" placeholder="Full Name">
                    <span id="nameerror"></span>
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email">
                    <span id="emailerror"></span>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Password">
                    <span id="passworderror"></span>
                </div>
                <div class="form-group">
                    <input type="tel" id="phone" name="phone" placeholder="Phone number">
                    <span id="phoneerror"></span>
                </div>
                <div class="form-group">
                    <input type="text" id="address" name="address" placeholder="Address">
                    <span id="addreserror"></span>
                </div>
                <div class="form-group">
                    <input type="text" id="city" name="city" placeholder="City">
    
                </div>
                <div class="form-group">
                    <input type="text" id="state" name="state" placeholder="State">
                    
                </div>
                <div class="form-group">
                    <input type="text" id="country" name="country" placeholder="Country">
                   
                </div>
                <div class="form-group">
                    <input type="text" id="pincode" name="pincode" placeholder="Pincode">
                    <span id="pincodeerror"></span>
                </div>
                <div class="form-group">
                    <select name="role" id="role">
                        <option value="">Select Role</option>
                        <option value="0">Customer</option>
                        <option value="1">Owner</option>
                    </select>
                    <span id="roleeror"></span>
                </div>
                <div class="form-checkbox">
                    <input type="checkbox">
                    <p class="modal_p">I agree to Zomato's <span class="termcon">Terms of Service, Privacy Policy</span> and Content Policies</p>
                </div>
                <div class="form-group">
                    <input type="submit" value="Sign in">
                </div>
            </form>
        </div>
    </div>

    <div id="Login" class="Loginform">
        <div class="modal-content2">
            <span class="close" id="closeLogin">&times;</span>
            <p id="error_login"></p>
            <h2>Login Up</h2>
            <form id="loginForm" method="post">
                <div class="form-group">
                    <input type="email" id="email2" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="text" id="pasword2" name="pasword" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Log in">
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <p class="con_p">Popular locations in <img src="images/india.png" alt=""><span class="con_span">India</span>
        </p>
        <p class=" con_caption">
            From swanky upscale restaurants to the cosiest hidden gems serving the most incredible food, Zomato covers
            it all. Explore menus, and millions of restaurant photos and reviews from users just like you, to find your
            next great meal.
        </p>
        <div class="location">
            <div class="firstloc">
                <p>Agra Resturants<i class="fa-solid fa-angle-right"></i></p>
            </div>
            <div class="firstloc">
                <p>Ahemdabad Resturants<i class="fa-solid fa-angle-right"></i></p>
            </div>
            <div class="firstloc">
                <p>Ajmer Resturants<i class="fa-solid fa-angle-right"></i></p>
            </div>
            <div class="firstloc">
                <p>Alappuzha Resturants<i class="fa-solid fa-angle-right"></i></p>
            </div>
            <div class="firstloc">
                <p>Allahabad Resturants<i class="fa-solid fa-angle-right"></i></p>
            </div>
            <div class="firstloc">
                <p>Ahemdabad Resturants<i class="fa-solid fa-angle-right"></i></p>
            </div>
            <div class="firstloc">
                <p>Amravati Resturants<i class="fa-solid fa-angle-right"></i></p>
            </div>

            <div class="firstloc">
                <p>Aurangabad Resturants<i class="fa-solid fa-angle-right"></i></p>
            </div>
            <div class="firstloc">
                <p>Bengluru Resturants<i class="fa-solid fa-angle-right"></i></p>
            </div>
            <div class="firstloc">
                <p>bhopal Resturants<i class="fa-solid fa-angle-right"></i></p>
            </div>
            <div class="firstloc">
                <p>Bhuvneshwer Resturants<i class="fa-solid fa-angle-right"></i></p>
            </div>
            <div class="firstloc">
                <p>Cuttack Resturants<i class="fa-solid fa-angle-right"></i></p>
            </div>
        </div>
    </div>
    <footer>
        <div class="fotter_up"></div>
        <div class="logo">
            <img class="zomatoing" src="images/redfood.png" alt="">
            <div class="flaglan">
                <p class="indiad">India <i class="fa-solid fa-angle-down"></i> <img class="indiaflag" src="images/india.png" alt=""> </p>
                <p class="english">English <i class="fa-solid fa-angle-down"></i></p>
            </div>
        </div>
        <div class="fotter_down">
            <div class="menus">
                <h2>ABOUT ZOMATO </h2>
                <p>Who We Are</p>
                <p>Blog</p>
                <p>Work With Us</p>
                <p>Investor Relations</p>
                <p>Report Fraud</p>
                <p>Contact Us</p>
            </div>
            <div class="menus">
                <h2>ZOMATOVERSE</h2>
                <p>Zomato</p>
                <p>Blinkit</p>
                <p>Feedingindia</p>
                <p>Hyperpure</p>
                <p>Zomaland</p>
            </div>
            <div class="menus">
                <h2>FOR RESTURANTS</h2>
                <p>Partner With Us</p>
                <p>App For You</p>
                <h3>FOR ENTERPRISES</h3>
                <p> Zomato For Enterprise</p>
            </div>
            <div class="menus">
                <h2>LEARN MORE</h2>
                <p>Privacy</p>
                <p>Security</p>
                <p>Terms</p>
                <p>Sitemaps</p>
            </div>
            <div class="menus">
                <h2>SOCIAL LINKS</h2>
                <div class="icons">
                    <i class="fa-brands fa-linkedin"></i>
                    <i class="fa-brands fa-square-instagram"></i>
                    <i class="fa-brands fa-square-twitter"></i>
                    <i class="fa-brands fa-square-youtube"></i>
                    <i class="fa-brands fa-square-facebook"></i>
                </div>
                <div class="imageds">
                    <img src="/images/playstore.jpg" alt="">
                    <img src="/images/appstore.jpg" alt="">
                </div>

            </div>
        </div>
    </footer>



</body>

</html>