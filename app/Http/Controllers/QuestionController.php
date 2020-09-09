<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Resources\QuestionResource;
use App\Http\Requests\AskQuestionRequest;

class QuestionController extends Controller
{
    public function __construct()
    {
        # code...
        $this->middleware('auth', ['excpet'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    //     $questions = Question::latest()->paginate(5);
    //     return view('questions.index', compact('questions'));
    // }
    // public function index()
    // {
    //     //
    //     \DB::enableQueryLog();
    //     $questions = Question::with('user')->latest()->paginate(5);
    //     view('questions.index', compact('questions'))->render();
    //     dd(\DB::getQueryLog());
    // }
    public function index()
    {
        //
        $questions = Question::latest()->paginate(5);
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $questions = new Question();
        return view('questions.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        //
        $request->user()->questions()->create($request->only('title', 'body'));
        return redirect()->route('questions.index')->with('success', 'Your question is successfully created');
        // return $request->user();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
        # code...
        $question->increment('views');
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
        $this->authorize("update", $question);
        return view("questions.edit", compact('question')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        //
        $this->authorize("update", $question);
        $question->update($request->only('title', 'body'));
        return redirect('/questions')->with('success', "The question has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
        $this->authorize("delete", $question);
        $question->delete();
        return redirect('/questions')->with('success', "The question already deleted");
    }
}
