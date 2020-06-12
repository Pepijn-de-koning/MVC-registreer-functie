<?php $this->layout('website') ?>

<h2>Contact</h2>

<p>Hulp nodig? Vul het onderstaande formulier in</p>

<form action="<?php echo url('contact.verwerk') ?>" method="post">

  <p>
    <label for="">Naam</label> <br>
    <input type="text" name="from_name" placeholder="Uw naam">
  </p>

  <p>
    <label for="">Email</label> <br>
    <input type="text" name="from_email" name="form_name" placeholder="Uw naam">
  </p>

  <p>
    <label for="">Bericht</label> <br>
    <input type="text" name="contact_message" vname="from_name" placeholder="Uw naam">
  </p>

  <button type="submit" name="button">Verstuur</button>
</form>
