<?php
namespace table;
/**
 * テーブル管理クラス
 * table : session
 *
 *
 */

class Model_UserSession extends Model_TableBase
{
	protected static $_table_name = 'user_session';
	protected static $_primary_key = 'id_session';
	protected static $_rules = array(
			'id_session' => 'required|max_length[64]',
			'id_u'       => 'required|valid_string[numeric]',
		);
	protected static $_labels = array(
			'id_session' => 'セッションID',
			'id_u'       => 'ユーザーID'
		);
	//protected static $_properties;
	//protected static $_mass_whitelist;
	//protected static $_mass_blacklists;
	//protected static $_connection;
	//protected static $_write_connection;
	//protected static $_defaults;
	protected static $_created_at = 'created_at';
	protected static $_updated_at = 'updated_at';
	protected static $_mysql_timestamp = false; //unixタイムスタンプを使う

	/**
	 *
	 *id_sessionが設定されていない場合設定する
	 */
	public  function set_session_id(){
		if( empty( $this->_data['id_session']) ){

			$sid = self::make_session_id();
			$this->set(array('id_session' => $sid ));
			return $sid;
		}
		else{
			return false;
		}
	}
	public static function make_session_id(){
		return \Str::random('sha2', 64);
	}


}