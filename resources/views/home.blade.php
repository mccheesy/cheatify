@extends('layouts.app')

@section('content')
<b-container>
    <b-row>
        <b-col>
            <b-jumbotron
                header="Cheatify!"
                lead="Who needs to git gud when you can chit gud?"
            >
                @guest
                    <b-btn variant="primary" href="/login">
                        Login
                    </b-btn>
                    <b-btn variant="primary" href="/register">
                        Register
                    </b-btn>
                @else
                    <b-btn variant="primary" :to="{ name: 'cheats.index' }">
                        Start Cheating
                    </b-btn>
                @endguest
            </b-jumbotron>
        </b-col>
    </b-row>
</b-container>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome!</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
<router-view></router-view>
@endsection
