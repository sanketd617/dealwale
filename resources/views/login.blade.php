@extends('master')

@section('content')
    <div class="row">
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Login</span>
                    <div class="row">
                        @foreach($errors->all() as $e)
                            <div class="red-text">
                                {{ $e }}
                            </div>
                        @endforeach
                        <form class="col s12" method="POST">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="email" type="email" name="email" class="validate" value="{{ old('email') }}">
                                    <label for="email">Email</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="password" type="password" name="password" class="validate" value="{{ old('password') }}">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="row">
                                {{ csrf_field() }}
                                <button class="btn waves-effect waves-light" type="submit" name="action">
                                    Login
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
