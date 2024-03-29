<?php
function DB(){
    $db = \Config\Database::connect();
    return $db;
}

function new_session(){
    $session = \Config\Services::session();
    return $session;
}


function total_members()
{

    $table = DB()->table('users');
    $query = $table->where('type', '4')->get();
    return $query->getNumRows();
}

function total_agents()
{
    $table = DB()->table('users');
    $query = $table->where('type', '2')->get();
    return $query->getNumRows();
}


function total_stockis()
{

    $table = DB()->table('users');
    $query = $table->where('type', '3')->get();

    return $query->getNumRows();
}

function total_pages()
{
    $table = DB()->table('pages');
    $query = $table->get();
    return $query->getNumRows();
}

function total_users()
{
    $table = DB()->table('users');
    $query = $table->where('type', '1')->get();

    return $query->getNumRows();
}

function merried_status($ms_id)
{
    if ($ms_id == 1) {
        return 'Single';
    }
    if ($ms_id == 2) {
        return 'Merried';
    } else {
        return 'Not Seleted';
    }
}


function sex_status($sex_id)
{
    if ($sex_id == 1) {
        return 'Male';
    }
    if ($sex_id == 2) {
        return 'Female';
    } else {
        return 'Not Seleted';
    }
}


function get_globle($rel_id, $title)
{
    $table = DB()->table('global_settings');
    $religion = $table->where('title',$title)->get();
    $name_array = $religion->getRow()->value;
    $name_json = json_decode($name_array);
    empty($name_json->$rel_id) ? $name = "Not Selected" : $name = $name_json->$rel_id;
    return $name;
}


function get_bank_name_by_id($bank_id)
{
    $table = DB()->table('bank');
    $bank = $table->where('bnk_id',$bank_id)->get()->getRow();
    $bank_array = $bank;
    $bank_name = empty($bank_array->b_name) ? "Please Select" : $bank_array->b_name;

    return $bank_name;
}

// function get_religion_by_id($religion_id ) {
// 	$ci =& get_instance();
// 	$ci->load->database();
// 	$query = $ci->db->query("SELECT `value` FROM `global_settings` WHERE `title` = 'religion' AND `value` = `".$religion_id."`");
// 	$religion_array = $religion->row();
// 	$religion_name = empty($religion_array->b_name) ? "Please Select" : $religion_array->b_name;

// 	return $religion_name;
// }

function group_name_by_id($id)
{
    $ci =& get_instance();
    $ci->load->database();
    $group = $ci->db->query("SELECT `group_name` FROM `class_group` WHERE `grp_id` = '$id'");
    $group_array = $group->row();
    $group_name = $group_array->group_name;
    return $group_name;
}

function class_name_by_id($id)
{
    $ci =& get_instance();
    $ci->load->database();
    $class = $ci->db->query("SELECT `class_name` FROM `classes` WHERE `class_id` = '$id'");
    $class_array = $class->row();
    $class_name = $class_array->class_name;
    return $class_name;
}


function get_year_list($from, $to, $sel = 0)
{
    for ($i = $from; $i <= $to; $i++) {
        if ($i == $sel) {
            $selected = 'selected="selected"';
        } else {
            $selected = '';
        }
        $option .= '<option ' . $selected . '>' . $i . '</option>';
    }
    return $option;
}


function roll_list_using_exam_id($exm_id, $sel = 0)
{
    $roll_list_class = DB()->query("SELECT `roll_no` FROM `exam`, `students` WHERE `exam`.`class_id` = `students`.`class_id` AND `exam`.`grp_id` = `students`.`group_id`  AND `exam`.`exm_id` = '$exm_id'");
    $option = '';
//	while($row = mysql_fetch_array($roll_list_class)) {
//		if ($row['roll_no'] == $sel) { $selected = 'selected="selected"'; }else { $selected = ''; }
//		$option .= '<option '.$selected.'>'.$row['roll_no'].'</option>';
//	}
    return $option;
}


