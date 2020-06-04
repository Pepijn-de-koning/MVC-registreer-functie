<?php $this->layout('website') ?>

<h2>Registeer</h2> <br>

<form action="<?php echo url("registreer.verwerk") ?>" method="POST" class="login-form"> <br>

  <p>
   <label class="label-login" for="voornaam">Voornaam</label> <br>
   <input class="input-login" type="text" name="voornaam" value="<?php echo input('voornaam') ?>"> <br>
   <?php if ( isset( $errors['voornaam'] ) ) : ?>
     <?php echo $errors['voornaam'] ?>
   <?php endif; ?>
  </p>

  <p>
   <label class="label-login" for="achternaam">Achternaam</label> <br>
   <input class="input-login" type="text" name="achternaam" value="<?php echo input('achternaam') ?>"> <br>
   <?php if ( isset( $errors['achternaam'] ) ) : ?>
     <?php echo $errors['achternaam'] ?>
   <?php endif; ?>
  </p>

  <p>
   <label class="label-login" for="email">E-Mail</label> <br>
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

   <button class="button-registreer" type="submit">Registreer</button>
</form>
