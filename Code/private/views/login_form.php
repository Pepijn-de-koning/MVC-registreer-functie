<?php $this->layout('website') ?>

<h2>login</h2> <br>

<form action="<?php echo url("login.verwerken") ?>" method="POST"> <br>

  <p>
   <label for="email">E-Mail</label> <br>
   <input type="text" name="email" value="<?php echo input('email') ?>"> <br>
   <small>We delen uw e-mail met niemand, bij ons zijn uw gegevens veilig. </small> <br>
   <?php if ( isset( $errors['email'] ) ) : ?>
     <?php echo $errors['email'] ?>
   <?php endif; ?>
  </p>

  <p>
   <label for="wachtwoord">Wachtwoord</label> <br>
   <input type="password" name="wachtwoord"/> <br>
   <?php if (isset( $errors['wachtwoord']  ) ) : ?>
     <?php echo $errors['wachtwoord'] ?>
   <?php endif; ?>
  </p>

   <button type="submit">Login</button>
</form>
