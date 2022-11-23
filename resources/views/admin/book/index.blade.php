@extends('layouts.app', ['active_nav' => 'dashboard'])

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
                        <li><a href="{{route('admin.book.create')}}">Add a new Book</a></li>
                    </ul>
                        <div class="box_general">
                            <div class="header_box">
                               
                            </div>
                            <div class="list_general">
                                <ul>

                                    @foreach ($books as $book)
                                            <li>
                                                <figure><img src="{{asset($book->cover_picture)}}" alt=""></figure>
                                                <h4>{{$book->title}}</h4>
                                                <ul class="booking_details">
                                                    <li><strong>Author</strong>{{$book->author->nick}}</li>
                                                    <li><strong>Edition</strong>{{$book->edition}}</li>
                                                    <li><strong>Publisher</strong>{{$book->publisher}}</li>
                                                    <li><strong>description</strong>{{$book->description}}</li>
                                                </ul>
                                                <ul class="buttons">
                                                    <li><a  href="{{route('admin.book.edit', ['id' => $book->id])}}" class="btn_1 gray info"><i class="fa fa-fw fa-check-circle-o"></i> Edit</a></li>
                                                    <li>
                                                        <form id="delete-form-{{$book->id}}" action="{{ route('admin.book.delete', ['id' => $book->id]) }}" method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a onclick="event.preventDefault(); document.getElementById('delete-form-{{$book->id}}').submit();" 
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
                            {{$books->links('partials.pagination')}}
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
