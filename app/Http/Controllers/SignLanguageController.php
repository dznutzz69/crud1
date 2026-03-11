<?php

namespace App\Http\Controllers;

use App\Models\SignLanguage;
use Illuminate\Http\Request;

class SignLanguageController extends Controller
{
    public function index()
    {
        return SignLanguage::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'word' => 'required'
        ]);

        $imageName = strtolower($request->word) . ".jpg";

        $sign = SignLanguage::create([
            'word' => $request->word,
            'image' => $imageName
        ]);

        return response()->json($sign);
    }

    public function show($id)
    {
        return SignLanguage::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $sign = SignLanguage::findOrFail($id);

        $imageName = strtolower($request->word) . ".jpg";

        $sign->update([
            'word' => $request->word,
            'image' => $imageName
        ]);

        return response()->json($sign);
    }

    public function destroy($id)
    {
        $sign = SignLanguage::findOrFail($id);
        $sign->delete();

        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}