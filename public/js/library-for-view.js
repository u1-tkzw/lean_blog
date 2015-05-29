
/**
 * 改行コード処理用関数
 * 受け取った文字列の改行コード(\r,\n)を <br /> に置換
 * 
 * @param {type} str
 * @returns {unresolved}
 */ 
function nl2br(str) {
    return str.replace(/\\r?\\n/g, '<br />');
}

function getPostData(url){

    // 返却値格納用配列
    var res = [];

    // 記事を取得
    $.ajax({
        type: 'GET',
        url: url,
        cache: false,
        datatype: 'json',
        async: false,
        success: function (data, textStatus, jqXHR) {
            res = data;
        }
    });
}

function testA(){
    
}
/*
// 編集ボタン用
function editSubmit(url) {
    alert(url);
    location.href = url;
}
// 削除ボタン用
function deleteSubmit() {
    if (confirm('本当に削除しますか？')) {
        var url = '/delete/' + res['post'].id;
        document.frm.action = url;
        document.frm.submit();
    }
}
*/