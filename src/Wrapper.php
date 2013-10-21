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

use Positivezero\Rest;

/**
 * You can easily create object for adzerk API endpoint. String representation of this class will generate
 * object wrap and json compatible string
 *
 * example: channel={"Id":13368,"Title":"Some name","AdTypes":[1,3,4],"Engine":"CPM","CPM":10}
 *
 * @author Vojtěch Kijenský <vojtech@positivezero.co.uk>
 *
 */
class Wrapper
{
	/** @var \stdClass */
	private $data;
	/** @var string */
	private $name;
	/** @var \Positivezero\Rest */
	protected $rest;

	/**
	 * name of method, will be called by REST
	 * @param $name
	 */
	function __construct(Rest $rest, $name)
	{
		$this->rest = $rest;
		$this->data = new \stdClass();
		$this->name = $name;
	}

	public function __get($key)
	{
		if (isset($this->data->$key)) {
			return $this->data->$key;
		} else {
			throw new InvalidArgumentException('Key ' . $key . ' not found!');
		}
	}

	public function __set($key, $value)
	{
		$this->data->$key = $value;
	}

	public function setParameters($data)
	{
		$this->data = $data;
	}

	public function __toString()
	{
		return $this->name . '=' . json_encode($this->data);
	}

	/**
	 * validate all required properties found in wrapped object
	 * using reflection
	 *
	 * @return bool
	 * @throws InvalidArgumentException
	 */
	public function validate()
	{
		$reflection = new Reflection($this);
		$properties = $reflection->getProperties();
		foreach ($properties as $property) {
			if (!isset($this->data->$property)) {
				throw new InvalidArgumentException('Property "' . $property . '" not found in "' . $this->name . '"
					wrapped object. Object is not valid!');
			}
		}
		return true;
	}

	public function get($parameter = null)
	{
		return $this->rest->get($parameter);
	}

	public function put()
	{
//		$this->validate();
		return $this->rest->put($this->Id, $this);
	}

	public function post()
	{
//		$this->validate();
		return $this->rest->post(null, $this);
	}

	public function delete($Id)
	{
		throw new InvalidArgumentException('This wrapped object "' . $this->firstUpper($this->name) . '" has no method delete!
			Method must be declared in wrapped object "Wrapper\\' . $this->firstUpper($this->name) . '"!
		');
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