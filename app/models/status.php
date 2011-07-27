<?php
class Status extends AppModel {
	
	var $hasMany = array(
		'Aticle' => array(
			'className'  => 'Article',
			'foreignKey' => 'status_id',
			'dependent'  => false
      )
    );

}
