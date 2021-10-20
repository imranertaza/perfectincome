<?php

namespace App\Controllers;


use App\Models\FunctionModel;

class Location extends BaseController
{
    protected $validation;
    protected $session;
    protected $functionModel;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
        $this->validation = \Config\Services::validation();
    }


    public function list_division()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('location');
            $query = $table->where('type', 'div')->get();
            $location = $query->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'location' => $location,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {
                echo view('Admin/Location/division_list', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function add_division()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $data = [
                'functionModel' => $this->functionModel,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Location/add_division', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function action_division()
    {
        $fields['name'] = $this->request->getPost('div_name');
        $fields['type'] = 'div';
        $location = DB()->table('location');
        $location->insert($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
        return redirect()->to(site_url("Location/list_division"));
    }

    public function edit_division($id)
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $table = DB()->table('location');
            $query = $table->where('lo_id', $id)->get();
            $rows = $query->getRow();

            $data = [
                'functionModel' => $this->functionModel,
                'row' => $rows,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Location/edit_division', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function update_division()
    {
        $fields['name'] = $this->request->getPost('div_name');
        $lo_id = $this->request->getPost('lo_id');

        $location = DB()->table('location');
        $location->where('lo_id', $lo_id);
        $location->update($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Location/list_division"));
    }

    public function add_district()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $data = [
                'functionModel' => $this->functionModel,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {

                echo view('Admin/Location/add_district', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function action_district()
    {
        $fields['name'] = $this->request->getPost('district_name');
        $fields['per_id'] = $this->request->getPost('perent');
        $fields['type'] = 'dis';
        $location = DB()->table('location');
        $location->insert($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
        return redirect()->to(site_url("Location/district_list"));
    }


    public function district_list()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $location = DB()->table('location');
            $query = $location->where('type', 'dis')->get();
            $loca = $query->getResult();

            $data = [
                'functionModel' => $this->functionModel,
                'location' => $loca,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Location/district_list', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function edit_district($id)
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $location = DB()->table('location');
            $query = $location->where('lo_id', $id)->get();
            $loca = $query->getRow();
            $data = [
                'functionModel' => $this->functionModel,
                'row' => $loca,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Location/edit_district', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function update_district()
    {

        $lo_id = $this->request->getPost('lo_id');
        $fields['name'] = $this->request->getPost('district_name');
        $fields['per_id'] = $this->request->getPost('perent');

        $location = DB()->table('location');
        $location->where('lo_id', $lo_id);
        $location->update($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Location/district_list"));


    }

    public function add_thana()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $data = [
                'functionModel' => $this->functionModel,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Location/add_thana', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }


    public function action_thana()
    {
        $fields['name'] = $this->request->getPost('thana');
        $fields['per_id'] = $this->request->getPost('perent');
        $fields['type'] = 'tha';

        $location = DB()->table('location');
        $location->insert($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
        return redirect()->to(site_url("Location/thana_list"));

    }

    public function thana_list()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $table = DB()->table('location');
            $sql = $table->where('type', 'tha')->get();
            $location = $sql->getResult();

            $data = [
                'functionModel' => $this->functionModel,
                'location' => $location,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Location/thana_list', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function edit_thana($id)
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $table = DB()->table('location');
            $sql = $table->where('lo_id', $id)->get();
            $location = $sql->getRow();

            $data = [
                'functionModel' => $this->functionModel,
                'row' => $location,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Location/edit_thana', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function update_thana()
    {
        $lo_id = $this->request->getPost('lo_id');
        $fields['name'] = $this->request->getPost('thana');
        $fields['per_id'] = $this->request->getPost('perent');

        $location = DB()->table('location');
        $location->where('lo_id', $lo_id);
        $location->update($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Location/thana_list"));
    }

    public function add_word()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {


            $data = [
                'functionModel' => $this->functionModel,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Location/add_word', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function action_ward()
    {
        $fields['name'] = $this->request->getPost('ward_name');
        $fields['per_id'] = $this->request->getPost('perent');
        $fields['type'] = 'ward';

        $location = DB()->table('location');
        $location->insert($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
        return redirect()->to(site_url("Location/word_list"));
    }

    public function word_list()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('location');
            $sql = $table->where('type', 'ward')->get();
            $word = $sql->getResult();

            $data = [
                'functionModel' => $this->functionModel,
                'word' => $word,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Location/word_list', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function edit_word($id)
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('location');
            $sql = $table->where('lo_id', $id)->get();
            $word = $sql->getRow();

            $data = [
                'functionModel' => $this->functionModel,
                'row' => $word,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('edit_page') == true) {
                echo view('Admin/Location/edit_word', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function update_ward(){
        $lo_id = $this->request->getPost('lo_id');
        $fields['name'] = $this->request->getPost('ward_name');
        $fields['per_id'] = $this->request->getPost('perent');

        $location = DB()->table('location');
        $location->where('lo_id', $lo_id);
        $location->update($fields);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Update successfully</div>');
        return redirect()->to(site_url("Location/word_list"));
    }


    public function delete($id)
    {
        $location = DB()->table('location');

        if ($location->delete(['lo_id' => $id])) {
            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Delete successfully</div>');
            return redirect()->back();
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong!.</div>');
            return redirect()->back();
        }
    }


}
