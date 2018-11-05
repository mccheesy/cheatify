<?php

namespace App\Http\Controllers;

use App\Cheat;
use App\Http\Resources\CheatResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheatController extends Controller
{
    public function index()
    {
        return CheatResource::collection(Cheat::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string',
            'description' => 'string'
        ]);
        $validatedData['creator_id'] = auth()->user()->id;

        $cheat = Cheat::create($validatedData);
        if (!$cheat) {
            return new JsonResponse(
                null,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
        return new CheatResource($cheat);
    }

    public function show(Cheat $cheat)
    {
        return new CheatResource($cheat);
    }

    public function update(Request $request, Cheat $cheat)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string',
            'description' => 'string'
        ]);
        $validatedData['creator_id'] = auth()->user()->id;
        $cheat->update($validatedData);
        return new CheatResource($cheat);
    }

    public function destroy(Cheat $cheat)
    {
        if ($cheat->delete()) {
            return new JsonResponse(
                null,
                Response::HTTP_NO_CONTENT
            );
        } else {
            return new JsonResponse(
                null,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
