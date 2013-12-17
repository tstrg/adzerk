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
 *
 * Create:
 *		$o = $this->adzerk->channelSite();
 * 		$o->ChannelId = 123456
 * 		$o->SiteId = 789
 * 		$o->Priority = 7
 *		$r = $o->create();
 *
 *
 * Delete:
 *		$o = $this->adzerk->channelSite();
 * 		$o->ChannelId = 123456
 * 		$o->SiteId = 789
 *		$r = $o->delete();
 *
 *
 * @property int Id
 * @property string Title
 * @property array AdTypes
 * @property string Engine
 * @property float CPM
 */
class ChannelSite extends Wrapper
{

	public function delete()
	{
		$response = $this->request->get('channel/' . $this->ChannelId . '/site/' . $this->SiteId . '/delete');
		return $response->decoded_response;
	}
}