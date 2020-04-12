<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="Amara Vo">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fundraise</title>
    <!-- <link rel="stylesheet" href="reset.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="main.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>
<body onload="setCurrentDate()">

<?php
require('connect-db.php');
require('promo.php');
setcookie('redirect', 'fundraise.php', time()+3600);  
session_start();
?>

<!--Source: Bootstrap Nav Bar from https://getbootstrap.com/docs/4.4/components/navbar/ -->   
<header>
    <nav class="navbar navbar-default navbar-expand-md">
        <a class="navbar-brand" href="index.php">HoosThrifting</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <i class="fas fa-bars"></i>        
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">   
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="shop.php" class="nav-link">Shop</a></li>
                <li class="nav-item"><a href="sell.php" class="nav-link">Sell</a></li>
                <li class="nav-item"><a href="fundraise.php" class="nav-link">Fundraise</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href='<?php if(isset($_SESSION['user'])) echo "logout.php"; else echo "login.php"; ?>' class="nav-link"><?php if(isset($_SESSION['user'])) echo "Log-out"; else echo "Log-in or sign up"; ?></a></li>
                <li class="nav-item"><a href="cart.php" class="nav-link"><i class="fas fa-shopping-cart"></i></a></li>
                <li class="nav-item"><a href="profile.php" class="nav-link"><i class="fas fa-user"></i></a></li>
            </ul>        
        </div>  
    </nav>
</header>  

<div class="container">
    
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4"><a href="fundraise.php">Fundraise</a></h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. </p>
    </div>

    <!--Steps of Fundraising-->
    <div class="row">
        <div class="col-lg-4">
            <h3>Step 1:</h3>
            <p> Lorem ipsum dolor sit amet, ei duo repudiandae vituperatoribus. Graece suscipit philosophia pro ad. Clita affert melius ei sea. Qualisque accusamus has an.
            </p>

        </div>
        <div class="col-lg-4">
            <h3>Step 2:</h3>
            <p> Lorem ipsum dolor sit amet, ei duo repudiandae vituperatoribus. Graece suscipit philosophia pro ad. Clita affert melius ei sea. Qualisque accusamus has an.
            </p>

        </div>
        <div class="col-lg-4">
            <h3>Step 3:</h3>
            <p> Lorem ipsum dolor sit amet, ei duo repudiandae vituperatoribus. Graece suscipit philosophia pro ad. Clita affert melius ei sea. Qualisque accusamus has an.
            </p>
        </div>
    </div>

       <!--Show Info If Guest--> <!--REQUIRE USER TO BE LOGGED IN-->
       <?php 
            

            // if user not logged in
            if(!isset($_SESSION['user'])) {     
                echo '</div>';
                echo '<div style="margin:0 auto; padding-top: 5px; padding-bottom: 40px" align=center>';
                echo '<form action="login.php">';
                echo '   <button type="submit" style="width:200px; height:90px" class="btn btn-primary btn-success">Log-in to start</button>';
                echo "</form>";
                echo "</div>";

                //exit;       // don't display the rest of the page

            }
            // user is logged in
            else {

        ?>


    <!--Fundraise Form-->
    <hr class="featurette-divider" >
    <form id="fundraise-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
        <div class="row">
            <!--Organization Information-->
            <div class="col-lg-3 form-group required">   
                <label for="org">Organization (CIO):</label><br>
                <input class="form-control" id="org" name="cio" type="text" placeholder="Name" required autofocus></input>
            </div>
            <div class="col-lg-3 form-group required d-inline">   
                <label for="CharityButton">Fundraising Purpose:</label><br>
                <input onchange="checkCharity()" type="radio" name="purpose" id="CIO-purpose" value="CIO" required><span id="choice"> <label for="CIO-purpose"> Your CIO</label> </span><br>
                <input onchange="checkCharity()" type="radio" name="purpose" id="Charity-purpose" value="CHARITYYTESTNAME" required><span id="choice"> <label for="Charity-purpose"> Charity (please specify):</label> </span>
                <input  type="text" id="charityName" name="charity">
                <!--Charity Validation-->
                <div class="col-lg-4 d-inline pt-lg-2 form-group" id="charityError" style="visibility: hidden">
                        <p id="charityErrorMessage" style="color: red; font-size: 14px;"> Please fill out the name of the charity.</p>
                </div>

                <p id="signupError" style="color: red; font-size: 14px;"> <?php if(isset($passError)) echo $passError?></p> 
            </div>            
            <!--Fundraising Information-->
            <div class="col-lg-2 form-group required">   
                <label for="start">Start Date:</label><br>
                <input required type="date" id="start" min="2020-02-27" style="width:105px">
            </div>
            <div class="col-lg-2 form-group required">   
                <label for="end">Duration:</label><br>
                <input id="end" placeholder="# of Days" required type="number"step="1" min="1" max="30" style="width:100px" >
            </div>
            <!--Promo code Box-->
            <div class="col-lg-2 form-group required">   
                <label for="promo">Promotional Code:</label><br>
                <input onkeyup="checkPromo()" required type="text" id="promo" name="code" pattern="[A-Za-z0-9]{3,6}" placeholder="Min. 3 characters" minlength="3" maxlength="6" style="width: 150px">
            </div>
            <!--Submit Button-->
            <div class="col-lg-12 form-group"> 
                <button id="submitButton" name="promo" type="submit" class="btn btn-secondary" style="width:144px">Submit</button> 
            </div>
        </div>
    </form>

    <!--Confirmation Screen-->
    <div id="Confirm-Submission" style="display: none;">
        <img class="rounded mx-auto d-block" src="https://svgsilh.com/svg/40319.svg" alt="Checkmark" style="width:90px;height:90px;" class="center" >
        <p id="Confirm-Text" class="lead" style="padding-top: 10px; text-align: center;"></p>
    </div>

</div>

<?php
    }
    echo "</div>";
?>

<!--Validate Charity-->
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {


}

?>

<!--Footer-->
<footer class="page-footer">
    <div class="row">
        <div class="col-4">
            <ul style="text-align: right;">
                <li><a href="index.php">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="profile.php">Profile</a></li>
            </ul>
        </div>
        <div class="col-4">
            <ul style="text-align: center;">
                <li><a href="shop.php">Shop</a></li>
                <li><a href="sell.php">Sell</a></li>
                <li><a href="fundraise.php">Fundraise</a></li>
            </ul>
        </div>
        <div class="col-4" style="text-align: left">
            <ul>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
    <div class="copyright text-center">
        <small>&copy; 2020 AV/CJ</small>
    </div>
</footer>


</body>
</html>