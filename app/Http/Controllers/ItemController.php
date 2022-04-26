<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends BaseController
{

    public $paginate=10;

    public function __construct()
    {
        $this->authorizeResource(Item::class,'item');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::paginate($this->paginate);
        return $this->sendResponse(ItemResource::collection($items)->response()->getData(true),'Items sent sussesfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Item::create($request->validated());
        return $this->sendResponse(new ItemResource($item ),'Item created sussesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return $this->sendResponse(new ItemResource($item),'Item shown sussesfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->update($request->validated());
        return $this->sendResponse(new ItemResource($item),'Item updated sussesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return $this->sendResponse(new ItemResource($item),'Item deleted sussesfully');
    }
}
