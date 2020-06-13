<?php $this->layout( 'website' ); ?>

<h3>Wachtwoord resetten</h3>

<form action="<?php echo url('wachtwoord.reset', ['reset_code' => $reset_code])?>" method="POST">
	<div>
		<label for="password">Wachtwoord</label> <br>
		<input type="password" name="password"> <br> <br>

		<span class="wrong">
			<?php if ( isset( $errors['wachtwoord'] ) ): ?>
				<?php echo $errors['wachtwoord'] ?>
			<?php endif; ?>
		</span>

		<label for="password_confirm">Wachtwoord bevestigen</label> <br>
		<input type="password" name="password_confirm"> <br> <br>
	</div>

	<button type="submit">Wachtwoord resetten</button>
</form>
