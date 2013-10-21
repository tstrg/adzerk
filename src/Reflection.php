<?php
/**
 * Adzerk thin client (https://github.com/positivezero/adzerk)
 *
 * Copyright (c) 2013 PositiveZero ltd. (http://www.positivezero.co.uk)
 *
 * For the full copyright and license information, please view
 * the file license.md that was distributed with this source code.
 *
 * API: https://github.com/adzerk/adzerk-api/wiki
 *
 * Usage: readme.md
 */

namespace Positivezero\Adzerk;

/**
 * Parse given object for PHP Doc property annotation with \ReflectionClass
 *
 * @author Vojtěch Kijenský <vojtech@positivezero.co.uk>
 *
 */
class Reflection {

	private $object;

	function __construct($object)
	{
		$this->object = new \ReflectionClass($object);
	}

	public function getProperties()
	{
		$annotation = $this->object->getDocComment();
		$lines = explode(PHP_EOL,$annotation);
		$result = array();
		foreach($lines as $line) {
			if (preg_match('/@property[\s]+[a-zA-Z0-9]+[\s]+([a-zA-Z0-9_\-]+)/',$line,$match)) {
				if (count($match) == 2) {
					array_push($result, $match[1]);
				}
			}
		}
		return $result;
	}
}