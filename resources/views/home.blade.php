@extends('layouts.app')

@section('content')
<div class="container  page-content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="col-sm-3">
                            <h1>profile</h1>
                        </div>
                        <div class="col-sm-8">
                            <ul id="posts-lists">
                            </ul>
                        </div>

                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
