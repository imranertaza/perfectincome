<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class FunctionModel extends Model {
    protected $db;
    protected $session;
    public function __construct() {
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    public function get_user_role_by_userid($user_id, $colum){
        $user_role = $this->db->table('user_roles');
        $query = $user_role->select($colum)->where('userID',$user_id)->get();
        $role_id = $query->getRow()->$colum;
        return $role_id;
    }

    public function hasPermission($permKey){
        $user_id = $this->session->user_id;
        $permissions = $this->db->table('permissions');
        $query = $permissions->where('permKey',$permKey)->get();
        $permission_id = $query->getRow()->ID;

        $role_id = $this->get_user_role_by_userid($user_id, 'roleID');

        $get_per = $this->db->table('role_perms');
        $result = $get_per->where('roleID',$role_id)->where('permID',$permission_id)->where('value','1')->get();

        $get_permissions = $result->getNumRows();

        if ($get_permissions > 0) {
            return true;
        }else {
            return false;
        }
    }



    public function category_checkbox($parent=0, $sel=0) {
        $table = DB()->table('category');
        $sql = $table->where('perent_id',$parent)->get();

        $category = $sql->getResult();

        $selected = explode(',', $sel);
        $output = '<ul class="Tree" id="Tree">';
        foreach($category as $category_list){
            if (in_array($category_list->cat_id, $selected)) { $checked = 'checked="checked"'; }else { $checked = ''; }
            $parent = $category_list->cat_id;
            $output .= '<li><label><input type="checkbox" '.$checked.' name="category" value="'.$category_list->cat_id.'">'.' '. $category_list->cat_name.'</label>';
            $this->category_checkbox($parent, $sel);
        }
        $output .= '</li></ul>';
        return $output;
    }

    public function view_image($sl_id, $w, $h) {

        $table = DB()->table('slider_gallery');
        $sql = $table->where('sl_id',$sl_id)->get();
        $image = $sql->getRow();

        if (!empty($image->image)) {
            return '<div class="pre_image"><img src="'.base_url().'/assets/timthumb.php?src='.base_url().'/uploads/gallery/'.$image->image.'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
        }else {
            return '<div class="pre_image"><img src="'.base_url().'/assets/timthumb.php?src='.base_url().'/uploads/gallery/no_thumb.jpg&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
        }
    }

    public function category_option_list($sel=0) {
        $table = DB()->table('product_cat');
        $sql = $table->get();
        $category = $sql->getResult();
        $data = '';
        foreach ($category as $rows){
            if ($rows->cat_id == $sel) { $sele = 'selected="selected"'; }else { $sele = ''; }
            $data .= '<option value="'.$rows->cat_id.'" '.$sele.'>'. $rows->cat_name.'</option>';
        }
        return $data;
    }

    public function category_option_list_parent($sel=0) {
        $table = DB()->table('product_cat');
        $sql = $table->where('perent_id','0')->get();
        $category = $sql->getResult();
        $data = '';
        foreach ($category as $rows){
            if ($rows->cat_id == $sel) { $sele = 'selected="selected"'; }else { $sele = ''; }
            $data .= '<option value="'.$rows->cat_id.'" '.$sele.'>'. $rows->cat_name.'</option>';
        }
        return $data;
    }
    public function show_widget($col, $w_id) {
        $table = DB()->table('widget');
        $sql = $table->select($col)->where('w_id',$w_id)->get();
        $widget_output = $sql->getRow();
        $result = $widget_output->$col;
        return $result;
    }

    public function modulePermission($key){
        $module_key = $this->db->table('modules')->where('module_key',$key)->get()->getRow()->status;

        // print_r($module_key);
        // exit();

        if ($module_key == '1') {
            return true;
        }else {
            return false;
        }
    }


}