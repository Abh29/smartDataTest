@extends('layouts.app', ['active_nav' => 'dashboard'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create a New Book') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('admin.book.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input form-control" id="cover_picture" name="cover_picture">
                              <label class="custom-file-label" for="cover_picture">Choose a book cover</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="author" class="col-md-4 col-form-label text-md-end">{{ __('Author') }}</label>
                            <div class="col-md-6">
                                <select id="author" class="form-control" name="author_id" required>
                                    @foreach ($authors as $author)
                                        <option value="{{$author->id}}">{{$author->nick}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="description" class="form-label col-md-4 col-form-label text-md-end">{{__('Description')}}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="description" rows="4" style="resize: none" name="description"></textarea>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="publisher" class="col-md-4 col-form-label text-md-end">{{ __('Publisher') }}</label>
                            <div class="col-md-6">
                                <input id="publisher" type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher" required autocomplete="publisher" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="edition" class="col-md-4 col-form-label text-md-end">{{ __('Edition') }}</label>

                            <div class="col-md-6">
                                <input id="edition" type="text" class="form-control @error('edition') is-invalid @enderror" name="edition" required autocomplete="edition" autofocus>

                                @error('edition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pages" class="col-md-4 col-form-label text-md-end">{{ __('pages') }}</label>

                            <div class="col-md-6">
                                <input id="pages" type="number" class="form-control @error('pages') is-invalid @enderror" name="pages" required autocomplete="pages" autofocus>

                                @error('pages')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="book_text" class="form-label col-md-4 col-form-label text-md-end">{{__('Book Text')}}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="book_text" rows="6" style="resize: none" maxlength="5000" name="book_text"></textarea>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
