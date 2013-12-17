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

use Positivezero\Adzerk\NotImplementedException;
use Positivezero\Adzerk\Wrapper;
use Positivezero\Rest;
use Positivezero\RestClient;

/**
 * Do REST request to Adzerk Native Engine API
 */
class Serve
{
	const ENDPOINT = 'http://engine.adzerk.net/api/v2';
	private $apiUrl;

	/**
	 * Method that requesting ad trough adzerk api with given data.
	 * More info:
	 * @link http://help.adzerk.com/Native_Ads_API
	 *
	 * @param $data
	 * @return RestClient
	 */
	public function request($data)
	{
		$request = new RestClient(array(
			'base_url' => self::ENDPOINT,
			'headers' => array(
				'Content-Type'	=> 'application/json'
			)
		));
		$example = '{"placements":[{"divName":"div1","networkId":4161,"siteId":20022,"adTypes":[5]}],"user":{"key":"abc"}}';
		$response = $request->post(
			$this->apiUrl,
			json_encode($data)
		);
		return $response;
	}
}