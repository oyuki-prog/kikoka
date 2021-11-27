<?php

namespace App\Http\Controllers;

use App\Http\Requests\DivideQuestionRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('user')->where('open', true)->orderBy('reward_coin', 'DESC')->simplePaginate(15);
        return view('questions.index', compact('questions'));
    }

    public function new()
    {
        $questions = Question::with('user')->where('open', true)->orderBy('created_at', 'DESC')->simplePaginate(15);
        return view('questions.index', compact('questions'));
    }

    public function popular()
    {
        $questions = Question::withCount('answers')->where('open', true)->orderBy('answers_count', 'DESC')->simplePaginate(15);
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        if (Auth::user()->coin < $request->reward_coin * 1.1) {
            return back()->withInput()->withErrors(['error' => 'コインの設定額が所持コインを上回っています']);
        }

        $question = new Question($request->all());
        $question->user_id = Auth::id();
        $question->due_date = $request->due_date . ':00';

        $user = User::find(Auth::id());
        if ($request->urgent == 1) {
            $user->coin -= $request->reward_coin * 1.2;
        } else {
            $user->coin -= $request->reward_coin * 1.1;
        }
        DB::beginTransaction();
        try {
            $question->save();
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'データの保存に失敗しました']);
        }

        return redirect()->route('questions.show', compact('question'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $answers = $question->answers()->with('user')->get();
        return view('questions.show',compact(['question','answers']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionRequest  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        // $question->delete()
    }

    public function close(Question $question)
    {
        $this->authorize('update', $question);
        $answers = $question->answers()->with('user')->get();
        return view('questions.close', compact(['question', 'answers']));
    }

    public function divide(DivideQuestionRequest $request, Question $question)
    {
        $this->authorize('update', $question);
        if ($question->open == false) {
            return back()->withErrors(['error' => '分配済みの質問です']);
        }
        if ($question->reward_coin != array_sum($request->user)) {
            return back()->withErrors(['error' => '分配コインが一致しません']);
        }
        $question->open = false;
        $request->user = array_diff($request->user, [null]);
        DB::beginTransaction();
        try {
            $question->save();
            foreach ($request->user as $userId => $reward_coin) {
                $user = User::find($userId);
                $user->coin += $reward_coin;
                $user->save();
            }
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'データの保存に失敗しました']);
        }

        return redirect()->route('questions.index')->with(['message' => '分配しました']);
    }

}
