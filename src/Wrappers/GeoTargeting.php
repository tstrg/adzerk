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

use Positivezero\Adzerk\NotImplementedException;
use Positivezero\Adzerk\Wrapper;
use Positivezero\Rest;
use Positivezero\RestClient;

/**
 * Wrapped object for defining and validating required properties, using magic call
 * @see \Positivezero\Adzerk\Wrapper;
 * @author Vojtěch Kijenský <vojtech@positivezero.co.uk>
 *
 * example:
 * Get one item:
 *  	$o = $this->adzerk->siteZoneTargeting( $idSiteZoneTargeting, $idFlight );
 *		$r = $o->get();
 *
 * Delete:
 *      $o = $this->adzerk->siteZoneTargeting( $idSiteZoneTargeting, $idFlight );
 *      $r = $o->delete();
 *
 * @property int Id
 * @property string CountryCode - The 2-3 character string that denotes the country you want to target
 * @property string Region - The 2-3 character string that denotes the region (or state) that you want to target
 * @property int MetroCode The 3 digit number that denotes the metropolitan area you want to target
 * @property boolean IsExclude (optional) - true: exclude location, false/null: include location
 */
class GeoTargeting extends Wrapper
{
	protected $idFlight;

	function __construct(RestClient $request, $id, $idFlight)
	{
		parent::__construct($request, $id);
		$this->idFlight = $idFlight;
		$this->method = 'geotargeting';
	}

	public function create()
	{
		throw new NotImplementedException('Create is not implemented');
	}

	public function update()
	{
		throw new NotImplementedException('Update is not implemented');
	}

	/**
	 * call rest type GET to adzerk API
	 * @return mixed
	 */
	public function get()
	{
		if (is_numeric($this->id)) {
			$response = $this->request->get('flight/' . $this->idFlight . '/' . $this->method . '/' . $this->id);
		} else {
			return false;
		}
		return $response->decoded_response;
	}

	public function delete()
	{
		$response = $this->request->get('flight/' . $this->idFlight . '/' . $this->method . '/' . $this->id . '/delete');
		return $response->decoded_response;
	}
}