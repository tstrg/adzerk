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

use Positivezero\Adzerk\RequestException;
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
 *  	$o = $this->adzerk->creative(null, $idAdvertiser);
 *		$r = $o->get();
 *
 * Get one item:
 *  	$o = $this->adzerk->creative(52885);
 *		$r = $o->get();
 *
 * Update:
 *  	$o = $this->adzerk->creative(52885);
 *      $o->Title = 'Creative 3';
 *      $r = $o->update();
 *
 * Create:
 *      $o = $this->adzerk->creative();
 *      $o->AdvertiserId = 37597;
 *      $o->Url = 'https://www.socifi.com';
 *      $o->Body = 'test body';
 *      $o->Title = 'test creative';
 *      $o->IsActive = true;
 *      $o->AdTypeId = 959;
 *      $o->Alt = 'test alt';
 *      $o->IsHTMLJS = true;
 *      $o->ScriptBody = 'Advertiser 37597';
 *      $r = $o->create();
 *
 * Delete:
 *      $o = $this->adzerk->creative(52878);
 *      $r = $o->delete();
 *
 * @property int Id
 * @property int AdvertiserId
 * @property string Body
 * @property string Url
 * @property string Title
 * @property bool IsSync
 * @property int AdTypeId
 * @property string Alt The text that's displayed when you hover over an ad.
 * @property bool IsActive
 * @property bool IsHTMLJS
 * @property string ScriptBody
 */
class Creative extends Wrapper
{
	protected $idAdvertiser;

	function __construct(RestClient $request, $id, $idAdvertiser)
	{
		parent::__construct($request, $id);
		$this->idAdvertiser = $idAdvertiser;
	}

	/**
	 * call rest type GET to adzerk API
	 * @return mixed
	 * @throws RequestException
	 */
	public function get()
	{
		$query = '';
		if (is_numeric($this->id)) {
			$query = '/' . $this->id;
		}
		try {
			if ($this->idAdvertiser) {
				$response = $this->request->get('advertiser/' . $this->idAdvertiser . '/creatives' . $query);
			} else {
				$response = $this->request->get('/creative' . $query);
			}
			return $response->decoded_response;
		} catch (Rest\RestClientException $e) {
			throw new RequestException($e->getMessage(),null,$e);
		}

	}


}