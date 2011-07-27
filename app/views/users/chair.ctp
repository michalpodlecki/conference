<?php

echo $form->create('User', array('url' => array('action' => 'chairEmail')));

echo $form->input('email', array('label'=> 'Email'));
echo $form->input('subject', array('label' => 'Temat'));
echo $form->input('content', array('label' => 'Tresc:', 'type' => 'textarea', 'escape' => false));

echo $form->checkbox('author', array('value' => 1, 'label' => 'Autorzy')); echo "Do autorow <br />";
echo $form->checkbox('reviewer', array('value' => 2 , 'label' => 'Recenzenci')); echo "Do recenzentow <br />";

echo $form->end('Wyslij');

?>