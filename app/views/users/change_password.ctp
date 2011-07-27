<h2>Zmiana hasła</h2>
<?php 
echo $this->Form->create('User', array('url' => array('action' => 'change_password'), 'inputDefaults' => array('autocomplete' => 'off')));
  echo $this->Form->input('change_password', array('label' => 'Nowe hasło', 'type' => 'password'));
  echo $this->Form->input('repeat_password', array('label' => 'Powtórz hasło', 'type' => 'password'));
echo $this->Form->end('Zmień');
?>