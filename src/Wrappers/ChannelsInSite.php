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
 *  	$o = $this->adzerk->channel();
 *		$r = $o->get();
 *
 * Get one item:
 *  	$o = $this->adzerk->channel(13468);
 *		$r = $o->get();
 *
 * Create:
 *		$o = $this->adzerk->channel();
 *		$o->Engine = 'CPM';
 *		$o->AdTypes = [1,3,4];
 *		$o->CPM = 10;
 *		$o->Title = 'My channel';
 *		$r = $o->create();
 *
 * Update:
 *		$o = $this->adzerk->channel(13468);
 *		$r = $o->get();
 *		$o->Title = 'My updated channel title';
 *		$r = $o->update();
 *
 * Delete:
 *		$o = $this->adzerk->channel(13468);
 *		$r = $o->delete();
 *
 *
 * @property int Id
 * @property string Title
 * @property array AdTypes
 * @property string Engine
 * @property float CPM
 */
class ChannelsInSite extends Wrapper
{
}