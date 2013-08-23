<?php
/**
 * Class IRegister
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 22.08.13
 */

namespace Flame\Thumb;


use Flame\Modules\Template\IHelperProvider;
use Nette\Templating\Template;

interface IRegister extends IHelperProvider
{

	/**
	 * @param string $name
	 * @return $this
	 */
	public function setHelperName($name);

	/**
	 * Register thumbnails helper into template
	 *
	 * @param Template $template
	 * @return void
	 */
	public function register(Template $template);
}