@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="">
                        <li class="">
                            <a href="{{route('admin.book.index')}}">Books</a>
                        </li>
                        <li class="">
                            <a href="{{route('admin.author.index')}}">Authors</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
