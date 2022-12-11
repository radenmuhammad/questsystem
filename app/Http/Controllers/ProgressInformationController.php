<?php

namespace App\Http\Controllers;

use App\Models\ProgressInformation;
use Illuminate\Http\Request;

class ProgressInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $progressinformations = ProgressInformation::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $progressinformations
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
        $progressinformations = ProgressInformation::create($request->all());
        return [
            "status" => 1,
            "data" => $progressinformations
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(ProgressInformation $progressinformations)
    {
        return [
            "status" => 1,
            "data" =>$progressinformations
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgressInformation $progressinformations)
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
    public function update(Request $request, ProgressInformation $progressinformations)
    {

        $progressinformations->update($request->all());

        return [
            "status" => 1,
            "data" => $progressinformations,
            "msg" => "The Progress Informations is updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgressInformation $progressinformations)
    {
        $quests->delete();
        return [
            "status" => 1,
            "data" => $progressinformations,
            "msg" => "The Progress Informations is deleted successfully"
        ];
    }
}

?>