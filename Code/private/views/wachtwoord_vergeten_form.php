<?php $this->layout('website'); ?>

<h2>Wachtwoord vergeten?</h2> <br>

<form action="<?php echo url('wachtwoord.vergeten') ?>" method="POST"> <br>

<?php if ( ! $mail_sent ): ?>

  <p>
   <label for="email">E-Mail</label> <br>
   <input type="text" name="email" value="<?php echo input('email') ?>"> <br>
   <small>We delen uw e-mail met niemand, bij ons zijn uw gegevens veilig. </small> <br>

   <span class="wrong">
     <?php if ( isset( $errors['email'] ) ) : ?>
       <?php echo $errors['email'] ?>
     <?php endif; ?>
   </span>

  </p>


   <button type="submit">Reset wachtwoord</button>
</form>
<?php else: ?>
    <h4>De mail is verstuurd met de reset link</h4>
<?php endif; ?>
