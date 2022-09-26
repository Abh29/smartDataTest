@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            

            @foreach ($authors  as $author)
                <div class="author_card_wrapper">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-5">
                            <figure>
                                   <img src="{{asset( $author->picture)}}" alt=""/>
                            </figure>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-7 ">
                            <div class="book_card_info">
                                <div class="book_card_title">
                                    <a href="{{route('author.details', ['id' => $author->id])}}"><h5>{{__($author->name)}}</h5></a>
                                </div>
                                <div class="author_nick">
                                    <p>{{$author->nick}}</p>
                                </div>
                                <span>Has {{count($author->books)}} books</span>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach


            <div class="col-md-12">
                <div class="row justify-content-center">
                    {{$authors->links('partials.pagination')}}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
