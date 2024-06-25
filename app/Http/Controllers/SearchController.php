<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $text = $request->input('text');
        $results = User::where('name', 'like', '%'.$text.'%')->get();

        foreach ($results as $result) {
            if ($result->avatar) {
                $result->image_url = asset('avatars/' . basename($result->avatar));
            }
        }

        if ($request->ajax()) {
            return response()->json($results);
        }

        return view('profile.search', compact('results'));
    }
}
