var table = document.getElementsByName("db");

function refresh() {
	location.reload();
}

function time(){
	var vWeek,vWeek_s,vDay;
	vWeek = ["星期天","星期一","星期二","星期三","星期四","星期五","星期六"];
	var date =  new Date();
	year = date.getFullYear();
	month = date.getMonth() + 1;
	day = date.getDate();
	hours = date.getHours();
	minutes = date.getMinutes();
	seconds = date.getSeconds();
	vWeek_s = date.getDay();
	document.getElementById("time").innerHTML = year + "年" + month + "月" + day + "日" + "\t" + hours + ":" + minutes +":" + seconds + "\t" + vWeek[vWeek_s];
};
setInterval("time()",1000);

function waiting(idname){
	var check_tr = document.getElementById("check"+idname.toString());
	check_tr.innerHTML = "<td>Waiting</td>";
}
function sendMsg(){
	console.log("waiting");
	return true;
}
function check(idname){
	waiting(idname);
	console.log("check"+idname.toString());
	var receiveMsg = sendMsg();
	var check_tr = document.getElementById("check"+idname.toString());
	if( receiveMsg ){
		check_tr.innerHTML = "<input value='Checked' readonly='readonly'/>";
	} else {
		check_tr.innerHTML = "<input type='submit' name='check_exist' value='Inform' onclick='check'/>";
	}
}