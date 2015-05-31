<?php
namespace api;
/**
 * 検索
 *
 */

class Model_Search extends Model_Base{


	public static function engineer_matrix( $value_position , $value_money , $radius , $offset, $limit){

		$value_position = floatval($value_position );
		$value_money    = floatval($value_money);
		$radius         = floatval($radius);
		$radius         = $radius*$radius;

		//テーブルモジュールの読み込み
		\Module::load('table');

		$query = \DB::select(
			'ud.id_u', 
			'up.year_career', 
			'up.value_money', 
			'up.value_position', 
			'up.skill',
			'ud.nick_name', 
			'ud.type')
		->from(array('user_profile' , 'up'))
		->join(array('user_data' , 'ud'))
		->on  ('ud.id_u', '=' ,'up.id_u')
		->where('ud.type','=','engineer')
		->and_where(\DB::expr("(value_money - {$value_money})*(value_money - {$value_money})
    		+ (value_position - {$value_position})*(value_position - {$value_position})
   			 < {$radius}"));

		if(!empty($limit)){
			$query->limit($limit);
			if(!empty($offset)){
				$query->offset($offset);
			}
		}
		$rows = $query->execute()->as_array();



		foreach ($rows as &$row) {
			$row['languages'] =
			\DB::select()->from('user_profile_language')
			->where('id_u','=',$row['id_u'])
			->order_by('rate','DESC')
			->limit(3)
			->execute()->as_array();
		}


		return $rows;
	}

	//======================================================================================================
	public static function designer_matrix( $value_position , $value_money , $radius , $offset, $limit){

		$value_position = floatval($value_position );
		$value_money    = floatval($value_money);
		$radius         = floatval($radius);
		$radius         = $radius*$radius;

		//テーブルモジュールの読み込み
		\Module::load('table');

		$query = \DB::select(
			'ud.id_u', 
			'up.year_career', 
			'up.value_money', 
			'up.value_position', 
			'up.skill',
			'ud.nick_name', 
			'ud.type')
		->from(array('user_profile' , 'up'))
		->join(array('user_data' , 'ud'))
		->on  ('ud.id_u', '=' ,'up.id_u')
		->where('ud.type','=','designer')
		->and_where(\DB::expr("(value_money - {$value_money})*(value_money - {$value_money})
    		+ (value_position - {$value_position})*(value_position - {$value_position})
   			 < {$radius}"));

		if(!empty($limit)){
			$query->limit($limit);
			if(!empty($offset)){
				$query->offset($offset);
			}
		}
		$rows = $query->execute()->as_array();



		foreach ($rows as &$row) {
			$row['design'] =
			\DB::select()->from('user_profile_design')
			->where('id_u','=',$row['id_u'])
			->order_by('rate','DESC')
			->limit(3)
			->execute()->as_array();
		}


		return $rows;
	}


}