@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $note->title}}</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><b>Author: </b>{{ $note->user->email }}</a></li>
                            <li class="list-group-item"><b>Category: </b>{{ $note->category->name }}</a></li>
                            <li class="list-group-item">
                                <img alt="" align="center" src="{{ asset("$note->img_src") }}" style="width: 300px; height: 300px;">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
