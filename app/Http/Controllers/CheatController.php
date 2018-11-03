<?php

namespace App\Http\Controllers;

use App\Cheat;
use App\Http\Resources\CheatResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheatController extends Controller
{
    public function index()
    {
        return CheatResource::collection(Cheat::all());
    }

    public function store(Request $request)
    {
        $cheat = Cheat::create($request->cheat);
        if (!$cheat) {
            return JsonResponse(
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
        $cheat->update($request->json('cheat'));
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
