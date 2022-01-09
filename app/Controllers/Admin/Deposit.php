<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Models\Category\CategoryModel;
use App\Models\FunctionModel;

class Deposit extends BaseController
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

            $table = DB()->table('history_manual_deposit_pm');
            $query = $table->orderBy('hist_manual_with_pm_id','DESC')->get();
            $deposit = $query->getResult();
            $data = [
                'functionModel' => $this->functionModel,
                'deposit' => $deposit,
            ];

            echo view('Admin/header');
            echo view('Admin/sidebar');
            if ($this->functionModel->hasPermission('page_list') == true) {
                echo view('Admin/Deposit/deposit_list',$data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    public function active($id){

        DB()->transStart();

        $acDopData = array(
            'status'=>'confirm',
        );
        $acDeposit = DB()->table('history_manual_deposit_pm');
        $acDeposit->where('hist_manual_with_pm_id',$id)->update($acDopData);


        $userID = get_data_by_id('user_id','history_manual_deposit_pm','hist_manual_with_pm_id',$id);
        $packageId = get_data_by_id('package_id','history_manual_deposit_pm','hist_manual_with_pm_id',$id);

        //Sponsor commision will be added to main Commission
        $spon_id = get_field_by_id_from_table("tree", "spon_id", "u_id", $userID);
        $spons_previous_bal = get_field_by_id_from_table("users", "balance", "ID", $spon_id);
//        $sponsor_com = get_field_by_id_from_table("global_settings", "value", "title", "sponsor_commission");
        $sponsor_com = get_id_by_data('sponsor_commission', 'package', 'package_id', $packageId);
        $sponsor_commision = array(
            'balance' => $spons_previous_bal + $sponsor_com,
        );

        $userCom = DB()->table('users');
        $userCom->where('ID', $spon_id)->update($sponsor_commision);


        // Sponsor commission Statement
        $spon_commision_statement = array(
            'u_id' => $spon_id,
            'purpose' => "Sponsor commission of a register new member",
            'amount' => $sponsor_com,
            'date' => date("Y-m-d h:i:s")
        );
        $comm_spot = DB()->table('comm_spot');
        $comm_spot->insert($spon_commision_statement);


        //sponsor commision is deducting from admin balance
        $adminBalance = get_field_by_id_from_table('users', 'balance', 'ID', 1);
        $adminBalanceCRspon = $adminBalance - $sponsor_com;
        $adminBalanceCRdataspon = array(
            'balance' => $adminBalanceCRspon,
        );
        $adminCm = DB()->table('users');
        $adminCm->where('ID', 1)->update($adminBalanceCRdataspon);


        //admin balance history
        $hisBalanceadminspon = array(
            'user_id' => 1,
            'amount' => $sponsor_com,
            'type' => 'CR',
            'purpose' => 'spon_commission',
        );
        $hisBalAdmin = DB()->table('history_balance_admin');
        $hisBalAdmin->insert($hisBalanceadminspon);


        //All Users Perent_point will be increased And matching
        $min_matching_point = get_field_by_id_from_table("global_settings", "value", "title", "min_matching_point");
        $matching_commission = get_field_by_id_from_table("global_settings", "value", "title", "matching_commission");
        $point = get_id_by_data('point', 'package', 'package_id', $packageId);
        $per_day_matching = get_field_by_id_from_table("global_settings", "value", "title", "per_day_matching");

        $parent_id = get_field_by_id_from_table("tree", "pr_id", "u_id", $userID);
        $user_id = $userID;

        while (!empty($parent_id)) {

            $old_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
            $old_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);

            //Increasing Parent hand Point (left or right)
            $treeHand = DB()->table('tree');
            $hand = $treeHand->where('u_id', $parent_id)->get()->getRow();

            if ($hand->l_t == $user_id) {
                $point_hand = "lpoint";
            }
            if ($hand->r_t == $user_id) {
                $point_hand = "rpoint";
            }


            $old_point = get_field_by_id_from_table("users", $point_hand, "ID", $parent_id);
            $pr_point = array(
                $point_hand => $old_point + $point
            );
            $userPoi = DB()->table('users');
            $userPoi->where('ID', $parent_id)->update($pr_point);

            //Adding history of points
            $current_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
            $current_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);
            $current_commission = get_field_by_id_from_table("users", "balance", "ID", $parent_id);
            $current_balance = get_field_by_id_from_table("users", "balance", "ID", $parent_id);
            $history_point_data = array(
                'u_id' => $parent_id,
                $point_hand => $point,
                'current_left_point' => $current_lpoint,
                'current_right_point' => $current_rpoint,
                'current_commission' => $current_commission,
                'current_balance' => $current_balance,
                'type' => "Add",
                'date' => date("Y-m-d h:i:s")
            );
            $hisPoinTbl = DB()->table('history_point');
            $hisPoinTbl->insert($history_point_data);


            //Matching Commission Start
            if ($current_lpoint > $current_rpoint) {
                $total_matching_time = $current_rpoint / $min_matching_point;
            } else {
                $total_matching_time = $current_lpoint / $min_matching_point;
            }

            for ($i = 0; $i <= $total_matching_time; $i++) {

                $whereBetween = ("`date` BETWEEN '" . date("Y-m-d") . " 00:00:00' AND '" . date("Y-m-d") . " 23:59:59'");
                $comMatch = DB()->table('comm_matching');
                $com_taken_on_day = $comMatch->where('u_id', $parent_id)->where($whereBetween)->countAllResults();


                if ($com_taken_on_day < $per_day_matching) {
                    $lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
                    $rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);

                    if (($lpoint >= $min_matching_point) && ($rpoint >= $min_matching_point) && !empty($hand->l_t) && !empty($hand->r_t)) {

                        $existing_com = get_field_by_id_from_table("users", "balance", "ID", $parent_id);

                        // Updating commission on user table
                        $data = array(
                            'balance' => $existing_com + $matching_commission
                        );
                        $userMetCom = DB()->table('users');
                        $userMetCom->where('ID', $parent_id)->update($data);

                        //Matching Commission History;
                        $data = array(
                            'u_id' => $parent_id,
                            'purpose' => 'Matching Commission' . date("Y-m-d h:i:s A"),
                            'amount' => $matching_commission,
                            'date' => date("Y-m-d h:i:s")
                        );
                        $uComMetch = DB()->table('comm_matching');
                        $uComMetch->insert($data);


                        //matching_commission is deducting from admin balance
                        $adminBalanceNew = get_field_by_id_from_table('users', 'balance', 'ID', 1);
                        $adminBalanceCR = $adminBalanceNew - $matching_commission;
                        $adminBalanceCRdata = array(
                            'balance' => $adminBalanceCR,
                        );
                        $adBalCom = DB()->table('users');
                        $adBalCom->where('ID', 1)->update($adminBalanceCRdata);

                        //admin balance history
                        $hisBalanceadmin = array(
                            'user_id' => 1,
                            'amount' => $matching_commission,
                            'type' => 'CR',
                            'purpose' => 'matching_commission',
                        );
                        $hisAdBal = DB()->table('history_balance_admin');
                        $hisAdBal->insert($hisBalanceadmin);


                        //Decreasing Point from both side
                        //$matching_point = $next_com_times * $min_matching_point;
                        $left_data = array(
                            'lpoint' => $lpoint - $min_matching_point,
                            'rpoint' => $rpoint - $min_matching_point
                        );
                        $lfUpdate = DB()->table('users');
                        $lfUpdate->where('ID', $parent_id)->update($left_data);


                        //Deducting history of points
                        $current_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
                        $current_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);
                        $current_commission = get_field_by_id_from_table("users", "balance", "ID", $parent_id);
                        $current_balance = get_field_by_id_from_table("users", "balance", "ID", $parent_id);
                        $deducting_point_data = array(
                            'u_id' => $parent_id,
                            'lpoint' => $min_matching_point,
                            'rpoint' => $min_matching_point,
                            'current_left_point' => $current_lpoint,
                            'current_right_point' => $current_rpoint,
                            'current_commission' => $current_commission,
                            'current_balance' => $current_balance,
                            'type' => "Deduct",
                            'date' => date("Y-m-d h:i:s")
                        );
                        $hisPoint = DB()->table('history_point');
                        $hisPoint->insert($deducting_point_data);

                    }

                }

            }
            //Matching Commission End


            //Flash existing Point after 100
            //$total_comm_taken = $com_taken_on_day + 1;

            if ($com_taken_on_day >= $per_day_matching) {

                $current_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
                $current_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);

                if ($current_lpoint <> $current_rpoint) {
                    if ($current_lpoint > $current_rpoint) {
                        $flash_hand = "rpoint";
                        $flash_point = $old_rpoint;
                    } else {
                        $flash_hand = "lpoint";
                        $flash_point = $old_lpoint;
                    }


                    $flashdata = array(
                        $flash_hand => 0
                    );
                    $faUpTab = DB()->table('users');
                    $faUpTab->where('ID', $parent_id)->update($flashdata);

                    //Flushing history of points
                    $current_lpoint = get_field_by_id_from_table("users", "lpoint", "ID", $parent_id);
                    $current_rpoint = get_field_by_id_from_table("users", "rpoint", "ID", $parent_id);
                    $current_commission = get_field_by_id_from_table("users", "balance", "ID", $parent_id);
                    $current_balance = get_field_by_id_from_table("users", "balance", "ID", $parent_id);
                    $flushing_point_data = array(
                        'u_id' => $parent_id,
                        $flash_hand => $flash_point,
                        'current_left_point' => $current_lpoint,
                        'current_right_point' => $current_rpoint,
                        'current_commission' => $current_commission,
                        'current_balance' => $current_balance,
                        'type' => "Flush",
                        'date' => date("Y-m-d h:i:s")
                    );
                    $hPoiUp = DB()->table('history_point');
                    $hPoiUp->insert($flushing_point_data);
                }
            }
            $user_id = $parent_id;
            $parent_id = get_field_by_id_from_table("tree", "pr_id", "u_id", $parent_id);
        }

        $uStatus = array(
            'status' => 'Active',
            'package_id' => $packageId
        );
        $stUser = DB()->table('users');
        $stUser->where('ID', $userID)->update($uStatus);

        DB()->transComplete();

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center ">   Successfully active!</div>');
        return redirect()->to(site_url("Admin/Deposit"));

    }

    public function cancel($id){
        $acDopData = array(
            'status'=>'cancel',
        );
        $acDeposit = DB()->table('history_manual_deposit_pm');
        $acDeposit->where('hist_manual_with_pm_id',$id)->update($acDopData);

        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center ">   Successfully cancel!</div>');
        return redirect()->to(site_url("Admin/Deposit"));
    }




}
