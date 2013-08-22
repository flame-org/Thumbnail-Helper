<?php
/**
 * Class ThumbnailHelper
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 05.05.13
 */
namespace Flame\Thumb\Helpers;

use Flame\Thumb\Config\IStorage;
use Nette\Object;
use Nette\Utils\Strings;
use Nette\Image;

class ThumbnailHelper extends Object
{

	const SEPARATOR = '.';

	/** @var \Flame\Thumb\Config\IStorage  */
	private $storage;

	/** @var array */
	private $flags = array(
		'fit' => Image::FIT,
		'fill' => Image::FILL,
		'exact' => Image::EXACT,
		'shrink' => Image::SHRINK_ONLY,
		'stretch' => Image::STRETCH,
	);

	/**
	 * @param IStorage $storage
	 */
	public function __construct(IStorage $storage)
	{
		$this->storage = $storage;
	}

	/**
	 * @param $relPath
	 * @param $width
	 * @param $height
	 * @param $mtime
	 * @param $flag
	 * @return string
	 */
	public function getUniqueName($relPath, $width, $height, $flag, $mtime)
	{
		$tmp = explode(self::SEPARATOR, $relPath);
		$ext = array_pop($tmp);
		$relPath = implode(self::SEPARATOR, $tmp);
		$relPath .= $width . 'x' . $height . '-' . $mtime . '-' . $flag;
		$relPath = md5($relPath) . self::SEPARATOR . $ext;
		return $relPath;
	}

	/**
	 * @return string
	 */
	public function getDirPath()
	{
		return $this->storage->getFullPath();
	}

	/**
	 * @param $width
	 * @param $height
	 * @param $flag
	 * @return int
	 */
	public function convertFlag($width, $height, $flag)
	{
		if ($flag === null) {
			$flag = ($width !== null && $height !== null) ? 'STRETCH' : 'FIT';
		}

		$flag = strtolower((string)$flag);

		return (isset($this->flags[$flag])) ? $this->flags[$flag] : Image::FIT;
	}

	/**
	 * @param string $thumbName
	 * @return string
	 */
	public function getImageUrl($thumbName)
	{
		if (Strings::startsWith($thumbName, '/') || Strings::endsWith($this->storage->getThumbsPath(), '/')) {
			return $this->storage->getThumbsPath() . $thumbName;
		}

		return $this->storage->getThumbsPath() . '/' . $thumbName;
	}

	/**
	 * @param string $relativePath
	 * @return string
	 */
	public function getImagePath($relativePath)
	{
		if (Strings::startsWith($relativePath, DIRECTORY_SEPARATOR) ||
			Strings::endsWith($this->storage->getBasePath(), DIRECTORY_SEPARATOR)) {
			return $this->storage->getBasePath() . $relativePath;
		}

		return $this->storage->getBasePath() . DIRECTORY_SEPARATOR . $relativePath;
	}
}