<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Models\Category\CategoryModel;
use App\Models\FunctionModel;

class Withdraw extends BaseController
{
    protected $validation;
    protected $session;
    protected $functionModel;
    protected $pager;
    protected $categoryModel;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
        $this->validation = \Config\Services::validation();
        $this->pager = \Config\Services::pager();
        $this->categoryModel = new CategoryModel();
        helper('Member');
    }


    public function index()
    {
        $adminLogin = $this->session->isLoggedInAdmin;
        if (!isset($adminLogin) || $adminLogin != TRUE) {
            echo view('Admin/login');
        } else {

            $table = DB()->table('history_withdraw_pm');
            $query = $table->get();
            $withdraw = $query->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'withdraw' => $withdraw,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {
                echo view('Admin/Withdraw/withdraw_list',$data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function withdraw_action(){

        $payer_Account = $this->request->getPost('Payer_Account');
        $batch_number = $this->request->getPost('batch_number');
        $sta = $this->request->getPost('sta');
        $withdraw_id = $this->request->getPost('withdraw_id');


        if ($sta == 'Cancel'){
            $userId = get_data_by_id('receiver_id','history_withdraw_pm','withdraw_id',$withdraw_id);
            $withdraw_amount = get_data_by_id('amount','history_withdraw_pm','withdraw_id',$withdraw_id);

            $oldBal = get_data_by_id('balance','users','ID',$userId);
            $newBal = $oldBal + $withdraw_amount;
            $userTabl = DB()->table('users');
            $uData = [
                'balance' => $newBal,
            ];
            $userTabl->where('ID',$userId)->update($uData);
//            $uD = [ 'rest_balance' => $newBal, ];
        }

        $data = [
          'Payer_Account' => $payer_Account,
          'batch_number' => $batch_number,
          'status' => $sta,
        ];
        $table = DB()->table('history_withdraw_pm');
        if ($table->where('withdraw_id',$withdraw_id)->update($data)){
            print '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Successfully update</div>';
        }else{
            print '<div class="alert alert-danger alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong</div>';
        }

//        print_r($data);
    }




}
