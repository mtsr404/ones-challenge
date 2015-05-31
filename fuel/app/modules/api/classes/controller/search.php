<?php
namespace api;
/**
 * API : 
 * 
 *
 *
 */

class Controller_Search extends Controller_ApiBase
{

	//======================================================================================================
	/**
	 *  API : search/matrix
	 *  
	 *
	 */
	public function post_engineer_matrix(){

		$rule_params = array(
			'value_position' => 'required',
			'value_money'    => 'required',
			'radius'         => 'required',
			'limit'          => 'natural_number',
			'offset'         => 'natural_number'
			);

		$result = 
		self::api_request( \Input::post(),$rule_params, 
			'Model_Search','engineer_matrix','list');
		$this->response($result);
	}


	public function post_designer_matrix(){

		$rule_params = array(
			'value_position' => 'required',
			'value_money'    => 'required',
			'radius'         => 'required',
			'limit'          => 'natural_number',
			'offset'         => 'natural_number'
			);

		$result = 
		self::api_request( \Input::post(),$rule_params, 
			'Model_Search','designer_matrix','list');
		$this->response($result);
	}

}
