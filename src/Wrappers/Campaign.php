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

	function __construct(Rest $rest)
	{
		parent::__construct($rest, 'campaign');
	}

}