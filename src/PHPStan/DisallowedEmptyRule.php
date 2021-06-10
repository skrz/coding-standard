<?php declare(strict_types = 1);
namespace Skrz\PHPStan;

use PhpParser\Node;
use PHPStan\Analyser\Scope;

class DisallowedEmptyRule implements \PHPStan\Rules\Rule
{

	public function getNodeType(): string
	{
		return \PhpParser\Node\Expr\Empty_::class;
	}

	/**
	 * @param \PhpParser\Node\Expr\Empty_ $node
	 * @param \PHPStan\Analyser\Scope $scope
	 * @return string[]
	 */
	public function processNode(Node $node, Scope $scope): array
	{
		// array in empty is allowed
		if ($scope->getType($node->expr)->isArray()->yes()) {
			return [];
		}

		return [
			'Construct empty() is allowed only for array. Use more strict comparison.',
		];
	}

}
