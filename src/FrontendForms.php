<?php

namespace MarcusGaius\FrontendForms;

use Craft;
use craft\web\Application as CraftWebApp;
use craft\web\twig\variables\CraftVariable;
use MarcusGaius\FrontendForms\Web\Twig\Variables\FrontendForms as FFVariable;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\base\Module;

class FrontendForms extends Module implements BootstrapInterface
{
	const ID = 'frontend-forms';

	public function __construct($id = self::ID, $parent = null, $config = [])
	{
		parent::__construct($id, $parent, $config);
	}

	public function bootstrap($app)
	{
		if (!$app instanceof CraftWebApp) {
			return;
		}

		static::setInstance($this);

		$this->configureModule();
		$this->registerComponents();

		$this->registerEventHandlers();
		Craft::info('FrontendForms module bootstrapped', __METHOD__);
	}

	private function configureModule(): void
	{
	}

	private function registerComponents(): void
	{
	}

	private function registerEventHandlers(): void
	{
		Event::on(
			CraftVariable::class,
			CraftVariable::EVENT_INIT,
			function (Event $event) {
				/** @var CraftVariable $variable */
				$variable = $event->sender;
				$variable->set('ff', FFVariable::class);
			}
		);
	}
}
