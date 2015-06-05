// ベースURL取得
var url_base = getBaseURL();
// ホームの定義
var url_home = url_base + '/post/mypost';

function getBaseURL(){
    var url = location.protocol + '//' + location.host;
    return url;
}

