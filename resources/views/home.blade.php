@extends('layouts.app')

@section('content')
<div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Main') }}</div>
                        <div class="card-body">
                            <ul class="list-group">
                                @if(auth()->user()->hasRole('manager'))
                                    <li class="list-group-item"><a href="{{ route('users.index') }}">Users</a></li>
                                @endif
                                <li class="list-group-item"><a href="{{ route('notes.index') }}">Notes</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
    </div>
</div>
@endsection
