<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::with('customer')->orderby('id', 'DESC')->get();
        return view('contract/list', [
            'contracts' => $contracts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('contract/new', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createForCustomer($id)
    {
        if($id == null)
            return redirect(route('contractList'))->with('statusErr', 'برای ثبت قرارداد باید یک مشتری انتخاب کرده باشید.');

        $customers = Customer::where('id', $id)->get();
        if($customers == null)
            return redirect(route('contractList'))->with('statusErr', 'مشتری مورد نظر یافت نشد.');
            
        return view('contract/new', [
            'customers' => $customers
        ]);
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
            'cid' => 'required|integer|min:1|exists:customers,id',
            'start_date' => 'required|string|max:50|min:4',
            'end_date' => 'required|string|max:50|min:4',
            'contract_no' => 'required|string|max:50|min:1',
        ]);
        
        $contract = new Contract();
        $contract->cid = $request->cid;
        $contract->start_date = \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d', \Morilog\Jalali\CalendarUtils::convertNumbers($request->start_date, true))->format('Y-m-d');
        $contract->end_date = \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d', \Morilog\Jalali\CalendarUtils::convertNumbers($request->end_date, true))->format('Y-m-d');
        $contract->contract_no = $request->contract_no;
        $contract->status = $request->status=="on" ? 1:0;
        $contract->save();
        
        return redirect(route('contractList'))->with('status', 'ثبت با موفقیت انجام شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == null)
            return redirect(route('contractList'))->with('statusErr', 'برای مشاهده باید یک قرارداد انتخاب کرده باشید.');

        $contract = Contract::with('customer')->where('id', $id)->first();
        if($contract == null)
            return redirect(route('contractList'))->with('statusErr', 'قرارداد مورد نظر یافت نشد.');
        
        $otherContracts = Contract::where('cid', $contract->cid)->where('id', '!=', $id)->orderby('id', 'DESC')->get();
        return view('contract/show', [
            'contract' => $contract,
            'otherContracts' => $otherContracts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        if($id == null)
            return redirect(route('contractList'))->with('statusErr', 'برای ویرایش باید یک قرارداد انتخاب کرده باشید.');

        $contract = Contract::where('id', $id)->first();
        if($contract == null)
            return redirect(route('contractList'))->with('statusErr', 'قرارداد مورد نظر یافت نشد.');
        
        return view('contract/edit', [
            'contract' => $contract
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id == null)
            return redirect(route('contractList'))->with('statusErr', 'برای ویرایش باید یک قرارداد انتخاب کرده باشید.');

        $validated = $request->validate([
            'start_date' => 'required|string|max:50|min:4',
            'end_date' => 'required|string|max:50|min:4',
            'contract_no' => 'required|string|max:50|min:1',
        ]);
        
        $contract = Contract::where('id', $id)->first();
        if($contract == null)
            return redirect(route('contractList'))->with('statusErr', 'قرارداد مورد نظر یافت نشد.');
            
        Contract::where('id', $id)->update([
            'start_date'=> \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d', \Morilog\Jalali\CalendarUtils::convertNumbers($request->start_date, true))->format('Y-m-d'),
            'end_date'=> \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d', \Morilog\Jalali\CalendarUtils::convertNumbers($request->end_date, true))->format('Y-m-d'),
            'contract_no'=> $request->contract_no,
            'status'=> $request->status=="on" ? 1:0,
        ]);
        return redirect(route('contractList'))->with('status', 'قرارداد مورد نظر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == null)
            return redirect(route('contractList'))->with('statusErr', 'برای حذف باید یک قرارداد انتخاب کرده باشید.');

        $contract = Contract::where('id', $id)->first();
        if($contract == null)
            return redirect(route('contractList'))->with('statusErr', 'قرارداد مورد نظر یافت نشد.');
            
        Contract::where('id', $id)->delete();
        return redirect(route('contractList'))->with('status', 'قرارداد مورد نظر با موفقیت حذف شد.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        if($id == null)
            return redirect(route('contractList'))->with('statusErr', 'برای ویرایش باید یک قرارداد انتخاب کرده باشید.');

        $contract = Contract::where('id', $id)->first();
        if($contract == null)
            return redirect(route('contractList'))->with('statusErr', 'قرارداد مورد نظر یافت نشد.');
            
        Contract::where('id', $id)->update([
            'status'=> ($contract->status ^ 1)
        ]);
        return redirect(route('contractList'))->with('status', 'قرارداد مورد نظر با موفقیت ویرایش شد.');
    }
}
