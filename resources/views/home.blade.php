@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @error('image')
        <span class="text-danger">{{$message}}</span>
        @enderror
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create & Upload
            </button>

            <!-- Modal -->
            <form action="{{route('new_feed')}}" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create & Update</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                    @csrf
                                    <div class="form-group">
                                        <label for="image" class="form-label">image: </label>
                                        <input type="file" id="image" name="image" class="form-control@error('image') is-invalid@enderror"  required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">description: </label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
