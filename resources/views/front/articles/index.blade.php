@extends('front.layouts.app')
@section('content')
    <div  id="app" class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="container">
                        <div class="search-wrapper">
                            <div class="active-pink-3 active-pink-4 mb-4">
                                <form action="/" method="get">
                                    <input type="text" v-model="search"  name="q" class="col-md-8" placeholder="Search title.." class="form-control"  aria-label="Search"/>
                                    <input type="submit" class=" btn  btn-dark" value="Search">
                                </form>
                            </div>
                        </div>
                        @if (count($articles))
                        @foreach($articles as $article)
                        <div class="row">

                                   <a href="/articles/1">
                                    <h2 class="post-title">
                                        {{$article->title}}
                                    </h2>
                                   </a>
                                {{--</router-link>--}}
                                <h3 class="post-subtitle">
                                    {{str_limit($article->content,100)}}
                                </h3>
                                <p class="post-meta">Posted by
                                    <a href="#">{{$article->author}}</a>
                                    {{$article->created_at}}</p>
                            {{--</div>--}}

                            <hr>
                            <!-- Pager -->
                            <!--<div class="clearfix">-->
                            <!--<a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>-->
                            <!--</div>-->
                        </div>
                        @endforeach
                            @else
                            <div>No Data found</div>
                            @endif
                    </div>
                {{--<router-view name="listArticle"></router-view>--}}
                {{--<router-view></router-view>--}}
                {{--<hr>--}}
                {{--<!-- Pager -->--}}
                {{--<div class="clearfix">--}}
                    {{--<a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>

@endsection

