<?php
require('connect-db.php');

// Inserts promo code into DB
function createPromoCode($code, $creatorID, $cio, $charity) {
    $query = "INSERT INTO promo (code, expire, creatorID, cio, charity) 
        VALUES (:code, :creatorID, new DateTime("now"), :cio, :charity)";
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':creatorID', $creatorID);
    $statement->bindValue(':cio', $cio);
    $statement->bindValue(':charity', $charity);
    $statement->execute();
    $statement->closeCursor();
}


// Returns true if the promo code already exists in the database, false otherwise
function isPromoCodeTaken($code) {
    $query = "SELECT * FROM promo";
    $statement = $db->prepare($query); 
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return in_array($code, $results);
}

// Returns true if the promo code is expired, false otherwise
function isPromoCodeExpired($code) {
    $query = "SELECT * FROM promo WHERE code=:code";
    $statement = $db->prepare($query); 
    $statement->bindValue(':code', $code);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    $now = new DateTime("now");
    foreach($results as $row){
        // Interval will be positive if expire date is in the past
        $interval = date_diff($row->expire, $datetime2);  
        $return (interval > 0);
    }
}

?>