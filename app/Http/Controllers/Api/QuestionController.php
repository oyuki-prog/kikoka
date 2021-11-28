<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('user')->where('open', true)->orderBy('reward_coin', 'ASC')->get();
        $questions->load(['user']);
        return response()->json(['questions' => $questions], HttpFoundationResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $question = new Question();
        $question->title = $request->title;
        $question->body = $request->body;
        $question->due_date = $request->due_date;
        $question->reward_coin = $request->reward_coin;
        $question->urgent = $request->urgent;
        $question->user_id = $user->id;
        $user->coin -= $request->coin;
        $question->save();
        $user->save();
        $question->load(['user']);
        return response()->json(['question' => $question], HttpFoundationResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $question = Question::find($id)->load('user');
        $answers = $question->answers->load('user');
        return response()->json(['question' => [$question, $answers]], HttpFoundationResponse::HTTP_OK);
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
        //
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
