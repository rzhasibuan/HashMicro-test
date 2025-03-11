<?php

namespace App\Http\Controllers;

use App\Services\CharacterCompareService;
use Illuminate\Http\Request;

class CharacterCompareController extends Controller
{
    private CharacterCompareService $characterCompareService;

    public function __construct(CharacterCompareService $characterCompareService)
    {
        $this->characterCompareService = $characterCompareService;
    }

    public function index()
    {
        return view("character-compare.index");
    }

    public function compare(Request $request)
    {
        $request->validate([
            "character1" => "required|string",
            "character2" => "required|string",
        ]);


        $data = $this->characterCompareService->compare($request->character1, $request->character2);

        return view("character-compare.index", [
            "character1" => $data["data"]["character1"],
            "character2" => $data["data"]["character2"],
            "percentage" => $data["data"]["percentage"],
        ]);

    }
}
