var wsUrl = "ws://192.168.10.10:8888";

var websocket = new WebSocket(wsUrl);

// 实例对象的 onopen 属性
websocket.onopen = function(evt) {
    websocket.send("hello：琯琯");
    console.log("webSocker-conected-success");
}

// 实例化 onmessage
websocket.onmessage = function(evt) {
    console.log("webSocker-return-data:" + evt.data);
    pushLive(evt.data);
}

// onclose
websocket.onclose = function(evt) {
    console.log("webSocker-close");
}

// onerror
websocket.onerror = function(evt, e) {
    console.log("webSocker-error-message:" + evt.data);
}

function pushLive(data)
{
	data = JSON.parse(data);
	var html = '';
	html += '<div class="frame">'
	html += '    <h3 class="frame-header">'
	html += '		<i class="icon iconfont icon-shijian"></i>第 '+data.type+' 节 01：30'
	html += '	 </h3>'
	html += '    <div class="frame-item">'
	html += '        <span class="frame-dot"></span>'
	html += '        <div class="frame-item-author">'
	if (data.logo) {
		html += '            <img src="./imgs/team1.png" width="20px" height="20px" />'
	}
	html += 				data.title
	html += '        </div>'
	html += '        <p>'+data.content+'</p>'
	html += '    </div>'
	html += '</div>'

	$("#match-result").prepend(html);
}

