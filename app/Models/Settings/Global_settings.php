<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Settings;
use CodeIgniter\Model;

class Global_settings extends Model {


    public function get_each_setting_value($key) {
        $table = DB()->table('global_settings');
        $sql = $table->where('title',$key)->get();
        $result = $sql->getRow();
        return $result->value;
    }






}