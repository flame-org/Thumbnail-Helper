<?php
/**
 * ThumbnailsCreator.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame
 *
 * @date    02.08.12
 */

namespace Flame\Thumb\Templating\Helpers;

use Flame\Thumb\Files\FileSystem;
use Nette\Diagnostics\Debugger;
use Nette\Image;
use Nette\InvalidArgumentException;
use Nette\Object;
use Flame\Thumb\Helpers\ThumbnailHelper;

class Thumbnail extends Object
{

	/** @var \Flame\Thumb\Helpers\ThumbnailHelper  */
	private $helper;

	/** @var \Flame\Thumb\Files\FileSystem  */
	private $fileSystem;

	/**
	 * @param ThumbnailHelper $helper
	 * @param FileSystem $fileSystem
	 */
	public function __construct(ThumbnailHelper $helper, FileSystem $fileSystem)
	{
		$this->helper = $helper;
		$this->fileSystem = $fileSystem;
	}

	/**
	 * @param      $imagePath
	 * @param      $width
	 * @param null $height
	 * @param null $flag
	 * @return string
	 * @throws \Nette\InvalidArgumentException
	 */
	public function create($imagePath, $width = 50, $height = null, $flag = null)
	{
		if (($width === null && $height === null)) {
			throw new InvalidArgumentException('Width or height of image must be set');
		}

		$thumbDirPath = $this->helper->getDirPath();
		if (!file_exists($thumbDirPath)) {
			$this->fileSystem->mkDir($thumbDirPath);
		}

		if (!is_dir($thumbDirPath) || !is_writable($thumbDirPath)) {
			throw new InvalidArgumentException('Folder ' . $thumbDirPath . ' does not exist or is not writable');
		}

		$origPath = $this->helper->getImagePath($imagePath);
		if (!file_exists($origPath)) {
			return $imagePath;
		}

		$flag = $this->helper->convertFlag($width, $height, $flag);
		$thumbName = $this->helper->getUniqueName($imagePath, $width, $height, $flag, filemtime($origPath));
		$thumbUri = $this->helper->getImageUrl($thumbName);
		$thumbPath = $thumbDirPath . DIRECTORY_SEPARATOR . $thumbName;

		if (file_exists($thumbPath)) {
			return $thumbUri;
		} else {

			try {
				$image = Image::fromFile($origPath);
				$image->alphaBlending(false);
				$image->saveAlpha(true);

				$origWidth = $image->getWidth();
				$origHeight = $image->getHeight();

				$image->resize($width, $height, $flag)->sharpen();

				$newWidth = $image->getWidth();
				$newHeight = $image->getHeight();

				if ($newWidth !== $origWidth || $newHeight !== $origHeight) {
					$image->save($thumbPath);

					return $thumbUri;
				} else {
					return $imagePath;
				}
			} catch (\Exception $ex) {
				Debugger::log($ex);
				return $imagePath;
			}
		}
	}
}
