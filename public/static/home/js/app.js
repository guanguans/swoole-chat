
/**
 * 系统配置
 */
var app = {
	host:'http://192.168.10.10:8888',
};

/**
 * 信息提示
 */
function msg(msg)
{
	layer.open({
	    content: msg,
	    skin: 'msg',
	    time: 2 //2秒后自动关闭
	});
}
