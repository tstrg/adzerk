<?php
/**
 * Adzerk thin client (https: *github.com/positivezero/adzerk)
 *
 * Copyright (c) 2013 PositiveZero ltd. (http: *www.positivezero.co.uk)
 *
 * For the full copyright and license information, please view
 * the file license.md that was distributed with this source code.
 *
 * API: https: *github.com/adzerk/adzerk-api/wiki
 *
 * Usage: readme.md
 */

namespace Positivezero\Adzerk\Wrappers;

use Positivezero\Adzerk\Wrapper;
use Positivezero\Rest;

/**
 * Wrapped object for defining and validating required properties, using magic call
 * @see \Positivezero\Adzerk\Wrapper;
 *
 * @author Vojtěch Kijenský <vojtech@positivezero.co.uk>
 *
 * example:
 * List:
 * 		$o = $this->adzerk->campaign();
 *		$r = $o->get();
 *
 * Get one item:
 *  	$o = $this->adzerk->campaign(13468);
 *		$r = $o->get();
 *
 * Create:
 *		$o = $this->adzerk->campaign();
 *		$o->Name = 'My campaign';
 *		$o->Flights = [];
 *		$o->Price = 0;
 *		$o->AdvertiserId = 37060;
 *		$o->StartDate = date('m/d/Y');
 *		$r = $o->create();
 *
 * Update:
 *		$o = $this->adzerk->campaign(13468);
 *		$o->Name = 'My campaign is updated';
 *		$r = $o->update();
 *
 * Remove:
 *		$o = $this->adzerk->campaign(13468);
 *		$r = $o->delete();
 *
 * @property int Id
 * @property string Name
 * @property string StartDate (m/d/Y)
 * @property int AdvertiserId
 * @property bool IsActive
 * @property bool IsDeleted
 * @property float Price
 * @property array Flights
 */
class Campaign extends Wrapper
{
}