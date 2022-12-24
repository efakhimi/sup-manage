<?php

namespace App\Http\Controllers;

use App\Models\SupportRequest;
use App\Models\Customer;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = SupportRequest::with('customer','category','user')->paginate(20);
        return view('support/list', [
            'requests' => $requests
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $query = Customer::with('contracts');
        $query->where(function($query) {
            $query->whereHas('contracts', function($q){
                $q->where('status', '1');
            });
            $query->whereHas('contracts', function($q){
                $q->where('end_date', '>=', date("Y-m-d"));
            });
        });
        $customers = $query->where('status', 'فعال')->get();
        
        $categories = Category::where('active', '1')->get();
        return view('support/new', [
            'customers' => $customers,
            'categories' => $categories
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
            'customer_id' => 'required|integer|min:1|exists:customers,id',
            'category_id' => 'required|integer|min:1|exists:categories,id',
            'title' => 'nullable|string|max:50|min:4',
            'callername' => 'nullable|string|max:50|min:3',
            'callertell' => 'nullable|string|max:50|min:3',
            'desc' => 'nullable|string|max:255|min:3',
        ]);

        $supportRequest = new SupportRequest();
        $supportRequest->customer_id = $request->customer_id;
        $supportRequest->category_id = $request->category_id;
        $supportRequest->title = $request->title;
        $supportRequest->callername = $request->callername;
        $supportRequest->callertell = $request->callertell;
        $supportRequest->desc = $request->desc;
        $supportRequest->user_id = Auth::User()->id;
        $supportRequest->start_date = date("Y/m/d H:i");
        $supportRequest->save();
        
        return redirect(route('supportList'))->with('status', 'ثبت با موفقیت انجام شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupportRequest  $supportRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == null)
            return redirect(route('supportList'))->with('statusErr', 'برای مشاهده باید یک قرارداد انتخاب کرده باشید.');

        $supportRequest = SupportRequest::with('customer','category','user')->where('id', $id)->first();
        if($supportRequest == null)
            return redirect(route('supportList'))->with('statusErr', 'قرارداد مورد نظر یافت نشد.');
        
        $otherSupportRequest = SupportRequest::with('customer','category','user')->where('customer_id', $supportRequest->customer_id)->where('id', '!=', $id)->orderby('id', 'DESC')->get();
        return view('support/show', [
            'supportRequest' => $supportRequest,
            'otherSupportRequest' => $otherSupportRequest,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupportRequest  $supportRequest
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        if($id == null)
            return redirect(route('supportList'))->with('statusErr', 'برای ویرایش باید یک درخواست انتخاب کرده باشید.');

        $supportRequest = SupportRequest::with('customer','category','user')->where('id', $id)->first();
        if($supportRequest == null)
            return redirect(route('supportList'))->with('statusErr', 'درخواست مورد نظر یافت نشد.');
        
        return view('support/edit', [
            'supportRequest' => $supportRequest
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupportRequest  $supportRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id == null)
            return redirect(route('supportList'))->with('statusErr', 'برای ویرایش باید یک درخواست انتخاب کرده باشید.');

        $validated = $request->validate([
            'title' => 'nullable|string|max:50|min:4',
            'callername' => 'nullable|string|max:50|min:3',
            'callertell' => 'nullable|string|max:50|min:3',
            'desc' => 'nullable|string|max:255|min:3',
        ]);
        
        $contract = SupportRequest::where('id', $id)->first();
        if($contract == null)
            return redirect(route('supportList'))->with('statusErr', 'درخواست مورد نظر یافت نشد.');
            
        SupportRequest::where('id', $id)->update([
            'title'=> $request->title,
            'callername'=> $request->callername,
            'callertell'=> $request->callertell,
            'desc'=> $request->desc,
        ]);
        return redirect(route('supportList'))->with('status', 'درخواست مورد نظر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupportRequest  $supportRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == null)
            return redirect(route('supportList'))->with('statusErr', 'برای حذف باید یک درخواست انتخاب کرده باشید.');

        $supportRequest = SupportRequest::where('id', $id)->first();
        if($supportRequest == null)
            return redirect(route('supportList'))->with('statusErr', 'درخواست مورد نظر یافت نشد.');
            
        SupportRequest::where('id', $id)->delete();
        return redirect(route('supportList'))->with('status', 'درخواست مورد نظر با موفقیت حذف شد.');
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
            return redirect(route('supportList'))->with('statusErr', 'برای ویرایش باید یک درخواست انتخاب کرده باشید.');

        $supportRequest = SupportRequest::where('id', $id)->first();
        if($supportRequest == null)
            return redirect(route('supportList'))->with('statusErr', 'درخواست مورد نظر یافت نشد.');
            
        if($supportRequest->end_date == null or $supportRequest->solved  == "")
            SupportRequest::where('id', $id)->update([
                'end_date'=> date("Y/m/d H:i"),
                'solved'=> ($supportRequest->solved ^ 1)
            ]);
        else
            return redirect(route('supportList'))->with('statusErr', 'خاتمه درخواست مورد نظر قبلا ثبت شده است.');
        return redirect(route('supportList'))->with('status', 'درخواست مورد نظر با موفقیت ویرایش شد.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function setEnd($id)
    {
        if($id == null)
            return redirect(route('supportList'))->with('statusErr', 'برای ویرایش باید یک درخواست انتخاب کرده باشید.');

        $supportRequest = SupportRequest::where('id', $id)->first();
        if($supportRequest == null)
            return redirect(route('supportList'))->with('statusErr', 'درخواست مورد نظر یافت نشد.');

        if($supportRequest->end_date == null or $supportRequest->solved  == "")
            SupportRequest::where('id', $id)->update([
                'end_date'=> date("Y/m/d H:i")
            ]);
        else
            return redirect(route('supportList'))->with('statusErr', 'خاتمه درخواست مورد نظر قبلا ثبت شده است.');
        return redirect(route('supportList'))->with('status', 'درخواست مورد نظر با موفقیت ویرایش شد.');
    }
}