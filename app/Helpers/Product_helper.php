<?php

function menufacture_list($sel_id=0) {
	$table = DB()->table('menufacture');
	$sql = $table->get();
	$q = $sql->getResult();
    $output = '';
	foreach ($q as $rows) {
		if ($sel_id == $rows->men_id) { $selected = 'selected="selected"'; }else { $selected = ''; }
		$output .= '<option value="'.$rows->men_id.'" '.$selected.' />'.  $rows->brand_name.'<br />';
	}
	return empty($output) ? "Not Set" : $output;
}


function product_cat_list($sel_id=0) {
    $table = DB()->table('product_cat');
    $sql = $table->get();
    $q = $sql->getResult();
	
	$output = '';
	foreach ($q as $rows) {
		if ($sel_id == $rows->cat_id) { $selected = 'selected="selected"'; }else { $selected = ''; }
		$output .= '<option value="'.$rows->cat_id.'" '.$selected.' />'.  $rows->cat_name.'<br />';
	}
    return empty($output) ? "Not Set" : $output;
}


function colors_list($sel_id=0) {
	$output = '';
	$colors = array(
	 				'1'=>"Red", 
					'2'=>"Green", 
					'3'=>"blue", 
					'4'=>"Yellow", 
					'5'=>"Pink", 
					'6'=>"Gray", 
					'7'=>"White", 
					'8'=>"Orange", 
					'9'=>"Black", 
					'10'=>"light Blue", 
					'11'=>"Asc");
	foreach ($colors as $k=>$v) {
		if ($sel_id == $k) { $selected = 'selected="selected"'; }else { $selected = ''; }
		$output .= '<option value="'.$k.'" '.$selected.' />'.  $v.'<br />';
	}
	print $output;
}


function quality_options($sel_id=0) {
	$output = '';
	$quality = array("1"=>"High", "2"=>"Good", "3"=>"Midium", "4"=>"Normal");
	foreach ($quality as $k=>$v) {
		if ($sel_id == $k) { $selected = 'selected="selected"'; }else { $selected = ''; }
		$output .= '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
	}
	print empty($output) ? "Not Set" : $output;
}

function special_options($sel_id=0) {
	$output = '';
	$special = array("0"=>"False", "1"=>"True");
	foreach ($special as $k=>$v) {
		if ($sel_id == $k) { $selected = 'selected="selected"'; }else { $selected = ''; }
		$output .= '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
	}
	print empty($output) ? "Not Set" : $output;
}


function quality_by_id($sel_id=0) {
	$output = '';
	$quality = array("1"=>"High", "2"=>"Good", "3"=>"Midium", "4"=>"Normal");
	foreach ($quality as $k=>$v) {
		if ($sel_id == $k) {
		$output .= $v;
		}
	}
	print empty($output) ? "Not Set" : $output;
}

function color_by_id($sel_id=0) {
	$output = '';
	$colors = array(
	 				'1'=>"Red", 
					'2'=>"Green", 
					'3'=>"blue", 
					'4'=>"Yellow", 
					'5'=>"Pink", 
					'6'=>"Gray", 
					'7'=>"White", 
					'8'=>"Orange", 
					'9'=>"Black", 
					'10'=>"light Blue", 
					'11'=>"Asc");
	foreach ($colors as $k=>$v) {
		if ($sel_id == $k) {
		$output .= $v;
		}
	}
	print empty($output) ? "Not Set" : $output;
}

function special_by_id($sel_id=0) {
	$output = '';
	$special = array("0"=>"False", "1"=>"True");
	foreach ($special as $k=>$v) {
		if ($sel_id == $k) {
			$output .= $v;
		}
	}
	print empty($output) ? "Not Set" : $output;
}

function get_cat_name_by_id($cat_id) {
	$table = DB()->table('product_cat');
	$data = $table->where('cat_id',$cat_id)->get();
    $query = '';
	$cat_name = @$query->cat_name;
	return $cat_name ? $cat_name : 'Not Set';
}

function get_menufacture_by_id($men_id) {
	$table = DB()->table('menufacture');
	$data = $table->where('men_id',$men_id)->get();
    $query = $data->getRow();

	$name = @$query->brand_name;
	return $name ? $name : 'Not Set';
}

?>