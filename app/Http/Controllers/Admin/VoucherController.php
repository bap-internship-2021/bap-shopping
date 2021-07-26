<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Voucher\CreateVoucherRequest;
use App\Http\Requests\Voucher\UpdateVoucherRequest;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::orderBy('id', 'DESC')->paginate(5);
        return view('admin.voucher.index')->with('vouchers', $vouchers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVoucherRequest $request)
    {
        $data = $request->except(['_method', '_token']);
        Voucher::create($data);
        return back()->with('status', 'create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voucher = Voucher::find($id);
        return view('admin.voucher.show', compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voucher = Voucher::find($id);
        return view('admin.voucher.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoucherRequest $request, $id)
    {
        $voucher = Voucher::find($id);
        $data = $request->except(['_method', '_token']);
        $voucher->update($data);
        return back()->with('status', 'update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
