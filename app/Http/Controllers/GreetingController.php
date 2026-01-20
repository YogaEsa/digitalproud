<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GreetingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_number' => 'required|string',
            'recipient_name' => 'required|string|max:100',
            'age' => 'required|integer|min:1|max:120',
            'message' => 'required|string|max:1000',
            'photo' => 'nullable|image|max:5120', // 5MB max
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $slug = Str::random(10);
        $id = Str::uuid()->toString();

        DB::table('greetings')->insert([
            'id' => $id,
            'slug' => $slug,
            'sender_number' => $validated['sender_number'],
            'recipient_name' => $validated['recipient_name'],
            'age' => $validated['age'],
            'message' => $validated['message'],
            'photo_path' => $photoPath,
            'current_views' => 0,
            'max_views' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'redirect_url' => route('greeting.show', ['slug' => $slug]),
        ]);
    }

    public function show($slug)
    {
        $greeting = DB::table('greetings')->where('slug', $slug)->first();

        if (!$greeting) {
            abort(404);
        }

        // Check view limit
        if ($greeting->current_views >= $greeting->max_views) {
            return view('expired');
        }

        // Increment view count
        DB::table('greetings')->where('id', $greeting->id)->increment('current_views');

        return view('card', ['data' => $greeting]);
    }
}
