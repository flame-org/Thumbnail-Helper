<?php
/**
 * Class IStorage
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 22.08.13
 */

namespace Flame\Thumb\Config;


interface IStorage
{

	/**
	 * @param $basePath
	 * @return $this
	 */
	public function setBasePath($basePath);

	/**
	 * @return string
	 */
	public function getBasePath();

	/**
	 * @param $thumbsPath
	 * @return $this
	 */
	public function setThumbsPath($thumbsPath);

	/**
	 * @return string
	 */
	public function getThumbsPath();

	/**
	 * Return absolute path
	 *
	 * @return string
	 */
	public function getFullPath();
}