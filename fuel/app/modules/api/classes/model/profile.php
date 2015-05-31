<?php
namespace api;
/**
 * プロフィール管理
 *
 */

class Model_Profile extends Model_Base{


	public static function update($session_id,$year_career,$value_position,$value_money,$skill,
		array $like_categories , array $use_languages , array $use_design){

		//テーブルモジュールの読み込み
		\Module::load('table');

		//セッションIDからユーザーIDを取得
		$session = self::get_session($session_id);

		$userProfile = \table\Model_UserProfile::forge(array(
			'id_u'            => $session->id_u,
			'year_career'     => $year_career,
			'value_position'  => $value_position,
			'value_money'     => $value_money,
			'skill' => $skill
			));

		//データベースへの書き込み開始
		//snippet : Model_TableBase------------------------------------------------
		$userProfile->validates_or_exception() ;

		//既にユーザーidでプロフィール登録がある場合、アップデート
		$up = \table\Model_UserProfile::find_one_by_id_u($session->id_u);
		$userProfile->is_new(true) ;
		if($up !== null){  
			$userProfile->is_new(false) ; 	
		}
		$result = $userProfile->save(false);

	

		//前回の登録情報の削除
		//-----------------------------------------------------------------------------
		\DB::delete('user_profile_category')->where('id_u' , '=' , $session->id_u)->execute();
		

		//カテゴリの保存
		foreach( $like_categories as $value ){
			$htp = \table\Model_UserProfileCategory::forge(array(
				'id_u'   => $session->id_u, 
				'id_tc'  => $value
			));
			$htp->validates_or_exception();
			$htp->is_new(true);
			$htp->save(false);
			
		}

		//-----------------------------------------------------------------------------
		\DB::delete('user_profile_language')->where('id_u' , '=' , $session->id_u)->execute();
		

		//言語の保存
		foreach( $use_languages as $value ){
			$htp = \table\Model_UserProfileLanguage::forge(array(
				'id_u'   => $session->id_u, 
				'id_tl'  => $value[0],
				'rate'   => $value[1]
			));
			$htp->validates_or_exception();
			$htp->is_new(true);
			$htp->save(false);
			
		}

		//-----------------------------------------------------------------------------
		\DB::delete('user_profile_design')->where('id_u' , '=' , $session->id_u)->execute();
		

		//デザインジャンルの保存
		foreach( $use_languages as $value ){
			$htp = \table\Model_UserProfileDesign::forge(array(
				'id_u'   => $session->id_u, 
				'id_td'  => $value[0],
				'rate'   => $value[1]
			));
			$htp->validates_or_exception();
			$htp->is_new(true);
			$htp->save(false);
			
		}


	}





	//======================================================================================================
	//======================================================================================================
	//======================================================================================================

	/**
	 *  セッション情報を取得する
	 *
	 *
	 */
	protected static function get_session($session_id){
		//テーブルモジュールの読み込み
		\Module::load('table');

		$session = \table\Model_UserSession::find_by_pk($session_id);
		if($session === null){
			throw new APIException("セッションIDが不正です。" , 3 );
		}
		return $session;
	}


}