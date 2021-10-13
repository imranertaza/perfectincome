<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Category;
use CodeIgniter\Model;

class CategoryModel extends Model {

//    protected $table = 'appointment';
//    protected $primaryKey = 'appointment_id';
//    protected $returnType = 'object';
//    protected $useSoftDeletes = false;
//    protected $allowedFields = ['doc_id', 'pat_id', 'day', 'time', 'date', 'name', 'phone', 'serial_number', 'h_id', 'createdDtm', 'createdBy', 'updatedDtm', 'updatedBy', 'deleted', 'deletedRole'];
//    protected $useTimestamps = false;
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';
//    protected $validationRules    = [];
//    protected $validationMessages = [];
//    protected $skipValidation     = true;

    public function category_option_list($sel) {
        $table = DB()->table('category');
        $query = $table->get();
        $category = $query->getResult();
        $view ='';
        foreach ($category as $rows)
        {
            if ($rows->cat_id == $sel) { $selected = 'selected="selected"'; }else { $selected = ''; }
            $view .='<option value="'.$rows->cat_id.'" '.$selected.'>'. $rows->cat_name.'</option>';
        }
        return $view;
    }

}