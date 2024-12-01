<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Http\Requests\WeightLogsRequest;
use App\Http\Requests\WeightRequest;
use App\Http\Requests\RegisterRequest;


class WeightController extends Controller
{

    public function index()
    {
        $userId = Auth::id();


        // 必要な追加データ
        $targetWeight = WeightTarget::where('user_id', $userId)->value('target_weight') ?? 50.0;
        $weightLogs = WeightLog::where('user_id', $userId)->orderBy('date', 'desc')->paginate(8);

        $currentWeight = $weightLogs->first()->weight ?? 0; // 現在体重（最初のデータ）
        $remainingWeight = $targetWeight - $currentWeight; // 目標までの差

        return view('weight_logs', [
            'weightLogs' => $weightLogs,
            'targetWeight' => $targetWeight,
            'currentWeight' => $currentWeight,
            'remainingWeight' => $remainingWeight,
            'searchResults' => null,
            'searchCondition' => '',
    ]);
    }





    public function search(Request $request)
    {
        $userId = Auth::id();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');


        $query = WeightLog::where('user_id', $userId);

        if ($startDate) {
            $query->where('date', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('date', '<=', $endDate);
        }

        $searchResults = $query->orderBy('date', 'asc')->paginate(8);


        $searchCondition = '';
        if ($startDate || $endDate) {
            $searchCondition = ($startDate ? $startDate : '未指定') . ' 〜 ' . ($endDate ? $endDate : '未指定');
        } else {
            $searchCondition = '全期間';
        }

        return view('weight_logs', [
            'weightLogs' => $searchResults ?? collect(),
            'searchResults' => $searchResults ?? collect(),
            'searchCondition' => $searchCondition,
        ]);
    }



        public function edit($id)
    {
        $weightLog = WeightLog::find($id);

        if (!$weightLog) {
            abort(404, 'Weight log not found.');
        }

        return view('edit', ['weightLog' => $weightLog]);
    }

    public function update(WeightLogsRequest $request, $id)
    {
        $validated = $request->validated();

        $weightLog = WeightLog::find($id);

        if (!$weightLog) {
            abort(404, 'Weight log not found.');
        }

        $weightLog->update($validated);

        return redirect()->route('weight_logs')->with('success');
    }

    public function destroy($id)
    {
        $weightLog = WeightLog::find($id);

        if (!$weightLog) {
            abort(404, 'Weight log not found.');
        }

        $weightLog->delete();

        return redirect()->route('weight_logs')->with('success');
    }






    public function registerData(WeightLogsRequest $request)
    {
        $validated = $request->validated();

        WeightLog::create([
            'user_id' => Auth::id(),
            'date' => $validated['date'],
            'weight' => $validated['weight'],
            'calories' => $validated['calories'],
            'exercise_time' => $validated['exercise_time'],
            'exercise_content' => $validated['exercise_content'],
        ]);

        return redirect()->route('weight_logs')->with('success');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function add(){
        return view('add');
    }


    public function create(Request $request){
        $form = $request->all();
        Author::create($form);
        return redirect('/');
    }




    public function goalSetting()
    {
        $target_weight = WeightTarget::where('user_id', Auth::id())->value('target_weight');

        return view('goal-setting', [
            'target_weight' => $target_weight ?? 0,
        ]);
    }


    public function updateGoalSetting(Request $request, WeightRequest $weightRequest)
    {
        $rules = [
            'target_weight' => $weightRequest->rules()['target_weight'],
        ];

        $messages = [
            'target_weight.required' => $weightRequest->messages()['target_weight.required'],
            'target_weight.digits_between' => $weightRequest->messages()['target_weight.digits_between'],
            'target_weight.regex' => $weightRequest->messages()['target_weight.regex'],
        ];

        $validated = $request->validate($rules, $messages);

        $weightTarget = WeightTarget::updateOrCreate(
            ['user_id' => Auth::id()],
            ['target_weight' => $validated['target_weight']]
        );

        return redirect()->route('weight_logs');
    }




}
