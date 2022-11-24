@extends('layouts.app', [
  'page_title' => " - Books",
  'active_nav' => 'book'
])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @foreach ($books as $book)
                <div class="book_card_wrapper">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-5">
                            <figure>
                                   <img src="{{asset( $book->cover_picture)}}" alt="book cover" style="max-width: 300px; max-height: 300px;" />
                            </figure>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-7 ">
                            <div class="book_card_info mt-5">
                                <div class="book_card_title">
                                    <h5><a href="{{route('book.details', ['id' => $book->id])}}">{{__($book->title)}}</a></h5>
                                </div>
                                <div class="book_discription">
                                    <p>{{$book->description}}</p>
                                </div>
                                <a href="{{route('author.details', ['id' => $book->author->id])}}">{{$book->author->nick}}</a>
                                <div class="rating_wrap">
                                    <div class="book_rating">
                                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach


            <div class="col-md-12">
                <div class="row justify-content-center">
                    {{$books->links('partials.pagination')}}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
