@extends('layouts.app', [
    'page_title' => ' - Authors',
    'active_nav' => 'author'
])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Nickname</th>
                <th scope="col">Books count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($authors as $author)
                <tr class="expandable-row">
                <th scope="row">{{ $author->id }}</th>
                <td><a href="{{route('author.details', ['id' => $author->id])}}"><h5>{{__($author->name)}}</h5></a></td>
                <td>{{ $author->nick}}</td>
                <td>{{ count( $author->books ) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>


            <div class="col-md-12">
                <div class="row justify-content-center">
                    {{$authors->links('partials.pagination')}}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
