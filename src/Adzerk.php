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
use Positivezero\Adzerk\InvalidArgumentException;
use Positivezero\Adzerk\Wrappers;

/**
 * Adzerk API thin client for Representational State Transfer (REST)
 *
 * @author Vojtěch Kijenský <vojtech@positivezero.co.uk>
 *
 * @link https://github.com/adzerk/adzerk-api/wiki/
 * @method Wrappers\Advertiser advertiser
 * @method Wrappers\Campaign campaign
 * @method Wrappers\Channel channel
 * @method Wrappers\Creative creative
 * @method Wrappers\Flight flight
 * @method Wrappers\Earnings earnings
 * @method Wrappers\Report report
 * @method Wrappers\Payments payments
 * @method Wrappers\Map map
 * @method Wrappers\Priority priority
 * @method Wrappers\Publisher publisher
 * @method Wrappers\Site site
 * @method Wrappers\Zone zone
 * @throws Adzerk Exception
 */
class Adzerk
{
	private $apiKey;
	private $apiUrl;

	public function __construct($key)
	{
		$this->apiUrl = array(
			'v1' => 'https://api.kevel.co/v1',
			'v2' => 'https://api.kevel.co/v2'
		);
		$this->apiKey = $key;
	}

	/**
	 * @param $method
	 * @param $args
	 * @return Adzerk\Wrapper
	 * @throws Adzerk\InvalidArgumentException
	 */
	public function __call($method, $args)
	{
		$class = '\\Positivezero\\Adzerk\\Wrappers\\'.$this->firstUpper($method);
		
		if (class_exists($class)) {
			$request = new RestClient(array(
				'base_url' => $this->apiUrl['v1'],
				'headers' => array(
					'X-Adzerk-ApiKey'=>$this->apiKey,
					'Content-Type'=> 'application/json',
					//'class'=>$class,
					//'method'=>$method
				)
			));

			// html decoder accept adzerk error messages, we need no parser here
			$request->register_decoder('html', function($data){
				return $data;
			});

			return new $class($request, isset($args[0]) ? $args[0] : null,  isset($args[1]) ? $args[1] : null );
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
