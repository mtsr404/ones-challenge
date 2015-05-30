<?php
namespace api;
/**
 * API controller の親クラス
 * 
 *
 *
 */

class Controller_ApiBase extends \Controller_Rest
{


	public static function api_request($input_params, $rule_params , $class_name, $method_name , $result_name){
		$rsp = array('is_error' => false);

		//コールバックに渡す引数の配列
		$args = array();
		try{
			//ルールの検証と引数の順序を整形
			foreach($rule_params as $name => $rule){
				//バリデーション
				self::validates_param(@$input_params[$name],$name,$rule);
				//jsonの場合デコードする
				if((is_array($rule) && in_array('json',$rule,true)) || $rule === 'json' ){
					//空の場合は空の配列
					$args[] = json_decode( empty($input_params[$name]) ? "[]" : $input_params[$name] , true);
				}
				else{
					$args[] = @$input_params[$name];
				}
			}

		}	
		catch(APIException $e){
			$p = self::make_error_response($e);
			return self::fix_response($p);
		}


		try{
			\DB::start_transaction();
			$result = call_user_func_array( array(__NAMESPACE__.'\\'.$class_name, $method_name) , $args);
			\DB::commit_transaction();
			//返り値の指定がある場合セット
			//PRODUCTION環境でdebug_プレフィックスが付いているメパラメータの場合セットしない
			if(!empty($result_name) && !(substr($result_name,0,6) == 'debug_' && \Fuel::$env == \Fuel::PRODUCTION)){
				$rsp[$result_name] = $result;
			}
		}
		catch(\Exception $e){
			\DB::rollback_transaction();
			$rsp = self::make_error_response($e);
		}

		return self::fix_response($rsp);
	}

	//======================================================================================================
	/**
	 * 
	 */
	protected static function validates_param($param, $name , $rules){
		//ルールが複数の場合
		if(is_array($rules) && $rules[0] != 'enum'){
			foreach($rules as $rule){
				self::_validates($param,$name,$rule);
			}
		}
		//ルールがひとつの場合
		else{
			self::_validates($param,$name,$rules);
		}
	}

	//======================================================================================================
	/**
	 *  一つのルールについてのバリデーション
	 * 
	 */
	protected static function _validates($param, $name , $rule){
		//ルールが設定されていない場合
		if(empty($rule)){
			return;
		}
		//------------------------------------------------------------------------------------------

		//必須な場合
		if($rule == 'required' ){
			//設定されていない
			if(empty($param)){
				throw new APIException('パラメータ: '.$name.' は必須です',2);
			}
			return;
		}
		//必須でなく、パラメータが設定されている時のみ他のバリデーションに進む
		else{
			if(empty($param)){
				return;
			}
		}

		//------------------------------------------------------------------------------------------
		//json
		if($rule == 'json'){
			if(json_decode($param,true) === null){
				throw new APIException('パラメータ: '.$name.' はjsonでなければなりません 入力された値['.$param.']',2);
			}
			return;
		}

		//------------------------------------------------------------------------------------------
		//自然数
		if($rule == 'natural_number'){
			if(!ctype_digit(strval($param))){
				throw new APIException('パラメータ: '.$name.' は正の整数でなければなりません 入力された値['.$param.']',2);
			}
			return;
		}
		//ソート条件
		if($rule == 'asc_desc'){
			if(!($param == 'asc' || $param == 'desc')){
				throw new APIException('パラメータ: '.$name.' はascかdescでなければなりません 入力された値['.$param.']',2);
			}
			return;
		}
		if($rule == 'pass'){
			if(!preg_match("/^[0-9A-Za-z!@#$%_\-]{6,12}$/" , $param)){
				throw new APIException( "パスワードは英数字と記号(@ # $ % _ -)を使って、6文字以上12文字以下で入力してください" , 2 );
			}
			return;
		}

		//------------------------------------------------------------------------------------------
		//引数をとるバリデーション
		if(is_array($rule)){
			//------------------------------------------------------------------------------------------
			//特定の値のいずれかをとる場合
			if($rule[0] == 'enum'){
				if(!is_array($rule[1])){
					throw new APIException('バリデーションのルール設定が不正です enumを指定した時は配列を渡さなければなりません',0);
				}
				if(!in_array($param , $rule[1])){
					$list = '';
					//ルールを文字列に変える
					foreach($rule[1] as $r){
						$list .= $r . ', ';
					}
					throw new APIException('パラメータ: '.$name.' は以下のいずれかでなければなりません ['.$list.'] 入力された値['.$param.']',2);
				}
				return;
			}
			//------------------------------------------------------------------------------------------
		}
		//------------------------------------------------------------------------------------------
		throw new APIException('バリデーションのルール設定が不正です name['.$name.'] rule['.$rule.'] param['.$param.']',0);
	}









	

