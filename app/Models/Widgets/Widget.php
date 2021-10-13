<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models\Widgets;
use CodeIgniter\Model;

class Widget extends Model {

    public function view_post_image($w_id, $w, $h) {
        $table = DB()->table('widget');
        $sql = $table->where('w_id',$w_id)->get();
        $pro_image = $sql->getRow();

        if (!empty($pro_image->image)) {
            return '<div class="pre_image"><img src="'.base_url().'/assets/timthumb.php?src='.base_url().'/uploads/widget_image/'.$pro_image->image.'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
        }else {
            return '<div class="pre_image"><img src="'.base_url().'/assets/timthumb.php?src='.base_url().'/uploads/widget_image/no_thumb.jpg&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
        }
    }

}