<?php
class User extends AppModel {
	
	var $displayField = 'username';
	
	var $validate = array(
    'register_email' => array(
      'rule1' => array( 
        'rule' => 'notEmpty',
        'message' => 'Pole nie może być puste.',
        'last' => true
        ),
      'rule2' => array(
        'rule' => array('email', true),
        'message' => 'To nie jest poprawny adres email.'
        ),
      'rule3' => array(
        'rule'    => array('_isUniqueEmail'),
        'on'      => 'create',
        'message' => 'Ten adres email znajduje się już w bazie.'
        )
      ),
    'register_password' => array(
      'rule1' => array( 
        'rule' => 'notEmpty',
        'message' => 'Pole nie może być puste.',
        'last' => true
        )
      )   
    );
    
  var $hasMany = array(
		'Bid' => array(
			'className'  => 'Bid',
			'foreignKey' => 'user_id',
			'dependent'  => true
      ),
    'Review' => array(
			'className'  => 'Review',
			'foreignKey' => 'user_id',
			'dependent'  => true
      )
    );
	
	var $hasAndBelongsToMany = array(
    'Article' => array(
      'className'             => 'Article',
      'joinTable'             => 'articles_users',
      'foreignKey'            => 'user_id',
      'associationForeignKey' => 'article_id',
      'unique'                => true
      )
    );
    
  function _isUniqueEmail()
    {
    return ($this->find('count', array('conditions' => array('User.email' => $this->data['User']['register_email']))) == 0);
    }

}
