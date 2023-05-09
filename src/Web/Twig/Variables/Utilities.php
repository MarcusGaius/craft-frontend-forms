<?php

namespace MarcusGaius\Utilities\Web\Twig\Variables;

use Craft;
use craft\helpers\Template;

class Utilities
{
	public function renderFormMacro($macro, array $args)
	{
		$originalPath = Craft::$app->getPaths->getTemplatesPath();

		Craft::$app->getPaths->setTemplatesPath(Craft::$app->getPaths->getCpTemplatesPath());
		$html = Craft::$app->getTemplates->renderMacro('_includes/forms', $macro, array($args));

		Craft::$app->getPaths->setTemplatesPath($originalPath);

		return Template::raw($html);
	}
}
