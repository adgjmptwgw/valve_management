<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\ValveOption;

class ValveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ListIndex()
    {
        // $ValveOptionsの変数にValveOptionモデルから取ってきたデータをid順に昇順で代入する。
        // $ValveOptions = ValveOption::orderBy('id', 'asc')->get();


        // $ValveOptions2 = ValveOption::orderBy('id', 'desc')->get();
        
        $T1 = ValveOption::orderBy('id', 'asc')->get();
        $ValveOptions = json_encode($T1);

        // ddd($ValveOptions);
        //   ※$ValveOptionsのデータの中身を確認。
        // ValveOptionという名前のオブジェクトに$ValveOptionsを代入する。このオブジェクトはview以下で使用。
        // return view('SystemList', [
        //     'ValveOptions' => $ValveOptions,
        //     'ValveOptions2' => $ValveOptions2
        // ]);

        return view('SystemList')->with('ValveOptions', $ValveOptions);
    }

    public function HomeIndex()
    {
        return view('Home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $validator = Validator::make($request->all(), [
            'valve_memo' => 'sometimes|max:50',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('SystemD.index')
                ->withInput()
                ->withErrors($validator);
        }
        // Eloquentモデル
        $valveOption = new ValveOption;
        $valveOption->valve_name = 'CWP出口弁';
        $valveOption->valve_state = '閉';
        $valveOption->valve_lock = '保安ロック';
        $valveOption->valve_memo = $request->valve_memo;
        $valveOption->operator = '楠本';
        $valveOption->save();
        // ルーティング「valveOptions.index」にリクエスト送信（一覧ページに移動）
        return redirect()->route('SystemD.index');
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
        // $ValveRecord = ValveOption::find($id);
        // return view('SystemD', ['ValveRecord' => $ValveRecord]);
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
        $validator = Validator::make($request->all(), [
            'valve_state' => 'sometimes|max:50',
            'valve_memo' => 'sometimes|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('SystemD.index')
                ->withInput()
                ->withErrors($validator);
        }

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
        return redirect()->route('SystemD.index');
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