function subject_name_by_id($sub_id)
{
    $ci =& get_instance();
    $ci->load->database();

    $sql = "SELECT `sub_name` FROM `subject` WHERE `sub_id` = '$sub_id'";
    $q = $ci->db->query($sql);
    $row = $q->row();
    $subject_name = $row->sub_name;
    return $subject_name;
}


function in_array_r($needle, $haystack, $strict = false)
{
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}

function get_agentname_as_list()
{
    $ci =& get_instance();
    $ci->load->database();

    $sql = "SELECT * FROM `users`,`user_roles` WHERE `users`.`ID`=`user_roles`.`userID` AND `user_roles`.`roleID` = '4'";
    $q = $ci->db->query($sql);
    foreach ($q->result() as $row) {
        $username_list .= '<option value="' . $row->username . '">';
    }
    return $username_list;
}


function get_username_as_list()
{
    $table = DB()->table('users');
    $query = $table->get();

    $username_list = '';
    foreach ($query->getResult() as $row) {

        $username_list .= '<option value="' . $row->username . '">';
    }
    return $username_list;
}


function get_ID_by_username($username)
{
    $table = DB()->table('users');
    $query = $table->where('username', $username)->get();

    $rows = $query->getRow();
    if (!empty($rows->ID)) {
        $id = $rows->ID;
    } else {
        $id = '0';
    }
    return $id;
}

function get_id_by_data($needcol,$table,$whereID,$thisId){
    $table = DB()->table($table);
    $query = $table->select($needcol)->where($whereID,$thisId)->get();
    $result = $query->getRow();
    if (!empty($result)){
        return $result->$needcol;
    }else{
        return false;
    }
}


function user_type_list()
{

    $ci =& get_instance();
    $ci->load->database();
    $username_list = '';
    $sql = "SELECT * FROM `roles` ORDER BY  `ID` ASC LIMIT 3, 3";
    $q = $ci->db->query($sql);
    foreach ($q->result() as $row) {
        $username_list .= '<option value="' . $row->ID . '">' . $row->roleName . '</option>';
    }
    return $username_list;
}


function get_list_global_settings($title, $sel = 0)
{
    $table = DB()->table('global_settings');
    $sql = $table->where('title', $title)->get();
    $output = '';
    $row = $sql->getRow();
    $all_value = json_decode($row->value);
    foreach ($all_value as $key => $value) {
        ($key == $sel) ? $selected = 'selected="selected"' : $selected = '';
        $output .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
    }
    return $output;
}

function get_global_settings_value($title){

    $table = DB()->table('global_settings');
    $religion = $table->where('title',$title)->get();
    $name_row = $religion->getRow()->value;
    return $name_row;
}


function get_location($per_id, $sel = 0)
{
    $table = DB()->table('location');
    $query = $table->where('per_id', $per_id)->get();
    $output = '';
    foreach ($query->getResult() as $row) {
        ($row->lo_id == $sel) ? $selected = 'selected="selected"' : $selected = '';
        $output .= '<option value="' . $row->lo_id . '" ' . $selected . '>' . $row->name . '</option>';
    }
    return $output;
}

function get_division($sel)
{
    $table = DB()->table('location');
    $query = $table->where('per_id', 0)->get();
    $output = '<option value="0">Choose Division...</option>';
    foreach ($query->getResult() as $row) {
        ($row->lo_id == $sel) ? $selected = 'selected="selected"' : $selected = '';
        $output .= '<option value="' . $row->lo_id . '" ' . $selected . '>' . $row->name . '</option>';
    }
    return $output;
}

function get_district($districtId, $division)
{
    $table = DB()->table('location');
    $query = $table->where('per_id', $division)->get();
    $output = '<option value="0">Select District...</option>';
    foreach ($query->getResult() as $row) {
        ($row->lo_id == $districtId) ? $selec = 'selected="selected"' : $selec = '';
        $output .= '<option value="' . $row->lo_id . '" ' . $selec . '>' . $row->name . '</option>';
    }
    return $output;
}

