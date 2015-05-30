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


class Model_Base extends \Model
{
	public static function get_test_result(){
		return 'test sentense';
	}


	/**
	 *
	 * セッションidからユーザーidを取得する
	 * @param string : セッションid
	 *
	 */
	private static function session_to_id($session_id){}


	/**
	 * パスワードをハッシュ化する
	 * 
	 * @param  $pass : パスワード
	 * @return string ハッシュ
	 */
	protected static function pass_to_hash($pass){
		//パスワードのハッシュ化
		$hash_pass = hash('sha256' ,$pass);
		//ソルトアンドペッパー
		return hash('sha256' , "minami".$hash_pass."koma");
	}


	/**
	 * ランダムな文字列を生成する
	 * 
	 * @param  [int] $length  [生成する文字列の長さ]
	 * @return [String]       [生成された文字列]
	 */
	protected static function makeRandStr($length) {
	    $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
	    $r_str = null;
	    for ($i = 0; $i < $length; $i++) {
	        $r_str .= $str[rand(0, count($str)-1 )];
	    }
	    return $r_str;
	}

}