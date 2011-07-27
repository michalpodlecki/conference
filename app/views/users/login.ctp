<h2>Logowanie</h2>
<?php
echo $this->Form->create('User', array('url' => array('action' => 'login')));
  echo $this->Form->input('email', array('label' => 'Adres email'));
  echo $this->Form->input('password', array('label' => 'Hasło'));
echo $this->Form->end('Zaloguj');
?>