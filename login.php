<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>
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
require('user.php');
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
                <li class="nav-item"><a href="cart.php" class="nav-link"><i class="fas fa-shopping-cart"></i></a></li>
                <li class="nav-item"><a href="profile.php" class="nav-link"><i class="fas fa-user"></i></a></li>
            </ul>        
        </div>  
    </nav>
</header>  

<div class="container">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4"><a href="cart.php">Login or Sign Up</a></h1>
    </div>
    <div class="row">
        <h1>Log in to an existing account</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
          Username: <input type="text" name="username" class="form-control" autofocus required /> <br/>
          Password: <input type="password" name="pwd" class="form-control" required /> <br/>
          <input type="submit" name="login" value="Sign in" class="btn btn-light"  />   
        </form>
    </div>

    <div class="row">
        <h1>Sign up for a new account</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
          First Name: <input type="text" name="first" class="form-control" required /> <br/>
          Last Name: <input type="text" name="last" class="form-control" required /> <br/>
          Email: <input type="email" name="email" class="form-control" autofocus required /> <br/>
          Username: <input type="text" name="username" class="form-control" autofocus required /> <br/>
          Password: <input type="password" name="pwd" class="form-control" required /> <br/>
          <input type="submit" name="signup" value="Sign in" class="btn btn-light"/>   
        </form>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // login
    if(!empty($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        if(authenticate($_POST['username'], $_POST['password']))) {
            // redirect to home page and log in by starting session
            session_start();
            $redir = 'http://localhost/hoos-thrifting/index.html';
            header("Location: ". $redir);
        }
        else {
            // TODO: more specific errors
            echo("There was a problem logging you in. Please try again.");
        }
    }
    // signup
    if(!empty($_POST['signup']) && !empty($_POST['first']) && !empty($_POST['last']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        if(!doesUserExist($_POST['username'])) {
            if(createUser($_POST['username']), $_POST['pass']), $_POST['first']), $_POST['last']), $_POST['email']))) {
                // redirect to home page and log in by starting session
                session_start();
                $redir = 'http://localhost/hoos-thrifting/index.html';
                header("Location: ". $redir);
            }
            else {
                // TODO: more specific error
                echo("There was a problem creating your account. Please try again.");
            }
        }
        }
    }
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