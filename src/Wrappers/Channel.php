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
 * @property string Title
 * @property array AdTypes
 * @property string Engine
 * @property float CPM
 */
class Channel extends Wrapper
{

	function __construct(Rest $rest)
	{
		parent::__construct($rest, 'channel');
	}

	public function delete($id)
	{
		return $this->get(array($id, 'delete'));
	}

}