@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>
                    <div class="card-body">
                        <div style="margin: 10px">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Add User
                            </button>
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add new user</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                                <form method="POST" action="{{ route('register') }}">
                                                    @csrf

                                                    <div class="form-group row">
                                                        <label for="email"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="email" type="email"
                                                                   class="form-control @error('email') is-invalid @enderror"
                                                                   name="email" value="{{ old('email') }}" required
                                                                   autocomplete="email">

                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="password"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="password" type="password"
                                                                   class="form-control @error('password') is-invalid @enderror"
                                                                   name="password" required autocomplete="new-password">

                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="password-confirm"
                                                               class="col-md-4 col-form-label text-md-right">
                                                            {{ __('Role') }}
                                                        </label>

                                                        <div class="col-md-6">
                                                            <input id="role_id" type="hidden"
                                                                   class="form-control" name="role_id">
                                                            <select id="select_role" class="form-select" onchange="function setRole() {
                                                                        let inp = document.getElementById('role_id');
                                                                        let sel = document.getElementById('select_role');
                                                                        inp.value = sel.value;
                                                            }
                                                            setRole(this)">
                                                                <option selected>Open this select menu</option>
                                                                @foreach($roles as $role)
                                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="btn btn-primary">
                                                                {{ __('Register') }}
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
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
