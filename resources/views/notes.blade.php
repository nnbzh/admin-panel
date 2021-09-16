@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Notes') }}</div>
                    <div class="card-body">
                        <div style="margin: 10px">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Add Note
                            </button>
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add new note</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('notes.store') }}" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group row">
                                                    <label for="title"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="title" type="text"
                                                               class="form-control @error('title') is-invalid @enderror"
                                                               name="title" value="{{ old('title') }}" required
                                                               autocomplete="email">

                                                        @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="image"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="image" type="file"
                                                               class="form-control @error('image') is-invalid @enderror"
                                                               name="image" value="{{ old('image') }}" required>

                                                        @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="category_id"
                                                           class="col-md-4 col-form-label text-md-right">
                                                        {{ __('Category') }}
                                                    </label>

                                                    <div class="col-md-6">
                                                        <input id="category_id" type="hidden"
                                                               class="form-control @error('image') is-invalid @enderror"
                                                               name="category_id"
                                                               value="{{ old('category_id') }}" required>

                                                        <select id="select_category" class="form-select" onchange="function setCat() {
                                                                        let inp = document.getElementById('category_id');
                                                                        let sel = document.getElementById('select_category');
                                                                        inp.value = sel.value;
                                                            }
                                                            setCat(this)">
                                                            <option selected>Open this select menu</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Add') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group">
                            @if($notes->isEmpty())
                                <div align="center" >No notes found.</div>
                            @else
                            @foreach($notes as $note)
                                <li class="list-group-item">
                                    <div>
                                        <a href="{{ route('notes.show', ['note' => $note]) }}">{{ $note->title }}</a>
                                        @if (Auth::user()->hasRole('manager'))
                                            by
                                            <a href="{{ route('notes.index', request()->merge(["user_id" => $note->user->id])->all())}}">
                                                {{$note->user->email}}
                                            </a>
                                        @endif
                                        <form method="POST" action="{{ route('notes.destroy', ["note" => $note])}}">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete" />
                                            <button type="submit" class="btn btn-danger float-right">DELETE</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                                {{ $notes->links("pagination::bootstrap-4") }}
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
