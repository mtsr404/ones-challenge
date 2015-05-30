<?php
namespace api;
/**
 *  設定
 *
 *
 */
class APIConfig{

//24 * 60 * 60
private static $_day = 86400;

//求人の応募があってから対応保留状態になるまでの時間
public static function time_to_new_wait(){
	//3日
	return self::$_day * 3;
}

//面接、試験の予定日を過ぎてから未報告状態になるまでの時間
public static function time_to_schedule_wait(){
	//3日
	return self::$_day * 3;
}
}