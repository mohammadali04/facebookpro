@extends('social.index')
@section('content')
@foreach ($posts as $post)
@include('social.wall')
<div class="panel panel-default post">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2 row-child-1">
                <a class="post-avatar thumbnail" href="profile.html">
                    <img src="files/img/user.png">
                    <div class="text-center">DevUser1</div>

                </a>
                <div class="likes text-center row-child-2"><span class="likes-span">{{$post->likes()->count()}}</span>
                    Likes</div>
            </div>
            <!--col-sm-2 end-->
            <div class="col-sm-10">
                <div class="bubble">
                    <div class="pointer">
                        <p>{{$post->description}}</p>
                    </div>
                    <div class="pointer-border"></div>
                </div>
                <!--Bubble end -->
                <p class="post-actions"><a href="#">Comment</a> - <a class="active" onclick="like({{$post->id}},this)"
                        id="like-btn">Like</a> - <a href="#">Follow</a> - <a href="#">Share</a></p>

                <div class="comment-form">
                    <form action="{{Route('add.comment')}}" method="post" class="form-inline">
                    @csrf
                        <div class="form-group">
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <input type="text" name="comment" class="form-control" placeholder="Enter Comment">
                        </div>

                        <button type="submit" class="btn btn-default">Add</button>
                    </form>

                </div>
                <!--comment form end-->
                <div class="clearfix"></div>

                <div class="comments">
                    <div class="comment">
                        <a class="comment-avatar pull-left" href="#"><img src="files/img/user.png"></a>
                        <div class="comment-text">
                            <p>Aenean lacus ante, tempus at convallis a, mattis a nibh. </p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
@foreach ($post->comments()->get() as $comment)


                    <div class="comment">
                        <a class="comment-avatar pull-left" href="#"><img src="files/img/user.png"></a>
                        <div class="comment-text">
                            <p>{{$comment->comment}} </p>
                        </div>
                    </div>
                    @endforeach
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>
</div>
@endforeach
<div class="panel panel-default post">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2">
                <a class="post-avatar thumbnail" href="profile.html">
                    <img src="files/img/user.png">
                    <div class="text-center">DevUser1</div>

                </a>
                <div class="likes text-center">7 Likes</div>
            </div>
            <!--col-sm-2 end-->
            <div class="col-sm-10">
                <div class="bubble">
                    <div class="pointer">
                        <p>Consectetur adipiscing elit. Aenean finibus aliquam sem, id mollis neque
                            dictum ut. Suspendisse rhoncus placerat mauris posuere lobortis. Cras
                            cursus rhoncus interdum. Proin venenatis tellus id est venenatis, et
                            tempor est rhoncus.</p>
                    </div>
                    <div class="pointer-border"></div>
                </div>
                <!--Bubble end -->
                <p class="post-actions"><a href="#">Comment</a> - <a href="#">Like</a> - <a href="#">Follow</a> - <a
                        href="#">Share</a></p>
                <div class="comment-form">
                    <form class="form-inline">
                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Enter Comment">
                        </div>

                        <button type="submit" class="btn btn-default">Add</button>
                    </form>

                </div>
                <!--comment form end-->
                <div class="clearfix"></div>

                <div class="comments">
                    <div class="comment">
                        <a class="comment-avatar pull-left" href="#"><img src="files/img/user.png"></a>
                        <div class="comment-text">
                            <p>Croin venenatis tellus id est venenatis, et tempor est rhoncus. </p>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="comment">
                        <a class="comment-avatar pull-left" href="#"><img src="files/img/user.png"></a>
                        <div class="comment-text">
                            <p>Aenean lacus ante, tempus at convallis a, mattis a nibh. </p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="panel panel-default post">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2">
                <a class="post-avatar thumbnail" href="profile.html">
                    <img src="files/img/user.png">
                    <div class="text-center">DevUser3</div>

                </a>
                <div class="likes text-center">78 Likes</div>
            </div>
            <!--col-sm-2 end-->
            <div class="col-sm-10">
                <div class="bubble">
                    <div class="pointer">
                        <p>Suspendisse rhoncus placerat mauris posuere lobortis. Cras cursus rhoncus
                            interdum. Proin venenatis tellus id est venenatis, et tempor est
                            rhoncus.</p>
                    </div>
                    <div class="pointer-border"></div>
                </div>
                <!--Bubble end -->
                <p class="post-actions"><a href="#">Comment</a> - <a href="#">Like</a> - <a href="#">Follow</a> - <a
                        href="#">Share</a></p>
                <div class="comment-form">
                    <form class="form-inline">
                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Enter Comment">
                        </div>

                        <button type="submit" class="btn btn-default">Add</button>
                    </form>

                </div>
                <!--comment form end-->
                <div class="clearfix"></div>

                <div class="comments">
                    <div class="comment">
                        <a class="comment-avatar pull-left" href="#"><img src="files/img/user.png"></a>
                        <div class="comment-text">
                            <p>Aenean lacus ante, tempus at convallis a, mattis a nibh. </p>
                        </div>
                    </div>
                    <div class="clearfix"></div>


                </div>
            </div>
        </div>

    </div>
</div>
@endsection