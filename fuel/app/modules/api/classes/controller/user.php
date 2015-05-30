<?php
namespace api;
/**
 * API : ユーザー管理
 * 
 *
 *
 */

class Controller_User extends Controller_ApiBase
{
	//======================================================================================================
	/**
	 *  API : user/register
	 *  ユーザー新規登録
	 *
	 */
	public function post_register(){

		$rule_params = array(
			'name'   => 'required',
			'type'   => array('required', array('enum',array('engineer','designer'))),
			'mail'   => 'required',
			'adress' => 'required',
			'sex'    => array('required', array('enum',array('M','F'))),
			'birth'  => array('required','natural_number'),
			'pass'   => array('required','pass'),
			);

		$result = 
		self::api_request( \Input::post(),$rule_params, 
			'Model_User','register','debug_auth_code');
		$this->response($result);
	}


	//======================================================================================================
	/**
	 *	user/login
	 *	ログイン
	 *
	 */
	public function post_login(){

		$rule_params = array(
			'mail' => 'required',
			'pass' => 'required'
			);

		$result = 
		self::api_request( \Input::post(),$rule_params,
			'Model_User','login','session_id');
		$this->response($result);
	}


	

}


