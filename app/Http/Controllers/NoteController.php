<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Note;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    public function index() {
        $notes = Note::query()->with('user');

        if (request()->has('category_id')) {
            $notes->where('category_id', request()->get('category_id'));
        }

        if (request()->has('user_id')) {
            $notes->where('user_id', request()->get('user_id'));
        }

        if (request()->user()->cannot('viewAny', Note::class)) {
            $notes->where('user_id', request()->user()->id);
        }

        return view('notes', [
            "notes"         => $notes->paginate(10),
            "categories"    => Category::query()->get()
        ]);
    }

    public function show(Note $note) {
        if (request()->user()->cannot('view', $note)) {
            abort(403);
        }

        return view('note', ["note" => $note]);
    }

    public function store() {
        $this->validate(request(), [
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

        return $this->index();
    }

    public function destroy(Note $note) {
        if (request()->user()->cannot('delete', $note)) {
            abort(403);
        }
        $note->delete();

        return $this->index();
    }
}