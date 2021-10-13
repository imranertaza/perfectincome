<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Product;
use App\Models\FunctionModel;
use CodeIgniter\Model;

class ProductfunctionModel extends Model {
    protected $session;
    public function __construct() {
        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
    }

    public function view_product_image($pro_id, $w, $h) {

        $table = DB()->table('products');
        $query = $table->where('pro_id',$pro_id)->get();
        $row = $query->getRow();

        if (!empty($row->main_image)) {
            return '<div class="pre_image"><img src="'.base_url().'/assets/timthumb.php?src='.base_url().'/uploads/pro_image/'.$row->main_image.'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
        }else {
            return '<div class="pre_image"><img src="'.base_url().'/assets/timthumb.php?src='.base_url().'/uploads/pro_image/no_thumb.jpg&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
        }
    }




}