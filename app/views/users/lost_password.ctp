<h2>Formularz przywracania hasła</h2>
<?php
echo $this->Form->create('User', array('url' => array('action' => 'lost_password')));
  echo $this->Form->input('email', array('label' => 'Adres email'));
echo $this->Form->end('Przywróć mi hasło');
?>