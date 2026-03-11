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
            'word' => 'required',
            'image' => 'required|image'
        ]);

        $imagePath = $request->file('image')->store('signs', 'public');

        $sign = SignLanguage::create([
            'word' => $request->word,
            'image' => $imagePath
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

        $sign->update([
            'word' => $request->word
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