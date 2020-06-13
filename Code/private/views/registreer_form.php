<?php $this->layout('website') ?>

<h2>Registeer</h2> <br>

<form action="<?php echo url("registreer.verwerk") ?>" method="POST" class="login-form"> <br>

  <p>
   <label for="voornaam">Voornaam</label> <br>
   <input type="text" name="voornaam" value="<?php echo input('voornaam') ?>"> <br>

   <span class="wrong">
     <?php if ( isset( $errors['voornaam'] ) ) : ?>
       <?php echo $errors['voornaam'] ?>
     <?php endif; ?>
   </span>

  </p>

  <p>
   <label for="achternaam">Achternaam</label> <br>
   <input type="text" name="achternaam" value="<?php echo input('achternaam') ?>"> <br>

   <span class="wrong">
     <?php if ( isset( $errors['achternaam'] ) ) : ?>
       <?php echo $errors['achternaam'] ?>
     <?php endif; ?>
   </span>

  </p>

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

  <p>
   <label for="wachtwoord">Wachtwoord</label> <br>
   <input type="password" name="wachtwoord"/> <br>

   <span class="wrong">
     <?php if (isset( $errors['wachtwoord']  ) ) : ?>
       <?php echo $errors['wachtwoord'] ?>
     <?php endif; ?>
   </span>

  </p>

   <button type="submit">Registreer</button>
</form>
