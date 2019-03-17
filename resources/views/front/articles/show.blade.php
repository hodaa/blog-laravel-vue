@extends('front.layouts.app')
@section('content')
    <div class="container">
        <div><h1>{{$article->title}}</h1></div>

        <div>{{$article->content}}</div>
        <hr>
        <div class="panel-body">
            <form v-on:submit="comment()" class="col-md-12">
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label"><h4> Add Comment</h4></label>
                        <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="6" cols="80"></textarea>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12 form-group">
                        <button class="btn btn-success">Add Comment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection