<?php
namespace table;
/**
 *
 *
 *
 *
 */

class Model_UserProfileLanguage extends Model_TableBase
{
	protected static $_table_name = 'user_profile_language';

	protected static $_rules = array(
			'id_u'  => 'valid_string[numeric]',
			'id_tl'  => 'valid_string[numeric]',
			'rate'   => 'required'

	
		);

	protected static $_labels = array(
			'id_u'  => 'ユーザーID',
			'id_tl' => 'プログラム言語ID',
			'rate'   => '自己評価'
		);


	//protected static $_properties;
	//protected static $_mass_whitelist;
	//protected static $_mass_blacklists;
	//protected static $_connection;
	//protected static $_write_connection;
	//protected static $_defaults;
	//protected static $_created_at = 'created_at';
	//protected static $_updated_at = 'updated_at';
	protected static $_mysql_timestamp = false; //unixタイムスタンプを使う

}