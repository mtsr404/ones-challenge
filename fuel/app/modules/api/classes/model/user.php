<?php
namespace api;
/**
 * ユーザーモデル
 *
 */

class Model_User extends Model_Base{

	//======================================================================================================
	/** 
	 * user/register 
	 * ユーザーの新規登録
	 * 
	 * @param
	 * @return rsp(array)
	 */
	public static function register( $name, $type, $mail, $adress, $sex, $birth, $pass ){
		//テーブルモジュールの読み込み
		\Module::load('table');

		//パスワードをハッシュ化してデータをセット
		$userData = \table\Model_Userdata::forge(array(
			'name'       => $name,
			'type'       => $type,
			'mail'       => $mail,
			'adress'	 => $adress,
			'sex'        => $sex,
			'birth'      => $birth,
			'pass'       => self::pass_to_hash($pass)
		));
	
		//user_dataテーブルへの書き込み----------------------------------------
		//snippet : Model_TableBase------------------------------------------------
		$userData->validates_or_exception();

		//メールアドレスが既に登録されているかチェック
		$row = \table\Model_Userdata::find_by_mail($mail);
		if($row !== null)
		 {	throw new APIException("メールアドレスが既に登録されています" , 102) ;} //メールアドレスが既に登録されています

		//ユーザーデータの書き込み
		$userData->is_new(true);
		$result = $userData->save(false);
	}

	

	//======================================================================================================
	/** 
	 * user/login
	 * ログインする
	 * @param  $mail       : メールアドレス
	 * @param  $pass       : パスワード
	 * @return $session_id : セッションidを返す
	 */
	public static function login( $mail , $pass){
		//テーブルモジュールの読み込み
		\Module::load('table');

		//メールアドレスとパスからユーザーが存在するかチェックする-----------------------------
		$rowUser = \table\Model_UserData::find_by(array(
				'mail' => $mail,
				'pass' => self::pass_to_hash($pass)
			));

		//セッションidを書き込みか更新する--------------------------------------------
		if($rowUser === null){
			//ユーザーが存在しなかった時
			throw new APIException("" ,201); //メールアドレスまたはパスワードが間違っています。
		}
		else{
			$session_id = self::update_session($rowUser[0]['id_u']  );
			if( $session_id === false ){
				throw new APIException("セッションidの書き込みに失敗しました" ,200); //ログインに失敗しました
			}
		}
		return $session_id;
	}

	//======================================================================================================
	//======================================================================================================
	//======================================================================================================




	//-------------------------------------------------------------------------------------------
	/**
	 * ユーザーidに対して、セッションidがすでに存在する場合は更新、
	 * 存在しない場合は新しくセッションidを登録する
	 *
	 * @param $id_u : ユーザーid
	 * @return string/Boolean 成功した場合セッションid、失敗した場合false
	 */
	protected static function update_session($id_u ){
		if( empty($id_u) ) {  
			throw new APIException("セッションidの書き込みに失敗しました、ユーザーidが指定されていません",1);
		}
		//ユーザーが存在した時、新しくセッションidを作りセッションを上書きして返す
		\Module::load('table');

		$rowSes = \table\Model_UserSession::find_one_by(array(
				'id_u' => $id_u ));

		//新しいセッションIDを生成する
		$id_session =  \table\Model_UserSession::make_session_id();

		if($rowSes === null){	$created_at = \Date::forge()->get_timestamp();	}
		else				{	$created_at = $rowSes['created_at'];	}


		$session = \table\Model_UserSession::forge(array(
				'id_session' => $id_session,
				'id_u'       => $id_u,
				'created_at' => $created_at
			));

		//snippet : Model_TableBase------------------------------------------------
		$session->validates_or_exception();
		//既存の登録がある場合まず削除
		if($rowSes !== null){	
			$rowSes->delete(); 
		}
		//セッションidを登録
		$session->is_new(true);
		$result = $session->save(false);
		


		return $id_session;
	}


	/**
	 * メールの認証コードを作成する
	 * 
	 * @param  $id_u : ユーザーid
	 * @return string 認証コード
	 */
	protected static function make_auth_code($id_u){
		return hash( 'sha256', \Date::forge()->get_timestamp().'asdokrjneo'.$id_u  );
	}


	//-------------------------------------------------------------------------------------------
	/**
	 *  セッションIDからユーザーIDを取得する
	 *
	 */
	protected static function get_id_u($session_id){
		//テーブルモジュールの読み込み
		\Module::load('table');

		$session = \table\Model_UserSession::find_by_pk($session_id);
		if($session === null){
			throw new APIException("セッションIDが不正です。" , 3 );
		}
		return $session['id_u'];
	}



}