$(document).ready(function () {
    $(".comment-reply-link").click(function () {
        var na = $(this).attr('data-id');
        $("#com_id").val(na);

        return false;
    });


    $('#submit_form').click(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var name = $('.input_name').val();
        var email = $('.input_email').val();
        var text_comment = $('.input_textarea').val();
        var id = $('.com_id').val();

        $.ajax({
            url: '/comments',
            type: 'post',
            cache: false,
            data: {name: name, email: email, text_comment: text_comment, id: id, parent_id: id},
            success: function (data) {
                if (!!data['parent_id']) {

                    $('#li-comment-' + id).after('<ul class="children"><li id="li-comment-' + data['id'] + '" class="comment item' + data['id'] + '"><div class="block ">\n' +
                        '            <div id="comment-' + data['id'] + '" class="comment-container">\n' +
                        '                <div class="comment-author vcard">\n' +
                        '                    <img alt="" src="https://www.gravatar.com/avatar/' + data['email'] + '?d=mm&s=75" class="avatar"\n' +
                        '                         height="55" width="55">\n' +
                        '                    <cite class="fn">' + data['name'] + '</cite>\n' +
                        '                </div>\n' +
                        '\n' +
                        '                <div class="comment-meta commentmetadata">\n' +
                        '                    <div class="intro">\n' +
                        '                        <div class="commentDate">\n' + data['created_at'] +
                        '                        </div>\n' +
                        '                    </div>\n' +
                        '                    <div class="comment-body">\n' +
                        '                        <p>' + data['text_comment'] + '</p>\n' +
                        '                    </div>\n' +
                        '                    <div class="reply group">\n' +
                        '                        <a onclick="myfun(this)" data-reply="reply_id" data-id="' + data['id'] + '" class="btn btn-success comment-reply-link">Ответить</a>\n' +
                        '\n' +
                        '                        <a href="http://comment/comments/' + data['id'] + '/edit" class="btn btn-warning">Редактировать</a>\n' +
                        '\n' +
                        '                        <a class="btn btn-danger deleteProduct" data-id="' + data['id'] + '">Удалить</a>\n' +
                        '\n' +
                        '                    </div>\n' +
                        '                </div>\n' +
                        '            </div></div></li></ul>\n');
                } else {
                    $('#comment_id').append('<li id="li-comment-' + data['id'] + '" class="comment item' + data['id'] + '"><div class="block ">\n' +
                        '            <div id="comment-' + data['id'] + '" class="comment-container">\n' +
                        '                <div class="comment-author vcard">\n' +
                        '                    <img alt="" src="https://www.gravatar.com/avatar/' + data['email'] + '?d=mm&s=75" class="avatar"\n' +
                        '                         height="55" width="55">\n' +
                        '                    <cite class="fn">' + data['name'] + '</cite>\n' +
                        '                </div>\n' +
                        '\n' +
                        '                <div class="comment-meta commentmetadata">\n' +
                        '                    <div class="intro">\n' +
                        '                        <div class="commentDate">\n' + data['created_at'] +
                        '                        </div>\n' +
                        '                    </div>\n' +
                        '                    <div class="comment-body">\n' +
                        '                        <p>' + data['text_comment'] + '</p>\n' +
                        '                    </div>\n' +
                        '                    <div class="reply group">\n' +
                        '                        <a onclick="myfun(this)" data-reply="reply_id"  class="btn btn-success comment-reply-link">Ответить</a>\n' +
                        '\n' +
                        '                        <a href="http://comment/comments/' + data['id'] + '/edit" class="btn btn-warning">Редактировать</a>\n' +
                        '\n' +
                        '                        <a class="btn btn-danger deleteProduct" data-id="' + data['id'] + '">Удалить</a>\n' +
                        '\n' +
                        '                    </div>\n' +
                        '                </div>\n' +
                        '            </div></div></li>\n');
                }
            },
            error: function (data) {
                if (data.status === 422) {
                    toastr.error('Cannot add the comment');
                }
            }
        });
        return false;
    });


    // ajax deleting comments
    $(document).on('click', '.deleteProduct', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var dataId = $(this).attr('data-id');
        $.ajax({
            url: '/comments/' + dataId,
            type: 'DELETE',
            cache: false,
            data: {},
            success: function (data) {
                $('.item' + dataId).remove();
            },
            error: function (data) {
                if (data.status === 422) {
                    toastr.error('Cannot delete the comment');
                }
            }
        });
        return false;
    });

    // modal window

    var elem = $('.go1');

    elem.click(function (event) {
        event.preventDefault();
        $('#com_id').val('');
        $('#name').val('');
        $('#email').val('');
        $('#comment').val('');
        theActiveId = $(this).attr('id');

        $('#overlay').fadeIn(400,
            function () {
                $('#modal_form_comment')
                    .css('display', 'block')
                    .animate({opacity: 1, top: '50%'}, 200);
            });
    });

    $('#modal_close, #overlay,#submit_form').click(function () {
        $('#modal_form_comment')
            .animate({opacity: 0, top: '45%'}, 200,
                function () {
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
    });


})