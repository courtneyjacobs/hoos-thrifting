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
<body>
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

    <!--Fundraise Form-->
    <hr class="featurette-divider">
    <form id="fundraise-form" onsubmit="confirmMessage()">
        <div class="row">
            <!--Contact Information-->
            <div class="col-lg-3 form-group required">   
                <label for="FName">Contact Name:</label><br>
                <input class="form-control" id="FName" type="text" required placeholder="First Name" autofocus></input>
            </div>
            <div class="col-lg-3 form-group">   
                <label>&nbsp;</dd></label><br>
                <input class="form-control" id="LName" type="text" required placeholder="Last Name"></input>
            </div>
            <div class="col-lg-3 form-group required">   
                <label for="Email">Contact Email:</label><br>
                <input class="form-control" id="Email" type="email" required placeholder="your@email.com" ></input>
            </div>
            <div class="col-lg-3 form-group ">   
                <label for="Number">Contact Number:</label><br>
                <input class="form-control" id="Number" type="tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="(___)-___-____"></input>
            </div>
            <!--Organization Information-->
            <div class="col-lg-3 form-group required">   
                <label for="org">Organization (CIO):</label><br>
                <input class="form-control" id="org" type="text" placeholder="Name" required></input>
            </div>
            <div class="col-lg-3 form-group required d-inline">   
                <label for="CharityButton">Fundraising Purpose:</label><br>
                <input type="radio" name="purpose" id="CIO-purpose" value="CIO" required><span id="choice"> <label for="CIO-purpose"> CIO</label> </span><br>
                <input type="radio" name="purpose" id="Charity-purpose" value="CIO" required><span id="choice"> <label for="Charity-purpose"> Charity</label> </span>
                
            </div>
            <div class="col-lg-6 form-group">   
                <label for="description">Fundraising Description:</label><br>
                <textarea class="form-control" id="description" rows=2 placeholder="Let everyone know what you're raising money for!"></textarea>
            </div>
            <!--Fundraising Information-->
            <div class="col-lg-3 form-group required">   
                <label for="start">Start Date:</label><br>
                <input required type="date" id="start" placeholder="YYYY-MM-DD" min="2020-02-27">
            </div>
            <div class="col-lg-3 form-group required">   
                <label for="end">End Date:</label><br>
                <input required type="date" id="end" placeholder="YYYY-MM-DD" min="2020-06-27">
            </div>
            <!--Promo code Box-->
            <div class="col-lg-2 form-group required">   
                <label for="promo">Promotional Code:</label><br>
                <input onkeyup="checkPromo()" required type="text" id="promo" pattern="[A-Za-z0-9]{3,6}" placeholder="Min. 3 characters" minlength="3" maxlength="6" style="width: 150px">
            </div>
            <!--Promo code Validation-->
            <span>
            <div class="col-lg-4 d-inline pt-lg-2 form-group" id="promoError" style="visibility: hidden">
                <p id="errorMessage" style="color: red; font-size: 14px;"> <br>Error. Code has been used before.</p>
            </div>
            </span>
            <!--Submit Button-->
            <div class="col-lg-12 form-group"> 
                <button id="submitButton" type="submit" class="btn btn-primary" style="width:144px">Submit</button> 
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
require('connect-db.php');
require('promo.php')
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