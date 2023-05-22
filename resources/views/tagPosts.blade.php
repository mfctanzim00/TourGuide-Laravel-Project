@extends('layouts.frontend.app')

@section('content')
    
     <!-- Start top-section Area -->
     <section class="top-section-area section-gap">
      <div class="container">
        <div class="row justify-content-between align-items-center d-flex">
          <div class="col-lg-8 top-left">
            <h1 class="text-white mb-20"style="font-family: 'Gill Sans', sans-serif; color:black;">All Posts of Tag {{ $query }}</h1>
            <ul>
              <li>
                <a href="index.html"style="font-family: 'Gill Sans', sans-serif; color:black;">Home</a
                ><span class="lnr lnr-arrow-right"></span>
              </li>
              <li>
                <a href="category.html"style="font-family: 'Gill Sans', sans-serif; color:black;">Tag</a
                ><span class="lnr lnr-arrow-right"></span>
              </li>
              <li><a href="single.html"style="font-family: 'Gill Sans', sans-serif; color:black;">Posts</a></li>
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
        <div class="container">
          <div class="row justify-content-center d-flex">
            <div class="col-lg-8">
              <div class="top-posts pt-50">
                <div class="container">
                  <div class="row justify-content-center">
                    @if ($tags->count() > 0)
                    @foreach($tags as $tag)
                    <div class="single-tags col-lg-6 col-sm-6">
                      <img class="img-fluid" src=" {{ asset('storage/post/'. $tag->post->image) }} " alt="{{ $tag->post->image }}" />
                      <div class="date mt-20 mb-20"style="font-family: 'Gill Sans', sans-serif; color:black;"> {{ $tag->post->created_at->format('D, d M Y H:i') }} </div>
                      <div class="detail">
                        <a href=" {{ route('tag.posts', $tag->post->slug) }} "style="font-family: 'Gill Sans', sans-serif; color:black;"
                          ><h4 class="pb-20"style="font-family: 'Gill Sans', sans-serif; color:black;">
                            {{ $tag->post->title }}
                          </h4></a
                        >
                        <p style="font-family: 'Gill Sans', sans-serif; color:black;">
                        <!-- {!!Str::limit($tag->post->body, 300)!!} -->
                        {!!  substr(strip_tags($post->body), 0, 200) !!}
                        </p>
                        <p class="footer pt-20">
                          <i class="fa fa-heart-o" aria-hidden="true"></i>
                          <a href="#"style="font-family: 'Gill Sans', sans-serif; color:black;">{{ $tag->post->likedUser->count() }} Likes</a>
                          <i
                            class="ml-20 fa fa-comment-o"
                            aria-hidden="true"
                          ></i>
                          <a href="#"style="font-family: 'Gill Sans', sans-serif; color:black;">{{ $tag->post->comments->count() }} Comments</a>
                        </p>
                      </div>
                    </div>
                    @endforeach
                    @else
                        <h1 style="font-family: 'Gill Sans', sans-serif; color:black;">No tags availabe</h1>
                    @endif
                    <div class="justify-content-center d-flex mb-3">
                      {{ $tags->appends(Request::all())->links() }}
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