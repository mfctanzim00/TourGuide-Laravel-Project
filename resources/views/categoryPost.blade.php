@extends('layouts.frontend.app')

@section('content')
    
     <!-- Start top-section Area -->
     <section class="top-section-area section-gap"style="font-family: 'Gill Sans', sans-serif; color:black;">
      <div class="container"style="font-family: 'Gill Sans', sans-serif; color:black;">
        <div class="row justify-content-between align-items-center d-flex">
          <div class="col-lg-8 top-left">
            <h1 class=" mb-20"style="font-family: 'Gill Sans', sans-serif; color:black;">All Posts of {{$category->name}}</h1>
            <ul>
              <li>
                <a href="/"style="font-family: 'Gill Sans', sans-serif; color:black;">Home</a
                ><span class="lnr lnr-arrow-right"></span>
              </li>
              <li>
                <a href="/categories"style="font-family: 'Gill Sans', sans-serif; color:black;">Category</a
                ><span class="lnr lnr-arrow-right"></span>
              </li>
              <li><a href="/posts"style="font-family: 'Gill Sans', sans-serif; color:black;">Posts</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- End top-section Area -->

    <!-- Start post Area -->
    <div class="post-wrapper pt-100"style="font-family: 'Gill Sans', sans-serif; color:black;">
      <!-- Start post Area -->
      <section class="post-area">
        <div class="container">
          <div class="row justify-content-center d-flex">
            <div class="col-lg-8">
              <div class="top-posts pt-50">
                <div class="container">
                  <div class="row justify-content-center">
                    @if ($posts->count() > 0)
                    @foreach($posts as $post)
                    <div class="single-posts col-lg-6 col-sm-6">
                      <img class="img-fluid" src=" {{ asset('storage/post/'. $post->image) }} " alt="{{ $post->image }}" style="width:1000px; height: 200px;"/>
                      <div class="date mt-20 mb-20"style="font-family: 'Gill Sans', sans-serif; color:white;"> {{ $post->created_at->format('D, d M Y H:i') }} </div>
                      <div class="detail">
                        <a href=" {{ route('post', $post->slug) }} "style="font-family: 'Gill Sans', sans-serif; color:black;"
                          ><h4 class="pb-20"style="font-family: 'Gill Sans', sans-serif; color:black;text-align:justify;">
                            {{ $post->title }}
                          </h4></a
                        >
                        <p style="font-family: 'Gill Sans', sans-serif; color:black;text-align:justify;">
                        <!-- {!!Str::limit($post->body, 200)!!} -->
                        {!!  substr(strip_tags($post->body), 0, 200) !!}..<a href="{{ route('post',$post->slug) }}" style="font-size:12px;color:blue;font-family: 'Gill Sans', sans-serif;">See More</a>
                        </p>
                        <p class="footer pt-20">
                          <i class="fa fa-heart-o" aria-hidden="true"></i>
                          <a href="#"style="font-family: 'Gill Sans', sans-serif; color:black;">{{ $post->likedUser->count() }} Likes</a>
                          <i
                            class="ml-20 fa fa-comment-o"
                            aria-hidden="true"
                          ></i>
                          <a href="#"style="font-family: 'Gill Sans', sans-serif; color:black;">{{ $post->comments->count() }} Comments</a>
                        </p>
                      </div>
                    </div>
                    @endforeach
                    @else
                        <h1 style="font-family: 'Gill Sans', sans-serif; color:black;">No posts availabe</h1>
                    @endif
                    <div class="justify-content-center d-flex mb-3"style="font-family: 'Gill Sans', sans-serif; color:black;">
                      {{ $posts->links()}}
                    </div>
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