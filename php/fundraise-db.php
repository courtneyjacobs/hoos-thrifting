<?php
// Author: Amara Vo (av2jf), Courtney Jacobs
require('connect-db.php');

// inserts promocode into database
function insertPromo($promo, $userId, $start, $duration, $cio, $charity){
    global $db;

    $query = "INSERT INTO promo (code, userId, start, duration, cio, charity)
                VALUES (:code, :userId, :startDate, :duration, :cio, :charity)";

    $statement = $db->prepare($query);
    $statement->bindValue(':code', $promo);
    $statement->bindValue(':userId', $userId);
    $statement->bindValue(':startDate', $start);
    $statement->bindValue(':duration', $duration);
    $statement->bindValue(':cio', $cio);
    $statement->bindValue(':charity', $charity);

    if ($statement->execute()) {
        //echo "New record created successfully for item";

        // Display success message
        // Source: https://stackoverflow.com/questions/2426304/how-to-hide-a-div-after-some-time-period
        echo '<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>';
        echo '<div id="successMessage" class="alert alert-success">Fundraiser successfully created!</div>';
    
        echo '<script type="text/javascript">';
        echo '$(document).ready( function() {
              $("#successMessage").delay(1500).fadeOut();
              });';
        echo '</script>';
    } else {
        echo '<div class="alert alert-danger">There was a problem creating your fundraiser.</div>';
    }
    $statement->closeCursor();

}

// Returns true if the promo code already exists in the database, false otherwise
function isPromoCodeTaken($code) {
    global $db;

    $query = "SELECT * FROM promo WHERE code=:code";
    $statement = $db->prepare($query); 
    $statement->bindValue(':code', $code);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
  //  echo '<div class="alert alert-danger">Promocode already exists.</div>';
    return in_array($code, $results);
}

// Returns true if the promo code is expired, false otherwise
function isPromoCodeExpired($code) {
    global $db;

    $query = "SELECT * FROM promo WHERE code=:code";
    $statement = $db->prepare($query); 
    $statement->bindValue(':code', $code);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    $now = new DateTime("now");
    foreach($results as $row){
        // Interval will be positive if expire date is in the past
        $interval = date_diff($row->expire, $now);  
        $return (interval > 0);
    }
}


?>