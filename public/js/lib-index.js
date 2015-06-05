// DOM ロード後の実行関数
$(function(){
    // API 用の URL 生成
    var url = url_base + "/api/blog/posts?count=9&order=desc";
    
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
