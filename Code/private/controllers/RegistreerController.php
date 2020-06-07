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

			if ( $statement->rowCount() === 0 ) {
				$sql	= "INSERT INTO `gebruikers` (`voornaam`, `achternaam`, `email`, `wachtwoord`) VALUES (:voornaam, :achternaam, :email, :wachtwoord)";

				$statement = $connection->prepare( $sql );
				$safe_password = password_hash( $wachtwoord, PASSWORD_DEFAULT );

				$params = [ 'email'				 => $email,
				 						'wachtwoord' 	 => $safe_password,
				  					'voornaam' 	 	 => $voornaam,
					 					'achternaam' 	 => $achternaam
									];

				$statement->execute( $params );

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

}
