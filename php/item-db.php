<?php
// Author: Courtney Jacobs (cj5he), Amara Vo (av2jf)

header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

require('connect-db.php');


// retrieve data from the request
$postdata = file_get_contents("php://input");

// Extract json format to PHP array
$request = json_decode($postdata);

// Set up 
$len = 0;

// SELL TODO: this is not how you check between the two
if($postdata == null) {
//    if (!empty($_POST['ctg']) && !empty($_POST['size']) && !empty($_POST['cond']) && !empty($_POST['price'])) {
        // insert into database
//        addSellItem(0, $_POST['ctg'], $_POST['brand'], $_POST['size'], $_POST['color'], $_POST['cond'], $_POST['desc'], $_POST['price']);
//    }
}
// SHOP
else {
    $data = [];

    // get shop items and put in $data object
    $resArray = getShopItems('', '');
    foreach($resArray as $res) {
        $data[$len] = $res;
        $len++;
    }

    $data['length'] = $len;
    // Send response (in json format) back the front end
    echo json_encode(['content'=>$data]);
}



// Returns all items for a user with given id
function getUserItems($id) {
    global $db;

    $query = "SELECT userId, category, brand, size, color, cond, description, price FROM item WHERE userId=:id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', intval($id)); 
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

// Gets all available items to display in Shop
function getShopItems($filter, $direction) {
    global $db;
    // Default is by most recently added
    if($filter == "") {
        $query = "SELECT id, userId, category, brand, size, color, cond, description, price FROM item ORDER BY creationDatetime DESC";
    }
    // if filter specified
    else {
        // ascending
        if($direction == "asc") {
            $query = "SELECT id, userId, category, brand, size, color, cond, description, price FROM item ORDER BY :filter ASC";
        }
        // descending
        if($direction == "desc") {
            $query = "SELECT id, userId, category, brand, size, color, cond, description, price FROM item ORDER BY :filter DESC";
        }
        // otherwise
        else {
            $query = "SELECT id, userId, category, brand, size, color, cond, description, price FROM item ORDER BY :filter";
        }
    }
    $statement = $db->prepare($query);
    if($filter != "") {
        $statement->bindValue(':filter', $filter); 
    }
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

// Returns 5 most recently listed items to display on home page
function get5RecentItems() {
    global $db;

    $query = "SELECT userId, category, brand, size, color, cond, description, price FROM item ORDER BY creationDatetime DESC LIMIT 5";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

// Insert item into database
function addSellItem($userId, $category, $brand, $size, $color, $condition, $description, $price) {
    global $db;

    $query = "INSERT INTO item (userId, category, brand, size, color, cond, description, price) 
            VALUES (:userId, :category, :brand, :size, :color, :condition, :description, :price)";
    
    $statement = $db->prepare($query);

    $statement->bindValue(':userId', $userId);
    $statement->bindValue(':category', $category);
    $statement->bindValue(':brand', $brand);
    $statement->bindValue(':size', $size);
    $statement->bindValue(':color', $color);
    $statement->bindValue(':condition', $condition);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':price', $price);

    if ($statement->execute()) {
        $statement->closeCursor();
        // Display success message
        // Source: https://stackoverflow.com/questions/2426304/how-to-hide-a-div-after-some-time-period
        echo '<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>'.'<div id="successMessage" class="alert alert-success">Item successfully listed!</div>'.'<script type="text/javascript">'.'$(document).ready( function() {
              $("#successMessage").delay(1500).fadeOut();
              });'.'</script>';

    } else {
        $statement->closeCursor();
        echo '<div class="alert alert-danger">There was a problem listing your item.</div>';
    }

}
function upload($image) {
    global $db;

    $query="insert IGNORE into `items` (`imgVar`) values ('$image')";
    $statement = $db->prepare($query);
    
    mysqli_query($con,$query) or die(mysqli_error($con));

    if ($statement->execute()) {
        // Display success message
        echo '<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>';
        echo '<div id="successMessage" class="alert alert-success">Item successfully listed!</div>';
    
        echo '<script type="text/javascript">';
        echo '$(document).ready( function() {
              $("#successMessage").delay(1500).fadeOut();
              });';
        echo '</script>';
    } else {
        echo '<div class="alert alert-danger">There was a problem listing your item.</div>';
    }
    $statement->closeCursor();
}

?>