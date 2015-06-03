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
    var url_base = getBaseURL();
    var url = url_base + '/post/edit/' + post_id;
    location.href = url;
}
function deleteSubmit(post_id) {
    if (confirm('この記事を本当に削除しますか？')) {
        var url_base = getBaseURL();
        var url = url_base + '/post/delete/' + post_id;
        console.log(url);
        location.href = url;
        /*
        document.frm.action = url;
        document.frm.submit();
        */
    }
}