@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="main-body">
              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{asset($author->picture)}}" alt="profile" class="rounded-circle" width="150">
                        <div class="mt-3">
                          <h4>{{$author->nick}}</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{$author->name}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Birthdate</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{$author->birth_date}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Books</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{count($author->books)}}
                        </div>
                      </div>
                      <hr>
                    
                      @auth
                        <div class="row">
                            <div class="col-sm-12">
                            <a class="btn btn-info " href="{{route('admin.author.edit', ['id' => $author->id])}}">Edit</a>
                            </div>
                        </div>  
                      @endauth
                      @guest
                          <div class="row" style="height: 35px"></div>
                      @endguest
                    </div>
                  </div>
                </div>
            </div>
        </div>

        @foreach ($author->books as $book)
                <div class="book_card_wrapper pt-5">
                    <div class="row">
                        <div class="col-md-4">
                            <figure>
                                   <img src="{{asset( $book->cover_picture)}}" alt=""/>
                            </figure>
                        </div>
                        <div class="col-md-8 ">
                            <div class="book_card_info">
                                <div class="book_card_title">
                                    <h5><a href="{{route('book.details', ['id' => $book->id])}}">{{__($book->title)}}</a></h5>
                                </div>
                                <div class="book_discription">
                                    <p>{{$book->description}}</p>
                                </div>
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

   
</div>
@endsection
