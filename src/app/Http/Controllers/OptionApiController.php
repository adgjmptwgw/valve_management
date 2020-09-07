<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ValveOption;
use App\Http\Requests\StoreOption;

class OptionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOption $request, $id)
    {
        // ddd($request);
        // $validator = Validator::make($request->all(), [
            
        // ]);

        // if ($validator->fails()) {
        //     return redirect()
        //         ->route('SystemD.index')
        //         ->withInput()
        //         ->withErrors($validator);
        // }

        $valveOption = ValveOption::find($id);
        // $valveOption->valve_name = 'CWP出口弁';
        if ($request->valve_state == !NULL) {
            $valveOption->valve_state = $request->valve_state;
        }
        if ($request->valve_lock == !NULL) {
            $valveOption->valve_lock = $request->valve_lock;
        }
        if ($request->valve_memo == !NULL) {
            $valveOption->valve_memo = $request->valve_memo;
        }
        if ($request->operator == !NULL) {
            $valveOption->operator = '楠本';
        }
        $valveOption->save();
        // return redirect()->route('SystemD.index');
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
