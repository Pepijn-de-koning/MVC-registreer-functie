<?php
// Model functions
// In dit bestand zet je ALLE functions die iets met data of de database doen

function getUsers() {

  $connection = dbConnect();
  $sql        = "SELECT * FROM `gebruikers`";
  $statement  = $connection->query( $sql );

  return $statement->fetchAll();
}

function getUserByEmail( $email ) {

	$connection = dbConnect();
	$sql        = "SELECT * FROM `gebruikers` WHERE `email` = :email";
	$statement  = $connection->prepare( $sql );
	$statement->execute( [ 'email' => $email ] );

	if ( $statement->rowCount() === 1 ) {
		return $statement->fetch();
	}

	return false;

}

function getUserByCode( $code ) {

  $connection = dbConnect();
  $sql        = "SELECT * FROM `gebruikers` WHERE `code` = :code";
  $statement  = $connection->prepare( $sql );
  $statement->execute( ['code' => $code ] );

  if ( $statement->rowCount() === 1 ) {
    return $statement->fetch();
  }

  return false;

}

function getUserByResetCode( $reset_code ) {

	$connection = dbConnect();
	$sql        = "SELECT * FROM `gebruikers` WHERE `password_reset` = :code";
	$statement  = $connection->prepare( $sql );
	$statement->execute( [ 'code' => $reset_code ] );

	if ( $statement->rowCount() === 1 ) {
		return $statement->fetch();
	}

	return false;
}

function updateWachtwoord($user_id, $nieuw_wachtwoord) {
  $safe_nieuw_wachtwoord = password_hash($nieuw_wachtwoord , PASSWORD_DEFAULT);
  $sql = "UPDATE `gebruikers` SET `wachtwoord` = :wachtwoord, `password_reset` = NULL WHERE id = :id";
  $connection = dbConnect();
  $statement = $connection->prepare($sql);
	$params = [
		'wachtwoord' => $safe_nieuw_wachtwoord,
		'id' => $user_id
	];

	return $statement->execute($params);
}
