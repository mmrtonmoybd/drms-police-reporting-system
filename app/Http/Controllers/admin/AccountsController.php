<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Category;
use App\Models\PaymentMethod;
use Carbon\Carbon;
use Session;

class AccountsController extends Controller
{
    //This method for get all accounts
    public function Index(Request $request){
        $session_user = Session::get('user');
        $query = Account::query();

        if( $cat_id = $request->get('cat_id'))
            $query->where('cat_id', $cat_id);

        if( $payment_method = $request->get('payment_method'))
            $query->where('payment_method', $payment_method);

        if($from_date = $request->get('from_date')){
            $new_date = Carbon::createFromFormat('d/m/Y',$from_date)->format('Y-m-d H:i:s');
            $query->where('created_at', '>=', date('Y-m-d 0:0:0', strtotime($new_date)));
        }
        if($to_date = $request->get('to_date')){
            $new_to_date = Carbon::createFromFormat('d/m/Y',$to_date)->format('Y-m-d H:i:s');
            $query->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($new_to_date)));
        }

        $query->with('category');
        $query->orderBy('id', 'DESC');
            
        $data['categories'] = Category::get();
        $data['payment_methods'] = PaymentMethod::get();
        $data['accounts'] = $query->paginate(20);
        $data['debit'] = $this->TotalAmount($request, 'debit');
        $data['credit'] = $this->TotalAmount($request, 'credit');
        $data['request'] =  $request;
        return view('admin/account/accounts', $data);
    }
    
    
    protected function TotalAmount($request, $type=null){
        $query = Account::query();

        if( $type)
            $query->where('type', $type);
        if( $cat_id = $request->get('cat_id'))
            $query->where('cat_id', $cat_id);

        if( $payment_method = $request->get('payment_method'))
            $query->where('payment_method', $payment_method);

        if($from_date = $request->get('from_date')){
            $new_date = Carbon::createFromFormat('d/m/Y',$from_date)->format('Y-m-d H:i:s');
            $query->where('created_at', '>=', date('Y-m-d 0:0:0', strtotime($new_date)));
        }
        if($to_date = $request->get('to_date')){
            $new_to_date = Carbon::createFromFormat('d/m/Y',$to_date)->format('Y-m-d H:i:s');
            $query->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($new_to_date)));
        }

        $query->with('category');
        $query->orderBy('id', 'DESC');
        
        return $query->sum('amount');
    }

    //this method for update account
    public function Create (Request $request){
        

        $validated = $request->validate([
            'created_at' => 'required',
            'cat_id' => 'required',
            'payment_method' => 'required',
            'type' => 'required',
            'amount' => 'required',
        ]);

        $insertAttr = [
            'created_at'=>$request->input('created_at'),
            'cat_id'=>$request->input('cat_id'),
            'payment_method'=>$request->input('payment_method'),
            'type'=>$request->input('type'),
            'amount'=>$request->input('amount'),
            'voucher'=>$request->input('voucher'),
            'comment'=>$request->input('comment'),
        ];

        if($request->input('created_at'))
            $insertAttr['created_at'] = Carbon::createFromFormat('d/m/Y',$request->input('created_at'))->format('Y-m-d H:i:s');
        else
            $insertAttr['created_at'] = null;

       
        if(Account::insert($insertAttr)){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/accounts');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        
        return redirect('admin/accounts');
    }

    //this method for edit account
    public function  Edit(Request $request, $id=null){
        $data= [];
        if(!$id or !is_numeric($id))
            return redirect('admin/accounts');
        $data['account'] = Account::where('id', $id)->first();
        if(!$data['account'])
            return redirect('admin/accounts');


        $session_user = Session::get('user');
        $query = Account::query();
        $query->with('category');
        $query->orderBy('id', 'DESC');
            
        $data['categories'] = Category::get();
        $data['payment_methods'] = PaymentMethod::get();
        $data['accounts'] = $query->paginate(20);
        $data['request'] =  $request;

        return view('admin/account/accounts', $data);
    }

    //this method for update account
    public function Update(Request $request, $id){

        $validated = $request->validate([
            'created_at' => 'required',
            'cat_id' => 'required',
            'payment_method' => 'required',
            'type' => 'required',
            'amount' => 'required',
        ]);

        $insertAttr = [
            'created_at'=>$request->input('created_at'),
            'cat_id'=>$request->input('cat_id'),
            'payment_method'=>$request->input('payment_method'),
            'type'=>$request->input('type'),
            'amount'=>$request->input('amount'),
            'voucher'=>$request->input('voucher'),
            'comment'=>$request->input('comment'),
        ];

        if($request->input('created_at'))
            $insertAttr['created_at'] = Carbon::createFromFormat('d/m/Y',$request->input('created_at'))->format('Y-m-d H:i:s');
        else
            $insertAttr['created_at'] = null;

       
        if(Account::where('id', $id)->update($insertAttr)){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/accounts');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        
        return redirect('admin/accounts');
    }


    
    //this method for  accounts delete
    public function Delete(Request $request, $id=null){
        if(!$id or !is_numeric($id))
            return redirect('admin/accounts');

        
        $session_user = Session::get('user');
        if($session_user['type']!='Admin'){
            $request->session()->flash('error_msg', 'You don\'t have permission to delete any data');
            return redirect('admin/dashboard');
        }

        if(Account::where('id', $id)->delete()){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/accounts');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/accounts');
        }
        return redirect('admin/accounts');
    }






    /*
    =================================================================================================
                            Category Update Section
    =================================================================================================
    */

    //This method for get all accounts
    public function CategoryIndex(Request $request){
        $session_user = Session::get('user');
        $query = Category::query();
        
        $query->orderBy('id', 'DESC');
            
        $data['categories'] = $query->paginate(20);
        $data['request'] =  $request;
        return view('admin/account/categories', $data);
    }

    //this method for update account
    public function CategoryCreate (Request $request){
        

        $validated = $request->validate([
            'name' => 'required',
        ]);

        $insertAttr = [
            'name'=>$request->input('name'),
            
        ];

       
        if(Category::insert($insertAttr)){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/accounts/category');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        
        return redirect('admin/accounts/category');
    }

    //this method for edit account
    public function  CategoryEdit(Request $request, $id=null){
        $data= [];
        if(!$id or !is_numeric($id))
            return redirect('admin/accounts');
        $data['category'] = Category::where('id', $id)->first();
        if(!$data['category'])
            return redirect('admin/accounts/category');


        $session_user = Session::get('user');
        $query = Category::query();
        
        $query->orderBy('id', 'DESC');
            
        $data['categories'] = $query->paginate(20);
        $data['request'] =  $request;

        return view('admin/account/categories', $data);
    }

    //this method for update account
    public function CategoryUpdate(Request $request, $id){

        $validated = $request->validate([
            'name' => 'required',
        ]);

        $insertAttr = [
            'name'=>$request->input('name'),
           
        ];

     
       
        if(Category::where('id', $id)->update($insertAttr)){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/accounts/category');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        
        return redirect('admin/accounts/category');
    }


    
    //this method for  accounts delete
    public function CategoryDelete(Request $request, $id=null){
        if(!$id or !is_numeric($id))
            return redirect('admin/accounts');

        
        $session_user = Session::get('user');
        if($session_user['type']!='Admin'){
            $request->session()->flash('success_msg', 'You don\'t have permission to delete any data');
            return redirect('admin/dashboard');
        }

        if(Category::where('id', $id)->delete()){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/accounts/category');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/accounts/category');
        }
        return redirect('admin/accounts/category');
    }


}
