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

use Positivezero\Adzerk\Wrapper;
use Positivezero\Rest;
use Positivezero\RestClient;

/**
 * Wrapped object for defining and validating required properties, using magic call
 * @see \Positivezero\Adzerk\Wrapper;
 * @author Vojtěch Kijenský <vojtech@positivezero.co.uk>
 *
 * example:
 * List:
 *  	$o = $this->adzerk->flight();
 *		$r = $o->get();
 *
 * Get one item:
 *  	$o = $this->adzerk->flight(13468);
 *		$r = $o->get();
 *
 * Update:
 *  	$o = $this->adzerk->flight(52885);
 *      $o->Title = 'My updated flight';
 *      $r = $o->update();
 *
 * Create:
 *		$o = $this->adzerk->flight();
 *		$o->Name = 'My flight';
 *		$o->CampaignId = 55311; // get id from CampaignWrapper
 *		$o->PriorityId = 31970; // get id from PriorityWrapper
 *		$o->SiteZoneTargeting = array(
 *                              // get id from SiteWrapper and ZoneWrapper
 *			(object) array('SiteId'=>53027, 'ZoneId' => 52752, 'IsExclude' => false)
 *		);
 *		$o->NoEndDate = true;
 *		$o->StartDate = date('m/d/Y');
 *		$o->Price = '100';
 *		$o->IsUnlimited = true;
 *		$o->IsFullSpeed = true;
 *		$o->Keywords = 'keyword1, keyword2, keyword3';
 *		$o->GoalType = 2;       // 1:Impressions, 2:Percentage, 3:Click, 4:Even, 5:View Conversions, 6:Click Conversions, 7:Any Conversions
 *		$o->Impressions = 100;  // work as impressions and as percent too if is set GoalType to Percentage
 *		$o->RateType = 1;       // 1:Flat, 2:CPM, 3:CPC, 4:CPA View, 5:CPA Click, 6:CPA Both
 *		$o->IsActive = true;
 *		$o->DatePartingStartTime = '07:00:00';
 *		$o->DatePartingEndTime = '22:00:00';
 *		$o->IsSunday = true;
 *		$o->IsFriday = true;
 *		$o->create();
 *
 * Delete:
 *      $o = $this->adzerk->flight(52878);
 *      $r = $o->delete();
 *
 * @property int Id
 * @property string Name
 * @property int CampaignId
 * @property int PriorityId
 * @property string StartDate m/d/Y
 * @property string EndDate m/d/Y
 * @property bool NoEndDate isPersistent?
 * @property float Price
 * @property int Impressions
 * @property bool IsUnlimited
 * @property bool IsNoDuplicates
 * @property bool IsFullSpeed
 * @property string Keywords "key1, key2"
 * @property string UserAgentKeywords  Keywords used to target individual browsers
 * @property bool IsDeleted
 * @property bool IsActive
 * @property string DatePartingStartTime (optional) - An 8 character string that indicates when Day Parting should start. It should use the format of HH:MM:SS, or 21:00:00.
 * @property string DatePartingEndTime - string (optional) - An 8 character string that indicates when Day Parting should end. It should use the format of HH:MM:SS, or 21:00:00.
 * @property bool IsSunday - (optional) - If you choose to only show your flight on Sunday, this value should be true.
 * @property bool IsMonday -  (optional) - If you choose to only show your flight on Monday, this value should be true.
 * @property bool IsTuesday - (optional) - If you choose to only show your flight on Tuesday, this value should be true.
 * @property bool IsWednesday - (optional) - If you choose to only show your flight on Wednesday, this value should be true.
 * @property bool IsThursday - (optional) - If you choose to only show your flight on Thursday, this value should be true.
 * @property bool IsFriday - (optional) - If you choose to only show your flight on Friday, this value should be true.
 * @property bool IsSaturday - (optional) - If you choose to only show your flight on Saturday, this value should be true.
 * @property array GeoTargeting [ object {
 *                  "CountryCode":"US",
 *                  "Region":"NC",
 *                  "MetroCode":560,
 *                  "IsExclude":false
 *                  }],
 * @property array SiteZoneTargeting [ object {
 *                  "SiteId":123
 *                  "ZoneId":321
 *                  "IsExclude":false
 *                  }],
 * */
class Flight extends Wrapper
{

	protected function afterGet(RestClient $response)
	{
		$keys = array('DatePartingStartTime', 'DatePartingEndTime');
		foreach($keys as $key) {
			if (isset($response->decoded_response->$key)) {
				$response->decoded_response->$key = preg_replace('/\.(.*)/','',$response->decoded_response->$key);
			}
		}
		return $response;
	}
}