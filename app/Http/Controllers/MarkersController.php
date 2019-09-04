<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marker;

use App\Http\Requests\CreateMarkerRequest;

class MarkersController extends Controller
{
    public function all()
    {
        $markers = Marker::all();

        return response()->json([
            "markers" => $markers
        ], 200);
    }

    public function get($id)
    {
        $marker = Marker::whereId($id)->first();

        return response()->json([
            "marker" => $marker
        ], 200);
    }

    public function new(CreateMarkerRequest $request)
    {
        $marker = Marker::create($request->only(["name", "comment", "longitude", "latitude"]));

        return response()->json([
            "marker" => $marker
        ], 200);
    }

    // public function remove($id)
    // {
    //     $marker = Marker::whereId($id)->delete();
    //     return response()->json([], 200);
    // }
}
