<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::setDefaultNamespace( 'Website\Controllers' );

SimpleRouter::group( [ 'prefix' => site_url() ], function () {

	// START: Zet hier al eigen routes
	// Lees de docs, daar zie je hoe je routes kunt maken: https://github.com/skipperbent/simple-php-router#routes

	//registreer routes
	SimpleRouter::get( '/registreer', 'RegistreerController@registreerForm' )->name( 'registreer.form' );
	SimpleRouter::post( '/registreer/verwerken', 'RegistreerController@VerwerkRegistreerForm' )->name( 'registreer.verwerk' );
	SimpleRouter::get( '/registreer/bedankt', 'RegistreerController@registreerbedankt' )->name( 'registreer.bedankt' );
	SimpleRouter::get( '/registreer/bevestigen/{code}', 'RegistreerController@registeerValidatie' )->name( 'registreer.validatie' );

	//login routes
	SimpleRouter::get( '/', 'LoginController@loginForm' )->name( 'login.form' );
	SimpleRouter::post( '/login/verwerken',	'LoginController@verwerkLoginForm' )->name( 'login.verwerken' );
	SimpleRouter::get( '/loguit', 'LoginController@loguit' )->name( 'loguit' );

	SimpleRouter::get( '/login/succes', 'LoginController@loginSucces' )->name( 'login.succes' );

	SimpleRouter::get( '/stuur-test-email', 'EmailController@sendTestEmail' )->name( 'email.test' );
	SimpleRouter::get( '/bekijk-test-email', 'EmailController@viewTestEmail' )->name( 'view.email' );

	SimpleRouter::get( '/contact', 'ContactController@contactForm' )->name( 'contact.form' );
	SimpleRouter::post( '/contact/versturen', 'ContactController@verwerkContactForm' )->name( 'contact.verwerk' );






	// STOP: Tot hier al je eigen URL's zetten

	SimpleRouter::get( '/not-found', function () {
		http_response_code( 404 );

		return '404 Page not Found';
	} );

} );

// Dit zorgt er voor dat bij een niet bestaande route, de 404 pagina wordt getoond
SimpleRouter::error( function ( Request $request, \Exception $exception ) {
	if ( $exception instanceof NotFoundHttpException && $exception->getCode() === 404 ) {
		response()->redirect( site_url() . '/not-found' );
	}

} );
