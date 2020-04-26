<?php
// Author: Courtney Jacobs (cj5he), Amara Vo (av2jf)
require('connect-db.php');


header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

// retrieve data from the request
$postdata = file_get_contents("php://input");

// Extract json format to PHP array
$request = json_decode($postdata);

// Set up 
$len = 0;

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