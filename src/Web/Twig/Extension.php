<?php

namespace MarcusGaius\Utilities\Web\Twig;

use Craft;
use craft\web\View;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Extension extends AbstractExtension
{
	public function getFunctions(): array
	{
		return [
			new TwigFunction('field', [$this, 'renderFormMacro'], ['is_safe' => ['html']]),
		];
	}

	public function renderFormMacro(string $fieldType, array $fieldOptions): string
	{
		$oldMode = Craft::$app->view->getTemplateMode();
		Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
		$html = Craft::$app->view->renderTemplateMacro('_includes/forms', $fieldType, [$fieldOptions]);
		Craft::$app->view->setTemplateMode($oldMode);

		return $html;
	}
}
