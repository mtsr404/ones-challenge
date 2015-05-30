<?php
namespace api;
/**
 *  メールの文章などのリソースを保存する静的クラス
 *
 *
 */
class Resources{

//======================================================================================================
	/**
	 *  ユーザーのメール認証
	 *
	 *
	 */
public static function mail_auth_user($auth_url){

$from_mail = "test@mail.test.test";
$from_name = "ふくいのオシゴト";
$subject = '【ふくいのオシゴト】仮登録受付のお知らせ';

$body =
'ふくいのオシゴトへ仮登録ありがとうございます
お客様のメールアドレスの「仮登録」を受け付けました。
以下のURLから、本登録を終了させてください。

認証アドレス'

 .$auth_url.'

--------------------------------------
ふくいのおしごと
  [url]
  自動送信！
';

return  array('from_mail' => $from_mail,  'from_name' => $from_name , 'subject' => $subject , 'body' => $body);

}




//======================================================================================================
	/**
	 *  企業の登録認証
	 *
	 *
	 */
public static function mail_accept_employer($pass){
$from_mail = "test@mail.test.test";
$from_name = "ふくいのオシゴト";
$subject = '【ふくいのオシゴト】企業審査の認可のお知らせ';

$body =
'企業認可しました

パスワード['.$pass.']

--------------------------------------
ふくいのおしごと
  url
  自動送信！
';

return  array('from_mail' => $from_mail,  'from_name' => $from_name , 'subject' => $subject , 'body' => $body);

}


//======================================================================================================
	/**
	 *  企業の登録認証
	 *
	 *
	 */
public static function mail_refuse_employer(){
$from_mail = "test@mail.test.test";
$from_name = "ふくいのオシゴト";
$subject = '【ふくいのオシゴト】企業審査の落選のお知らせ';

$body =
'企業認可しませんでした

--------------------------------------
ふくいのおしごと
  url
  自動送信！
';

return  array('from_mail' => $from_mail,  'from_name' => $from_name , 'subject' => $subject , 'body' => $body);

}



//======================================================================================================
	/**
	 *  企業の登録認証
	 *
	 *
	 */
public static function mail_accept_offer(){
$from_mail = "test@mail.test.test";
$from_name = "ふくいのオシゴト";
$subject = '【ふくいのオシゴト】求人掲載審査の認可のお知らせ';

$body =
'求人掲載認可しました

--------------------------------------
ふくいのおしごと
  url
  自動送信！
';

return  array('from_mail' => $from_mail,  'from_name' => $from_name , 'subject' => $subject , 'body' => $body);

}



//======================================================================================================
	/**
	 *  企業の登録認証
	 *
	 *
	 */
public static function mail_refuse_offer(){
$from_mail = "test@mail.test.test";
$from_name = "ふくいのオシゴト";
$subject = '【ふくいのオシゴト】求人掲載審査の落選のお知らせ';

$body =
'求人掲載認可しませんでした

--------------------------------------
ふくいのおしごと
  url
  自動送信！
';

return  array('from_mail' => $from_mail,  'from_name' => $from_name , 'subject' => $subject , 'body' => $body);

}


//======================================================================================================











}