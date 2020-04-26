<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="Courtney Jacobs; Amara Vo">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
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
require('user-db.php');
require('item-db.php');
session_start();
setcookie('redirect', 'profile.php', time()+3600);  
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
                <li class="nav-item"><a href="http://localhost:4200" class="nav-link">Shop</a></li>
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Edit Profile
    if(!empty($_POST['first']) && !empty($_POST['last']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['pwd'])) {
        // Source: https://stackoverflow.com/questions/6917198/php-check-domain-of-email-being-registered-is-a-school-edu-address

        $email = strtolower(trim($_POST['email']));
                
        // List of allowed domains
        $allowed = [
            'virginia.edu'
        ];

        // Separate string by @ characters (there should be only one)
        $parts = explode('@', $email);

        // Remove and return the last part, which should be the domain
        $domain = array_pop($parts);
        
    // if new username or old username is chosen
    if(!doesUserExist($_POST['username']) || ($_POST['username'] == $_SESSION['user'])) {       
            
        // validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !in_array($domain, $allowed)){
            $emailError = "Must be a valid virginia.edu email address.";
        }

        // validate password (6)
        if (strlen($_POST['pwd']) < 6) {
            $passError = "Password must be at least 6 characters.";
    }

    // if there are no email/pass errors
    if(!isset($emailError) && !isset($passError)) {
        // create user // ($id, $username, $pass_hash, $first, $last)
        
        $userId = updateUserInfo($_SESSION['userId'], $_POST['username'], $_POST['pwd'], $_POST['first'], $_POST['last'], $_POST['email']);

        // updating session variables
        $_SESSION['user'] = $_POST['username'];
        $_SESSION['first'] = $_POST['first'];
        $_SESSION['last'] = $_POST['last'];
        $_SESSION['email'] = $_POST['email'];
    }
    // if there are errors
    else {
        // get the variables of fields
        $tempFirst = $_POST['first'];
        $tempLast = $_POST['last'];
        $tempEmail = $_POST['email'];
        $tempUser = $_POST['username'];
    }

            
        }
    }   
}
?>

<div class="container">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4"><a href="profile.php">Profile</a></h1>
        <!--Show Username-->
        <?php 
            
            echo '<p class="lead">Hello, ';
            echo getUserInfo($_SESSION['userId'])['first'] . "!";
            echo '</p>';

        ?>

    </div>
    <div class="row">

        <?php

            // get current user's info
            $results = getUserInfo($_SESSION['userId']);

            $newUser = $results['username'];
            $newFirst = $results['first'];
            $newLast = $results['last'];
            $newEmail = $results['email'];
            $newPhone = $results['phone'];
            $newBio = $results['bio'];

        ?>

        <div class="col-sm-6">
            <h2>Edit Profile</h2>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                First Name: <input type="text" name="first" class="form-control" value="<?php if(isset($tempFirst)) echo $tempFirst; else if (isset($newFirst)) echo $newFirst?>" <?php if(!isset($signupError)) echo "autofocus" ?> required /> <br/>
                Last Name: <input type="text" name="last" class="form-control" required value="<?php if(isset($tempLast)) echo $tempLast; else if (isset($newLast)) echo $newLast?>"/> <br/>
                Email: <input type="email" name="email" class="form-control" required value="<?php if(isset($tempEmail)) echo $tempEmail; else if (isset($newEmail)) echo $newEmail?>" <?php if(isset($emailError)) echo "autofocus" ?> />
                <p id="signupError" style="color: red; font-size: 14px;"> <?php if(isset($emailError)) echo $emailError?></p>
                Username: <input type="text" name="username" class="form-control" required value="<?php if(isset($tempUser)) echo $tempUser; else if (isset($newUser)) echo $newUser?>"/> <br/>       
                Password: <input type="password" name="pwd" class="form-control" required <?php if(isset($passError) && !isset($emailError)) echo "autofocus" ?> />
                <p id="signupError" style="color: red; font-size: 14px;"> <?php if(isset($passError)) echo $passError?></p>  <br/>
                <input type="submit" name="signup" value="Save" class="btn btn-secondary"/>  
                <p id="signupError" style="color: red; font-size: 14px;"> <br><?php if(isset($signupError)) echo $signupError?></p> 
            </form>

        </div>
    </div>
    <h2> Your Available Items </h2>
    <div class="row">
        <?php
            $items = getUserItems($_SESSION['userId']);
            if(!empty($items)) {
                echo '<ul>';
                foreach($items as $item) {
                    echo '<li>';
                    echo 'User Id: ' . $item['userId'] . ', Category: '. $item['category'] . ', Brand: ' . $item['brand'] . 
                        ', Size: ' . $item['size'] . ', Color: ' . $item['color'] . ', Condition: ' . 
                        $item['cond'] . ', Description: ' . $item['description'] . ', Price: ' . $item['price'];
                    echo '</li>';
                }
                echo '</ul>';
            }
            else {
                echo '<p>No items to display! List an item on the <a href=sell.php>Sell page</a>.</p>';
            }
        ?>
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
                <li><a href="http://localhost:4200">Shop</a></li>
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