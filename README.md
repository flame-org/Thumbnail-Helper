Thumbnail-Helper
================

Nette template helper for lazy creating of thumbnails

###Instalation
**Example is based on 2.1-dev of Nette, but the package is compatible with stable version too**

```php

	class Presenter extends \Nette\Application\UI\Presenter
	{

		/**
		 * @inject
		 * @var \Flame\Templating\Helpers\Thumbnail
		 */
		public $thumbnailsCreator;

		protected function beforeRender()
		{
			parent::beforeRender();

			$this->template->registerHelper('thumb', \Nette\Callback::create($this->thumbnailsCreator, 'create'));
		}

	}

```
