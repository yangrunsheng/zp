<?php

namespace App\Http\Controllers\Boll;

use App\Boll\Guess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GuessController extends Controller
{
    //
    public function add()
    {
        return view('boll.add');
    }

    public function doAdd(Request $request)
    {
        $params = $request->all();
        $guess = new Guess();
        $data = [
            'team_a' =>$params['team_a'],
            'team_b' =>$params['team_b'],
            'end_at' =>$params['end_at']
        ];
        $guess->add($data);
        return redirect('/boll/guess/list?user_id=1');
    }

    public function list(Request $request)
    {
        $params = $request->all();
        $guess = new Guess();
        $assign['list'] = $guess->getList();
        $assign['user_id'] = isset($params['user_id']) ?? 1;
        return view('boll.list',$assign);
    }

    public function guess(Request $request)
    {
        $params = $request->all();
        $guess = new Guess();
        $assign['info'] = $guess->getInfo($params['id']);
        $assign['user_id'] = isset($params['user_id']) ?? 1;
        return view('boll.guess',$assign);
    }

    public function doGuess(Request $request)
    {
        $params = $request->all();
        unset($params['_token']);
        DB::table('study_guess_record')->insert($params);
        return redirect('/study/guess/list?user_id=1');
    }
}
