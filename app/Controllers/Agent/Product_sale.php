<?php

namespace App\Controllers\Agent;

use App\Controllers\BaseController;
use App\Models\FunctionModel;
use App\Models\Settings\Global_settings;

class Product_sale extends BaseController
{
    protected $validation;
    protected $session;
    protected $functionModel;
    protected $globalSettingsModel;
    protected $cart;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->functionModel = new FunctionModel();
        $this->validation = \Config\Services::validation();
        $this->globalSettingsModel = new Global_settings();
        $this->cart = \Config\Services::cart();
    }

    public function index()
    {
        $clientLogin = $this->session->isLoggedInClient;
        if (!isset($clientLogin) || $clientLogin != TRUE) {
            return redirect()->to(site_url("Member_form/login"));
        } else {


            $addCart = $this->request->getPost('add_to_cart');
            // Add product into cart
            if (isset($addCart)) {

                $existing_qty = get_field_by_id('quantity', $this->request->getPost('product_id'));
                $product_name = get_field_by_id('name', $this->request->getPost('product_id'));
                if ($existing_qty >= $this->request->getPost('qty')) {
                    $data = array(
                        'id' => $this->request->getPost('product_id'),
                        'qty' => $this->request->getPost('qty'),
                        'price' => $this->request->getPost('price'),
                        'name' => strrev($product_name),
                        'options' => array('Point' => $this->request->getPost('point'))
                    );
                    $this->cart->insert($data);
                } else {
                    $this->session->setFlashdata('message', '<p class="error">Sorry! We don\'t have that amount of product. We have max (' . $existing_qty . ') Products of the iteam: ' . $product_name . '<p>');
                }
            }

            $empty = $this->request->getPost('empty');
            if (isset($empty)) {
                $this->cart->destroy();
            }


            $data['globalSettingsModel'] = $this->globalSettingsModel;
            $data['cart'] = $this->cart;
            $data['dwn_path'] = base_url() . "/uploads/downloads/";
            $data['timthumb'] = "/assets/timthumb.php";
            $data['pro_path'] = "/uploads/pro_image/";

            $downloads = DB()->table('downloads');
            $sdow = $downloads->where('cat_id', '5')->get();
            $notice_list = $sdow->getResult();

            $downl = DB()->table('downloads');
            $notiCount = $downl->where('cat_id', '5')->countAllResults();
            if ($notiCount > 0) {
                $data['list_notice'] = $notice_list;
            } else {
                $data['list_notice'] = 'No notice published';
            }

            $data['footer_widget_title'] = $this->functionModel->show_widget('title', 8);
            $data['footer_widget_description'] = $this->functionModel->show_widget('description', 8);

            $data['footer_widget2_title'] = $this->functionModel->show_widget('title', 9);
            $data['footer_widget2_description'] = $this->functionModel->show_widget('description', 9);

            $data['page_title'] = 'home';
            $data['slider'] = '';


            $role = $this->session->role;
            $userId = $this->session->user_id;
            if (($clientLogin == true) && ($role == 4)) {
                $data['log_url'] = 'member_form/logout';
                $data['log_title'] = 'Logout';
                $data['check_user'] = $clientLogin;
                $data['ID'] = $this->session->user_id;
                $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $userId);
                $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $userId);
                $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $userId);
                $data['gameBalance'] = get_field_by_id_from_table('users', 'OP_game_balance', 'ID', $userId);
                $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $userId);
                $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $userId);
                $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $userId);
                $data['user_id'] = $this->session->user_id;

                $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
                $data['sidebar_right'] = view('Front/Client_area/Agent/sidebar-right', $data);
                $pro = DB()->table('products');
                $products = $pro->where('quantity >', 0)->get();
                $data['pro_query'] = $products->getResult();

                echo view('Front/Client_area/header', $data);
                echo view('Front/Client_area/Agent/product_sale', $data);
                echo view('Front/Client_area/footer', $data);

            } else {
                return redirect()->to(site_url("Member/dashboard"));
            }


        }
    }

    public function buy()
    {
        $clientLogin = $this->session->isLoggedInClient;
        if (!isset($clientLogin) || $clientLogin != TRUE) {
            return redirect()->to(site_url("Member_form/login"));
        } else {
            $data['msg'] = '';
            $new_point = 0;
            $new_balance = 0;

            foreach ($this->cart->contents() as $item) {
                $product_into[$item['id']] = $item['qty'];
                $new_point = $new_point + ($item['options']['Point'] * $item['qty']); // Count Point with quantity of each products
            }
            $productInfo = json_encode($product_into);

            if (isset($_POST['confirm'])) {

                $sessionId = $this->session->user_id;
                $totalamount = $this->request->getPost('totalamount');
                $userID = get_ID_by_username($this->request->getPost('username'));

                $agentBl = get_field_by_id_from_table('users', 'balance', 'ID', $sessionId);

                if ($agentBl >= $totalamount) {
                    DB()->transStart();
                    //sales insert
                    $saleProduct = array(
                        'u_id' => $userID,
                        'agent_id' => $sessionId,
                        'amount' => $totalamount,
                        'pro_info' => $productInfo,
                    );
                    $sales = DB()->table('sales');
                    $sales->insert($saleProduct);


                    //user balance update

                    $Balance = get_field_by_id_from_table('users', 'balance', 'ID', $sessionId);
                    $agentBalance = $Balance - $totalamount;

                    $value = array('balance' => $agentBalance);
                    $userBal = DB()->table('users');
                    $userBal->where('ID', $sessionId)->update($value);


                    //admin balance update

                    $adminBal = get_field_by_id_from_table('users', 'balance', 'ID', 1);
                    $adminBalance = $adminBal + $totalamount;

                    $adminvalue = array('balance' => $adminBalance);
                    $adusers = DB()->table('users');
                    $adusers->where('ID', 1)->update($adminvalue);


                    //user Point update
                    $usersBy = DB()->table('users');
                    $point = $usersBy->selectSum('point')->where('ID',$userID)->get()->getRow()->point;

                    $totalpoint = $point + $new_point;
                    $pointdata = array('point' => $totalpoint);
                    $poinUser = DB()->table('users');
                    $poinUser->where('ID', $userID)->update($pointdata);


                    //user status update Point
                    $active_amount = get_field_by_id_from_table('global_settings', 'value', 'title', 'active_amount');
                    $salesSum = DB()->table('sales');
                    $usbala = $salesSum->selectSum('amount')->where('u_id',$userID)->get()->getRow()->amount;
                    $userbalance = $usbala;
                    if ($userbalance >= $active_amount) {
                        $userdata = array('status' => 'Active');
                        $upUser = DB()->table('users');
                        $upUser->where('ID', $userID)->update($userdata);
                    }
                    DB()->transComplete();
                    $this->cart->destroy();
                    $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Successfully Purchased</div>');
                    return redirect()->to(site_url("Agent/product_sale"));
                    redirect(site_url('agent/product_sale/'));
                } else {
                    $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissable text-center "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Your Balance Is Too Low</div>');
                    return redirect()->to(site_url("Agent/product_sale"));
                }


            }


            $data['globalSettingsModel'] = $this->globalSettingsModel;
            $data['cart'] = $this->cart;
            $data['dwn_path'] = base_url() . "/uploads/downloads/";
            $data['timthumb'] = "/assets/timthumb.php";
            $data['pro_path'] = "/uploads/pro_image/";

            $downloads = DB()->table('downloads');
            $sdow = $downloads->where('cat_id', '5')->get();
            $notice_list = $sdow->getResult();

            $downl = DB()->table('downloads');
            $notiCount = $downl->where('cat_id', '5')->countAllResults();
            if ($notiCount > 0) {
                $data['list_notice'] = $notice_list;
            } else {
                $data['list_notice'] = 'No notice published';
            }

            $data['footer_widget_title'] = $this->functionModel->show_widget('title', 8);
            $data['footer_widget_description'] = $this->functionModel->show_widget('description', 8);

            $data['footer_widget2_title'] = $this->functionModel->show_widget('title', 9);
            $data['footer_widget2_description'] = $this->functionModel->show_widget('description', 9);

            $data['page_title'] = 'home';
            $data['slider'] = '';

            $userId = $this->session->user_id;
            $data['log_url'] = 'member_form/logout';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $clientLogin;
            $data['ID'] = $this->session->user_id;
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $userId);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $userId);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $userId);
            $data['gameBalance'] = get_field_by_id_from_table('users', 'OP_game_balance', 'ID', $userId);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $userId);
            $data['point'] = get_field_by_id_from_table('users', 'point', 'ID', $userId);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $userId);
            $data['user_id'] = $this->session->user_id;

            $data['sidebar_left'] = view('Front/Client_area/sidebar-left', $data);
            $data['sidebar_right'] = view('Front/Client_area/Agent/sidebar-right', $data);

            $pro = DB()->table('products');
            $products = $pro->get();
            $data['pro_query'] = $products->getResult();

            echo view('Front/Client_area/header', $data);
            echo view('Front/Client_area/Agent/buy', $data);
            echo view('Front/Client_area/footer', $data);


        }

    }


}
