@extends('layouts.index')

@section('title', 'Комментарии')

@section('comments')

    <div class="wrap_result"></div>

    <div id="comments">
        <ol class="commentlist group" id="comment_id">
        @foreach($comments as $k => $comment)
            <!--Выводим только родительские комментарии если parent_id = 0-->
                @if($k)
                    @break
                @endif
                @include('layouts.comment', ['items' => $comment])
            @endforeach
        </ol>

        <div><a class="btn btn-primary go1">Добавить комментарий</a></div>
        <div style="margin-top: 20px"><a href="http://comment" class="btn btn-actions">Вернуться на главную</a></div>
    </div>

    <!-- Модальное окно -->

    <div id="modal_form_comment" class="modal_form">

        <span id="modal_close">X</span>

        <div id="respond">
            <h3 id="reply-title"><span>Добавить комментарий</span></h3>

            <form class="comment_form" id="commentform">
                @csrf
                <div class="form-group">
                    <input id="name" name="name" placeholder="Имя" type="text" value="" size="30"
                           aria-required="true" class="form-control input_name"/>
                </div>
                <div class="form-group">
                    <input id="email" name="email" placeholder="Email" type="text" value="" size="30"
                           aria-required="true" class="form-control input_email"/>
                </div>
                <div class="form-group">
                        <textarea id="comment" placeholder="Ваш комментарий" name="text_comment" cols="45" rows="4"
                                  class="form-control input_textarea"></textarea>
                </div>

                <input type="hidden" id="comment_parent" name="comment_parent" value="" class="comment_parent">
                <input type="hidden" id="com_id" name="id" value="" class="com_id">


                <div class="clear"></div>

                <input id="submit_form" class="btn btn-primary" name="submit" type="submit" id="submit"
                       value="Отправить"/>

            </form>
        </div>

    </div>

    @if (count($errors) > 0)
        <div class = "alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script>
        function myfun(element) {
            var na = $(element).attr('data-id');
            $("#com_id").val(na);
            $('#name').val('');
            $('#email').val('');
            $('#comment').val('');

            $('#overlay').fadeIn(400,
                function () {
                    $('#modal_form_comment')
                        .css('display', 'block')
                        .animate({opacity: 1, top: '50%'}, 200);
                });
        };
    </script>

@endsection