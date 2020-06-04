<?php
// Model functions
// In dit bestand zet je ALLE functions die iets met data of de database doen

function getUsers() {
  $connection = dbConnect();
  $sql        = "SELECT * FROM `gebruikers`";
  $statement  = $connection->query( $sql );

  return $statement->fetchAll();
}

function getUserByEmail($email){
  $connection = dbConnect();
  $sql        = "SELECT * FROM `email` WHERE email = :email";
  $statement  = $connection->query( $sql );
  $statement->execute( [ 'email' => $email ] );

  if($statement->rowCount() ===1) {
    return  $statement->fetch();
  }

  return false;

}
