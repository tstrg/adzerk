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
use Positivezero\RestClient;

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
	protected $data;

	protected $id;

	/** @var bool|string override wrapper rest method  */
	protected $method = false;

	protected $request;

	/**
	 * name of method, will be called by REST
	 * @param array $url
	 * @param string $key
	 */
	function __construct(RestClient $request, $id)
	{
		$this->id = $id;
		$this->data['Id'] = $id;
		$this->request = $request;
		$this->data = new \stdClass();
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
		return $this->getRestMethod() . '=' . json_encode($this->data);
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

	/**
	 * call rest type PUT to adzerk api
	 * You must send all properties, because adzerk remove some property, if they are not defined again.
	 * @return RestClient
	 */
	public function update()
	{
		// load default data
		$object = $this->get();
		$tmp = (array)$object;
		// and override with users data
		foreach ($this->data as $key => $value) {
			$tmp[$key] = $value;
		}
		$this->data = $tmp;
		// save all properties again
		$response = $this->request->put($this->getRestMethod() . '/' . $this->data['Id'], (string)$this);
		return $response->decoded_response;
	}

	/**
	 * call rest type GET to adzerk API
	 * @return mixed
	 */
	public function get()
	{
		$query = '';
		if (is_numeric($this->id)) {
			$query = '/' . $this->id;
		}
		$response = $this->request->get($this->getRestMethod() . $query);
		return $response->decoded_response;
	}

	/**
	 * call rest type POST to adzerk api
	 * @return RestClient
	 */
	public function create()
	{
		$response = $this->request->post($this->getRestMethod(), (string)$this);
		return $response->decoded_response;
	}


	public function delete()
	{
		$response = $this->request->get($this->getRestMethod() . '/' . $this->id . '/delete');
		return $response->decoded_response;
	}

	/**
	 * Convert first character to upper case.
	 * @param  string  UTF-8 encoding
	 * @return string
	 */
	public function firstUpper($s)
	{
		return mb_strtoupper((mb_substr($s, 0, 1, 'UTF-8')), 'UTF-8') . mb_substr($s, 1, strlen(utf8_decode($s)), 'UTF-8');
	}

	/**
	 * create method from class, which is passed to rest query
	 * @return string
	 */
	public function getRestMethod()
	{
		if ($this->method) return $this->method;
		$name = explode('\\', get_called_class());
		return strtolower($name[count($name) - 1]);
	}

}