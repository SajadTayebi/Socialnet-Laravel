@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div align="center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBdGVt3o7JIXPvZU3B57byuYSQzufgD0FxQg&usqp=CAU" alt="Not Found" class="rounded-circle" width="110px">
                        <div>
                            <span class="fs-5 fw-bold">Following: {{$user->count_following}}</span>
                            <span class="fs-5 fw-bold ms-5">Follows: {{$user->count_followers}}</span>
                        </div>
                        <div>
                            @if($user->id != auth()->user()->id)
                                <form action="{{route('click_follow', $user)}}" method="post">
                                    @csrf
                                    @if(check_follow($user->id, auth()->user()->id))
{{--                                        {{dd(check_follow($users, auth()->user()->id))}}--}}
                                        <button class="btn btn-warning">Follow</button>
                                    @else
                                        <button class="btn btn-primary">UnFollow</button>
                                    @endif
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @foreach($feeds as $feed)
                @php
                    views($feed)->record();
                @endphp
                 <div class="col-sm-4 mt-3 mb-3">
                <img src="{{$feed->image_url}}" alt="Not Found" class="img-thumbnail">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="text-black">{{$feed->description}}</h3>
                                <span>Publisher By <a href="{{route('profile', $feed->user->id)}}">{{$feed->user->name}}</a></span>
                            </div>
                            <div class="col">
                                <form action="{{route('submit_like', $feed)}}" method="post">
                                    @csrf
                                    <button class="border-0 bg-transparent  float-end">
                                        @if(check_liked($feed, auth()->user()->id))
                                            <i class="fa fa-heart fa-2x"></i>
                                        @else
                                            <i class="fa fa-heart fa-2x" style="color: red"></i>
                                            <span class="text-danger">{{$feed->count_like}}</span>
                                        @endif
                                    </button>
                                </form>
                                <i class='fas fa-eye float-end'>{{views($feed)->unique()->count()}}</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
