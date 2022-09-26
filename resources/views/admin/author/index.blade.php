@extends('layouts.app')

<link rel="stylesheet" href="{{asset('css/app.css')}}">


@section('content')

<div class="container col-10">
    <div class="row justify-content-center">
        <div class="col-12"> 
                <div class="content-wrapper">
                    <div class="container-fluid">
                    <!-- Breadcrumbs-->
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.book.index')}}">Books</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.author.index')}}">Authors</a>
                        </li>
                    </ul>
                    <ul>
                        <li><a href="{{route('admin.author.create')}}">Add a new Author</a></li>
                    </ul>
                        <div class="box_general">
                            <div class="header_box">
                               
                            </div>
                            <div class="list_general">
                                <ul>
                                    @foreach ($authors as $author)
                                        <li>
                                            <figure><img src="{{asset($author->picture)}}" alt=""></figure>
                                            <h4>{{$author->name}}</h4>
                                            <ul class="booking_details">
                                                <li><strong>Author's Nick</strong> 11 November 2017</li>
                                                <li><strong>Author's Birthdate</strong> 10.20AM</li>
                                            </ul>
                                            <ul class="buttons">
                                                <li><a  href="{{route('admin.author.edit', ['id' => $author->id])}}" class="btn_1 gray info"><i class="fa fa-fw fa-check-circle-o"></i> Edit</a></li>
                                                <li>
                                                    <form id="delete-form-{{$author->id}}" action="{{ route('admin.author.delete', ['id' => $author->id]) }}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a onclick="event.preventDefault(); document.getElementById('delete-form-{{$author->id}}').submit();" 
                                                        class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                        </div>
                        <!-- /box_general-->
                        <nav aria-label="...">
                            {{$authors->links('partials.pagination')}}
                        </nav>
                        <!-- /pagination-->
                    </div>
                    <!-- /container-fluid-->
                    </div>
                    <!-- /container-wrapper-->
                    
                </div>
             </div>
            </div>
        </div>

@endsection
