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

namespace Positivezero;
use Nette\Utils\Strings;
use Positivezero\Adzerk\InvalidArgumentException;
use Positivezero\Adzerk\Wrappers;

/**
 * Adzerk API thin client for Representational State Transfer (REST)
 *
 * @author Vojtěch Kijenský <vojtech@positivezero.co.uk>
 *
 * @link https://github.com/adzerk/adzerk-api/wiki/
 * @property Rest login
 * @property Rest report
 * @property Rest advertiser
 * @property Rest site
 * @property Rest channelSite
 * @property Wrappers\Channel channel
 * @property Rest adtypes
 * @property Rest priority
 * @property Rest campaign
 * @property Rest flight
 * @property Rest payments
 */
class Adzerk
{
	private $apiKey;
	private $apiBase = 'http://api.adzerk.net/v1';

	public function __construct($key)
	{
		$this->apiKey = $key;
	}

	/**
	 * @param method
	 * @return Adzerk\Wrapper
	 * @throws Adzerk\InvalidArgumentException
	 */
	public function __get($method)
	{
		$class = '\\Positivezero\\Adzerk\\Wrappers\\'.$this->firstUpper($method);
		if (class_exists($class)) {
			return new $class(new Rest($method, $this->apiBase, array(
				'X-Adzerk-ApiKey' => $this->apiKey
			)));
		}
		throw new InvalidArgumentException($class . ' not found!');
	}

	/**
	 * Convert first character to upper case.
	 * @param  string  UTF-8 encoding
	 * @return string
	 */
	public static function firstUpper($s)
	{
		return mb_strtoupper((mb_substr($s, 0, 1, 'UTF-8')), 'UTF-8') . mb_substr($s, 1, strlen(utf8_decode($s)), 'UTF-8');
	}

}
