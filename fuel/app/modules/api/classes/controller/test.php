<?php
namespace api;
/**
 * ベースモデル
 *
 * Class Model_Base
 * 
 * データベース関連の、Validationなどの共通処理を記述する
 * 
 */


class Controller_Test extends \Controller_Rest
{
	public function get_test(){

		$this->response( 'test test test' );
	}

}
