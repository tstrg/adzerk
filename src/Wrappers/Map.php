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
 * List:
 *  	$o = $this->adzerk->map(null, $idFlight);
 *		$r = $o->get();
 *
 * Get one item:
 *  	$o = $this->adzerk->map($idMap, $idFlight);
 *		$r = $o->get();
 *
 * Update:
 *  	not implemented
 *
 * Create:
 *      $o = $this->adzerk->map(null, $idFlight);
 *      $o->SizeOverride = false;
 *      $o->CampaignId = 55312;
 *      $o->PublisherAccountId = 17576;
 *      $o->IsDeleted = false;
 *      $o->Percentage = 0;
 *      $o->Iframe = false;
 *      $o->Creative = (object) array('Id'=>150909);
 *      $o->DistributionType = 1;
 *      $o->IsActive = true;
 *      $o->FlightId = 101929;
 *      $r = $o->create();
 *
 * Delete:
 *      $o = $this->adzerk->map($idMap, $idFlight);
 *      $r = $o->delete();
 *
 * @property int Id
 * @property int MapId
 * @property bool SizeOverride True or false value used to determine if the size needs to be overridden. Default is false.
 * @property int CampaignId The id found using Campaign Endpoints.
 * @property int PublisherAccountId The id found using Publisher Endpoints.
 * @property bool IsDeleted True or false value that should indicate whether the Creative should be deleted.
 * @property int Percentage The percentage that you want the campaign to run.
 * @property bool Iframe  True or false value that should indicate whether the Creative should use an iframe.
 * @property object Creative { Id:12345 }  Creative Endpoints object - One creative object should be passed in to link the flight to the creative.
 * @property int DistributionType Determine how the creative is distributed. 1 = Auto-Balanced, 2 = Percentage, 3 = Fixed number of Impressions (only works with impression goal flights)
 * @property bool IsActive True or false value that should indicate whether the ad should serve.
 * @property int ZoneId (optional)
 * @property int SiteId (optional)
 * @property int FlightId  The id found using the Flight Endpoints.
 * @property int Impressions The number of impressions that you want this create to run at.
 */
class Map extends Wrapper
{
	protected $idFlight;

	function __construct(RestClient $request, $id, $idFlight)
	{
		parent::__construct($request, $id);
		$this->idFlight = $idFlight;
		$this->method = 'creative';
	}

	/**
	 * call rest type GET to adzerk API
	 * @return mixed
	 */
	public function get()
	{
		if (!is_numeric($this->id)) {
			$response = $this->request->get('flight/' . $this->idFlight . '/creatives');
		} else {
			$response = $this->request->get('flight/' . $this->idFlight . '/creative/' . $this->id);
		}
		return $response->decoded_response;
	}

	/**
	 * @return RestClient
	 */
	public function create()
	{
		$response = $this->request->post('flight/' . $this->idFlight . '/creative', (string)$this);
		return $response->decoded_response;
	}

	public function update()
	{
		throw new NotImplementedException('This method has not been implemented yet.');
	}

	public function delete()
	{
		$response = $this->request->get('flight/' . $this->idFlight . '/creative/' . $this->id . '/delete');
		return $response->decoded_response;
	}

}