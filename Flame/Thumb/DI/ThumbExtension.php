<?php
/**
 * Class ThumbExtension
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 22.08.13
 */
namespace Flame\Thumb\DI;

use Nette\Configurator;
use Nette\DI\CompilerExtension;
use Nette\Utils\Validators;

class ThumbExtension extends CompilerExtension
{

	/** @var array  */
	public $defaults = array(
		'paths' => array(
			'base' => '%wwwDir%',
			'thumbs' => '/media/thumbs'
		)
	);

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig($this->defaults);

		Validators::assert($config, 'array');
		Validators::assertField($config, 'paths', 'array');
		Validators::assertField($config['paths'], 'base', 'string');
		Validators::assertField($config['paths'], 'thumbs', 'string');

		$builder->addDefinition($this->prefix('register'))
			->setClass('Flame\Thumb\ThumbnailRegister');

		$builder->addDefinition($this->prefix('storage'))
			->setClass('Flame\Thumb\Config\Storage')
			->setArguments(array($config['paths']['base'], $config['paths']['thumbs']));

		$builder->addDefinition($this->prefix('helper'))
			->setClass('Flame\Thumb\Helpers\ThumbnailHelper');

		$builder->addDefinition($this->prefix('thumbnail'))
			->setClass('Flame\Thumb\Templating\Helpers\Thumbnail');

		$builder->addDefinition($this->prefix('fileSystem'))
			->setClass('Flame\Thumb\Files\FileSystem');
	}

	/**
	 * @param Configurator $configurator
	 */
	public static function register(Configurator $configurator)
	{
		$configurator->onCompile[] = function ($configurator, $compiler) {
			$compiler->addExtension('thumb', new ThumbExtension);
		};
	}

}