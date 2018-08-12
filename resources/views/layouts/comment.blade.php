@foreach($items as $item)
    <li id="li-comment-{{$item->id}}" class="comment item{{$item->id}}">
        <div class="block ">
            <div id="comment-{{$item->id}}" class="comment-container">
                <div class="comment-author vcard">
                    <img alt="" src="https://www.gravatar.com/avatar/{{md5($item->email)}}?d=mm&s=75" class="avatar"
                         height="55" width="55">
                    <cite class="fn">{{$item->name}}</cite>
                </div>

                <div class="comment-meta commentmetadata">
                    <div class="intro">
                        <div class="commentDate">
                            {{ is_object($item->created_at) ? $item->created_at->format('d.m.Y в H:i') : ''}}
                        </div>
                    </div>
                    <div class="comment-body">
                        <p>{{ $item->text_comment }}</p>
                    </div>
                    <div class="reply group group_button">
                        <a onclick="myfun(this)" data-reply="reply_id" class="btn btn-success comment-reply-link" data-id="{{$item->id}}">Ответить</a>

                        <a href="{{action('CommentController@edit',$item->id)}}"
                           class="btn btn-warning">Редактировать</a>

                        <a class="btn btn-danger deleteProduct" data-id="{{$item->id}}">Удалить</a>

                    </div>
                </div>
            </div>
        </div>


        @if(isset($comments[$item->id]))
            <ul class="children">
                @include(env('THEME').'layouts.comment', ['items' => $comments[$item->id]])
            </ul>
        @endif
    </li>
@endforeach
