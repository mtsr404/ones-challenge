<?php
namespace api;
/**
 * 検索
 *
 */

class Model_Basic extends Model_Base{

	public static function all(){
		
		$pgl = \DB::select()->from('type_language')->execute();
		$tc  = \DB::select()->from('type_category')->execute();
		$td  = \DB::select()->from('type_design')->execute();

		return array( 'languages' => $pgl , 'category' => $tc , 'design' => $td );

	}



}