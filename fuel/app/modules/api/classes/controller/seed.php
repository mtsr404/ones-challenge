<?php
namespace api;
/**
 * API : ユーザー管理
 * 
 *
 *
 */

class Controller_Seed extends Controller_ApiBase
{
	//======================================================================================================
	/**
	 *  API : 
	 *  
	 *
	 */
	public function post_make_user(){

		$rule_params = array(
			'num'      => 'required',
			'type'     => 'required',
			'sex'  => 'required'
			
			);

		$result = 
		self::api_request( \Input::post(),$rule_params, 
			'Model_Seed','make_user','');
		$this->response($result);
	}
}