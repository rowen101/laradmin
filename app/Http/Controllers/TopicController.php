<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelTopic;
class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $topics = ModelTopic::all();
        return response()->json($topics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $topics = new ModelTopic();
        $topics->topic = $request->input('Topic');
        $topics->description = $request->input('description');

        $topics->save();
        return response()->json($topics);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topics = ModelTopic::find($id);
        return response()->json($topics);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
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
        $topics = ModelTopic::find($id);
        $topics->topic = $request->input('Topic');
        $topics->description = $request->input('description');

        $topics->save();
        return response()->json($topics);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topics = ModelTopic::find($id);
        $topics->delete();
        return response()->json($topics);
    }
}
