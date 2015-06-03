var url_base = getBaseURL();
var url_home = url_base + '/post/mypost';
/*
function nl2br(str) {
    return str.replace(/\\r?\\n/g, '<br />');
}
*/
function getPostID(){
    var pathname = location.pathname;
    var strArray = pathname.split('/');
    return strArray[3];
}
function getBaseURL(){
    var url = location.protocol + '//' + location.host;
    return url;
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