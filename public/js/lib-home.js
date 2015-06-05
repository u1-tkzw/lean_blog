// DOM ロード後の実行関数
$(function(){
    // hidden 要素からユーザ ID 取得
    var user_id = $('#userId').val();
    // API 用の URL 生成
    var url = url_base + "/api/blog/posts?user_id=" + user_id + "&with_comments=true";
    
    // 記事データ取得・注入
    $.getJSON(url, null, function(data,status){
        // 記事注入(n件)
        $.views.settings.delimiters("{(",")}");
        $.views.tags("getUrlBase", function(){
            return url_base;
        });
        var result = $("#posts_template").render(data);
        $("#posts_area").html(result);
    });
});