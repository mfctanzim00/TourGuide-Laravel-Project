@extends('layouts.frontend.app')

@section('content')
<!-- start banner Area -->
    <section
      class="banner-area relative"
      id="home"
      data-parallax="scroll"
      data-image-src="{{asset('frontend/img/Sunrise_Seen_from_the_Helipad_at_Sajek_Valley.jpg')}}"style="height: 820px;"
    >
      <div class="overlay-bg overlay"></div>
      <div class="container">
        <div class="row fullscreen">
          <div
            class="banner-content d-flex align-items-center col-lg-12 col-md-12"
          >
            <h1 style="float: left;margin-left: 144px;font-family: 'Gill Sans', sans-serif; color:white;text-align:justify;" class="text-center">
              Welcome to TourGuide Website<br />
              <p style="font-family: 'Gill Sans', sans-serif;font-size:25px;">
              Explore the World
              </p>
            </h1>
          </div>

          <div
            class="head-bottom-meta d-flex justify-content-between align-items-end col-lg-12"
          >
            <div class="col-lg-6 flex-row d-flex meta-left no-padding">
             
            </div>
            <div
              class="col-lg-6 flex-row d-flex meta-right no-padding justify-content-end"
            >
             
          </div>
        </div>
      </div>
    </section>
    <!-- End banner Area -->

    <!-- Start category Area -->
    <section class="category-area section-gap" id="news">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="menu-content pb-70 col-lg-8">
            <div class="title text-center">
              <h1 class="mb-10" style="font-family: 'Gill Sans', sans-serif; color:black;">Latest Posts from all categories</h1>
              <p style="font-family: 'Gill Sans', sans-serif; color:black;">Find the Latest Post from all category.</p>
            </div>
          </div>
        </div>
        <div class="active-cat-carusel">
            @foreach($posts as $post)
            <div class="item single-cat">
               <!-- <div style="width:200px">
               <img src="{{ asset('storage/post/'. $post->image) }}" alt="$post->image" style="width:1000px; height: 200px;" />
                <p class="date">{{$post->created_at->diffForHumans()}}</p>
                <h4><a href=" {{ route('post', $post->slug) }} "> {{$post->title}} </a></h4>
