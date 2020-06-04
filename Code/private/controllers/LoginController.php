<?php

namespace Website\Controllers;

/**
 * Class LoginController
 */
class LoginController {

	public function loginForm() {

		$template_engine = get_template_engine();
		echo $template_engine->render('login_form');

	}

	public function VerwerkloginForm() {

		$connection = dbConnect();
		$errors = [];

		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			$email                 = $_POST['email'];
		  $wachtwoord            = $_POST['wachtwoord'];

		  if ( empty( $email ) ) {
		    $errors ['email'] = 'E-mail adres niet ingevuld';
		  }

		  if ( empty( $wachtwoord ) ) {
		    $errors ['wachtwoord'] = 'Wachtwoord niet ingevuld';
		  }

		  if ( count( $errors ) === 0 ) {

		      $sql = 'SELECT * FROM `gebruikers` WHERE `email` = :email';
		      $statement = $connection->prepare( $sql );

		      $params = ['email' => $email];

		      $statement->execute($params);

		      if ( $statement->rowCount() === 1 ) {

		        $gebruiker = $statement->fetch();

		        if ( password_verify( $wachtwoord, $gebruiker['wachtwoord'])){

		          session_start();
		          $_SESSION['user_id'] = $gebruiker['id'];
		          $_SESSION['voornaam'] = $gebruiker['voornaam'];

		          header('location: homepage.php');
		          exit();
		        }

		        else {
		          $errors['wachtwoord_check'] = 'wachtwoord is niet goed';
		      }
		    }
		  }
		}
	}
}
