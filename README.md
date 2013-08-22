Thumbnail-Helper
================

Nette template helper for lazy creating of thumbnails

###Instalation
**Examples is based on Nette version 2.0.12, but the package is compatible with @dev version too**

##Register "thumb" extension
In **bootstrap.php**
```php
\Flame\Thumb\DI\ThumbExtension::register($configurator);
```

###Register "thumb" helper

```php

	/**
     * Base presenter for all application presenters.
     */
    abstract class BasePresenter extends Presenter
    {

    	/**
    	 * @param null $class
    	 * @return \Nette\Templating\ITemplate
    	 */
    	protected function createTemplate($class = null)
    	{
    		$template = parent::createTemplate($class);
    		/** @var \Flame\Thumb\ThumbnailRegister $register */
    		$register = $this->context->getService('thumb.register');
    		$register->register($template);
    		return $template;
    	}
    }
```

###Set variables (Optional)
In **config.neon**
```yml
	thumb:
		paths:
			base: %wwwDir%
			thumbs: /media/thumbs
``

**That's all! Enjoy it!**
