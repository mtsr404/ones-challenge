<?php
namespace api;
/**
 * 検索
 *
 */

class Model_Seed extends Model_Base{

	public static function make_user( $num , $type , $sex){

		//テーブルモジュールの読み込み
		\Module::load('table');

		for($i=0 ; $i<$num ; $i++){
			
			//パスワードをハッシュ化してデータをセット
			$userData = \table\Model_Userdata::forge(array(
				'nick_name'  => self::makeRandStr(10),
				'name'       => self::makeRandStr(10),
				'type'       => $type,
				'mail'       => self::makeRandStr(10).'@a.b.c',
				'adress'	 => self::makeRandStr(10),
				'sex'        => $sex,
				'birth'      => '675588365',
				'pass'       => self::pass_to_hash('pass_word')
			));
			
			$userData->validates_or_exception();
			$userData->is_new(true);
			$result = $userData->save(false);

			$id_u = $userData->id_u;


			$userProfile = \table\Model_UserProfile::forge(array(
				'id_u'            => $id_u,
				'year_career'     => rand(1,10),
				'value_position'  => rand(-1000000,1000000) /1000000,
				'value_money'     => rand(-1000000,1000000) /1000000,    
				'skill'           => self::makeRandStr(10)
			));

			$userData->validates_or_exception() ;
			$userProfile->is_new(true) ;
			$userProfile->save(false) ;

			
			//カテゴリの保存
			$c_num = rand(1,4);
			for($i=0 ; $i< $c_num ; $i++ ){
				$htp = \table\Model_UserProfileCategory::forge(array(
					'id_u'   => $id_u, 
					'id_tc'  => rand(1,3)
				));
				$htp->validates_or_exception();
				$htp->is_new(true);
				$htp->save(false);
				unset($htp);
			}

		
			//言語の保存
			$l_num = rand(1,4);
			for($i=0 ; $i< $l_num ; $i++ ){
				$htp = \table\Model_UserProfileLanguage::forge(array(
					'id_u'   => $id_u, 
					'id_tl'  => rand(1,6),
					'rate'   => rand(0,100) / 100
				));
				$htp->validates_or_exception();
				$htp->is_new(true);
				$htp->save(false);
				unset($htp);
			}
			unset($userData);
			unset($userProfile);
			
		}

	}


	protected static function makeRandStr($length) {
	    $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
	    $r_str = null;
	    for ($i = 0; $i < $length; $i++) {
	        $r_str .= $str[rand(0, count($str)-1 )];
	    }
	    return $r_str;
	}


}