</div> -->
<div  style="width:300px">
                <img src="{{ asset('storage/post/'.$post->image) }}" alt="$post->image" style="width:1000px; height: 200px;" class="img-fluid " />
                <p class="date" style="float: left;margin-left: -1px; width: 140px;"style="font-family: 'Gill Sans', sans-serif; color:black;">{{$post->created_at->diffForHumans()}}</p>
                <h4 style="float: left;margin-left: -144px; margin-top: 81px;"><a href=" {{ route('post', $post->slug) }} "style="font-family: 'Gill Sans', sans-serif; color:black;"> {{$post->title}} </a></h4>
            </div>
            </div>
            @endforeach
        </div>
      </div>
    </section>
    <!-- End category Area -->

    <section class="travel-area section-gap" id="travel">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="menu-content pb-70 col-lg-8">
					<div class="title text-center">
						<h1 class="mb-10"style="font-family: 'Gill Sans', sans-serif; color:black;">Hot topics of this Week</h1>
						<p style="font-family: 'Gill Sans', sans-serif; color:black;">The posts which are most views in this week.</p>
					</div>
				</div>
			</div>
				<div class="container">
				<div class="row justify-content-center">
                    @foreach($hotPosts as $post)
					<div class="single-posts col-lg-4 col-sm-4 mb-3">
						<img class="img-fluid" src="{{asset('storage/post/'.$post->image)}}" alt="{{$post->image}}"style="width:1000px; height: 200px;">
						<div class="date mt-20 mb-20"style="font-family: 'Gill Sans', sans-serif; color:white;">{{$post->created_at->diffForHumans()}}</div>
						<div class="detail">
							<a href=" {{ route('post', $post->slug) }} "><h4 class="pb-20"style="font-family: 'Gill Sans', sans-serif; color:black;">{{$post->title}}</h4></a>
							<p style="font-family: 'Gill Sans', sans-serif; color:black;text-align:justify;margin-top: -3px;">
             <!-- {!!Str::limit($post->body,400)!!} -->
             {!!  substr(strip_tags($post->body), 0, 150) !!} ..<a href="{{ route('post', $post->slug) }}"style="font-size:12px;color:blue;font-family: 'Gill Sans', sans-serif;">See More</a>
							</p>
							<!-- <p class="" footer=""style="font-family: 'Gill Sans', sans-serif; color:black;">
								<br>
								</p> -->
                                <ul class="d-flex space-around py-2 my-3" style="    margin-top: -22px;">
									<li><a href="javascript:void(0);" onclick=" toastr.info('To add to your favorite list you have to login first.', 'Info', { closeButton: true, progressBar: true, })"><i class="fa fa-heart-o" aria-hidden="true"></i><span> {{ $post->likedUser->count() }} </span></a></li>
									<li><i class="fa fa-comment-o" aria-hidden="true"></i><span> {{ $post->comments->count() }} </span></li>
									<li><i class="fa fa-eye" aria-hidden="true"></i> <span> {{ $post->view_count }} </span></li>
								</ul>
						<p></p>
						</div>
					</div>
                    @endforeach
				</div>
			</div>
		</div>
	</section>

    <!-- Start team Area -->
    <!-- <section class="team-area section-gap" id="about">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="menu-content pb-70 col-lg-8">
					<div class="title text-center">
						<h1 class="mb-10">About This Site</h1>
						<p>This is personal blogging site related to Internet of Things &amp; Web Development Tutorials</p>
					</div>
				</div>
			</div>
			<div class="row justify-content-center d-flex align-items-center">
				<div class="col-lg-6 team-left">
					<p>
						Find a blogs and tutorials related to Internet of things, Web Designe, Web Development, GIS Web applications and more.
					</p>
					<p>
						This site is made with laravel framework. The theme is <a href="">Blogger Theme</a> and the Admin Panel theme is <a href="https://github.com/puikinsh/sufee-admin-dashboard">Sufee Admin</a>.
          </p>
          <p>Checkout the full tutorial how this site is made on <span class="c1">Youtube</span>.</p>
					<h4>About the Creator</h4>
					<br>
					<p style="font-family: 'Gill Sans', sans-serif; color:black;">I am <span class="c1"style="font-family: 'Gill Sans', sans-serif; color:black;">Full stack Web Developer</span> specialized <span class="c1"style="font-family: 'Gill Sans', sans-serif; color:black;">LARAVEL</span> - PHP. Currently Studing GEOSPATIAL SCIENCE and learning <span class="c1"style="font-family: 'Gill Sans', sans-serif; color:black;">GIS Web Applications Development</span>. </p>
					<br>
					<h4>Email: <span style="font-size: medium; font-weight: lighter;"style="font-family: 'Gill Sans', sans-serif; color:black;">subhadipghorui105@gmail.com</span></h4>
					<br>
					<div class="col-md-12 d-flex justify-content-center py-3 mt-2">
						<a href="https://subhadipghorui.github.io" class="genric-btn info circle arrow mr-md-auto" target="_blank"style="font-family: 'Gill Sans', sans-serif; color:black;">Know More<span class="lnr lnr-arrow-right"style="font-family: 'Gill Sans', sans-serif; color:black;"></span></a>
					</div>
				</div>
				<div class="col-lg-6 team-right d-flex justify-content-center"style="font-family: 'Gill Sans', sans-serif; color:black;">
					<div class="row">
						<div class="single-team">
							<div class="thumb">
								<img class="img-fluid w-75 mx-auto" src="{{asset('frontend/img/admin.jpg')}}" alt="admin">
								<div class="align-items-center justify-content-center d-flex">
									<a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
									<a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a>
								</div>
							</div>
							<div class="meta-text mt-30 text-center"style="font-family: 'Gill Sans', sans-serif; color:black;">
								<h4>Tanzim Chowdhury</h4>
								<p>Creator</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<section class="team-area section-gap" id="about">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-70 col-lg-8">
          <div class="title text-center">
            <h1 class="mb-10" style="font-family: 'Gill Sans', sans-serif; font-weight:bold;">About Us</h1>

          </div>
        </div>
      </div>
      <div class="row justify-content-center d-flex align-items-center"style="font-family: 'Gill Sans', sans-serif;">
        <div class="col-lg-6 team-left"style="font-family: 'Gill Sans', sans-serif;">
          {{-- <p style="font-family: 'Gill Sans', sans-serif;">
            Find a blogs and tutorials related to Internet of things, Web Designe, Web Development, GIS Web applications and more.
          </p> --}}
          {{-- <p style="font-family: 'Gill Sans', sans-serif;">
            This site is made with laravel framework..
          </p> --}}


          <p style="font-family: 'Gill Sans', sans-serif;text-align:justify; ">
              We will work with you to plan a worry free adventure that meets your travel needs,expectations and budget.When you plan your vacation with us we are there through out the entire process.This means making ourselves available to you before during and after travel.

          </p>



          <br>
          <div class="col-md-12 d-flex justify-content-center py-3 mt-2">
            <a href="https://www.facebook.com/mfc.tanzim/" class="genric-btn btn-warning circle arrow mr-md-auto" target="_blank">Read More<span class="lnr lnr-arrow-right"></span></a>
          </div>
        </div>
        <div class="col-lg-6 team-right d-flex justify-content-center">
          <div class="row">
            <div class="single-team">
              <div class="thumb">
                <img class="img-fluid  mx-auto" src="{{asset('frontend/img/default.jpg')}}" alt="admin">
                <div class="align-items-center justify-content-center d-flex">
                  <a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                  <a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                </div>
              </div>
              <div class="meta-text mt-30 text-center">
                 <h4>Tanzim Chowdhury & Mahmuda Akter Munny</h4>
                <p>Creator</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- End team Area -->
@endsection