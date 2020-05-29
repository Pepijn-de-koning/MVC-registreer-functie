<?php $this->layout('website') ?>

<h2>Registeer</h2> <br>

<form action="<?php echo url("registreer.verwerk") ?>" method="POST" class="login-form"> <br>

  <p>
   <label class="label-login" for="voornaam">Voornaam</label> <br>
   <input class="input-login" type="text" name="voornaam"/>
  </p>

  <p>
   <label class="label-login" for="achternaam">Achternaam</label> <br>
   <input class="input-login" type="text"name="achternaam"/>
  </p>

  <p>
   <label class="label-login" for="email">E-Mail</label> <br>
   <input class="input-login" type="text"name="email"/>
  </p>

  <p>
   <label class="label-login" for="wachtwoord">Wachtwoord</label> <br>
   <input class="input-login" type="password" name="wachtwoord"/>
  </p>

   <button class="button-registreer" type="submit">Registreer</button>
</form>
