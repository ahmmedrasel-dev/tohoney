@extends('Frontend.frontend-master')
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Blog Details</h2>
                        <ul>
                            <li><a href="{{ route('blogs') }}">Blog</a></li>
                            <li><span>Blog Details</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- blog-details-area start-->
    <div class="blog-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="blog-details-wrap">
                        <img src="{{ asset('blog_images/'.$blogItem->created_at->format('Y/m/').$blogItem->id.'/'.$blogItem->feature_image ) }}" alt="{{ $blogItem->feature_images }}">
                        <h3>{{ $blogItem->title }}</h3>
                        <ul class="meta">
                            <li>{{ $blogItem->created_at->format('d M Y') }}</li>
                            <li>{{ $blogItem->User->name }}</li>
                        </ul>
                        {!! $blogItem->short_description !!}
                        <div class="share-wrap">
                            <div class="row">
                                <div class="col-sm-7 ">
                                    <ul class="socil-icon d-flex">
                                        <li>share it on :</li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-5 text-right">
                                    <a href="javascript:void(0);">Next Post <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-form-area">
                        <div class="comment-main">
                            <h3 class="blog-title"><span>(03)</span>Comments:</h3>
                            <ol class="comments">
                                <li class="comment even thread-even depth-1">
                                    <div class="comment-wrap">
                                        <div class="comment-theme">
                                            <div class="comment-image">
                                                <img src="assets/images/comment/1.png" alt="Jhon">
                                            </div>
                                        </div>
                                        <div class="comment-main-area">
                                            <div class="comment-wrapper">
                                                <div class="sewl-comments-meta">
                                                    <h4>Lily Justin </h4>
                                                    <span>19 JAN 2019  at 2:30pm</span>
                                                </div>
                                                <div class="comment-area">
                                                    <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-wrap">
                                        <div class="comment-theme">
                                            <div class="comment-image">
                                                <img src="assets/images/comment/2.png" alt="Jhon">
                                            </div>
                                        </div>
                                        <div class="comment-main-area">
                                            <div class="comment-wrapper">
                                                <div class="sewl-comments-meta">
                                                    <h4>Timberlake Justin </h4>
                                                    <span>19 JAN 2019  at 2:30pm</span>
                                                </div>
                                                <div class="comment-area">
                                                    <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-wrap">
                                        <div class="comment-theme">
                                            <div class="comment-image">
                                                <img src="assets/images/comment/3.png" alt="Jhon">
                                            </div>
                                        </div>
                                        <div class="comment-main-area">
                                            <div class="comment-wrapper">
                                                <div class="sewl-comments-meta">
                                                    <h4>Sata Houston </h4>
                                                    <span>19 JAN 2019  at 2:30pm</span>
                                                </div>
                                                <div class="comment-area">
                                                    <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                        <div id="respond" class="sewl-comment-form comment-respond form-style">
                            <h3 id="reply-title" class="blog-title">Leave a <span>comment</span></h3>
                            <form novalidate="" method="post" id="commentform" class="comment-form" action="#0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="sewl-form-inputs no-padding-left">
                                            <div class="row">
                                                <div class="col-sm-6 col-12">
                                                    <input id="name" name="name" value="" tabindex="2" placeholder="Name" type="text">
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <input id="email" name="email" value="" tabindex="3" placeholder="Email" type="email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="sewl-form-textarea no-padding-right">
                                            <textarea id="comment" name="comment" tabindex="4" rows="3" cols="30" placeholder="Write Your Comments..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-submit">
                                            <input name="submit" id="submit" value="Send" type="submit">
                                            <input name="comment_post_ID" value="1" id="comment_post_ID" type="hidden">
                                            <input name="comment_parent" id="comment_parent" value="0" type="hidden">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <aside class="sidebar-area">
                        <div class="widget widget_categories">
                            <h4 class="widget-title">Categories</h4>
                            <ul>
                                @foreach ( $categories as $item )
                                    <li><a href="{{ route('categoryBlogs', $item->id) }}">{{ $item->category_name }}({{ $item->Blog->count() }})</a></li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="widget widget_recent_entries recent_post">
                            <h4 class="widget-title">Recent Post</h4>
                            <ul>
                                @foreach ( $recent_blog as $item )
                                <li>
                                    <div class="post-img">
                                        <img style="width: 60px" src="{{ asset('blog_images/'.$item->created_at->format('Y/m/').$item->id.'/'.$item->thumbnail) }}" alt="">
                                    </div>
                                    <div class="post-content">
                                        <a href="blog-details.html">{{ $item->title }}</a>
                                        <p>{{ $item->created_at->format('d M Y') }}</p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- blog-details-area end -->
@endsection
