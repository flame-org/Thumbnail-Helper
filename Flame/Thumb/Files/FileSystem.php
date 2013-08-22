<?php
/**
 * Class FileSystem
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 22.08.13
 */
namespace Flame\Thumb\Files;

use Nette\InvalidStateException;
use Nette\Object;

class FileSystem extends Object
{

	/**
	 * @param $dir
	 * @param bool $recursive
	 * @param int $chmod
	 * @param bool $need
	 * @return bool
	 * @throws \Nette\InvalidStateException
	 */
	public function mkDir($dir, $recursive = true, $chmod = 0777, $need = true)
	{
		$parentDir = $dir;
		while (!is_dir($parentDir)) {
			$parentDir = dirname($parentDir);
		}

		@umask(0000);
		if (!is_dir($dir) && false === ($result = @mkdir($dir, $chmod, $recursive)) && $need) {
			throw new InvalidStateException('Unable to create directory ' . $dir);
		}

		if ($dir !== $parentDir) {
			do {
				@umask(0000);
				@chmod($dir, $chmod);
				$dir = dirname($dir);
			} while ($dir !== $parentDir);
		}

		return isset($result) ? $result : true;
	}

}