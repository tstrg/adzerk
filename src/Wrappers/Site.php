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
 *  	$o = $this->adzerk->site();
 *		$r = $o->get();
 *
 * Get one item:
 *  	$o = $this->adzerk->site(13468);
 *		$r = $o->get();
 *
 * Update:
 *  	$o = $this->adzerk->site(52885);
 *      $o->Title = 'Site 3';
 *      $r = $o->update();
 *
 * Create:
 *      $o = $this->adzerk->site();
 *      $o->Title = 'My site';
 *      $o->Url = 'http://test.cz';
 *      $r = $o->create();
 *
 * Delete:
 *      $o = $this->adzerk->site(52878);
 *      $r = $o->delete();
 *
 * @property int Id
 * @property string Title
 * @property string Url
 * @property int PublisherAccountId
 */
class Site extends Wrapper
{
}