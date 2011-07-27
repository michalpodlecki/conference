<?php
/* Adre Fixture generated on: 2011-02-26 01:44:40 : 1298681080 */
class AdreFixture extends CakeTestFixture {
	var $name = 'Adre';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'ulica' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'nr' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'nr_lokalu' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'kod_poczt' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 6, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'miasto' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'panstwo' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_polish_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_polish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'ulica' => 'Lorem ipsum dolor sit amet',
			'nr' => 1,
			'nr_lokalu' => 1,
			'kod_poczt' => 'Lore',
			'miasto' => 'Lorem ipsum dolor sit amet',
			'panstwo' => 'Lorem ipsum dolor '
		),
	);
}
?>