	//======================================================================================================

	//パラメータが存在しているかのチェック
	public static function exsit_required_params($params , $input){
		foreach ($params as $param) {
			if(empty( $input[$param])){
				$rsp = array();
				$rsp['is_error'] = true;
				$rsp['error_code'] = 1;
				$rsp['error_title'] = 'エラー';
				$rsp['error_message'] = Model_Error::get_error_message(1);
				$rsp['error_message_for_debug'] = '必須パラメーター : '.$param .' が存在しません';
				return $rsp;
			}
		}
		return true;
	}

	/**
	 * パラメータが存在しているかのチェック 
	 * 
	 * @param  $para  
	 * @param  $input 
	 * @return [type]
	 */
	public static function exsit_required_post_params($params , $input){
		foreach ($params as $param) {
			if(empty( $input[$param])){
				$rsp = array();
				$rsp['is_error'] = true;
				$rsp['error_code'] = 1;
				$rsp['error_title'] = 'エラー';
				$rsp['error_message'] = Model_Error::get_error_message(1);
				$rsp['error_message_for_debug'] = '必須パラメーター : '.$param .' が存在しません';
				return $rsp;
			}
		}
		return true;
	}

	public static function exsit_required_get_params($params , $input){
		foreach ($params as $param) {
			if(empty($input[$param])){
				$rsp = array();
				$rsp['is_error'] = true;
				$rsp['error_code'] = 1;
				$rsp['error_title'] = 'エラー';
				$rsp['error_message'] = Model_Error::get_error_message(1);
				$rsp['error_message_for_debug'] = '必須パラメーター : '.$param .' が存在しません';
				return $rsp;
			}
		}
		return true;
	}

	/**
	 * キャッチした例外からエラーレスポンスを作る
	 *
	 */
	public static function make_error_response($e){ 
		$rsp['is_error'] = true;
		$rsp['error_title'] = "エラー";
		try{
			throw $e;
		}
		//想定内のエラー
		catch(APIException $ae){
			$rsp['error_code'] = $e->getCode();
			$rsp['error_message'] = Model_Error::get_error_message($e->getCode());
			$rsp['error_message_for_debug'] = $e->getMessage();
			
		}
		//データベースエラー
		catch(\Database_Exception $e){
			$rsp['error_code'] = 4;
			$rsp['error_message'] = Model_Error::get_error_message(4);
			$rsp['error_message_for_debug'] = $e->getMessage();
			$rsp['error_stack_trace'] = $e->getTraceAsString();
		}
		//想定外のエラー
		catch(\Exception $ex){
			$rsp['error_code'] = 0;
			$rsp['error_message'] = Model_Error::get_error_message(0);
			$rsp['error_message_for_debug'] = '想定外のエラーが発生しました'. $e->getMessage();
		}
		$rsp['error_point_for_debug'] = "Exception from " . $e->getFile() ." :".$e->getLine();
		$rsp['error_stack_trace'] = $e->getTraceAsString();
		return $rsp;


	}


	//本番サーバーではデバッグメッセージを出力しないようにする
	public static function fix_response($rsp){
		if(\Fuel::$env === \Fuel::PRODUCTION){
			unset($rsp['error_message_for_debug'] );
			unset($rsp['error_point_for_debug'] );
			unset($rsp['error_stack_trace'] );
		}
		return $rsp;
	}


}

