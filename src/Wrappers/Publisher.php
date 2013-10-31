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

/**
 * Wrapped object for defining and validating required properties, using magic call
 * @see \Positivezero\Adzerk\Wrapper;
 *
 * @author Vojtěch Kijenský <vojtech@positivezero.co.uk>
 *
 * example:
 * List:
 *      $o = $this->adzerk->publisher();
 *		$r = $o->get();
 *
 * Get item:
 *      $o = $this->adzerk->publisher(30083);
 *		$r = $o->get();
 *
 * Create:
 *		$o = $this->adzerk->publisher();
 *		$o->CompanyName = 'my company';
 *		$o->FirstName = 'name';
 *		$o->LastName = 'surname';
 *		$o->IsActive = true;
 *		$o->PaypalEmail = 'my@email.com';
 *		$o->PaymentOption = 1;
 *		$o->Address = (object) array(
 *		    "Line1" => "100 What St.",
 *		    "Line2" => "Apt. 123",
 *		    "City"  =>"Durham",
 *		    "StateProvince" => "NC",
 *		    "PostalCode" => "27701",
 *		    "Country" =>"USA"
 *		);
 *		$r = $o->create();
 *
 * Update:
 *		$o = $this->adzerk->publisher(37343);
 *		$o->FirstName = 'New advertiser name';
 *		$r = $o->update();
 *
 * Remove:
 *		$o = $this->adzerk->publisher(37343);
 *		$r = $o->delete();
 *
 * @property int Id
 * @property string FirstName
 * @property string LastName
 * @property string CompanyName
 * @property string PaypalEmail
 * @property int PaymentOption
 * @property object Address must contain ( "Line1", "Line2", "City", "StateProvince",  "PostalCode", "Country" );
 * @property bool IsDeleted
 * @property bool IsActive
 */
class Publisher extends Wrapper
{
}