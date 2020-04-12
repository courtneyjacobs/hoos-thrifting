<?php
// Author: Amara Vo; Courtney Jacobs
require('connect-db.php');

// Inserts promo code into DB
function createPromoCode($code, $userId, $start, $end, $cio, $charity) {
    global $db;
    
    $query = "INSERT INTO promo (code, userId, start, end, cio, charity) VALUES (:code, :userId, :start, :end, :cio, :charity)";            // do i still need default here? new DateTime('now')
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':userId', $userId);
    $statement->bindValue(':start', $start);
    $statement->bindValue(':end', $end);
    $statement->bindValue(':cio', $cio);
    $statement->bindValue(':charity', $charity);
    
    $statement->execute();
    $statement->closeCursor();
}


// Returns true if the promo code already exists in the database, false otherwise
function isPromoCodeTaken($code) {
    global $db;

    $query = "SELECT * FROM promo";
    $statement = $db->prepare($query); 
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
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