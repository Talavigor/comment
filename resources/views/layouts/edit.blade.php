@extends('layouts.index')

@section('title', 'Изменить комментарий')

@section('comments')
<div>
    <h3 id="reply-title"><span>Редактировать комментарий</span></h3>

    <form method="post" class="comment_form1"  action="{{action('CommentController@update',$id)}}" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        <div class="form-group">
            <input id="name" name="name" placeholder="Имя" type="text" value="{{$comment->name}}" size="30"
                   aria-required="true" class="form-control input_name"/>
        </div>
        <div class="form-group">
            <input id="email" name="email" placeholder="Email" type="text" value="{{$comment->email}}" size="30"
                   aria-required="true" class="form-control input_email"/>
        </div>
        <div class="form-group">
                        <textarea id="comment" placeholder="Ваш комментарий" name="text_comment" cols="45" rows="4"
                                  class="form-control input_textarea">{{$comment->text_comment}}</textarea>
        </div>

        <div class="clear"></div>

        <input  class="btn btn-primary" name="submit" type="submit"
               value="Обновить"/>

    </form>
    <div style="margin-top: 20px"><a href="http://comment/comments" class="btn btn-actions">Все комментарии</a></div>
</div>

@endsection