<?php $this->layout('email_layout', ['message' => $message] ); ?>

<p>Nieuw bericht</p>

<p>
	<strong>Naam:</strong> <?php echo $from_name?><br/>
	<strong>E-mail:</strong> <?php echo $from_email?> <br/>
	<strong>Bericht:</strong><br/>
	<?php echo $contact_message?><br/>
</p>
