<?php

namespace Website\Controllers;

/**
 * EmailController
 */
class EmailController {

	public function	sendTestEmail() {

		$mailer = getSwiftMailer();

		$message = createEmailMessage('29118@ma-web.nl', 'Dit is een test email', 'Pepijn de Koning', '29118@ma-web.nl');

		$template_engine = get_template_engine();
		$html = $template_engine->render('email', [ 'message' => $message ] );

		$message->setBody( $html, 'text/html' );

		$aantal_verstuurd = $mailer->send($message);

		echo "Aantal = " . $aantal_verstuurd;

	}

	function viewTestEmail() {

		$mailer = getSwiftMailer();

		$message = createEmailMessage('29118@ma-web.nl', 'Dit is een test email', 'Pepijn de Koning', '29118@ma-web.nl');


		$template_engine = get_template_engine();
		echo $template_engine->render('email', [ 'message' => null ] );

	}

}
