@extends('front.layouts.app')
@section('content')
    <div class="container">
        <div><h1>{{$article->title}}</h1></div>

        <div>{{$article->content}}</div>
        <hr>
        <div class="panel-body">
            <div><h1>Comments</h1></div>
            <div class="comments">
                @foreach($article->comments as $comment)
                    <p>
                       <div class="col-md-6"> {{$comment->text}}</div>
                    </p>
                    <hr>
                @endforeach
        </div>
        </div>
        <hr>
        <div class="panel-body">
            <form method="post" action="{{url('articles/'.$article->id.'/comments') }}" class="col-md-12">
                {{ csrf_field() }}
                <input type="hidden" name="article_id" value="{{$article->id}}">
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label"><h4> Add Comment</h4></label>
                        <textarea name="text" class="form-control rounded-0" id="exampleFormControlTextarea1" rows="6" cols="80"></textarea>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <button  type="submit" class="btn btn-success">Add Comment</button>
                    </div>
                </div>

            </form>


        </div>
    </div>
@endsection