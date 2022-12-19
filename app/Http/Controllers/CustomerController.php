<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $customers = Customer::paginate(20);
        return view('customer/list', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer/new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cname' => 'required|string|max:50|min:2|unique:customers,cname',
            'ctell' => 'nullable|string|max:50|min:4',
            'caddress' => 'nullable|string|max:50|min:4',
            'techname' => 'nullable|string|max:50|min:4',
            'techtell' => 'nullable|string|max:50|min:4',
            'status' => 'required|string|in:فعال,غیرفعال,مسدود',
        ]);

        $customer = new Customer();
        $customer->cname = $request->cname;
        $customer->ctell = $request->ctell;
        $customer->caddress = $request->caddress;
        $customer->techname = $request->techname;
        $customer->techtell = $request->techtell;
        $customer->status = $request->status;
        $customer->save();
        
        return redirect(route('customerList'))->with('status', 'ثبت با موفقیت انجام شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        if($id == null)
            return redirect(route('customerList'))->with('statusErr', 'برای ویرایش باید یک مشتری انتخاب کرده باشید.');

        $customer = Customer::where('id', $id)->first();
        if($customer == null)
            return redirect(route('customerList'))->with('statusErr', 'مشتری مورد نظر یافت نشد.');
        
        return view('customer/edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id == null)
            return redirect(route('customerList'))->with('statusErr', 'برای ویرایش باید یک مشتری انتخاب کرده باشید.');

        $validated = $request->validate([
            'cname' => 'required|string|max:50|min:2|unique:customers,cname',
            'ctell' => 'nullable|string|max:50|min:4',
            'caddress' => 'nullable|string|max:50|min:4',
            'techname' => 'nullable|string|max:50|min:4',
            'techtell' => 'nullable|string|max:50|min:4',
            'status' => 'required|string|in:فعال,غیرفعال,مسدود',
        ]);
        
        $customer = Customer::where('id', $id)->first();
        if($customer == null)
            return redirect(route('customerList'))->with('statusErr', 'مشتری مورد نظر یافت نشد.');
            
        Customer::where('id', $id)->update([
            'cname'=> $request->cname,
            'ctell'=> $request->ctell,
            'caddress'=> $request->caddress,
            'techname'=> $request->techname,
            'techtell'=> $request->techtell,
            'status'=> $request->status,
        ]);
        return redirect(route('customerList'))->with('status', 'مشتری مورد نظر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == null)
            return redirect(route('customerList'))->with('statusErr', 'برای حذف باید یک مشتری انتخاب کرده باشید.');

        $customer = Customer::where('id', $id)->first();
        if($customer == null)
            return redirect(route('customerList'))->with('statusErr', 'مشتری مورد نظر یافت نشد.');
            
        Customer::where('id', $id)->delete();
        return redirect(route('customerList'))->with('status', 'مشتری مورد نظر با موفقیت حذف شد.');
    }
}
