@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="row pb-3">
                <div class="col-5 offset-3">
                    <a href="/profile/{{$post->user->id}}">
                        <img src="/storage/{{$post->image}}" alt="" class="w-100">
                    </a>
                </div>
            </div>
            <div class="row pb-3">
                <div class="col-5 offset-3 bg-white">
                    <p><span class="font-weight-bold"><a href="/profile/{{$post->user->id}}"
                                                         style="color: #003569;">{{$post->user->username}}</a></span> {{$post->caption}}
                    </p>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{$posts->links()}}
            </div>
        </div>

    </div>
@endsection
