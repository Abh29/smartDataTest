@extends('layouts.app', [
  'page_title' => " - Book: {$book->title}",
  'active_nav' => 'book'
])

@section('content')
    <div class="container">

        <h2>{{$book->title}}</h2>
        <h4><a href="{{route('author.details', ['id' => $book->author->id])}}">{{$book->author->nick}}</a></h4>

        <p>{{ $book->book_text }}</p>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint perferendis quae repellendus quisquam placeat exercitationem, fugit officia quidem atque odit ea reiciendis, aperiam saepe laboriosam distinctio dolore dicta similique! Suscipit explicabo excepturi molestias officia soluta aliquam reiciendis temporibus veritatis in vel autem facere porro vero hic rem vitae, iste rerum enim natus minus! Voluptates earum dolore officia cupiditate quo tempora ullam iste, necessitatibus error, est, facere at sed ut sapiente eligendi perferendis vitae iure cum. Fugit consequatur perferendis omnis porro voluptatum quas, delectus nisi voluptate fuga eveniet similique vel, autem accusamus, laboriosam eius sit eum adipisci tempore accusantium. Sed, sunt?</p>
        
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laudantium fugit reiciendis dolores labore quisquam omnis placeat doloribus. Ullam sequi officiis in, vitae consequuntur at animi nobis sunt fugiat minus vel maiores? Id quis cum veniam ipsum assumenda voluptates alias facilis expedita reprehenderit ipsa nemo, velit necessitatibus suscipit esse quas recusandae omnis optio distinctio incidunt ratione, nesciunt error. Illum quas ex quidem! Voluptatum, corporis aspernatur odit impedit distinctio quaerat fugit voluptas, optio eaque nemo quisquam nesciunt totam mollitia, exercitationem sapiente neque reiciendis voluptatibus provident qui laudantium deleniti? Fuga, doloremque iste ab natus similique labore voluptatum ducimus aliquam architecto quibusdam fugit asperiores.</p>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum voluptatem, molestias blanditiis, veniam adipisci tempora itaque soluta quibusdam delectus illo nemo reiciendis nostrum quasi beatae dignissimos laborum cum iusto at?</p>

    </div>
@endsection

