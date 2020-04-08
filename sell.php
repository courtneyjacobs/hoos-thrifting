<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="Courtney Jacobs">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sell</title>
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

    
<?php
require('connect-db.php');
session_start();
if(isset($_SESSION['user'])) {
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
                <li class="nav-item"><a href='<?php if(isset($_SESSION['user'])) echo "logout.php"; else echo "login.php"; ?>' class="nav-link"><?php if(isset($_SESSION['user'])) echo "Logout"; else echo "Log in or sign up"; ?></a></li>
                <li class="nav-item"><a href="cart.php" class="nav-link"><i class="fas fa-shopping-cart"></i></a></li>
                <li class="nav-item"><a href="profile.php" class="nav-link"><i class="fas fa-user"></i></a></li>
            </ul>        
        </div>  
    </nav>
</header> 

<div class="container">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4"><a href="sell.php">Sell</a></h1>
    </div>
    
    <div class="row">
        <!--Upload Button-->
        <div class="col-lg-4">
            <img class="rounded mx-auto d-block" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f2/OOjs_UI_icon_upload-ltr.svg/1024px-OOjs_UI_icon_upload-ltr.svg.png" alt="Upload Icon" style="width:150px;height:150px;" class="center" >
        </div>

        <div class="col-lg-8">
            <div class="page-content">
            <!--Source: Bootstrap form from https://www.w3schools.com/bootstrap/bootstrap_forms.asp -->
            <form id="sell-form" class="form-horizontal" action="" method="post" onsubmit="populate(); return false;">
                <div class="form-group" >
                    <label class="control-label col-sm-2" for="category">Category:</label>
                    <div class="col-sm-8">          
                        <select class="form-control" id="category">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <!--Brand Selection-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="brand">Brand:</label>
                    <div class="col-sm-8">          
                        <select class="form-control" id="brand">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <!--Size Selection-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="size">Size:</label>
                    <div class="col-sm-8">          
                        <select class="form-control" id="size">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <!--Color Selection-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="color">Color:</label>
                    <div class="col-sm-8">          
                        <select class="form-control" id="color">
                            <option>White</option>
                            <option>Black</option>
                            <option>Gray</option>
                            <option>Brown</option>
                            <option>Cream/Beige</option>
                            <option>Tan</option>
                            <option>Gold</option>
                            <option>Silver</option>
                            <option>Red</option>
                            <option>Orange</option>
                            <option>Yellow</option>
                            <option>Green</option>
                            <option>Blue</option>
                            <option>Purple</option>
                        </select>
                    </div>
                </div>
                <!--Condition Selection-->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="condition">Condition:</label>
                    <div class="col-sm-8">          
                        <select class="form-control" id="condition">
                            <option>New</option>
                            <option>Like New</option>
                            <option>Good</option>
                            <option>Fair</option>
                            <option>Poor</option>
                        </select>
                    </div>
                </div>
                <!--Description-->
                <div class="form-group">   
                    <label class="control-label col-sm-2" for="desc">Description:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="desc" maxlength="250"></textarea>
                    </div>
                </div>
                <!--Pricing-->
                <div class="form-group">
                    <label class="control-label col-sm-2 d-inline" for="price">Price:</label>
                    <div class="col-3">
                        <input class="form-control"  id="price" type="number" step="0.01" min="1" max="1000" required onchange="validPrice()"></input>
                        <small style="color: red" id="youearnError"></small><br>
                    </div> 
                    <div class="col-3">
                        <label class="control-label" for="youearn">You Will Earn:</label>
                        <input disabled="true" class="form-control"  id="youearn" ></input>
                    </div>
                </div>
                <!--List Item-->
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-secondary">List Item</button>
                    </div>
                </div>
            </form>
            <!--Item List-->
            <div id="createdItems">
            </div>
            </div>
        </div>
    </div>
</div>

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

<?php 
} else {
  header("Location: login.php");
}
?>

</body>
</html>