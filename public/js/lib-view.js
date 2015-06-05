// 記事ID 取得
var post_id = getPostID();
// API 用の URL 生成
var url = url_base + '/api/blog/post/' + post_id;

// DOM ロード後の実行関数
$(function(){
    // hidden 要素からユーザ ID 取得
    var user_id = $('#userId').val();
    // 記事の取得・注入
    $.getJSON(url, null, function(data,status){
        // 記事注入(1件)
        $('#post_title').text(data['post'].title);
        $('#post_date').text(data['post'].date);
        $('#post_body').html(data['post'].body);
        // コメント注入(n件)
        $.views.settings.delimiters("{(",")}");
        var result = $("#comments_template").render(data['comments']);
        $("#comments_area").html(result);
        var button_html = $("#form_template").render({"post_id": post_id});
        if (data['post'].user_id == user_id){
            $('#control_button_area').html(button_html);
        }
    });
    $(document).on('click', '#deleteBtn', function() {
        deleteSubmit(post_id);
    });;
    $(document).on('click', '#editBtn', function() {
        editSubmit(post_id);
    });;
});

function getPostID(){
    var pathname = location.pathname;
    var strArray = pathname.split('/');
    return strArray[3];
}
function editSubmit(post_id) {
    var url = url_base + '/post/edit/' + post_id;
    location.href = url;
}
function deleteSubmit(post_id) {
    var url = url_base + '/api/blog/post/' + post_id;
    if (confirm('この記事を本当に削除しますか？')) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            url: url,
            type: 'DELETE',
            success: function(data) {
                alert('記事を削除しました。');
                location.href = url_home;
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('記事の削除に失敗しました。');
                location.href = url_home;
            }
        });
    }
}