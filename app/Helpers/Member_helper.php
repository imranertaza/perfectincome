<?php

    function view_member_image($std_id, $w, $h) {
        $table = DB()->table('users');
        $query = $table->where('ID',$std_id)->get();
        $pro_image = $query->getRow();

        if (!empty($pro_image->photo)) {
            return '<div class="pre_image"><img src="'.base_url().'/assets/timthumb.php?src='.base_url().'/uploads/user_image/'.$pro_image->photo.'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
        }else {
            return '<div class="pre_image"><img src="'.base_url().'/assets/timthumb.php?src='.base_url().'/uploads/user_image/no_thumb.jpg&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
        }
    }





?>