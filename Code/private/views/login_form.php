<?php $this->layout('website') ?>

<h2>login</h2> <br>

<form action="<?php echo url("login.verwerken") ?>" method="POST"> <br>

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

   <br>

   <small><a href=" <?php echo url("wachtwoord.vergeten") ?> ">Wachtwoord vergeten?</a></small>

  </p>

  <p>
    <a>Nog geen account meld je <a href="<?php echo url("registreer.form") ?>">hier</a> aan</a>
  </p>

   <button type="submit">Login</button>
</form>
