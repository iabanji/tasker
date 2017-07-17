<?php 

namespace app\core;

use \Pdo;

/**
 * Class DB
 * @package app\core
 */
class DB 
{
    /**
     * @var Pdo
     */
	public $PDO;

    /**
     * @var null
     */
	private static $instance = NULL;

    /**
     * @var
     */
	private $config;

    /**
     * @var
     */
	public $rows;

    /**
     * DB constructor.
     * @param $config
     */
	private function __construct($config) 
	{
		$this->config = $config;
		$this->PDO = new PDO(
			"mysql:host={$this->config['host']};
			dbname={$this->config['dbName']}",
			$this->config['userName'],
			$this->config['password']
		);
		// set the PDO error mode to exception
		$this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->PDO->exec("SET CHARACTER SET 'utf8'");
		$this->PDO->exec("SET SESSION collation_connection = 'utf8_general_ci'");
	}

    /**
     * Deny clone DB
     */
	private function __clone () 
	{
	}
	
	public static function getInstance($config) 
	{
		if (self::$instance == NULL) 
		{
			self::$instance = new DB($config);
		}
		return self::$instance;
	}

}