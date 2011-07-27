<h2>Edycja profilu</h2>

<?php 

echo $form->create('User', array('url' => array('action' => 'profile')));
echo $form->input('user.firstname', array('label' => 'Nazwa użytkownika'));



?>