<?php
require('connect-db.php');

// Inserts promo code into DB
function createUser($username, $pass, $first, $last, $email) {
    global $db;

    echo "user: $username , pass: $pass , first: $first , last: $last , email: $email";
    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (username, pass, first, last, email) VALUES (:username, :pass_hash, :first, :last, :email)";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':pass_hash', $pass_hash);
    $statement->bindValue(':first', $first);
    $statement->bindValue(':last', $last);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $statement->closeCursor();

    $query = "SELECT id FROM user WHERE username=:username";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username); 
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    if(count($result) > 0) {

        // correct pass
        return $result[0]['id'];
    }
    return -1;
}

// Returns true if a user with the given username exists, false otherwise
function doesUserExist($username) {
    global $db;

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
    global $db;

    $query = "SELECT id, pass FROM user WHERE username=:username";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username); 
    $statement->execute();
    $hash = $statement->fetchAll();
    $statement->closeCursor();
    if(count($hash) > 0) {
        // correct pass
        if(password_verify($pass, $hash[0]['pass'])) {
            return $hash[0]['id'];
        }
    }
    return -1;
}
 
// Returns all information for a user with given id
function getUserInfo($id) {
    global $db;

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
    global $db;

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