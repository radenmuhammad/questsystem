<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use Illuminate\Http\Request;

class QuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quests = Quest::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $quests
        ];
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

        $quests = Quest::create($request->all());
        return [
            "status" => 1,
            "data" => $quests
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Quest $quests)
    {
        return [
            "status" => 1,
            "data" =>$quests
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Quest $quests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quest $quests)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $quests->update($request->all());

        return [
            "status" => 1,
            "data" => $quests,
            "msg" => "The Quests is updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quest $quests)
    {
        $quests->delete();
        return [
            "status" => 1,
            "data" => $quests,
            "msg" => "The Quests is deleted successfully"
        ];
    }
}

?>