function get_upozila($select, $district)
{
    $table = DB()->table('location');
    $query = $table->where('per_id', $district)->get();
    $output = '<option value="0">Select Thana/Upazila...</option>';
    foreach ($query->getResult() as $row) {
        ($row->lo_id == $select) ? $selected = 'selected="selected"' : $selected = '';
        $output .= '<option value="' . $row->lo_id . '" ' . $selected . '>' . $row->name . '</option>';
    }
    return $output;
}

function get_union($select, $upozila)
{
    $table = DB()->table('location');
    $query = $table->where('per_id', $upozila)->get();
    $output = '<option value="0">Select Union/Ward...</option>';
    foreach ($query->getResult() as $row) {
        ($row->lo_id == $select) ? $selected = 'selected="selected"' : $selected = '';
        $output .= '<option value="' . $row->lo_id . '" ' . $selected . '>' . $row->name . '</option>';
    }
    return $output;
}


function get_location_type($type)
{
    $ci =& get_instance();
    $ci->load->database();
    $output = '';
    $query = $ci->db->query("SELECT `lo_id`,`name` FROM `location` WHERE `type` = '$type'");
    foreach ($query->result() as $row) {
        $output .= '<option value="' . $row->lo_id . '">' . $row->name . '</option>';
    }
    return $output;
}

function get_location_Id($id)
{
    $table = DB()->table('location');
    $query = $table->where('lo_id',$id)->get()->getRow();

    $location_name = $query;

    $location = empty($location_name->name) ? "Please Select" : $location_name->name;

    return $location;
}

function bank_list($sel)
{
    $table = DB()->table('bank');
    $query = $table->get();
    $output = '';

    foreach ($query->getResult() as $row) {
        if ($row->bnk_id == $sel) {
            $s = 'selected="selected"';
        } else {
            $s = '';
        }
        $output .= '<option value="'.$row->bnk_id .'" '. $s .' >' .$row->b_name .'</option>';
    }
    return $output;
}

function get_userid_by_username($username)
{
    $table = DB()->table('users');
    $query = $table->where('username',$username)->countAllResults();
    $sql = $table->where('username',$username)->get();
    if ($query > 0) {
        $ID = $sql->getRow()->ID;
    } else {
        $ID = 0;
    }
    return $ID;
}

function get_balance_by_id($user_id)
{
    $table = DB()->table('users');
    $query = $table->where('ID', $user_id)->get();

    $result = $query->getNumRows();

    if ($result > 0) {
        return $query->getRow()->balance;
    } else {
        return false;
    }
}

// Balance Update
function update_balance($user_name, $balance)
{
    $ci =& get_instance();
    $ci->load->database();

    $userId = get_userid_by_username($user_name);
    $userBalance = get_balance_by_id($userId);

    $totalBalance = $userBalance + $balance;

    //update
    $ci->db->trans_start();
    $ci->db->query("UPDATE `users` SET `balance`= '$totalBalance' WHERE `ID` ='$userId'");
    $query = $ci->db->trans_complete();

    if ($query == 1) {
        return $ci->session->set_flashdata('message', "<div class='alert alert-success' role='alert'>Balance Update Success</div>");
    } else {
        return $ci->session->set_flashdata('message', "<div class='alert alert-danger' role='alert'>Sorry! Balance Update Unsuccess</div>");
    }

}

function get_commission_by_id($user_id)
{
    $table = DB()->table('users');
    $sql = $table->where('ID',$user_id)->get();

    $query = $sql->getRow();
    $commission = empty($query->commission) ? "0" : $query->commission;
    return $commission;
}

function get_point_by_id($user_id)
{
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT `point` FROM `users` WHERE `ID` = '$user_id'");
    $point = $query->row()->point;
    return $point;
}

function get_pr_point_by_id($user_id)
{
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT `pr_point` FROM `users` WHERE `ID` = '$user_id'");
    @$pr_point = $query->row()->pr_point;
    $pr_point = empty($pr_point) ? 0 : $pr_point;
    return $pr_point;
}

function get_quantity_by_id($pro_id)
{
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT `quantity` FROM `products` WHERE `pro_id` = '$pro_id'");
    $quantity = $query->row()->quantity;
    return $quantity;
}

