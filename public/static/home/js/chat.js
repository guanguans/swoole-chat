var wsUrl = "ws://192.168.10.10:8889";

var websocket = new WebSocket(wsUrl);

// 实例对象的 onopen 属性
websocket.onopen = function(evt) {
    websocket.send("hello：chat");
    console.log("webSocker-conected-success");
}

// 实例化 onmessage
websocket.onmessage = function(evt) {
    console.log("webSocker-return-data:" + evt.data);
    pushChat(evt.data);
}

// onclose
websocket.onclose = function(evt) {
    console.log("webSocker-close");
}

// onerror
websocket.onerror = function(evt, e) {
    console.log("webSocker-error-message:" + evt.data);
}

function pushChat(data) {
    data = JSON.parse(data);
    var html = '';
    html += '<div class="comment">'
    html += '    <span>' + data.userName + ':</span>'
    html += '    <span>' + data.message + '</span>'
    html += '</div>'

    $("#comments").prepend(html);
}