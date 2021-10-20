<?php

namespace App\Controllers\Admin_ut;

use App\Controllers\BaseController;
use App\Models\FunctionModel;

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

            $username = $this->request->getPost('username');
            $u_id = get_ID_by_username($username);

            $type = $this->request->getPost('type');

            //query nagad transection list for this user
            $balance = number_format(get_balance_by_id($u_id) ,2);
            $commission = number_format(get_commission_by_id($u_id), 2);
            $history_point = DB()->table('history_point');
            if ($type) {
                $sql = $history_point->where('u_id',$u_id)->get();
                $hisPoint = $sql->getResult();
            }else {
                $sql2 = $history_point->where('u_id')->get();
                $hisPoint = $sql2->getResult();
            }
            $whe = array("u_id" => $u_id, "lpoint !=" => "Null", "type" => "Add");
            $totalLeftAdd = $history_point->where($whe)->countAllResults();

            $whe2 = array("u_id" => $u_id, "rpoint !=" => "Null", "type" => "Add");
            $totalRightAdd = $history_point->where($whe2)->countAllResults();

            $whe3 =  array("u_id" => $u_id, "type" => "Deduct");
            $totalDeduct = $history_point->where($whe3)->countAllResults();

            $whe4 = array("u_id" => $u_id, "lpoint" => "100", "type" => "Flush");
            $totalLeftFlush = $history_point->where($whe4)->countAllResults();

            $whe5 = array("u_id" => $u_id, "rpoint" => "100", "type" => "Flush");
            $totalRightFlush = $history_point->where($whe5)->countAllResults();



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
