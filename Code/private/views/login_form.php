<?php $this->layout('website') ?>

<h2>Inloggen</h2> <br>

<form action="<?php echo url("login.verwerk") ?>" method="POST" class="login-form"> <br>

  <p>
   <label class="label-login" for="email">EMail</label> <br>
   <input class="input-login" type="text" name="email" value="<?php echo input('email') ?>"> <br>
   <small>We delen uw e-mail met niemand, bij ons zijn uw gegevens veilig. </small> <br>
   <?php if ( isset( $errors['email'] ) ) : ?>
     <?php echo $errors['email'] ?>
   <?php endif; ?>
  </p>

  <p>
   <label class="label-login" for="wachtwoord">Wachtwoord</label> <br>
   <input class="input-login" type="password" name="wachtwoord"/> <br>
   <?php if (isset( $errors['wachtwoord']  ) ) : ?>
     <?php echo $errors['wachtwoord'] ?>
   <?php endif; ?>
  </p>

   <button type="submit">Login</button>
</form>
