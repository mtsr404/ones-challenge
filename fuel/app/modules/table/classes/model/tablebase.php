<?php
namespace table;
/**
 * tableモジュールのmodelの親クラス
 * 
 *
 */

class Model_TableBase extends \Model_Crud{


	protected $ex_error_message = "";
	protected $fExValidated = false ;

	/**
	 * Validationクラスでは出来ない、高度なvalidationを実装する
	 *
	 *
	 */
	public function exValidates(){
		$this->fExValidated = true;

		//$this->ex_error_message = "ex val test";
		return true;
	}

	/**
	 * エラーメッセージを返す
	 *
	 *
	 */
	public function get_error_message(){

		//Validationクラスによるエラーメッセージ取得
		$save_errors = array();
		$errors = $this->validation()->error();
		foreach ($errors as $err) {
			array_push($save_errors, $err->get_message());
		}

		if(!empty($save_errors) ){
			// :label がalphaのようになっている場合を置き換える
			return $this->_replace_error_message($save_errors[0]);
		}
		else if( !empty($this->ex_error_message)){
			return $this->ex_error_message;
		}
		else{ return false ;}
	}

	protected function _replace_error_message($val){
		$val = str_replace("alpha","アルファベット",$val);
		return str_replace("numeric","数値",$val);
		 
	}

	public function validates_or_exception(){
		\Module::load('api');
		if( $this->validates() === false ){
			throw new \api\APIException($this->get_error_message(),2);
		}
	}

}
