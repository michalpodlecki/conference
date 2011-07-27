<?php
class Article extends AppModel {

  var $order = 'Article.created DESC';
	
	var $belongsTo = array(
    'Status' => array(
			'className'    => 'Status',
			'foreignKey'   => 'status_id'
		  )
    );
    
  var $hasMany = array(
		'Bid' => array(
			'className'  => 'Bid',
			'foreignKey' => 'article_id',
			'dependent'  => true
      ),
    'Review' => array(
			'className'  => 'Review',
			'foreignKey' => 'article_id',
			'dependent'  => true
      )
    );

}
