<?php

namespace app\core;

use app\core\Request;

class Application
{
    /**
     * @var array
     */
	public static $config = [];

    /**
     * @var DB|null
     */
	public $db = null;

    /**
     * @var \app\core\Request|null
     */
	public $request = null;

    /**
     * @var null
     */
	private static $instance = NULL;

    /**
     * Application constructor.
     */
	private function __construct()
	{
		$this->db = DB::getInstance(self::$config['db']);
		$this->request = Request::getInstance();
	}

    /**
     * @return Application|null
     */
	public static function getInstance()
    {
		if (self::$instance == NULL) {
			self::$instance = new self();
		}
		return self::$instance;
	}

    /**
     * Deny clone Application
     */
	private function __clone () {}

    /**
     * Set config to Application
     * @param $config
     */
	public static function setConfig($config)
    {
        self::$config = $config;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public static function getParam($key)
    {
        $value = self::$config[$key];

        return ($value) ? $value : null;
    }
}