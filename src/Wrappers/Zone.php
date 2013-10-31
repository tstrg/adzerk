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
 * @author Vojtěch Kijenský <vojtech@positivezero.co.uk>
 *
 * example:
 * List:
 *  	$o = $this->adzerk->zone();
 *		$r = $o->get();
 *
 * Get one item:
 *  	$o = $this->adzerk->zone(13468);
 *		$r = $o->get();
 *
 * Update:
 *  	$o = $this->adzerk->zone(52885);
 *      $o->Name = 'Default zone';
 *      $r = $o->update();
 *
 * Create:
 *      $o = $this->adzerk->zone();
 *      $o->Name = 'Default zone';
 *      $r = $o->create();
 *
 * Delete:
 *      $o = $this->adzerk->zone(52878);
 *      $r = $o->delete();
 *
 * @property int Id
 * @property string Name
 * @property int SiteId
 */
class Zone extends Wrapper
{
}