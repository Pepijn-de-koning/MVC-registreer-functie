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

	public function verwerkLoginForm() {

		$template_engine = get_template_engine();

		$errors = [];

		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			$email      = $_POST['email'];
		  $wachtwoord = $_POST['wachtwoord'];

		  if ( empty( $email ) ) {
		    $errors ['email'] = 'E-mail adres niet ingevuld';
		  }

		  if ( empty( $wachtwoord ) ) {
		    $errors ['wachtwoord'] = 'Wachtwoord niet ingevuld';
		  }

		  if ( count( $errors ) === 0 ) {

					$connection = dbconnect();
		      $sql = 'SELECT * FROM `gebruikers` WHERE `email` = :email';
		      $statement = $connection->prepare( $sql );

		      $params = ['email' => $email];

		      $statement->execute($params);

		      if ( $statement->rowCount() === 1 ) {

		        $gebruiker = $statement->fetch();

						if ( $gebruiker['code'] === null ) {

		        if ( password_verify( $wachtwoord, $gebruiker['wachtwoord'])){

		          session_start();
		          $_SESSION['user_id'] = $gebruiker['id'];
		          $_SESSION['voornaam'] = $gebruiker['voornaam'];

							loginGebruiker( $gebruiker );

							$bedanktUrl = url('login.succes');
							redirect($bedanktUrl);
		        }

				else {
		      $errors['wachtwoord_check'] = 'wachtwoord is niet correct';
		    }

			} else {
			 		$errors['email'] = 'Uw acount is nog niet bevestigd';
			}

	 	}

	}

}

		$template_engine = get_template_engine();
		echo $template_engine->render( 'login_form', ['errors' => $errors]);

}

	public function loginSucces(){

		loginCheck();

		$template_engine = get_template_engine();
		echo $template_engine->render("login_succes");

	}

	public function loguit( ) {
		loguitGebruiker();
		redirect(url('login.form') );
	}

}
