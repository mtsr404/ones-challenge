<?php
namespace api;
/**
 * API : ユーザー管理
 * 
 *
 *
 */

class Controller_Profile extends Controller_ApiBase
{
	//======================================================================================================
	/**
	 *  API : profile/update
	 *  ユーザー新規登録
	 *
	 */
	public function post_update(){

		$rule_params = array(
			'session_id'      => 'required',
			'year_carrer'     => 'required',
			'value_position'  => 'required',
			'value_money'     => 'required',
			'skill'           => 'required',
			'like_categories' => 'json',
			'use_languages'   => 'json'
			);

		$result = 
		self::api_request( \Input::post(),$rule_params, 
			'Model_Profile','update','');
		$this->response($result);
	}


}