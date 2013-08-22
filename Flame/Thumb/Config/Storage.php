<?php
/**
 * Class Storage
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 22.08.13
 */
namespace Flame\Thumb\Config;

use Nette\Object;
use Nette\Utils\Strings;

class Storage extends Object implements IStorage
{

	/** @var  string */
	private $baseFolderPath;

	/** @var  string */
	private $folderPath;

	/**
	 * @param $baseFolderPath
	 * @param $folderPath
	 */
	function __construct($baseFolderPath, $folderPath)
	{
		$this->baseFolderPath = (string) $baseFolderPath;
		$this->folderPath = (string) $folderPath;
	}

	/**
	 * @param string $baseFolderPath
	 * @return $this
	 */
	public function setBasePath($baseFolderPath)
	{
		$this->baseFolderPath = (string) $baseFolderPath;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getBasePath()
	{
		if(Strings::endsWith($this->baseFolderPath, DIRECTORY_SEPARATOR)) {
			$this->baseFolderPath = substr($this->baseFolderPath, 0, strlen($this->baseFolderPath) - 1);
		}

		return $this->baseFolderPath;
	}

	/**
	 * @param string $folderPath
	 * @return $this
	 */
	public function setThumbsPath($folderPath)
	{
		$this->folderPath = (string) $folderPath;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getThumbsPath()
	{
		if(!Strings::startsWith($this->folderPath, DIRECTORY_SEPARATOR)) {
			$this->folderPath = DIRECTORY_SEPARATOR . $this->folderPath;
		}

		return $this->folderPath;
	}


	/**
	 * Return absolute path
	 *
	 * @return string
	 */
	public function getFullPath()
	{
		return $this->getBasePath() . $this->getThumbsPath();
	}
}