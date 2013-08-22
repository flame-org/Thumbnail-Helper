<?php
/**
 * Class IRegister
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 22.08.13
 */

namespace Flame\Thumb;


use Nette\Templating\Template;

interface IRegister
{

	/**
	 * Register thumbnails helper into template
	 *
	 * @param Template $template
	 * @return void
	 */
	public function register(Template $template);
}