<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class CurrenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.currencies.index')->with('currencies',Currency::withTrashed()->get());
        }
        else{
            return view('admin.currencies.index')->with('currencies',Currency::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'sign'=>'required',
            'rate'=>'required'
        ]);


        $currency=Currency::create([
            'name'=>$request->name,
            'sign'=>$request->sign,
            'rate'=>$request->rate,
        ]);

        Session::flash('success','Currency added successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency=Currency::find($id);
        return view('admin.currencies.edit')->with('currency', $currency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required',
            'sign'=>'required',
            'rate'=>'required'
        ]);
        $currency=Currency::find($id);
        $currency->name=$request->name;
        $currency->sign=$request->sign;
        $currency->rate=$request->rate;
        $currency->save();
        Session::flash('success', 'Currency updated successfully');
        return redirect()->route('currencies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency=Currency::find($id);
        $currency->delete();
        Session::flash('success','The currency data was just trashed.');
        return redirect()->back();
    }
}
