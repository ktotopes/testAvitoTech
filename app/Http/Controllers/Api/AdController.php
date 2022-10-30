<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use App\Http\Requests\AdRequest;
use App\Http\Resources\AdResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index(Request $request)
    {

        $adQuery = Ad::query();

        $sorting = $request->input('sorting') ?? [];

        if (count($sorting)) {
            foreach ($sorting as $key => $direction) {
                $adQuery->orderBy($key, $direction);
            }
        }

        return response()->json([
            'ads' => AdResource::collection(
                $adQuery->paginate(10)
            ),
        ]);
    }

    public function show(Ad $ad)
    {
        return response()->json([
            'ad' => new AdResource($ad),
        ]);
    }

    public function store(AdRequest $adRequest)
    {
        $ad = new Ad($adRequest->validated());
        $ad->save();

        return response()->json([
            'id' => $ad->id
        ]);
    }
}
