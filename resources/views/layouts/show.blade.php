@extends('layouts.index')

@section('title', 'Комментарий')

@section('comments')
    <li id="li-comment-{{$comment->id}}" class="comment item{{$comment->id}}">
    <div class="block " style="width: auto;height: 200px;">
        <div id="comment-{{$comment->id}}" class="comment-container">
            <div class="comment-author vcard" style="height: auto">
                <img alt="" src="https://www.gravatar.com/avatar/{{md5($comment->email)}}?d=mm&s=75" class="avatar"
                     height="55" width="55">
                <cite class="fn">{{$comment->name}}</cite>
            </div>

            <div class="comment-meta commentmetadata">
                <div class="intro">
                    <div class="commentDate">
                        {{ is_object($comment->created_at) ? $comment->created_at->format('d.m.Y в H:i') : ''}}
                    </div>
                </div>
                <div class="comment-body">
                    <p>{{ $comment->text_comment }}</p>
                </div>

            </div>
        </div>
    </div>
    </li>

   <div> <a href="/comments" class="btn btn-info">Все комментарии</a></div>
@endsection