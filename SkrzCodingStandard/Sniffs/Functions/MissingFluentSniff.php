<?php

namespace SkrzCodingStandard\Sniffs\Functions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use SlevomatCodingStandard\Helpers\TokenHelper;

class MissingFluentSniff implements Sniff
{

	public const MISSING_SETTER_RETURN_CODE = 'MissingReturn';
	private const MISSING_SETTER_RETURN_MSG = 'missing return on setter %s';

	public function register()
	{
		return [
			T_FUNCTION,
		];
	}

	public function process(File $phpcsFile, $functionPointer)
	{
		$tokens = $phpcsFile->getTokens();
		$namePointer = TokenHelper::findNextEffective($phpcsFile, $functionPointer + 1);
		$functionName = $tokens[$namePointer]['content'];

		if (strpos($functionName, 'set') !== 0) {
			return;
		}

		$functionStart = TokenHelper::findNext($phpcsFile, [T_OPEN_CURLY_BRACKET, T_SEMICOLON], $namePointer + 1);

		// it is an interface or abstract method
		if ($tokens[$functionStart]['code'] === T_SEMICOLON) {
			return;
		}

		$nextFunctionPointer = TokenHelper::findNext($phpcsFile, T_FUNCTION, $namePointer + 1);

		// last function in class
		if ($nextFunctionPointer === null) {
			$allCurlyEnds = TokenHelper::findNextAll($phpcsFile, T_CLOSE_CURLY_BRACKET, $namePointer + 1);
			$functionEnd = $allCurlyEnds[count($allCurlyEnds) - 2];
		} else {
			$functionEnd = TokenHelper::findPrevious($phpcsFile, T_CLOSE_CURLY_BRACKET, $nextFunctionPointer);
		}

		$returnPointer = TokenHelper::findNext($phpcsFile, T_RETURN, $functionStart, $functionEnd);

		if ($returnPointer === null) {
			$phpcsFile->addError(
				sprintf(self::MISSING_SETTER_RETURN_MSG, $functionName),
				$functionPointer,
				self::MISSING_SETTER_RETURN_CODE
			);
		}
	}

}
