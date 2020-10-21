<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Tag;
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
        // あいまい検索でcategoryカラムの中から、系統図番号に合うものだけを引っ張ってくる。

        // <1号ボイラの弁データ>

        $U1_B4 = ValveOption::orderBy('id', 'asc')->where('category', 'like', '%B-4%')->get();
        $U1_B5 = ValveOption::orderBy('id', 'asc')->where('category', 'like', '%B-5%')->get();
        // $U1_B5 = ValveOption::orderBy('id', 'asc')->find([1, 2, 3, 4, 5]);
        $U1_B9 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B11 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B17 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B18 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B19 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B20 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B21 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B23 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B24 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B27 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B30 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B31 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B34 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B36 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B37 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B38 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_B41 = ValveOption::orderBy('id', 'asc')->find([1]);

        // <1号タービンの弁データ>
        $U1_T3 = ValveOption::orderBy('id', 'asc')->find([1, 2, 3, 4, 5]);
        $U1_T4 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T5 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T6 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T7 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T8 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T9 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T10 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T11 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T12 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T13 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T16 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T19 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T20 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T25 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T26 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T28 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T30 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T31 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T32 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T33 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_T36 = ValveOption::orderBy('id', 'asc')->find([1]);

        // <1号電気の弁データ>
        $U1_E27 = ValveOption::orderBy('id', 'asc')->find([1, 2, 3, 4, 5]);
        $U1_E29 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_E30 = ValveOption::orderBy('id', 'asc')->find([1]);
        $U1_E31 = ValveOption::orderBy('id', 'asc')->find([1]);

        // <付箋データ>
        $Tag = Tag::orderBy('id', 'asc')->get();

        // 配列データをjson形式に変換
        // <1号ボイラ>
        $ValveOptions_U1_B4 = json_encode($U1_B4);
        $ValveOptions_U1_B5 = json_encode($U1_B5);
        $ValveOptions_U1_B9 = json_encode($U1_B9);
        $ValveOptions_U1_B11 = json_encode($U1_B11);
        $ValveOptions_U1_B17 = json_encode($U1_B17);
        $ValveOptions_U1_B18 = json_encode($U1_B18);
        $ValveOptions_U1_B19 = json_encode($U1_B19);
        $ValveOptions_U1_B20 = json_encode($U1_B20);
        $ValveOptions_U1_B21 = json_encode($U1_B21);
        $ValveOptions_U1_B23 = json_encode($U1_B23);
        $ValveOptions_U1_B24 = json_encode($U1_B24);
        $ValveOptions_U1_B27 = json_encode($U1_B27);
        $ValveOptions_U1_B30 = json_encode($U1_B30);
        $ValveOptions_U1_B31 = json_encode($U1_B31);
        $ValveOptions_U1_B34 = json_encode($U1_B34);
        $ValveOptions_U1_B36 = json_encode($U1_B36);
        $ValveOptions_U1_B37 = json_encode($U1_B37);
        $ValveOptions_U1_B38 = json_encode($U1_B38);
        $ValveOptions_U1_B41 = json_encode($U1_B41);

        // <1号タービン>
        $ValveOptions_U1_T3 = json_encode($U1_T3);
        $ValveOptions_U1_T4 = json_encode($U1_T4);
        $ValveOptions_U1_T5 = json_encode($U1_T5);
        $ValveOptions_U1_T6 = json_encode($U1_T6);
        $ValveOptions_U1_T7 = json_encode($U1_T7);
        $ValveOptions_U1_T8 = json_encode($U1_T8);
        $ValveOptions_U1_T9 = json_encode($U1_T9);
        $ValveOptions_U1_T10 = json_encode($U1_T10);
        $ValveOptions_U1_T11 = json_encode($U1_T11);
        $ValveOptions_U1_T12 = json_encode($U1_T12);
        $ValveOptions_U1_T13 = json_encode($U1_T13);
        $ValveOptions_U1_T16 = json_encode($U1_T16);
        $ValveOptions_U1_T19 = json_encode($U1_T19);
        $ValveOptions_U1_T20 = json_encode($U1_T20);
        $ValveOptions_U1_T25 = json_encode($U1_T25);
        $ValveOptions_U1_T26 = json_encode($U1_T26);
        $ValveOptions_U1_T28 = json_encode($U1_T28);
        $ValveOptions_U1_T30 = json_encode($U1_T30);
        $ValveOptions_U1_T31 = json_encode($U1_T31);
        $ValveOptions_U1_T32 = json_encode($U1_T32);
        $ValveOptions_U1_T33 = json_encode($U1_T33);
        $ValveOptions_U1_T36 = json_encode($U1_T36);

        // <1号電気>
        $ValveOptions_U1_E27 = json_encode($U1_E27);
        $ValveOptions_U1_E29 = json_encode($U1_E29);
        $ValveOptions_U1_E30 = json_encode($U1_E30);
        $ValveOptions_U1_E31 = json_encode($U1_E31);

        // <付箋データ>
        $TagsData = json_encode($Tag);

        // 上記のjson配列データをSystemListへ送信
        return view('SystemList')->with(
            [
                // <1号ボイラ>
                'ValveData_U1_B4' => $ValveOptions_U1_B4,
                'ValveData_U1_B5' => $ValveOptions_U1_B5,
                'ValveData_U1_B9' => $ValveOptions_U1_B9,
                'ValveData_U1_B11' => $ValveOptions_U1_B11,
                'ValveData_U1_B17' => $ValveOptions_U1_B17,
                'ValveData_U1_B18' => $ValveOptions_U1_B18,
                'ValveData_U1_B19' => $ValveOptions_U1_B19,
                'ValveData_U1_B20' => $ValveOptions_U1_B20,
                'ValveData_U1_B21' => $ValveOptions_U1_B21,
                'ValveData_U1_B23' => $ValveOptions_U1_B23,
                'ValveData_U1_B24' => $ValveOptions_U1_B24,
                'ValveData_U1_B27' => $ValveOptions_U1_B27,
                'ValveData_U1_B30' => $ValveOptions_U1_B30,
                'ValveData_U1_B31' => $ValveOptions_U1_B31,
                'ValveData_U1_B34' => $ValveOptions_U1_B34,
                'ValveData_U1_B36' => $ValveOptions_U1_B36,
                'ValveData_U1_B37' => $ValveOptions_U1_B37,
                'ValveData_U1_B38' => $ValveOptions_U1_B38,
                'ValveData_U1_B41' => $ValveOptions_U1_B41,

                // <1号タービン>
                'ValveData_U1_T3' => $ValveOptions_U1_T3,
                'ValveData_U1_T4' => $ValveOptions_U1_T4,
                'ValveData_U1_T5' => $ValveOptions_U1_T5,
                'ValveData_U1_T6' => $ValveOptions_U1_T6,
                'ValveData_U1_T7' => $ValveOptions_U1_T7,
                'ValveData_U1_T8' => $ValveOptions_U1_T8,
                'ValveData_U1_T9' => $ValveOptions_U1_T9,
                'ValveData_U1_T10' => $ValveOptions_U1_T10,
                'ValveData_U1_T11' => $ValveOptions_U1_T11,
                'ValveData_U1_T12' => $ValveOptions_U1_T12,
                'ValveData_U1_T13' => $ValveOptions_U1_T13,
                'ValveData_U1_T16' => $ValveOptions_U1_T16,
                'ValveData_U1_T19' => $ValveOptions_U1_T19,
                'ValveData_U1_T20' => $ValveOptions_U1_T20,
                'ValveData_U1_T25' => $ValveOptions_U1_T25,
                'ValveData_U1_T26' => $ValveOptions_U1_T26,
                'ValveData_U1_T28' => $ValveOptions_U1_T28,
                'ValveData_U1_T30' => $ValveOptions_U1_T30,
                'ValveData_U1_T31' => $ValveOptions_U1_T31,
                'ValveData_U1_T32' => $ValveOptions_U1_T32,
                'ValveData_U1_T33' => $ValveOptions_U1_T33,
                'ValveData_U1_T36' => $ValveOptions_U1_T36,

                // <1号電気>
                'ValveData_U1_E27' => $ValveOptions_U1_E27,
                'ValveData_U1_E29' => $ValveOptions_U1_E29,
                'ValveData_U1_E30' => $ValveOptions_U1_E30,
                'ValveData_U1_E31' => $ValveOptions_U1_E31,

                // <付箋データ>
                'TagsData' => $TagsData
            ]
        );
    }

    public function HomeIndex()
    {
        return view('home');
    }
    public function HistoryIndex()
    {
        return view('History');
    }

    public function Index()
    {
        // $ValveOptionsの変数にValveOptionモデルから取ってきたデータをid順に昇順で代入する。
        $ValveOptions = ValveOption::orderBy('id', 'asc')->get();

        //  ddd($ValveOptions);
        //   ※$ValveOptionsのデータの中身を確認。
        // ValveOptionという名前のオブジェクトに$ValveOptionsを代入する。このオブジェクトはview以下で使用。
        return view('SystemD', [
            'ValveOptions' => $ValveOptions,
        ]);
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
        $valveOption->valve_number = 'SW-1';
        $valveOption->valve_usually_state = '開';
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
