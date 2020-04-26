
<?php

header('Access-Control-Allow-Origin: http://localhost:4200');
//header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');  
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');


require('connect-db.php');
require('user-db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // login
    if(!empty($_POST['login']) && !empty($_POST['username']) && !empty($_POST['pwd'])) {
        $userId = authenticate($_POST['username'], $_POST['pwd']);

        if($userId > -1) {
            // redirect to home page and log in by starting session
            session_start();
            $_SESSION['user'] = $_POST['username'];
            $_SESSION['userId'] = $userId;
            $_SESSION['first'] = $_POST['first'];
            $_SESSION['last'] = $_POST['last'];
            $_SESSION['email'] = $_POST['email']; 
            
            // cookie to redirect to previous page
            if (isset($_COOKIE['redirect'])){
                // read variable
                $redir = $_COOKIE['redirect'];
            }
            // redirect to home page if user didn't come from another page
            else {
                $redir = 'index.php';
            }
            
            header("Location: ". $redir);
        }
        else {
            // TODO: more specific errors
            $loginError = "There was a problem logging you in. Please try again.";
        }
    }
    // signup
    if(!empty($_POST['signup']) && !empty($_POST['first']) && !empty($_POST['last']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['pwd'])) {
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
        
        // check if username already exists
        if(doesUserExist($_POST['username'])) {
            $userExistsError = "This username is already taken. Please choose a different one.";
        }

        // check if email already exists
        if(doesEmailExist($_POST['email'])) {
            $emailError = "This email is already taken. Please choose a different valid virginia.edu email address.";
        }

        // validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !in_array($domain, $allowed)){
            $emailError = "Must be a valid virginia.edu email address.";
        }

        // validate password (6)
        if (strlen($_POST['pwd']) < 6) {
            $passError = "Password must be at least 6 characters.";
        }

        // if there are no email/pass errors
        if(!isset($emailError) && !isset($passError) && !isset($userExistsError)) {
            // create user
            $userId = createUser($_POST['username'], $_POST['pwd'], $_POST['first'], $_POST['last'], $_POST['email']);

            if($userId > -1) {
                // redirect to home page and log in by starting session
                session_start();
                $_SESSION['user'] = $_POST['username'];
                $_SESSION['userId'] = $userId;
                $_SESSION['first'] = $_POST['first'];
                $_SESSION['last'] = $_POST['last'];
                $_SESSION['email'] = $_POST['email'];
                
                // cookie to redirect to previous page
                if (isset($_COOKIE['redirect'])){
                    // read variable
                    $redir = $_COOKIE['redirect'];
                }
                // redirect to home page if user didn't come from another page
                else {
                    $redir = 'index.php';
                }
                
                header("Location: ". $redir);
            }
            else {
                $signupError = "There was a problem creating your account. Please try again.";
            }

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
?>


<div class="container">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4"><a href="cart.php">Log-in or Sign Up</a></h1>
    </div>
    <div class="row">
        <!--Log-In Form-->
        <div class="col-5">
            <h2>Log-in to an existing account</h2>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
              Username: <input type="text" name="username" class="form-control" required /> <br/>
              Password: <input type="password" name="pwd" class="form-control" required /> <br/>
              <input type="submit" name="login" value="Log in" class="btn btn-light"  />   
              <p id="loginError" style="color: red; font-size: 14px;"> <br><?php if(isset($loginError)) echo $loginError?></p> 
            </form>
        </div>

        <!--Sign-Up Form-->
        <div class="col-7">
            <h2>Sign up for a new account</h2>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
              First Name: <input type="text" name="first" class="form-control" value="<?php if(isset($tempFirst)) echo $tempFirst?>" <?php if(isset($signupError)) echo "autofocus" ?> required /> <br/>
              Last Name: <input type="text" name="last" class="form-control" required value="<?php if(isset($tempLast)) echo $tempLast?>"/> <br/>
              Email: <input type="email" name="email" class="form-control" required value="<?php if(isset($tempEmail)) echo $tempEmail?>" <?php if(isset($emailError)) echo "autofocus" ?> />
              <p id="signupError" style="color: red; font-size: 14px;"> <?php if(isset($emailError)) echo $emailError?></p>
              Username: <input type="text" name="username" class="form-control" required value="<?php if(isset($tempUser)) echo $tempUser?>" <?php if(isset($userExistsError) && !isset($emailError)) echo "autofocus" ?>/> <br/> 
              <p id="userExistsError" style="color: red; font-size: 14px;"> <?php if(isset($userExistsError)) echo $userExistsError?></p>
              Password: <input type="password" name="pwd" class="form-control" required <?php if(isset($passError) && !isset($emailError) && !isset($userExistsError)) echo "autofocus" ?> />
              <p id="signupError" style="color: red; font-size: 14px;"> <?php if(isset($passError)) echo $passError?></p>  <br/>
              <input type="submit" name="signup" value="Sign up" class="btn btn-light"/>  
              <p id="signupError" style="color: red; font-size: 14px;"> <br><?php if(isset($signupError)) echo $signupError?></p> 
            </form>
        </div>
    </div>
</div>

