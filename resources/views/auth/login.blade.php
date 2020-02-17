@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header">{{ __('Login via API') }}</div>

                <div class="card-body">
                    <a href="/apiLogin">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login via API') }}
                    </button>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
