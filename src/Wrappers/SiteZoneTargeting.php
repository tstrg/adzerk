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
 * @property string Title
 * @property string Url
 * @property int PublisherAccountId
 */
class SiteZoneTargeting extends Wrapper
{
	protected $idFlight;

	function __construct(RestClient $request, $id, $idFlight)
	{
		parent::__construct($request, $id);
		$this->idFlight = $idFlight;
		$this->method = 'sitezonetargeting';
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
		if (!is_numeric($this->id)) {
			$response = $this->request->get('flight/' . $this->idFlight . '/sitezonetargeting');
		} else {
			$response = $this->request->get('flight/' . $this->idFlight . '/sitezonetargeting/' . $this->id);
		}
		return $response->decoded_response;
	}

	public function delete()
	{
		$response = $this->request->get('flight/' . $this->idFlight . '/sitezonetargeting/' . $this->id . '/delete');
		return $response->decoded_response;
	}
}