function get_field_by_id($col, $pro_id)
{
    $table = DB()->table('products');
    $query = $table->select($col)->where('pro_id',$pro_id)->get()->getRow()->$col;
    $output = $query;
    return $output;
}

function get_field_by_id_from_table($table, $col, $col_id, $src_id)
{
    $table2 = DB()->table($table);
    $sql = $table2->where($col_id,$src_id)->get();
    $query = $sql->getRow();

    $tableRow = DB()->table($table);
    $numRow = $tableRow->where($col_id,$src_id)->countAllResults();

    if ($numRow == 1) {
        $output = $query->$col;
    } else {
        $output = 0;
    }
    return $output;
}

function check_username($username)
{
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT `username` FROM `users` WHERE `username` = '$username'");
    $rows = $query->num_rows();
    return ($rows > 0) ? TRUE : FALSE;
}

function get_username_by_id($id)
{
    $table = DB()->table('users');
    $sql = $table->where('ID', $id)->get();
    $query = $sql->getRow();

    $data = empty($query->username) ? 'No Data' : $query->username;
    return $data;
}

function get_email_by_id($id)
{
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT `email` FROM `users` WHERE `ID` = '$id'")->row();
    //var_dump($query);
    return $query->email;
}

function get_total_price_of_a_sale($sale_id)
{
    $sales = DB()->table('sales');
    $sales->where('sale_id',$sale_id)->get()->getRow();

    $query = $sales->where('sale_id',$sale_id)->get()->getRow();;
    $product_info = json_decode($query->pro_info);
    $keys = array_keys((array)$product_info);
    $price = 0;
    foreach ($keys as $k => $v) {
        $unit_price = get_price_by_id($v) * $product_info->$v;
        $price = $price + $unit_price;
    }
    return $price;
}

function get_price_by_id($pro_id)
{
    $products = DB()->table('products');
    $query = $products->where('pro_id',$pro_id)->get()->getRow();
    $price = $query->price;
    return $price;
}


function get_total_point_of_a_sale($sale_id)
{
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT `pro_info` FROM `sales` WHERE `sale_id` = '$sale_id'")->row();
    $product_info = json_decode($query->pro_info);
    $keys = array_keys((array)$product_info);
    $point = 0;
    foreach ($keys as $k => $v) {
        $unit_point = get_point_of_a_product($v) * $product_info->$v;
        $point = $point + $unit_point;
    }
    return $point;
}

function get_point_of_a_product($pro_id)
{
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT `Point` FROM `products` WHERE `pro_id` = '$pro_id'")->row();
    $point = $query->point;
    return $point;
}


function get_side_point_by_id($side, $id)
{
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT `$side` FROM `tree` WHERE `u_id` = $id")->row();
    $side_id = $query->$side;
    return get_pr_point_by_id($side_id);
}


function view_user_image($user_id, $w, $h)
{

    $style = '';
    $table = DB()->table('users');
    $sql = $table->where('ID',$user_id)->get();
    $user_info =$sql->getResult();
    if (!empty($user_info)) {
        $style = ($user_info[0]->status == "Inactive") ? 'style="border: 2px solid red;"' : "";
    }

    if (!empty($user_info[0]->photo)) {
        return '<img ' . $style . ' src="' . base_url() . '/assets/timthumb.php?src=' . base_url() . '/uploads/user_image/' . $user_info[0]->photo . ' &amp;w=' . $w . '&amp;h=' . $h . '&amp;zc=1" class=" level" style="border:1px solid;" />';

    } else {
        return '<img ' . $style . ' src="' . base_url() . '/assets/timthumb.php?src=' . base_url() . '/uploads/user_image/images.png&amp;w=' . $w . '&amp;h=' . $h . '&amp;zc=1" class=" level" style="border:1px solid;" />';
    }

}

