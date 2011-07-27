<?php
class Review extends AppModel {
	
	var $belongsTo = array(
    'Article' => array(
			'className'    => 'Article',
			'foreignKey'   => 'article_id'
		  )
    );    
  
}
