<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ValveOption;
use App\Http\Requests\StoreOption;
// use App\Tag;
// use App\Http\Requests\StoreTag;

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
        $valveOption = ValveOption::find($id);
        // $valveOption->valve_name = 'CWP出口弁';
        if ($request->valve_name == !NULL) {
            $valveOption->valve_name = $request->valve_name;
        }
        if ($request->valve_number == !NULL) {
            $valveOption->valve_number = $request->valve_number; 
        }
        if ($request->valve_usually_state == !NULL) {
            $valveOption->valve_usually_state = $request->valve_usually_state;
        }
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

    // public function updateTag(StoreTag $request, $id)
    // {
    //     $tag = Tag::find($id);
    //     if ($request->content == !NULL) {
    //         $tag->content = $request->content;
    //     }
    //     if ($request->width == !NULL) {
    //         $tag->width = $request->width;
    //     }
    //     if ($request->height == !NULL) {
    //         $tag->height = $request->height;
    //     }
    //     if ($request->visibility == !NULL) {
    //         $tag->visibility = $request->visibility;
    //     }
    //     $tag->save();
    // }

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
