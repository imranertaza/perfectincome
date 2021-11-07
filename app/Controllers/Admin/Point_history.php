<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\UserModel;

class Point_history extends BaseController
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

//            UserModel::findAll();

            $username = $this->request->getPost('username');
            $u_id = get_ID_by_username($username);

            $type = $this->request->getPost('type');

            //query nagad transection list for this user
            $balance = number_format(get_balance_by_id($u_id), 2);
            $commission = number_format(get_commission_by_id($u_id), 2);

            if (!empty($type)) {
                $history_point1 = DB()->table('history_point');
                $sql = $history_point1->where('u_id', $u_id)->where('type', $type)->get();
                $hisPoint = $sql->getResult();
            } else {
                $history_point2 = DB()->table('history_point');
                $sql2 = $history_point2->where('u_id', $u_id)->get();
                $hisPoint = $sql2->getResult();
            }


            $hisLAd = DB()->table('history_point');
            $whe = array("u_id" => $u_id, "lpoint !=" => "Null", "type" => "Add");
            $totalLeftAdd = $hisLAd->where($whe)->countAllResults();

            $hisRAd = DB()->table('history_point');
            $whe2 = array("u_id" => $u_id, "rpoint !=" => "Null", "type" => "Add");
            $totalRightAdd = $hisRAd->where($whe2)->countAllResults();

            $hisDed = DB()->table('history_point');
            $whe3 = array("u_id" => $u_id, "type" => "Deduct");
            $totalDeduct = $hisDed->where($whe3)->countAllResults();

            $hisFlu = DB()->table('history_point');
            $whe4 = array("u_id" => $u_id, "lpoint" => "100", "type" => "Flush");
            $totalLeftFlush = $hisFlu->where($whe4)->countAllResults();

            $hisFluR = DB()->table('history_point');
            $whe5 = array("u_id" => $u_id, "rpoint" => "100", "type" => "Flush");
            $totalRightFlush = $hisFluR->where($whe5)->countAllResults();


            $data = [
                'functionModel' => $this->functionModel,
                'records' => $hisPoint,
                'totalLeftAdd' => $totalLeftAdd,
                'totalRightAdd' => $totalRightAdd,
                'totalDeduct' => $totalDeduct,
                'totalLeftFlush' => $totalLeftFlush,
                'totalRightFlush' => $totalRightFlush,
                'commission' => $commission,
                'balance' => $balance,
                'username' => $username,
                'type' => $type,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('download_list') == true) {
                echo view('Admin/Point/list', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }


}
