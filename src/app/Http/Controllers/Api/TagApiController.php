<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Tag;
use App\Http\Requests\StoreTag;

class TagApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTag $request, $id)
    {
        // Log::debug('$request="' . $request . '"');
        $tag = Tag::find($id);
        if ($request->tag_name == !NULL) {
            $tag->tag_name = $request->tag_name;
        }
        if ($request->content == !NULL) {
            $tag->content = $request->content;
        }
        if ($request->position_X == !NULL) {
            $tag->position_X = $request->position_X;
        }
        if ($request->position_Y == !NULL) {
            $tag->position_Y = $request->position_Y;
        }
        if ($request->visibility == !NULL) {
            $tag->visibility = $request->visibility;
        }
        $tag->save();
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
