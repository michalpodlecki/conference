<?php
/* User Fixture generated on: 2011-02-26 02:32:21 : 1298683941 */
class UserFixture extends CakeTestFixture {
	var $name = 'User';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'imie' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'nazwisko' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'id_adres' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'telefon' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 10, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'haslo' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'cur_timestamp' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_polish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'imie' => 'Lorem ipsum dolor sit amet',
			'nazwisko' => 'Lorem ipsum dolor sit amet',
			'id_adres' => 1,
			'telefon' => 'Lorem ip',
			'haslo' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'cur_timestamp' => '1298683941'
		),
	);
}
?>