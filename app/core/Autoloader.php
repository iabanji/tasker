<?php

/**
 * Class Autoloader
 */
class AutoloaderClass
{
    public static function load($className)
    {
		if(strpos($className, "\\") === false)
		{
			 die('Namespace is missing for ' . $className);
		}else
		{
			$file = str_replace('\\', '/', $className . '.php');

			if(is_file($file))
			{
				require $file;
			}
			else
			{
				die('Здесь может быть страница 404, нету ' . $file);
			}
			
		}
    }
}
spl_autoload_register("\\AutoloaderClass::load");


function my_autoloader($class) {

    include 'app/controllers/' . $class . '.php';
}

spl_autoload_register('my_autoloader');