<?php

namespace App\Http\Controllers;

use App\Addresse;
use App\Customer;
use App\CustomerCompany;
use App\Phone;
use App\User;
use App\Company;
use Request;
// use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use DB;
class RoutingController extends Controller
{


    // public function __construct()
    // {
    //     $this->middleware('auth')->except('index');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Display a view based on first route param
     *
     * @return \Illuminate\Http\Response
     */
    public function root($first = '')
    {
        if ($first != 'assets' && empty($first) === false)
            return view($first);

        if(empty($first) === true)
            return redirect('crm/users');

        return view('index');
    }

    /**
     * second level route
     */
    public function secondLevel($first='crm', $second='customers')
    {
        $request = Request::instance();
        // exit;
        $users = User::where('id','<>',0)->paginate(10);
        $filters = $request->input('filters');

        $customers = Customer::where('customers.id','<>',0)
        ->leftJoin('companies', 'customers.cc_id', '=', 'companies.id')
        ->select('customers.id', 'customers.first_name', 'customers.representative', 'customers.last_name', 'companies.name', 'companies.purchase_date', 'companies.share_amount');


        if (!empty($filters)) {
            $purchase_date = $request->input('purchase_s_date');
            if(!empty($purchase_date) && empty($purchase_e_date)){
                $purchase_date = date('Y-m-d', strtotime($request->input('purchase_s_date')));
                $customers = $customers->where('companies.purchase_date', '=', $purchase_date);
            }
            if(!empty($purchase_date) && !empty($purchase_e_date)){
                $purchase_date = date('Y-m-d', strtotime($request->input('purchase_s_date')));
                $customers = $customers->where('companies.purchase_date', '>=', $purchase_date);
            }
            $purchase_e_date = $request->input('purchase_e_date');
            if(!empty($purchase_e_date)){
                $purchase_e_date = date('Y-m-d', strtotime($request->input('purchase_e_date')));
                $customers = $customers->where('companies.purchase_date', '<=', $purchase_e_date);
            }
            $state = $request->input('state');
            if(!empty($state)){
                $customers = $customers->WhereHas('addresses', function($customers) use ($state){
                    return $customers->where('state', 'LIKE', "%".$state."%");
                });
            }
            $zip = $request->input('zip_code');
            if(!empty($zip)){
                $customers = $customers->WhereHas('addresses', function($customers) use ($zip){
                    return $customers->where('zip', 'LIKE', "%".$zip."%");
                });
            }
            if(!empty($zip)){

            }
            $fund = $request->input('fund_no');
            if(!empty($fund)){
                // echo $fund;exit;
                $customers = $customers->where('fund', $fund);
            }
            $company = $request->input('company');
            if(!empty($company)){
                $customers = $customers->where('companies.name', $company);
            }

        }
        $customers = $customers->paginate(100);
        /*$customers = $customer->where('customers.id','<>',0)->leftJoin('companies', 'customers.cc_id', '=', 'companies.id')
            ->select('customers.id', 'customers.first_name', 'customers.representative', 'customers.last_name', 'companies.name', 'companies.purchase_date', 'companies.share_amount')->paginate(10);*/
        $companies = Company::where('id','<>',0)->get();
        $accout_types = array('Individual','Joint','Corporate','Trust','IRA','IRA – Midland','Custodial Midland');
        // echo 'asndad'.$first.$second;exit;
        if ($first != 'assets')
            return view($first.'.'.$second, compact('users', 'customers', 'companies', 'accout_types'));
        return view('index');
    }

    /**
     * third level route
     */
    public function thirdLevel($first, $second, $third)
    {
        if ($first != 'assets'){
            if($second == "delete"){
                if($first == "users"){
                    $delete = User::find($third);
                }
                if($first == "customers"){
                    $delete = Customer::find($third);
                }
                $delete->delete();
                return redirect('crm/'.$first);
            }
            else{
                if((int) $third > 0){
                    $user = array();$customer = array();$addresses = array();$phones = array();$companies = array();
                    $company = array();$company_ids = array();
                    if($first == "users"){
                        $user = User::where('id',$third)->first();
                    }
                    if($first == "customers"){
                        $customer = Customer::where('id',$third)->first();
                        $addresses = Addresse::where('customer_id',$customer->id)->get();
                        $phones = Phone::where('customer_id',$customer->id)->get();
                        $companies = Company::where('id','<>',0)->get();
                        $customer_companies = CustomerCompany::where('customer_id',$third)->select(DB::raw('GROUP_CONCAT(company_id) AS company_ids'))->get();
                        if(isset($customer_companies) && empty($customer_companies[0]) === false){
                            $company_ids = explode(',',$customer_companies[0]->company_ids);
                        }
                    }
                    if($first == "companies"){
                        $company = Company::where('id',$third)->first();
                    }
                    $accout_types = array('Individual','Joint','Corporate','Trust','IRA','IRA – Midland','Custodial Midland');
                    return view($first.'.'.$second, compact('user', 'customer', 'addresses', 'phones', 'companies', 'accout_types', 'company', 'company_ids'));
                }
            }
            return view($first.'.'.$second.'.'.$third);
        }
        return view('index');
    }
}
