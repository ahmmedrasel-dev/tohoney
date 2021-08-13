@extends('frontend.frontend-master')
@section('active_blog')
    active
@endsection
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Blog Page</h2>
                        <ul>
                            <li><a href="{{ route('blog.index') }}">Blog</a></li>
                            <li><span>Category Blog Post</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- blog-area start -->
    <div class="blog-area">
        <div class="container">
            <div class="col-lg-12">
                <div class="section-title  text-center">
                    <h2>Categorories Product</h2>
                    <img src="{{ asset('front/assets/images/section-title.png') }}" alt="">
                </div>
            </div>
            <div class="row">
                @foreach ( $categoryBlogs as $item )
                <div class="col-lg-4  col-md-6 col-12">
                    <div class="blog-wrap">
                        <div class="blog-image">
                            <img src="{{ asset('blog_images/'.$item->created_at->format('Y/m/').$item->id.'/'.$item->thumbnail) }}" alt="{{ $item->title }}">
                            <ul>
                                <li>{{ $item->created_at->format('d') }}</li>
                                <li>{{ $item->created_at->format('M') }}</li>
                            </ul>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <ul>
                                    <li><a href="#"><i class="fa fa-user"></i> {{ $item->User->name }}</a></li>
                                    <li class="pull-right"><a href="#"><i class="fa fa-clock-o"></i> {{ $item->created_at->format('Y/m/d') }}</a></li>
                                </ul>
                            </div>
                            <h3><a href="{{ route('blogDetails', $item->slug ) }}">{{ Str::limit($item->title, 40) }}</a></h3>
                            {!! Str::words($item->short_description, 30) !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- blog-area end -->
@endsection

