<?php
/**
 * Class ThumbnailRegister
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 22.08.13
 */
namespace Flame\Thumb;

use Nette\Object;
use Flame\Thumb\Templating\Helpers\Thumbnail;
use Nette\Templating\Template;

class ThumbnailRegister extends Object implements IRegister
{

	/** @var \Flame\Thumb\Templating\Helpers\Thumbnail  */
	private $thumbnail;

	/**
	 * @param Thumbnail $thumbnail
	 */
	function __construct(Thumbnail $thumbnail)
	{
		$this->thumbnail = $thumbnail;
	}

	/**
	 * @param Template $template
	 * @param string $name
	 */
	public function register(Template $template, $name = 'thumb')
	{
		$template->registerHelper((string) $name, array($this->thumbnail, 'create'));
	}
}