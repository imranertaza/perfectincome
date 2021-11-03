<?php

namespace App\Controllers;


use App\Models\FunctionModel;
use App\Models\Widgets\Widget;

class Widgets extends BaseController
{
    protected $validation;
    protected $session;
    protected $functionModel;
    protected $pager;
    protected $widget;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
        $this->validation = \Config\Services::validation();
        $this->pager = \Config\Services::pager();
        $this->widget = new Widget();
    }


    public function widgets_list()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('widget');
            $query = $table->get();
            $widget = $query->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'widget' => $widget,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {
                echo view('Admin/Widgets/widget_list',$data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function view($id)
    {

        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $member = $this->userModel->where('ID', $id)->first();
            $img = view_member_image($id, 150, 150);
            $data = [
                'functionModel' => $this->functionModel,
                'row' => $member,
                'pro_image' => $img,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Member/view', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function edit_widget($id)
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $table = DB()->table('widget');
            $query = $table->where('w_id',$id)->get();
            $widget = $query->getRow();
            $data = [
                'functionModel' => $this->functionModel,
                'row' => $widget,
                'widget' => $this->widget,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Widgets/edit_widget', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function update(){

        $w_id = $this->request->getPost('w_id');
        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');
        $fields['b_code'] = $this->request->getPost('b_code');

        if (!empty($_FILES['f_img']['name'])) {
            $image = $this->request->getFile('f_img');
            $name = $image->getRandomName();
            $image->move(FCPATH . '\uploads\widget_image', $name);
            $fields['image'] = $name;
        }

        $widget = DB()->table('widget');
        $widget->where('w_id', $w_id);
        $widget->update($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Widgets/widgets_list"));


    }

    public function add()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $data = [
                'functionModel' => $this->functionModel,
                'widget' => $this->widget,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Widgets/add_new_widget');
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function action()
    {

        $fields['title'] = $this->request->getPost('title');
        $fields['description'] = $this->request->getPost('description');
        $fields['b_code'] = $this->request->getPost('b_code');

        if (!empty($_FILES['f_img']['name'])) {
            $image = $this->request->getFile('f_img');
            $name = $image->getRandomName();
            $image->move(FCPATH . '\uploads\widget_image', $name);
            $fields['image'] = $name;
        }

        $widget = DB()->table('widget');
        $widget->insert($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
        return redirect()->to(site_url("Widgets/widgets_list"));

    }

    public function delete($id)
    {
        $widget = DB()->table('widget');

        if ($widget->delete(['w_id' => $id])) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Delete successfully</div>');
            return redirect()->to(site_url("Widgets/widgets_list"));
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong!.</div>');
            return redirect()->back();
        }
    }


}
