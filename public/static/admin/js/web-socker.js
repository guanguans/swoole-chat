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
}

// onclose
websocket.onclose = function(evt) {
    console.log("webSocker-close");
}

// onerror
websocket.onerror = function(evt, e) {
    console.log("webSocker-error-message:" + evt.data);
}