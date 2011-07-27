<h2>Rejestracja</h2>
<?php
echo $this->Form->create('User', array('inputDefaults' => array('autocomplete' => 'off')));
  echo $this->Form->input('register_email', array('label' => 'Adres email'));
  echo $this->Form->input('register_password', array('label' => 'Hasło', 'type' => 'password', 'value' => ''));
  echo '<br />';
  echo $this->Form->input('firstname', array('label' => 'Imię'));
  echo $this->Form->input('surname', array('label' => 'Nazwisko'));
  echo $this->Form->input('phone', array('label' => 'Telefon'));
  echo '<br />';
  echo $this->Form->input('country', array('label' => 'Państwo'));
  echo $this->Form->input('city', array('label' => 'Miasto'));
  echo $this->Form->input('zip_code', array('label' => 'Kod pocztowy'));
  echo $this->Form->input('street', array('label' => 'Ulica'));
  echo $this->Form->input('number', array('label' => 'Numer'));
  echo $this->Form->input('ap_number', array('label' => 'Numer lokalu'));
echo $this->Form->end('Zarejestruj');
?>