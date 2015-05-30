<?php
namespace table;
/**
 *
 *
 *
 *
 */

class Model_UserData extends Model_TableBase
{
	protected static $_table_name = 'user_data';
	protected static $_primary_key = 'id_u';

	protected static $_rules = array(
			'id_u'       => 'valid_string[numeric]',
			'name'       => 'required|max_length[255]',
			'type'       => 'required|match_collection[engineer,designer]',
			'mail'       => 'required|valid_email',
			'adress'	 => 'required',
			'sex'        => 'required|match_collection[M,F]',
			'birth'      => 'required|valid_string[numeric]',
			'pass'       => 'required'
		);

	protected static $_labels = array(
			'id_u'       => 'ユーザーID',
			'name'       => '名前',
			'type'       => 'ユーザータイプ',
			'mail'       => 'メールアドレス',
			'adress'	 => '住所',
			'sex'        => '性別',
			'birth'      => '誕生日',
			'pass'       => 'パスワード'
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



}