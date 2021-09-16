<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    public function index() {
        $user = Auth::user();
        if ($user->hasRole('manager')) {
            $notes = Note::query()->with(['category', 'user']);
        } else {
            $notes = $user->notes()->with(['category', 'user']);
        }

        return view('notes', [
            "notes"         => $notes->paginate(10),
            "categories"    => Category::query()->get()
        ]);
    }

    public function show($note) {
        return view('note', [
            "note" => Note::query()->with('category')->findOrFail($note)
        ]);
    }

    public function store() {
        $validated = $this->validate(request(), [
            "title" => "required",
            "category_id" => "required|exists:categories,id",
            "image"       => "required|file|mimes:jpg,jpeg,png,bmp,tiff|max:4096"
        ]);

        $image = request()->file('image');
        $filename = request()->user()->id."_".Str::random(4).".".$image->getClientOriginalExtension();
        Storage::disk('uploads')->put($filename, $image->getContent());

        Note::query()->create(
            [
                "title" => request()->get('title'),
                "category_id" => request()->get('category_id'),
                "img_src" => 'uploads/'.$filename,
                "user_id" => request()->user()->id
            ]
        );

        $this->index();
    }
}