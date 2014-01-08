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

namespace Positivezero\Adzerk\Wrappers;

use Positivezero\Adzerk\RequestException;
use Positivezero\Adzerk\Wrapper;
use Positivezero\Rest;

/**
 * Wrapped object for defining and validating required properties, using magic call
 * @see \Positivezero\Adzerk\Wrapper;
 * @author Vojtěch Kijenský <vojtech@positivezero.co.uk>
 *

 * You can specify the criteria for the report using an object titled "criteria".
 * @property string StartDate -  m/d/Y - The start date for the report
 * @property string EndDate -  m/d/Y - The end date for the report
 * @property array GroupBy - List of strings - The values to group the report on. The possible values here are day, week, month, brandId, campaignId, optionId, creativeId, adTypeId, siteId, zoneId, countryCode, metroCode, keyword.
 * @property boolean Top30Countries -  If set to true only returns data from the top 30 countries as calculated by total network traffic.
 * @property boolean Exclude3rdParty - If set to true will exclude HTML/Javascript ads from the report.
 * @property boolean IsTotal - Boolean - Set to true if you want to receive a single total.
 * @property array Parameters - List of Crit objects - An unlimited number of criteria that can be applied to a report. The possible terms are advertiserId, campaignId, flightId, creativeId, channelId, adTypeId, siteId, zoneId, countryCode, metroCode, and keyword.
 */
class Report extends Wrapper
{

	/**
	 *
	 * (Note: flightId will be returned as OptionId in the report.)
	 * Here is a sample criteria object that will generate a daily report for the Advertiser with an id of 12 grouped by campaign:
	 * criteria={'StartDate': '1/1/2011', 'EndDate': '5/16/2011', 'GroupBy': ['day','campaignId'], 'Parameters': [{'brandId': 12}]}
	 *
	 * @return mixed
	 * @throws RequestException
	 */
	public function get()
	{
		try {
			$response = $this->request->post($this->getRestMethod(), (string)$this);
			return $response->decoded_response;
		} catch (Rest\RestClientException $e) {
			throw new RequestException($e->getMessage(),null,$e);
		}
	}

	public function __toString()
	{
		return 'criteria=' . json_encode($this->data);
	}
}