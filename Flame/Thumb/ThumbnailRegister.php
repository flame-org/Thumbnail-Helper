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

	/** @var  string */
	private $name = 'thumb';

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
	 */
	public function register(Template $template)
	{
		$template->registerHelper($this->name, array($this->thumbnail, 'create'));
	}

	/**
	 * @param string $name
	 * @return $this
	 */
	public function setHelperName($name)
	{
		$this->name = (string) $name;
		return $this;
	}
}