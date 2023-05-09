<?php

namespace MarcusGaius\Utilities;

use Craft;
use craft\web\Application as CraftWebApp;
use craft\web\twig\variables\CraftVariable;
use MarcusGaius\Utilities\Web\Twig\Extension;
use MarcusGaius\Utilities\Web\Twig\Variables\Utilities as UtilitiesVariable;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\base\Module;

class Utilities extends Module implements BootstrapInterface
{
	const ID = 'utils';

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
		Craft::info('Utilities module bootstrapped', __METHOD__);
	}

	private function configureModule(): void
	{
	}

	private function registerComponents(): void
	{
		Craft::$app->getView()->registerTwigExtension(new Extension);
	}

	private function registerEventHandlers(): void
	{
		Event::on(
			CraftVariable::class,
			CraftVariable::EVENT_INIT,
			function (Event $event) {
				/** @var CraftVariable $variable */
				$variable = $event->sender;
				$variable->set('utils', UtilitiesVariable::class);
			}
		);
	}
}
