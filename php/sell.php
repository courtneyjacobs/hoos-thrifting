<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="Courtney Jacobs; Amara Vo">
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
require('item-db.php');
session_start();
setcookie('redirect', 'sell.php', time()+3600);  
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

<div class="container">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4"><a href="sell.php">Sell</a></h1>
        
        <!--Show Info If Guest--> <!--REQUIRE USER TO BE LOGGED IN-->
        <?php 
            // if user not logged in
            if(!isset($_SESSION['user'])) {     
                echo '<p class="lead">Selling is simple and fast!</p> </div>';
                echo '<div style="margin:0 auto; padding-top: 5px; padding-bottom: 40px" align=center>';
                echo '<form action="login.php">';
                echo '   <button type="submit" style="width:200px; height:90px" class="btn btn-primary btn-success">Log-in to start selling</button>';
                echo "</form>";
                echo "</div>";
            }
            // user is logged in
            else {

        ?>

        <!--PHP: Insert Items into Database-->
        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // if the required fields are NOT empty: category, size, condition, price
            if (!empty($_POST['ctg']) && !empty($_POST['size']) && !empty($_POST['cond']) && !empty($_POST['price'])) {
                // insert into database
                addSellItem($_SESSION['userId'], $_POST['ctg'], $_POST['brand'], $_POST['size'], $_POST['color'], $_POST['cond'], $_POST['desc'], $_POST['price']);
            }

        }
        ?>



    <div id="sellForm" class="row" style="visibility: visible">
        <!--Upload Button-->
        <div class="col-lg-4">
            <img class="rounded mx-auto d-block" src="https://cdn.onlinewebfonts.com/svg/img_234957.png" alt="Upload Icon" style="width:150px;height:150px;" class="center" >
            <!--UPLOAD FORM-->
            <!--Source: https://www.w3schools.com/php/php_file_upload.asp ; https://stackoverflow.com/questions/37504383/button-inside-a-label https://stackoverflow.com/questions/572768/styling-an-input-type-file-button -->
            <form name="upload-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="GET" enctype="multipart/form-data">
                <br>
                <div class="form-group">
                    <label>Upload an image:<br><small>(.jpg, .jpeg, .png)</small></label><br></div>

                <input id="kh" type="file" style="display:none" />
                <button for="fileToUpload" type="button" class="btn btn-secondary" style="background-color: #E8E8E8; border-color:transparent; color:black;">
                    <label for="fileToUpload" style=" display: inline-block; width:110px; height:4px; cursor: pointer;">Choose Image</label>
                </button> <br>
                <small style="color: red" id="imgError"></small>
                
                <input id="fileToUpload" name="fileToUpload" type="file" style="display:none" require/>
                <br>
                <input type="submit" name="upload" value="Upload" style="display:none">

                
                <button type="button" class="btn btn-secondary">
                    <label for="upload" style="display:inline-block; width:100px; height:4px; cursor:pointer;">Upload</label>
                </button>
            </form>

            
        
        </div>
        <div class="col-lg-8">
            <!--ITEM FORM-->
            <!--Source: Bootstrap form from https://www.w3schools.com/bootstrap/bootstrap_forms.asp -->
            <form id="sell-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                <!--Category Selection-->
                <div class="form-group required">
                    <label class="col-sm-12" style="display:inline-block; text-align:left;" for="ctg">Category:</label>
                    <div class="col-sm-8"> 
                        <select class="form-control" id="category" name="ctg" required style="cursor:pointer;">
                            <option disabled selected value> -- select a category -- </option>
                            <option value="1">Tops</option>
                            <option value="2">Bottoms</option>
                            <option value="3">Shoes</option>
                            <option value="4">Accessories</option>
                            <option value="5">Other</option>
                        </select>
                    </div>
                </div>
                <!--Brand Selection-->
                <div class="form-group">   
                    <label class="col-sm-12" style="display:inline-block; text-align:left;" for="brand">Brand:</label>
                    <div class="col-sm-8">
                        <input class="col-sm-12" type="text" id="brandBox" name="brand"> 
                    </div>
                </div>
                <!--Size Selection-->
                <div class="form-group required">
                    <label class="col-sm-12" style="display:inline-block; text-align:left;" for="size">Size:</label>
                    <div class="col-sm-8">          
                        <select class="form-control" id="size" name="size" required style="cursor:pointer;">
                            <option disabled selected value> -- select a size -- </option>
                            <option value="1">No Size</option>
                            <option value="2">XS (00-1)</option>
                            <option value="3">S (2-4)</option>
                            <option value="4">M (5-7)</option>
                            <option value="5">L (8-10)</option>
                            <option value="6">XL (11-14)</option>
                        </select>
                    </div>
                </div>
                <!--Color Selection-->
                <div class="form-group">
                    <label class="col-sm-12" style="display:inline-block; text-align:left;" for="color">Color:</label>
                    <div class="col-sm-8">          
                        <select class="form-control" id="color" name="color" style="cursor:pointer;">
                            <option value="0" selected></option>
                            <option value="1">Black</option>
                            <option value="2">Blue</option>
                            <option value="3">Brown</option>
                            <option value="4">Cream</option>
                            <option value="5">Gray</option>
                            <option value="6">Green</option>
                            <option value="7">Orange</option>
                            <option value="8">Pink</option>
                            <option value="9">Purple</option>
                            <option value="10">Red</option>
                            <option value="11">Yellow</option>
                            <option value="12">White</option>
                        </select>
                    </div>
                </div>
                <!--Condition Selection-->
                <div class="form-group required">
                    <label class="col-sm-12" style="display:inline-block; text-align:left;" for="cond">Condition:</label>
                    <div class="col-sm-8">          
                        <select class="form-control" id="condition" name="cond" required style="cursor:pointer;">
                            <option disabled selected value> -- select a condition -- </option>
                            <option value="1">New</option>
                            <option value="2">Like New</option>
                            <option value="3">Good</option>
                            <option value="4">Fair</option>
                            <option value="5">Poor</option>
                        </select>
                    </div>
                </div>
                <!--Description-->
                <div class="form-group">   
                    <label class="col-sm-12" style="display:inline-block; text-align:left;" for="desc">Description:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="desc" name="desc" maxlength="250" onkeydown="checkWordCt()"></textarea>
                        <div class="col-sm-14" style=" text-align:right;" id="wordCt"><small>250</small></div>
                    </div>
                </div>
                <!--Pricing-->
                <div class="form-group required">
                    <label class="col-sm-12" style="display:inline-block; text-align:left;" for="price">Price:</label>
                    <div class="col-sm-3">
                        <input class="form-control"  id="price" name="price" type="number" step="0.01" min="1" max="1000" required onchange="validPrice()"></input>
                    </div> 
                    <div class="col-sm-12" style=" text-align:left;"><small style="color: red" id="youearnError"></small></div>
                </div>
                <div class="form-group"> 
                    <label class="col-sm-12" style="display:inline-block; text-align:left;" for="youearn">You Will Earn:</label>
                    <div class="col-3">
                        <input disabled="true" class="form-control"  id="youearn" ></input>
                    </div>
                </div>
                <!--List Item-->
                <div class="form-group">        
                    <div class="col-sm-12" style="display:inline-block; text-align:left;">
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
<?php
    }
    echo "</div>";
?>

<!--PHP: Upload images
testUpload($userId, $ctg, $size, $cond, $price, $img)
-->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //echo ("page post.");

    // check if it's from the upload img button
    if(isset($_POST["upload"])) {
        echo ("inside upload");

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES[$_POST["fileToUpload"]]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


        // CHECK IF A FILE HAS BEEN UPLOADED

        // check if file is an image type
        $check = getimagesize($_FILES[$_POST["fileToUpload"]]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists. But added it anyway";
            $target_file = $target_file.'_'.time();    
            // add uploadok?
        }

        // Check file size
        if ($_FILES[$_POST["fileToUpload"]]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$_POST["fileToUpload"]]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES[$_POST["fileToUpload"]]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    // upload button has no data
    else {
        //echo ("Please select an image.");
                    
        //echo '<script type="text/javascript">';
        //echo 'document.getElementById("imgError").innerHTML = "Please choose an image."';
        //echo '</script>';
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

</body>
</html>