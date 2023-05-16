<?php

namespace MarcusGaius\Utilities\Web\Twig;

use Craft;
use craft\helpers\Cp;
use craft\helpers\StringHelper;
use Symfony\Component\VarDumper\VarDumper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class Extension extends AbstractExtension
{
	public function getFunctions(): array
	{
		return [
			new TwigFunction('field', static function(string $fieldType, array $fieldOptions = []): string {
				return Cp::fieldHtml('template:_includes/forms/' . $fieldType, $fieldOptions);
			}, ['is_safe' => ['html']]),
			new TwigFunction('dd', static function(mixed ...$vars): never {
				foreach ($vars as $v) {
					VarDumper::dump($v);
				}

				exit(1);
			}),
		];
	}

	public function getFilters(): array
	{
		return [
			new TwigFilter('slugify', static function(string $str): string {
				return StringHelper::slugify($str, language: Craft::$app->getSites()->getCurrentSite()->language);
			}),
		];
	}
}