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

	public function loguit() {
		loguitGebruiker();
		redirect(url('login.form') );
	}

	public function wachtwoordVergeten() {

		$errors = [];
		$mail_sent = false;

	  if ( request()->getMethod() === 'post' ) {

			$email = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL );

 		 	if ( $email === false ) {
	 			$errors['email'] = 'Geen geldig email adres opgegeven';
      }

 		  if ( count( $errors ) === 0 ) {
	 			$gebruiker = getUserByEmail($email);

	 			if ( $gebruiker === false ) {
		 				$errors['email'] = 'Onbekend account';
   	 		}

    	}

			if ( count( $errors ) === 0 ) {
				stuurWachtwoordResetEmail( $email );
				$mail_sent = true;
			}

		}

		$template_engine = get_template_engine();
		echo $template_engine->render( 'wachtwoord_vergeten_form',  ['errors' => $errors,  'mail_sent' => $mail_sent ] );

	}

	public function wachtwoordResetForm($reset_code) {

		$errors = [];

			$gebruiker = getUserByResetCode($reset_code);
				if ($gebruiker === false) {
					echo "Geen geldige code";
					exit;
				}

				if ( request()->getMethod() === 'post' ) {

					$wachtwoord         = $_POST['password'];
					$wachtwoord_confirm = $_POST['password_confirm'];

				if ( strlen( $wachtwoord ) < 6 ) {
					$errors['password'] = 'Geen geldig wachtwoord (Minimaal 6 tekens)';
				}

				if ( count( $errors ) === 0 ) {
					if ( $wachtwoord !== $wachtwoord_confirm ) {
					$errors['wachtwoord'] = 'Wachtwoorden zijn niet gelijk.';
					}
				}

				if ( count( $errors ) === 0 ) {

					$result = updateWachtwoord($gebruiker['id'], $wachtwoord);
						if($result === true){
							redirect(url('login.form'));

						}else{
							$errors['password'] ='Er ging iets fout bij het opslaan van het wachtwoord';
						}

				}


		}

		$template_engine = get_template_engine();
		echo $template_engine->render( 'password_reset_form', [ 'errors' => $errors, 'reset_code' => $reset_code ] );

	}

}
