<?php

namespace App\Http\Controllers;

use App\Http\Resources\TableResource;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends BaseController
{

    public $paginate=10;

    public function __construct()
    {
        $this->authorizeResource(Table::class,'table');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::paginate($this->paginate);
        return $this->sendResponse(TableResource::collection($tables)->response()->getData(true),'Tables sent sussesfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = Table::create($request->validated());
        return $this->sendResponse(new TableResource($table ),'Table created sussesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        return $this->sendResponse(new TableResource($table),'Table shown sussesfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        $table->update($request->validated());
        return $this->sendResponse(new TableResource($table),'Table updated sussesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        $table->delete();
        return $this->sendResponse(new TableResource($table),'Table deleted sussesfully');
    }
}
