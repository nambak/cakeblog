<?php

/**
 * CakePHP 2.x Laravel Valet Driver
 * 
 * @link https://laravel.com/docs/5.6/valet#custom-valet-drivers
 */
class LocalValetDriver extends ValetDriver
{
	/**
	 * Determine if the driver serves the request.
	 *
	 * @param  string  $sitePath
	 * @param  string  $siteName
	 * @param  string  $uri
	 * @return bool
	 */
	public function serves($sitePath, $siteName, $uri)
	{
		return file_exists($sitePath . '/app/Console/cake');
	}

	/**
	 * Determine if the incoming request is for a static file.
	 *
	 * @param  string  $sitePath
	 * @param  string  $siteName
	 * @param  string  $uri
	 * @return string|false
	 */
	public function isStaticFile($sitePath, $siteName, $uri)
	{
		if (file_exists($staticFilePath = $sitePath . '/app/webroot' . $uri)) {
			return $staticFilePath;
		}

		return false;
	}

	/**
	 * Get the fully resolved path to the application's front controller.
	 *
	 * @param  string  $sitePath
	 * @param  string  $siteName
	 * @param  string  $uri
	 * @return string
	 */
	public function frontControllerPath($sitePath, $siteName, $uri)
	{
		$_SERVER['DOCUMENT_ROOT'] = $sitePath . 'app/webroot';
		$_SERVER['SCRIPT_FILENAME'] = $sitePath . 'app/webroot/index.php';
		$_SERVER['SCRIPT_NAME'] = '/index.php';
		$_SERVER['PHP_SELF'] = '/index.php';

		return $sitePath . '/app/webroot/index.php';
	}
}
