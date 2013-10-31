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
 *      $o = $this->adzerk->advertiser();
 *		$r = $o->get();

 * Get item:
 *      $o = $this->adzerk->advertiser(30083);
 *		$r = $o->get();
 *
 * Create:
 *		$o = $this->adzerk->advertiser();
 *		$o->Title = 'Advertiser name';
 *		$r = $o->create();
 *
 * Update:
 *		$o = $this->adzerk->advertiser(37343);
 *		$o->Title = 'New advertiser name';
 *		$r = $o->update();
 *
 * Remove:
 *		$o = $this->adzerk->advertiser(37343);
 *		$r = $o->delete();
 *
 * @property int Id
 * @property string Title
 * @property bool IsDeleted
 * @property bool IsActive
 */
class Advertiser extends Wrapper
{
}