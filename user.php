<?php
require('connect-db.php');

// Inserts promo code into DB
function createUser($username, $pass_hash, $first, $last, $email) {
    $query = "INSERT INTO user (username, pass, first, last, email) VALUES (:username, :pass_hash, :first, :last, :email)";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':pass_hash', $pass_hash);
    $statement->bindValue(':first', $first);
    $statement->bindValue(':last', $last);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $statement->closeCursor();
}

// Returns true if a user with the given username exists, false otherwise
function doesUserExist($username) {
    $query = "SELECT * FROM user WHERE username=:username";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username); 
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return (count($results) > 0);
}

// Returns true if the given user exists and the password matches the correct hash, false otherwise
function authenticate($username, $pass) {
    $query = "SELECT pass FROM user WHERE username=:username";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username); 
    $statement->execute();
    $hash = $statement->fetchAll();
    $statement->closeCursor();
    if(count($hash) > 0) {
        return password_verify($pass, $hash[0]);
    }
    return false;
}
 
// Returns all information for a user with given id
function getUserInfo($id) {
    $query = "SELECT * FROM user WHERE id=:id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id); 
    $statement->execute();
    $results = $statement->fetch();
    $statement->closeCursor();
    return $results;
}

// Updates the information of the user with given id
function updateUserInfo($id, $username, $pass_hash, $first, $last) {
    $query = "UPDATE user SET username=:username, pass=:pass_hash, first=:first, last=:last WHERE id=:id";    
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':pass_hash', $pass_hash);
    $statement->bindValue(':first', $first);
    $statement->bindValue(':last', $last);
    $statement->bindValue(':id', $id); 
    $statement->execute();
    $results = $statement->fetch();
    $statement->closeCursor();
    return $results;
}


?>