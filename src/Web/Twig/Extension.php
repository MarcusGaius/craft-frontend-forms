<?php

namespace MarcusGaius\Utilities\Web\Twig;

use craft\helpers\Cp;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Extension extends AbstractExtension
{
	public function getFunctions(): array
	{
		return [
			new TwigFunction('field', [$this, 'renderCpFieldHtml'], ['is_safe' => ['html']]),
		];
	}

	public function renderCpFieldHtml(string $fieldType, array $fieldOptions = []): string
	{
		return Cp::fieldHtml('template:_includes/forms/' . $fieldType, $fieldOptions);
	}
}