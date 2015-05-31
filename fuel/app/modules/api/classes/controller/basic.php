<?php
namespace api;
/**
 * API : 
 * 
 *
 *
 */

class Controller_Basic extends Controller_ApiBase
{

	//======================================================================================================
	/**
	 *  API : basic/all
	 *  
	 *
	 */
	public function get_all(){

		$rule_params = array(
			);

		$result = 
		self::api_request( \Input::post(),$rule_params, 
			'Model_Basic','all','list');
		$this->response($result);

	}


	
}