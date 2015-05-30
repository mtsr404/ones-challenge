<?php
namespace table;
/**
 *
 *
 *
 *
 */

class Model_UserProfile extends Model_TableBase
{
	protected static $_table_name = 'user_profile';
	protected static $_primary_key = 'id_u';

	protected static $_rules = array(
			'id_u'           => 'valid_string[numeric]',
			'year_career'    => 'required',
			'value_position' => 'required',
			'value_money'    => 'required'

	
		);

	protected static $_labels = array(
			'id_u'           => 'ユーザーID',
			'year_career'    => '経験年数',
			'value_position' => 'フロントよりかバックよりか',
			'value_money'    => 'お金がほしいかそうでもないか',
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