<?php
namespace table;
/**
 *
 *
 *
 *
 */

class Model_UserProfileDesign extends Model_TableBase
{
	protected static $_table_name = 'user_profile_design';

	protected static $_rules = array(
			'id_u'   => 'valid_string[numeric]',
			'id_td'  => 'valid_string[numeric]'
		);

	protected static $_labels = array(
			'id_u'  => 'ユーザーID',
			'id_td' => 'デザインジャンルID'
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