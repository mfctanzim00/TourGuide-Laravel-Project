@extends('layouts.frontend.app')

@section('content')
    
    <!-- Start top-section Area -->
<section class="top-section-area section-gap"style="font-family: 'Gill Sans', sans-serif;  color:white;">
  <div class="container">
    <div class="row justify-content-between align-items-center d-flex">
      <div class="col-lg-8 top-left">
        <h1 class=" mb-20"style="font-family: 'Gill Sans', sans-serif;  color:black;">All Post</h1>
        <ul>
          <li>
            <a href="index.html"style="font-family: 'Gill Sans', sans-serif; color:black;">Home</a>
            <span class="lnr lnr-arrow-right" style="color:black;"></span>
          </li>
          <li>
            <a href="category.html"style="font-family: 'Gill Sans', sans-serif; color:black;">Category</a>
            <span class="lnr lnr-arrow-right" style="color:black;"></span>
          </li>
          <li><a href="single.html"style="font-family: 'Gill Sans', sans-serif;  color:black;;">Posts</a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
    <!-- End top-section Area -->   

    <!-- Start post Area -->
<div class="post-wrapper pt-100">
      <!-- Start post Area -->
  <section class="post-area">
    <div class="container"style="font-family: 'Gill Sans', sans-serif; color:black;">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-8">
          <div class="top-posts pt-50">
            <div class="container">
              <div class="row justify-content-center">
                @if ($posts->count() > 0)
                  @foreach($posts as $post)
                  <div class="single-posts"style="font-family: 'Gill Sans', sans-serif; color:black;">
                    <div>
                      <img class="img-fluid" src="{{asset('storage/post/'.$post->image)}}" alt="{{$post->image}}"style="width:1000px; height: 200px;"/>
                      <div class="date mt-20 mb-20"style="font-family: 'Gill Sans', sans-serif;  color:white;">10 Jan 2018</div>
                    </div>
                    <div class="detail">
                      <a href=" {{ route('post', $post->slug) }} ">
                        <h4 class="pb-20"style="font-family: 'Gill Sans', sans-serif; color:black;text-align:justify;"> {{ $post->title }} </h4>
                      </a>
                      <p style="font-family: 'Gill Sans', sans-serif; color:black; text-align:justify;">
                        <!-- {!! Str::limit($post->body, 400)!!} -->
                        {!!  substr(strip_tags($post->body), 0, 200) !!}..<a href="{{ route('post',$post->slug) }}" style="font-size:12px;color:blue;font-family: 'Gill Sans', sans-serif;">See More</a>
                      </p>
                      <p class="footer pt-20">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                        <a href="#"style="font-family: 'Gill Sans', sans-serif; color:black;"> {{ $post->likedUser->count() }} Likes </a>
                        <i class="ml-20 fa fa-comment-o" aria-hidden="true"></i>
                          <a href="#"style="font-family: 'Gill Sans', sans-serif; color:black;">{{ $post->comments->count() }}  Comments</a>
                      </p>
                    </div>
                  </div>
                  @endforeach
                @else
                  <h3 style="font-family: 'Gill Sans', sans-serif; color:black;">No post availabe</h3>
                @endif
              </div>
              <div class="justify-content-center d-flex mt-5">
               
                {{ $posts->links() }}
               
              </div>
            </div>
          </div>
        </div>
        @include('layouts.frontend.partials.sidebar')
      </div>
    </div>
  </section>
      <!-- End post Area -->
</div>
    <!-- End post Area -->
@endsection