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

/**
 * Wrapped object for defining and validating required properties, using magic call
 * @see \Positivezero\Adzerk\Wrapper;
 * @author Vojtěch Kijenský <vojtech@positivezero.co.uk>
 *

 * @property string StartDate
 * @property string EndDate
 * @property int SiteId
 * @property int PublisherAccountId
 */
class Payments extends Wrapper
{

	/**
	 * call rest type GET to adzerk API
	 * @return mixed
	 * @throws RequestException
	 */
	public function get()
	{
		try {
			$response = $this->request->post($this->getRestMethod(), (string)$this);
			return $response->decoded_response;
		} catch (Rest\RestClientException $e) {
			throw new RequestException($e->getMessage(),null,$e);
		}
	}
}