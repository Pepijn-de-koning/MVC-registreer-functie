<?php

namespace Website\Controllers;

/**
 * Class RegistreerController
 *
 * Deze handelt de logica van de registreerform af van gebruikers
 *
 */
class RegistreerController {

	public function RegistreerForm() {

		$template_engine = get_template_engine();
		echo $template_engine->render('registreer_form');

	}

	public function VerwerkRegistreerForm() {

		$template_engine = get_template_engine();

		$errors = [];

		$voornaam   = $_POST['voornaam'];
		$achternaam = $_POST['achternaam'];
		$email 			= filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL );
		$wachtwoord = trim( $_POST['wachtwoord'] );

		if ( empty($voornaam)) {
			$errors['voornaam'] = 'Geen voornaam ingevuld';
		}

		if ( empty($achternaam)) {
			$errors['achternaam'] = 'Geen achternaam ingevuld';
		}

		if ( $email	=== false ) {
			$errors['email'] = 'Geen geldig email adres';
		}

		if ( strlen( $wachtwoord) < 6 ) {
			$errors['wachtwoord'] = 'Geen geldig wachtwoord (Minimaal 6 tekens)';
		}

		if ( count( $errors ) === 0 ) {

			$connection = dbconnect();
			$sql				=	"SELECT * FROM `gebruikers` WHERE `email` =:email";
			$statement  = $connection->prepare( $sql );
			$statement->execute( [ 'email' => $email ] );

			//verificatie code
			$code = md5( uniqid( rand(), true ) );

			if ( $statement->rowCount() === 0 ) {
				$sql	= "INSERT INTO `gebruikers` (`voornaam`, `achternaam`, `email`, `wachtwoord`, `code`) VALUES (:voornaam, :achternaam, :email, :wachtwoord, :code)";

				$statement = $connection->prepare( $sql );
				$safe_password = password_hash( $wachtwoord, PASSWORD_DEFAULT );

				$params = [ 'email'				 => $email,
				 						'wachtwoord' 	 => $safe_password,
				  					'voornaam' 	 	 => $voornaam,
										'achternaam' 	 => $achternaam,
					 					'code' 				 => $code
									];

				$statement->execute( $params );

				//Verificatie mail versturen
				stuurVerificatieEmail( $email, $code );

				$bedanktUrl = url('registreer.bedankt');
				redirect($bedanktUrl);

			} else{
				$errors['email'] = 'Dit acount bestaat al';
			}
		}

		$template_engine = get_template_engine();
		echo $template_engine->render( 'registreer_form', ['errors' => $errors]);

	}

	public function registreerbedankt(){

		$template_engine = get_template_engine();
		echo $template_engine->render("registreer_bedankt");

	}

	public function registeerValidatie( $code ) {

		 $gebruiker = getUserByCode($code);
		 if ( $gebruiker === false) {
			 echo"Onbekende gebruiker of al bevestigd";
			 exit;
		 }

		 bevestigAccount( $code );

		 $template_engine = get_template_engine();
		 echo $template_engine->render("registreer_confirm");
	}

}
