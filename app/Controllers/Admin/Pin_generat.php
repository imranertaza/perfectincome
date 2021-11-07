<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FunctionModel;

class Pin_generat extends BaseController
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

    public function index()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $table = DB()->table('pins');
            $sql = $table->groupBy('package_id')->get();
            $result = $sql->getResult();

            $data = [
                'functionModel' => $this->functionModel,
                'pins' => $result,

            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Pine_gnerate/pin_generate',$data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function add(){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $tab = DB()->table('package');
            $query = $tab->get()->getResult();

            $data = [
                'functionModel' => $this->functionModel,
                'package' => $query,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Pine_gnerate/pin_generate_form',$data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function pin_generat_action(){
        $userId = $this->session->user_id;
        $num_pins = $this->request->getPost('amount');
        $packageId = $this->request->getPost('package_id');
        $balance = get_id_by_data('balance', 'users', 'ID', $userId);
        $packAmount = get_id_by_data('price', 'package', 'package_id', $packageId);
        $totalPrice = $packAmount * $num_pins;

        if ($balance >= $totalPrice) {
            DB()->transStart();
            for ($i = 1; $i <= $num_pins; $i++) {
                $pin = $this->generate();
                $data = [
                    'package_id' => $packageId,
                    'generated_by' => $userId,
                    'pin' => $pin,
                ];
                $table = DB()->table('pins');
                $table->insert($data);
            }

            $oldPack = get_id_by_data('total_pin_generated_number', 'package', 'package_id', $packageId);
            $newPin = $oldPack + $num_pins;

            $data = ['total_pin_generated_number' => $newPin];
            $pack = DB()->table('package');
            $pack->where('package_id', $packageId)->update($data);



            //admin balance update
            $newBalUser = $balance - $totalPrice;
            $adminUser = DB()->table('users');
            $adminUser->where('ID', $userId)->update(['balance' => $newBalUser]);

            //history balance admin insert
            $histryData = [
              'user_id' => $userId,
              'amount' => $totalPrice,
              'type' => 'CR',
              'purpose' => 'Pin generate by admin',
            ];
            $adminHistory = DB()->table('history_balance_admin');
            $adminHistory->insert($histryData);

            DB()->transComplete();


            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Add successfully</div>');
            return redirect()->to(site_url("/Admin/Pin_generat"));
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Sorry your load balance is not enough!</div>');
            return redirect()->to(site_url("/Admin/Pin_generat"));
        }


    }

    public function generate()
    {
        $pins = rand(1, 1000000);
        return $pins;
    }

    public function view_agent_pin($id){
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {
            $table = DB()->table('pins');
            $sql  = $table->where('package_id',$id)->get();
            $query = $sql->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'agent' => $query,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('dashboard') == true) {
                echo view('Admin/Pine_gnerate/view_pin',$data);
            }else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }










}