function view_user_image_leve2($user_id, $w, $h)
{

    $style = '';
    $table = DB()->table('users');
    $user_info = $table->where('ID',$user_id)->get()->getResult();
    if (!empty($user_info)) {
        $style = ($user_info[0]->status == "Inactive") ? 'style="border: 2px solid red;"' : "";
    }
    if (!empty($user_info[0]->photo)) {
        return '<img ' . $style . ' src="' . base_url() . '/assets/timthumb.php?src=' . base_url() . '/uploads/user_image/' . $user_info[0]->photo . '&amp;w=' . $w . '&amp;h=' . $h . '&amp;zc=1" class="level2" style="border:1px solid;" />';
    } else {
        return '<img ' . $style . ' src="' . base_url() . '/assets/timthumb.php?src=' . base_url() . '/uploads/user_image/images.png&amp;w=' . $w . '&amp;h=' . $h . '&amp;zc=1" class=" level2" style="border:1px solid;" />';
    }
}

function view_user_image_leve3($user_id, $w, $h){
    $style = '';
    $table = DB()->table('users');
    $user_info = $table->where('ID',$user_id)->get()->getResult();

    if (!empty($user_info)) {
        $style = ($user_info[0]->status == "Inactive") ? 'style="border: 2px solid red;"' : "";
    }
    if (!empty($user_info[0]->photo)) {
        return '<img ' . $style . ' src="' . base_url() . '/assets/timthumb.php?src=' . base_url() . '/uploads/user_image/' . $user_info[0]->photo . '&amp;w=' . $w . '&amp;h=' . $h . '&amp;zc=1" class="level3" style="border:1px solid;" />';
    } else {
        return '<img ' . $style . ' src="' . base_url() . '/assets/timthumb.php?src=' . base_url() . '/uploads/user_image/images.png&amp;w=' . $w . '&amp;h=' . $h . '&amp;zc=1" class="level3" style="border:1px solid;" />';
    }
}


function Tk_view($amount)
{

    $TK = "(৳) $amount/-";
    return $TK;
}

//function Tk_view($amount)
//{
//
//    $TK = "(৳) $amount/-";
//    return $TK;
//}

function get_username_byID($id){

    $table = DB()->table('users');
    $query = $table->where('ID',$id)->get();
    $rows = $query->getRow();
    if (!empty($rows->username)) {
        $username = $rows->username;
    }else {
        $username = 'None';
    }
    return $username;
}


function get_hand_byID($id, $hand='l_t'){
    $table = DB()->table('tree');
    $query = $table->select($hand)->where('u_id',$id)->get();
    $rows = $query->getRow();

    if (!empty($rows->$hand)) {
        $get_hand = $rows->$hand;
    }else {
        $get_hand = 0;
    }
    return $get_hand;
}

function country(){
    $countries = array(
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua And Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia And Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CG' => 'Congo',
        'CD' => 'Congo, Democratic Republic',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote D\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands (Malvinas)',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island & Mcdonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran, Islamic Republic Of',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle Of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Lao People\'s Democratic Republic',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia, Federated States Of',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory, Occupied',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts And Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre And Miquelon',
        'VC' => 'Saint Vincent And Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome And Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia And Sandwich Isl.',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard And Jan Mayen',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad And Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks And Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Outlying Islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Viet Nam',
        'VG' => 'Virgin Islands, British',
        'VI' => 'Virgin Islands, U.S.',
        'WF' => 'Wallis And Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe',
    );

    return $countries;
}

function countryName($keys){
    $name = '';
    foreach (country() as $key => $val){
        if ($key == $keys){
            $name = $val;
        }
    }
    return $name;
}
function already_shown($video_id){
    $userId = new_session()->user_id_client;
    $today = date('Y-m-d');
    $table = DB()->table('video_view_count');
    $count = $table->where('video_id',$video_id)->where('u_id',$userId)->where('date',$today)->countAllResults();
    return $count;
}


function get_data_by_id($needCol, $table, $whereCol, $whereInfo)
{
    $tableName = DB()->table($table);
    $query = $tableName->select($needCol)->where($whereCol, $whereInfo)->get();
    $result = $query->getRow();
    if (!empty($result)) {
        return $result->$needCol;
    } else {
        return false;
    }
}


function encrypt_decrypt($string, $action = 'encrypt')
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
    $secret_iv = '5fgf5HJ5g27'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}