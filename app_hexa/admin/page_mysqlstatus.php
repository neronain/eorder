<?
class Page_MysqlStatus extends Joay_ListPage {
	public function Test() {
		$this->GenerateHtml();
	}
	/*public static function GenerateScript($key){
		$domain = strtolower(Conf()->this_http_domain);
		$domain = str_replace('http://', '', $domain);
		?>
		$(document).ready(function(){
			Refresh<?=md5($domain)?>("<?=$domain?>");
		});
	
		function Refresh<?=md5($domain)?>(hostname){
			var protocol = 'https';
			var url = protocol+"://"+hostname+"/"+'<?=Def(Joay_Action_service)->URL_mysqlstatus(array('key'=>$key,'callback'=>"?"))?>';
			$.getJSON(url,
				function(data) {
				if(data==null) {
					LoggerNofity('Error '+hostname,"An internal error has occured");
				} else if(data.success) {
					//data.record
					return true;
				} else {
					LoggerNofity('Error '+hostname,"data.messages");
					return false;
				}
			});
		
			setTimeout("Refresh<?=md5($domain)?>('"+hostname+"')",20000);
		}
		<?
	}*/
	public static function GenerateHtml(){
	?>
<? include '../../app_hexa/_share/html_header.php'; ?>
<style>
.table-record-list tr td {
	padding: 4px 2px;
	height:60px;
}
.table-record-list {
	font-size:11px;
}
.table-record-list th{
	font-size:11px;
}
.table-record-list th.double2 {
	font-size:11px;
}

#processList tr td{
	padding: 6px 2px;
	height:auto;
	text-align:center;
}

.processdetail{
	width:100%;
}
.Process_Id{
	width:60px;
}
.Process_User{
	width:80px;
}
.Process_Host{
	width:150px;
}
.Process_db{
	width:100px;
}
.Process_Command{
	width:80px;
}
.Process_Time{
	width:60px;
}
.Process_State{
	width:350px;
}
.Process_Info{
	
}
.Last_Error_TD{
	
}
.Last_Error{
	position:absolute;
	display:block;
	right:0;
	width:400px;
	background:rgba(255,255,255,128);
	opacity:0.8;
}

</style>
<a target="_blank" href="https://hexaceram">hexaceram</a>
<div class="div-main-auto">
	<div class="div-main-head">

		<div class="div-clear"></div>
	</div>
	<div id="debug_log">
	</div>
	<!-- BEGIN PAGE CONTENT -->
	<table class="table-record-list" cellpadding="0" cellspacing="0">
		<tr>
			<th class="" rowspan="2">[/]</th>
			<th class="padleft" rowspan="2">Host</th>
			<th class="double" colspan="2">Master</th>
			<th rowspan="2">&nbsp;</th>
			<th class="double" colspan="11">Slave</th>
			<th class="double" rowspan="2">Action</th>
		</tr>
		<tr>
			<th class="double2">File</th>
			<th class="double2">Position</th>

			<th class="double2">IO</th>
			<th class="double2">SQL</th>
			<th class="double2">IO State</th>

			<th class="double2">Master Host</th>
			<th class="double2">Master Log</th>

			<th class="double2">Read_Master_Log_Pos</th>
			<th class="double2">R_Speed</th>
			<th class="double2">Relay_Master_Log_File</th>
			<th class="double2">Relay_Log_Pos</th>
			<th class="double2">Exec_Master_Log_Pos</th>
			<!--  th class="double2">Errno</th-->
			<th class="double2"><!-- Error --></th>
			<!-- th class="double2">Skip_Counter</th-->
			
		</tr>
		<tbody id=mysqlList>
		
		</tbody>
	</table>
	
	<br />
<br />
	
	<!-- BEGIN PAGE CONTENT -->
	<table class="table-record-list" cellpadding="0" cellspacing="0">
		<tr>
			<th class="padleft" width="150">Host</th>
			<th class="Process_Id">Id</th>
			<th class="Process_User">User</th>
			<th class="Process_Host">Host</th>
			<th class="Process_db">db</th>
			<th class="Process_Command">Cmd</th>
			<th class="Process_Time">Time</th>
			<th class="Process_State">State</th>
			<th class="Process_Info">Info</th>
		</tr>
		<tbody id=processList>
		
		</tbody>
	</table>	
	
	
	
	
</div>
<!-- END PAGE CONTENT -->
<br />
<br />
<script>
$(document).ready(function(){
	Refresh("hexaceram/eorder2",0,30000*2);
});


var datarecord = {};
function RestartSlave(hostname,trid){
	if(typeof(threadRefresh[hostname])!='undefined'){
		clearTimeout(threadRefresh[hostname]);
	}
	$('#'+trid).html('<td colspan="18" height="60" align="center">Reload...</td>');//remove();
	$('#'+trid+'_detail').html('<td colspan="18" height="60" align="center">Reload...</td>');//.remove();
	var protocol = 'https';
	var url = protocol+"://"+hostname+"/"+'<?=Def(Joay_Action_service)->URL_mysqlrestartslave(array('key'=>Joay_Action_service::GenKey(),'callback'=>"?"))?>';
	$.getJSON(url,function(){
		if(lastRefresh[hostname]){
			Refresh(hostname,0,lastRefresh[hostname].rate);
		}else{
			Refresh(hostname,0,5000);
		}
	
	});


	return false;
}

function StartSlave(hostname,trid){
	if(typeof(threadRefresh[hostname])!='undefined'){
		clearTimeout(threadRefresh[hostname]);
	}
	$('#'+trid).html('<td colspan="18" height="60" align="center">Reload...</td>');//.remove();
	$('#'+trid+'_detail').html('<td colspan="18" height="60" align="center">Reload...</td>');//.remove();
	var protocol = 'https';
	var url = protocol+"://"+hostname+"/"+'<?=Def(Joay_Action_service)->URL_mysqlstartslave(array('key'=>Joay_Action_service::GenKey(),'callback'=>"?"))?>';
	$.getJSON(url,function(){
		if(lastRefresh[hostname]){
			Refresh(hostname,0,lastRefresh[hostname].rate);
		}else{
			Refresh(hostname,0,5000);
		}
	
	});


	return false;
}

function StopSlave(hostname,trid){
	if(typeof(threadRefresh[hostname])!='undefined'){
		clearTimeout(threadRefresh[hostname]);
	}
	$('#'+trid).html('<td colspan="18" height="60" align="center">Reload...</td>');//.remove();
	$('#'+trid+'_detail').html('<td colspan="18" height="60" align="center">Reload...</td>');//.remove();
	var protocol = 'https';
	var url = protocol+"://"+hostname+"/"+'<?=Def(Joay_Action_service)->URL_mysqlstopslave(array('key'=>Joay_Action_service::GenKey(),'callback'=>"?"))?>';
	$.getJSON(url,function(){
		if(lastRefresh[hostname]){
			Refresh(hostname,0,lastRefresh[hostname].rate);
		}else{
			Refresh(hostname,0,5000);
		}
	
	});


	return false;
}


function SkipSlave(hostname,trid){
	if(typeof(threadRefresh[hostname])!='undefined'){
		clearTimeout(threadRefresh[hostname]);
	}
	var lastErrorRecord = $(".Last_Error",$('#'+trid)).html();
	lastErrorRecord = lastErrorRecord.replace(/\[Skip\]/,'');
	$(".Last_Error",$('#'+trid)).html('<td colspan="18" height="60" align="center">Reload SkipSlave( '+hostname+', '+trid+' )<br/>'+lastErrorRecord+'</td>');//.remove();
	$('#'+trid+'_detail').html('<td colspan="18" height="60" align="center">Reload...</td>');//.remove();
	var protocol = 'https';
	var url = protocol+"://"+hostname+"/"+'<?=Def(Joay_Action_service)->URL_mysqlskip(array('key'=>Joay_Action_service::GenKey(),'callback'=>"?"))?>';
	$.getJSON(url,function(){
		if(lastRefresh[hostname]){
			Refresh(hostname,0,lastRefresh[hostname].rate);
		}else{
			Refresh(hostname,0,5000);
		}
	
	});

	
	return false;
}
function FixSlave(hostname,trid){
	if(!confirm('Confirm?')){
		return;
	}
	if(typeof(threadRefresh[hostname])!='undefined'){
		clearTimeout(threadRefresh[hostname]);
	}
	$('#'+trid).html('<td colspan="18" height="60" align="center">Reload...</td>');//.remove();
	$('#'+trid+'_detail').html('<td colspan="18" height="60" align="center">Reload...</td>');//.remove();
	var protocol = 'https';
	var url = protocol+"://"+hostname+"/"+'<?=Def(Joay_Action_service)->URL_mysqlfixrelay(array('key'=>Joay_Action_service::GenKey(),'callback'=>"?"))?>';
	$.getJSON(url,function(data){
		if(data.success){

		}else{
			alert(data.messages);
		}
		if(lastRefresh[hostname]){
			Refresh(hostname,0,lastRefresh[hostname].rate);
		}else{
			Refresh(hostname,0,5000);
		}
		
	});

	
	return false;
}



function fixdup(hostname,trid,table,indexkey,key1,key2,key3){
	if(typeof(threadRefresh[hostname])!='undefined'){
		clearTimeout(threadRefresh[hostname]);
	}
	if(key3===undefined){
		key3 = '';
	}
	var lastErrorRecord = $(".Last_Error",$('#'+trid)).html();
	lastErrorRecord = lastErrorRecord.replace(/\[FIX\]/,'');
	$(".Last_Error",$('#'+trid)).html('<td colspan="18" height="60" align="center">Reload...fixdup('+hostname+', '+trid+', '+table+', '+indexkey+', '+key1+', '+key2+', '+key3+')<br/>'+lastErrorRecord+'</td>');//.remove();
	$('#'+trid+'_detail').html('<td colspan="18" height="60" align="center">Reload...</td>');//.remove();
	var protocol = 'https';
	var url = protocol+"://"+hostname+"/"+'<?=Def(Joay_Action_service)->URL_fixdup(array('table'=>"'+table+'",'indexkey'=>"'+indexkey+'",'key1'=>"'+key1+'",'key2'=>"'+key2+'",'key3'=>"'+key3+'",'key'=>Joay_Action_service::GenKey(),'callback'=>"?"))?>';
	$.getJSON(url,function(data){
		if(data.success){

		}else{
			
			alert(data.messages+lastErrorRecord);
		}	
		if(lastRefresh[hostname]){
			Refresh(hostname,0,lastRefresh[hostname].rate);
		}else{
			Refresh(hostname,0,5000);
		}
	});

	
	return false;

}



function OstringToHex (s) {
	  var r = "0x";
	  var hexes = new Array ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");
	  for (var i=0; i<s.length; i++) {
		  r += hexes [s.charCodeAt(i) >> 4] + hexes [s.charCodeAt(i) & 0xf];
	  }
	  return r;
}

function OhexToString (h) {
  	var r = "";
  	for (var i= (h.substr(0, 2)=="0x")?2:0; i<h.length; i+=2) {
	  r += String.fromCharCode (parseInt (h.substr (i, 2), 16));
	}
  	return r;
}


function stringToHex (s) {
	var r = "0x";
	var hexes = new Array ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");
	for (var i=0; i<s.length; i++) {
		var c = s.charCodeAt(i);
        if (c < 128) {
        	r += hexes [c >> 4] + hexes [c & 0xf];
        	//console.log('charCodeAt(i)='+c+'>'+hexes [c >> 4] + hexes [c & 0xf]);	
        } else if (c > 127 && c < 2048) {
        	//r += hexes [c >> 4] + hexes [c & 0xf];
            r += String.fromCharCode(c >> 6 | 192);
            r += String.fromCharCode(c & 63 | 128);
        	//console.log('charCodeAt(i)='+c+'>'+String.fromCharCode(c >> 6 | 192) +String.fromCharCode(c & 63 | 128));	
        } else{
            r += String.fromCharCode(c >> 12 | 224);
            r += String.fromCharCode(c >> 6 & 63 | 128);
            r += String.fromCharCode(c & 63 | 128);
            //console.log('charCodeAt(i)='+c+'>'+String.fromCharCode(c >> 12 | 224) + String.fromCharCode(c >> 6 & 63 | 128)+String.fromCharCode(c & 63 | 128));	
        }
	}
	return escape(r).replace(/%/g,'');
}

function hexToString (h) {
  	var r = "";
  	var i= (h.substr(0, 2)=="0x")?2:0;
  	while (i < h.length) {
        c = parseInt (h.substr (i, 2), 16)
        if (c < 128) {
        	r += String.fromCharCode (c);
            //console.log('charCodeAtX('+h.substr (i, 2)+')='+c);
            i+=2;
        } else if (c > 191 && c < 224) {
        	c1 = parseInt (h.substr (i, 2), 16)
        	c2 = parseInt (h.substr (i+2, 2), 16)
            r += String.fromCharCode((c1 & 31) << 6 | c2 & 63);
            //console.log('charCodeAtY('+h.substr (i, 2)+h.substr (i+2, 2)+')='+((c1 & 31) << 6 | c2 & 63));
            i += 4;
        } else {
        	c1 = parseInt (h.substr (i, 2), 16)
        	c2 = parseInt (h.substr (i+2, 2), 16)
            c3 = parseInt (h.substr (i+4, 2), 16)
            r += String.fromCharCode((c1 & 15) << 12 | (c2 & 63) << 6 | c3 & 63);
        	//console.log('charCodeAtZ('+h.substr (i, 2)+h.substr (i+2, 2)+h.substr (i+4, 2)+')='+((c1 & 15) << 12 | (c2 & 63) << 6 | c3 & 63));
        	//r += String.fromCharCode((c & 31) << 16 | (c2 & 127) << 10 | c3 & 127);
            i += 6;
        }
    }

  	return r;
}


function ProcessData(data){

}
var threadRefresh = {};
var lastRefresh = {};
var threadAttempt = {};
function Refresh(hostname,delay,rate){
	if(typeof(threadRefresh[hostname])!='undefined'){
		clearTimeout(threadRefresh[hostname]);
	}
	var unique = stringToHex(hostname);
	if(rate===undefined){
		rate = 10000;
	}

	if($('#refresh'+unique+'').length>0 && !$('#refresh'+unique+'').prop('checked')){
		threadRefresh[hostname] = setTimeout("Refresh('"+hostname+"',0,"+rate+")",rate+delay);
		return;
	}


	if(typeof(threadAttempt[unique])=='undefined'){
		threadAttempt[unique] = 1;	
	}else{
		threadAttempt[unique]++;
		if(threadAttempt[unique]>3 && $('#refresh'+unique+'').length==0){
			console.log('Stop refresh '+hostname+'');
			return;
		}
	}
	
	var protocol = 'https';

	var url = protocol+"://"+hostname+"/"+'<?=Def(Joay_Action_service)->URL_mysqlstatus(array('key'=>Joay_Action_service::GenKey(),'callback'=>"?"))?>';
	$.getJSON(url,
		function(data) {
		if(data==null) {
			LoggerNofity('Error '+hostname,"An internal error has occured");
		} else if(data.success) {
			var nowdate = (new Date()).getTime();		
			
			var ip='';
			switch(hostname){
				case 'localhost/eorder2':
					ip = "127.0.0.1";
					break;
				case "hexaceram/eorder2":
					ip = "110.164.212.183";
					break;

			}


			var virtualnode = {}
			virtualnode['110.164.212.183'] = 'background:#F99;';
			virtualnode['127.0.0.1'] = 'background:#CCC;';
			
			
			//virtualnode['50.28.6.62'] = '<span style="background:#FF0">192.168.13.1</span>';
			var defstyle = 'padding:1px;border:solid 1px #666;display:inline-block;width:80px;';
			var masterstyle = defstyle+(virtualnode[data.record.slave.Master_Host]===undefined?'':virtualnode[data.record.slave.Master_Host]);
			var slavestyle = defstyle+(virtualnode[ip]===undefined?'':virtualnode[ip]);
			
			
			
			var server_id = 'n/a';
			var slave_max_allowed_packet = 1073741824;
			var mhostname = '-';
			if(data.record.variable!==undefined){
				server_id = data.record.variable.server_id;
				if(data.record.variable.slave_max_allowed_packet!==undefined){
					slave_max_allowed_packet = data.record.variable.slave_max_allowed_packet;//1073741824;
				}
				
				mhostname = data.record.variable.hostname;
			}
			
			//if(data.record.slave.Master_Host=='192.168.11.17' || data.record.slave.Master_Host=='192.168.1.5'){
			//	data.record.slave.Master_Host = "50.28.24.35";
			//}
			
			data.record.id = ip.replace(/\./g,'');
			
			var text = '';
			var detail = '';
			text += '<td><input type="checkbox" id="refresh'+unique+'" checked="checked"/></td>';
			text += '<td class="align-left" valign="top">'+hostname+'<br/><span class="smalltext" style="'+slavestyle+'">'+ip+'</span><span id="timediff'+data.record.id+'"></span><br/>['+server_id+':'+data.record.variable.auto_increment_offset+'] '+mhostname+' </td>';

			if(typeof(data.record.master.File)!='undefined'){
				text += '<td class="File">'+data.record.master.File+'</td>';

				var file_size_percent = Math.round(data.record.master.Position/slave_max_allowed_packet*100);
				var file_size_html = '<table cellpadding="0" cellspacing="0" class="smalltext_gray" align="center" width="100" style="border:1px solid #333"><tr><td width="'+file_size_percent+'" style="background:#666;height:6px;padding:0px;margin:0px"></td><td width="'+(100-file_size_percent)+'" style="background:#EEE;height:6px;padding:0px;margin:0px"></td></tr></table>';
				
				
				text += '<td class="Position">'+data.record.master.Position+''+file_size_html+'</td>';
			}else{
				text += '<td class="File">-</td>';
				text += '<td class="Position">-</td>';
			}

			text += '<td class=""></td>';

			text += '<td class="Slave_IO_Running">'+data.record.slave.Slave_IO_Running+'</td>';
			text += '<td class="Slave_SQL_Running">'+data.record.slave.Slave_SQL_Running+'</td>';
			text += '<td class="Slave_IO_State">'+data.record.slave.Slave_IO_State+'</td>';

			//&darr;&darr;<br/>
			text += '<td class="Master_Host"><span style="'+masterstyle+'">M '+data.record.slave.Master_Host+'</span><br/><span style="'+slavestyle+'">S '+ip+'</span></td>';
			text += '<td class="Master_Log_File">'+data.record.slave.Master_Log_File+'</td>';
			{
				var file_size_percent = Math.round(data.record.slave.Read_Master_Log_Pos/slave_max_allowed_packet*100);
				var file_size_html = '<table cellpadding="0" cellspacing="0" class="smalltext_gray" align="center" width="100" style="border:1px solid #333"><tr><td width="'+file_size_percent+'" style="background:#666;height:6px;padding:0px;margin:0px"></td><td width="'+(100-file_size_percent)+'" style="background:#EEE;height:6px;padding:0px;margin:0px"></td></tr></table>';
				
				text += '<td class="Read_Master_Log_Pos">'+data.record.slave.Read_Master_Log_Pos+''+file_size_html+'</td>';
			}
			if(typeof(lastRefresh[hostname])!='undefined'){
				var rspeed = Math.round((data.record.slave.Read_Master_Log_Pos-lastRefresh[hostname].slave.Read_Master_Log_Pos)*1000/(nowdate-lastRefresh[hostname].lastfresh));
				if(rspeed>1000000){
					rspeed = Math.round(rspeed/1000000)+"M";
				}else if(rspeed>1000){
					rspeed = Math.round(rspeed/1000)+"K";
				}
				text += '<td class="Read_Master_Log_Pos_Diff">'+rspeed+'/s</td>';
			}else{
				text += '<td class="Read_Master_Log_Pos_Diff">&nbsp;</td>';

			}					

			var changemaster_qry = "CHANGE MASTER TO MASTER_HOST = '"+data.record.slave.Master_Host+"', MASTER_LOG_FILE='"+data.record.slave.Master_Log_File+"', MASTER_LOG_POS="+data.record.slave.Exec_Master_Log_Pos+";"
			
			
			text += '<td class="Relay_Master_Log_File">'+data.record.slave.Relay_Master_Log_File+'</td>';
			text += '<td class="Relay_Log_Pos">'+data.record.slave.Relay_Log_Pos+'</td>';
			text += '<td class="Exec_Master_Log_Pos">'+data.record.slave.Exec_Master_Log_Pos+'</td>';
			//text += '<td class="Last_Errno">'+data.record.slave.Last_Errno+'</td>';
			text += '<td class="Last_Error_TD"><div class="Last_Error">'+(data.record.slave.Last_Errno>0?data.record.slave.Last_Errno+": ":"")+data.record.slave.Last_Error.replace(/([\(,])/g,'$1 ')+'</div></td>';
			//text += '<td class="Skip_Counter">'+data.record.slave.Skip_Counter+'</td>';
			text += '<td class="Skip_Counter"> '+
				'<a href="#" onclick="return StartSlave(\''+hostname+'\',\'mysql' + data.record.id + '\');">Start</a> '+
				'<a href="#" onclick="return StopSlave(\''+hostname+'\',\'mysql' + data.record.id + '\');">Stop</a> '+
				'<a href="#" onclick="return FixSlave(\''+hostname+'\',\'mysql' + data.record.id + '\');">FixBroke</a> '+'<br/>'+
				'<input style="font-size:8px" value="'+changemaster_qry+'"/></td>';
			


			var process_table = '';
			process_table += '<td class="" valign="top">'+hostname+'<br/><span class="smalltext_gray">'+ip+'</span><span id="timediff'+data.record.id+'"></span></td>';
			process_table += '<td colspan="8">';
			process_table += '<table class="processdetail">';
			for(i in data.record.process){
				var connect_host = data.record.process[i].Host.replace(/:.+$/g,'');

				switch(connect_host){
					case 'http://110.164.212.183/':	
						connect_host = "hexaceram";
						break;						
					case 'localhost':
						switch(data.record.id){
							case '127001':
								connect_host = 'LOCAL';
								break;
							default:
								connect_host = data.record.id;
						}
						break;
						
				}
				
				if(data.record.process[i].db==null){
					data.record.process[i].db = '';
				}
				if(data.record.process[i].State==null){
					data.record.process[i].State = '';
				}
				if(data.record.process[i].Info==null){
					data.record.process[i].Info = '';
				}
							
				
				process_table += '<tr>';
				process_table += '<td class="Process_Id">'+data.record.process[i].Id+'</td>';
				process_table += '<td class="Process_User">'+data.record.process[i].User+'</td>';
				process_table += '<td class="Process_Host">'+connect_host+'</td>';
				process_table += '<td class="Process_db">'+data.record.process[i].db+'</td>';
				process_table += '<td class="Process_Command">'+data.record.process[i].Command+'</td>';
				process_table += '<td class="Process_Time">'+data.record.process[i].Time+'</td>';
				process_table += '<td class="Process_State">'+data.record.process[i].State+'</td>';
				process_table += '<td class="Process_Info">'+data.record.process[i].Info+'</td>';
				process_table += '</tr>';
			}
			process_table += '</table></td>';
			
			
			//alert('#mysql' + data.record.id);
			if($('#mysql' + data.record.id).length>0) {
				//var fcolor = $('.File',$('#mysql' + data.record.id)).css('color');
				//var pcolor = $('.Position',$('#mysql' + data.record.id)).css('color');

				$('#mysql' + data.record.id).html(text);
				$('#mysql' + data.record.id+'_detail').html(process_table);
				//$('.File',$('#mysql' + data.record.id)).css('color',fcolor);
				//$('.Position',$('#mysql' + data.record.id)).css('color',pcolor);
			} else {
				$('#mysqlList').append('<tr class="record-list" id="mysql' + data.record.id + '">' + text + '</tr>');
				
				$('#processList').append('<tr class="record-list" id="mysql' + data.record.id + '_detail">' + process_table + '</tr>');
				
			}	

			if(data.record.slave.Last_Error!=''){
				
				//var match = data.record.slave.Last_Error.match(/Duplicate entry '(\d+)\-(\d+)' for key '([^ ]+)'' .+ '(Insert Into|Update) ([^ \(]+) /i);

				/*var match = data.record.slave.Last_Error.match(/Duplicate entry '(\d+)\-(\d+)' for key '([^ ]+)'' .+ '(Insert Into|Update) ([^ \(]+) /i);
				console.log(match[1]);
				console.log(match[2]);
				console.log(match[3]);
				console.log(match[4]);*/
				var match = null;
				if(match = data.record.slave.Last_Error.match(/Duplicate entry '(.+?)\-(.+?)\-(.+?)' for key '([^ ]+)'' .+ '(Insert Into|Update) ([^ \(]+) /i)){
					
					/*console.log(match[1]);
					console.log(match[2]);
					console.log(match[3]);
					console.log(match[4]);*/
					if(hostname=='localhost/eorder2'){
						

						//console.log(match[0]);
						setTimeout('fixdup(\''+hostname+'\',\'mysql' + data.record.id + '\',\''+match[6]+'\',\''+match[4]+'\',\''+match[1]+'\',\''+match[2]+'\',\''+match[3]+'\');',5);
						//fixdup(hostname,'mysql' + data.record.id,match[3],match[2],match[1],0);
					}else{
						$(".Last_Error",$('#mysql' + data.record.id)).append(' <a href="#" onclick="fixdup(\''+hostname+'\',\'mysql' + data.record.id + '\',\''+match[6]+'\',\''+match[4]+'\',\''+match[1]+'\',\''+match[2]+'\',\''+match[3]+'\')">[FIX]</a>');
					}
				
				}else if(match = data.record.slave.Last_Error.match(/Duplicate entry '(\d+)\-(.+?)' for key '?([^ ]+)''? .+ '(Insert Into|Update) ([^ \(]+) /i)){
					/*console.log(match[1]);
					console.log(match[2]);
					console.log(match[3]);
					console.log(match[4]);*/
					if(hostname=='localhost/eorder2'){
						//console.log(match[0]);
						setTimeout('fixdup(\''+hostname+'\',\'mysql' + data.record.id + '\',\''+match[5]+'\',\''+match[3]+'\',\''+match[1]+'\',\''+match[2]+'\');',5);
						//fixdup(hostname,'mysql' + data.record.id,match[3],match[2],match[1],0);
					}else{
						$(".Last_Error",$('#mysql' + data.record.id)).append(' <a href="#" onclick="fixdup(\''+hostname+'\',\'mysql' + data.record.id + '\',\''+match[5]+'\',\''+match[3]+'\',\''+match[1]+'\',\''+match[2]+'\')">[FIX]</a>');
					}
				}else if(match = data.record.slave.Last_Error.match(/Duplicate entry '(.+?)' for key '([^ ]+)'' .+ 'Insert Into ([^ \(]+) /i)){
					/*console.log(match[1]);
					console.log(match[2]);
					console.log(match[3]);
					console.log(match[4]);*/
					if(hostname=='localhost/eorder2'){
						//console.log(match[0]);
						setTimeout('fixdup(\''+hostname+'\',\'mysql' + data.record.id + '\',\''+match[3]+'\',\''+match[2]+'\',\''+match[1]+'\',0);',5);
						//fixdup(hostname,'mysql' + data.record.id,match[3],match[2],match[1],0);
					}else{
						$(".Last_Error",$('#mysql' + data.record.id)).append(' <a href="#" onclick="fixdup(\''+hostname+'\',\'mysql' + data.record.id + '\',\''+match[3]+'\',\''+match[2]+'\',\''+match[1]+'\',0)">[FIX]</a>');
					}
				}else if(match = data.record.slave.Last_Error.match(/Duplicate entry '(.+?)' for key (\d+)' .+ 'Insert Into ([^ \(]+) /i)){
					/*console.log(match[1]);
					console.log(match[2]);
					console.log(match[3]);
					console.log(match[4]);*/
					if(hostname=='localhost/eorder2'){
						//console.log(match[0]);
						if(match[2]=='1'){
							match[2] = 'PRIMARY';
						}
						setTimeout('fixdup(\''+hostname+'\',\'mysql' + data.record.id + '\',\''+match[3]+'\',\''+match[2]+'\',\''+match[1]+'\',0);',5);
						//fixdup(hostname,'mysql' + data.record.id,match[3],match[2],match[1],0);
					}else{
						$(".Last_Error",$('#mysql' + data.record.id)).append(' <a href="#" onclick="fixdup(\''+hostname+'\',\'mysql' + data.record.id + '\',\''+match[3]+'\',\''+match[2]+'\',\''+match[1]+'\',0)">[FIX]</a>');
					}
					
				}else if(match = data.record.slave.Last_Error.match(/Duplicate entry '(.+?)' for key (\d+)' .+ 'Insert Into ([^ \(]+) /i)){

					
				}else if(match = data.record.slave.Last_Error.match(/dental\/(.+?).MYI\'; try to repair it\'/i)){
					if(hostname=='localhost/eorder2'){
						//console.log(match[0]);
						setTimeout('fixdup(\''+hostname+'\',\'mysql' + data.record.id + '\',\''+match[1]+'\',\'repair\',0,0,0);',5);
						//fixdup(hostname,'mysql' + data.record.id,match[3],match[2],match[1],0);
					}else{
						$(".Last_Error",$('#mysql' + data.record.id)).append(' <a href="#" onclick="fixdup(\''+hostname+'\',\'mysql' + data.record.id + '\',\''+match[1]+'\',\'repair\',0,0,0)">[FIX]</a>');
					}
				}else if(match = data.record.slave.Last_Error.match(/dental\\(.+?)' is marked as crashed and should be repaired/i)){
					if(hostname=='localhost/eorder2'){
						//console.log(match[0]);
						setTimeout('fixdup(\''+hostname+'\',\'mysql' + data.record.id + '\',\''+match[1]+'\',\'repair\',0,0,0);',5);
						//fixdup(hostname,'mysql' + data.record.id,match[3],match[2],match[1],0);
					}else{
						$(".Last_Error",$('#mysql' + data.record.id)).append(' <a href="#" onclick="fixdup(\''+hostname+'\',\'mysql' + data.record.id + '\',\''+match[1]+'\',0,0,0)">[FIX]</a>');
					}
				}else if(match = data.record.slave.Last_Error.match(/Duplicate column name/i)){
					if(hostname=='localhost/eorder2'){
						//console.log(match[0]);
						setTimeout('SkipSlave(\''+hostname+'\',\'mysql' + data.record.id + '\');',5);
					}
				}else if(match = data.record.slave.Last_Error.match(/Error dropping database|Can't drop database/i)){
					//if(hostname=='localhost/eorder2'){
					setTimeout('SkipSlave(\''+hostname+'\',\'mysql' + data.record.id + '\');',5);
					//}
				}
			
				$(".Last_Error",$('#mysql' + data.record.id)).append(' <a href="#" onclick="return SkipSlave(\''+hostname+'\',\'mysql' + data.record.id + '\');">[Skip]</a>');

				$(".Last_Error",$('#mysql' + data.record.id)).append("<br/>Relay"+data.record.slave.Relay_Log_File+":"+data.record.slave.Relay_Log_Pos);
			}

			
			
			datarecord[ip] = {'id':data.record.id,'file':data.record.master.File,'pos':data.record.master.Position,'read':data.record.slave.Read_Master_Log_Pos,'exe':data.record.slave.Exec_Master_Log_Pos};
			var diffRead = 0;
			if(typeof(datarecord[data.record.slave.Master_Host])!='undefined'){
				var id = datarecord[data.record.slave.Master_Host].id;
				var file = datarecord[data.record.slave.Master_Host].file;
				var pos = datarecord[data.record.slave.Master_Host].pos;
				if(data.record.slave.Relay_Master_Log_File != file){
					$('.Relay_Master_Log_File',$('#mysql' + data.record.id)).css('color','#F00');
					$('.File',$('#mysql' + id)).css('color','#F00');
				}else{
					$('.Relay_Master_Log_File',$('#mysql' + data.record.id)).css('color','#000');
					$('.File',$('#mysql' + id)).css('color','#000');
				}


				if(data.record.slave.Master_Log_File != file){
					$('.Master_Log_File',$('#mysql' + data.record.id)).css('color','#F00');
					$('.File',$('#mysql' + id)).css('color','#F00');
				}else{
					$('.Master_Log_File',$('#mysql' + data.record.id)).css('color','#000');
					$('.File',$('#mysql' + id)).css('color','#000');
				}
				

				
				if(Math.abs(data.record.slave.Read_Master_Log_Pos - pos)>50000){
					$('.Read_Master_Log_Pos',$('#mysql' + data.record.id)).css('color','#F00');
					$('.Position',$('#mysql' + id)).css('color','#F00');
					diffRead = pos-data.record.slave.Read_Master_Log_Pos;

					var file_dif = 0;
					if(typeof(file)!='undefined' && typeof(data.record.slave.Master_Log_File)!='undefined' ){
						file_dif = parseInt(file.substring(10)) - parseInt(data.record.slave.Master_Log_File.substring(10));
					}
					
					if(file_dif>0){
						diffRead += slave_max_allowed_packet*file_dif;
					}

					
					if(Math.abs(diffRead)>1000*1000*1000){
						$('.Read_Master_Log_Pos',$('#mysql' + data.record.id)).append("("+Math.round(diffRead/1000/1000/1000)+"G)");
					}else if(Math.abs(diffRead)>1000*1000){
						$('.Read_Master_Log_Pos',$('#mysql' + data.record.id)).append("("+Math.round(diffRead/1000/1000)+"M)");
					}else if(Math.abs(diffRead)>1000){
						$('.Read_Master_Log_Pos',$('#mysql' + data.record.id)).append("("+Math.round(diffRead/1000)+"K)");
					}else{
						$('.Read_Master_Log_Pos',$('#mysql' + data.record.id)).append("("+(diffRead)+")");
					}
				}else{
					$('.Read_Master_Log_Pos',$('#mysql' + data.record.id)).css('color','#000');
					$('.Position',$('#mysql' + id)).css('color','#F00');
				}
			}


			if(data.record.slave.Read_Master_Log_Pos != data.record.slave.Exec_Master_Log_Pos){
				$('.Exec_Master_Log_Pos',$('#mysql' + data.record.id)).css('color','#F00');

				
				var file_dif = 0;
				if(typeof(data.record.slave.Master_Log_File)!='undefined' && typeof(data.record.slave.Relay_Master_Log_File)!='undefined' ){
					file_dif = parseInt(data.record.slave.Master_Log_File.substring(10)) - parseInt(data.record.slave.Relay_Master_Log_File.substring(10));
				}
				
				
				var diffExec = data.record.slave.Read_Master_Log_Pos - data.record.slave.Exec_Master_Log_Pos;



				
				if(file_dif>0){

					{
						var file_size_percent = Math.round(data.record.slave.Exec_Master_Log_Pos/slave_max_allowed_packet*100);
						var file_size_html = '<table cellpadding="0" cellspacing="0" class="smalltext_gray" align="center" width="100" style="border:1px solid #333"><tr><td width="'+file_size_percent+'" style="background:#666;height:6px;padding:0px;margin:0px"></td><td width="'+(100-file_size_percent)+'" style="background:#EEE;height:6px;padding:0px;margin:0px"></td></tr></table>';
						
						
					}

					
					diffExec += slave_max_allowed_packet*file_dif;
				}
				if(diffExec>1000*1000*1000){
					$('.Exec_Master_Log_Pos',$('#mysql' + data.record.id)).append(file_size_html+"Diff("+Math.round(diffExec/1000/1000/1000)+"G)");
				}else if(diffExec>1000*1000){
					$('.Exec_Master_Log_Pos',$('#mysql' + data.record.id)).append(file_size_html+"Diff("+Math.round(diffExec/1000/1000)+"M)");
				}else if(diffExec>1000){
					$('.Exec_Master_Log_Pos',$('#mysql' + data.record.id)).append("<br/>Diff("+Math.round(diffExec/1000)+"K)");
				}else{
					$('.Exec_Master_Log_Pos',$('#mysql' + data.record.id)).append("<br/>Diff("+(diffExec)+")");
				}
				if(typeof(lastRefresh[hostname])!='undefined'){

					var rspeed = Math.round((data.record.slave.Exec_Master_Log_Pos-lastRefresh[hostname].slave.Exec_Master_Log_Pos)*1000/(nowdate-lastRefresh[hostname].lastfresh));
					var last_speed = 0;
					if(typeof(lastRefresh[hostname].rspeed)!='undefined'){
						rspeed = lastRefresh[hostname].rspeed + (rspeed-lastRefresh[hostname].rspeed)*0.1;
					}
					data.record.rspeed = rspeed;
					

					var est = diffExec/rspeed;
					var est_time = '';

					if(rspeed<1){
						est_time = '';
					}else if(est>60*60*24){
						est_time = Math.round(est/60/60/24)+"d";
					}else if(est>60*60){
						est_time = Math.round(est/60/60)+"h";
					}else if(est>60){
						est_time = Math.round(est/60)+"m";
					}else if(est>1){
						est_time = Math.round(est)+"s";
					}
					
					if(rspeed>1000000){
						rspeed = Math.round(rspeed/1000000)+"M";
					}else if(rspeed>1000){
						rspeed = Math.round(rspeed/1000)+"K";
					}else if(rspeed>100){
						rspeed = Math.round(rspeed/1)+"";
					}else if(rspeed>10){
						rspeed = Math.round(rspeed/1)+"";
					}else if(rspeed>1){
						rspeed = Math.round(rspeed/1)+"";
					}else{
						rspeed = "0";
					}
					
					$('.Exec_Master_Log_Pos',$('#mysql' + data.record.id)).append(est_time+'<br/>Speed['+rspeed+'/s]');
					
					
					
				}
			}else{
				$('.Exec_Master_Log_Pos',$('#mysql' + data.record.id)).css('color','#000');
				
			}			




			
			
			if(typeof(lastRefresh[hostname])!='undefined'){
				if(data.record.slave.Read_Master_Log_Pos-lastRefresh[hostname].slave.Read_Master_Log_Pos!=0){
					
					var pspeed = Math.round((data.record.slave.Read_Master_Log_Pos-lastRefresh[hostname].slave.Read_Master_Log_Pos)*1000/(nowdate-lastRefresh[hostname].lastfresh));
					var last_pspeed = 0;
					if(typeof(lastRefresh[hostname].pspeed)!='undefined'){
						pspeed = lastRefresh[hostname].pspeed + (pspeed-lastRefresh[hostname].pspeed)*0.1;
					}
					data.record.pspeed = pspeed;
					
	
					est = diffRead/pspeed;
					est_time = '';
	
					if(pspeed<1){
						est_time = '';
					}else if(est>60*60*24){
						est_time = Math.round(est/60/60/24)+"d";
					}else if(est>60*60){
						est_time = Math.round(est/60/60)+"h";
					}else if(est>60){
						est_time = Math.round(est/60)+"m";
					}else if(est>1){
						est_time = Math.round(est)+"s";
					}
					
					if(pspeed>1000000){
						pspeed = Math.round(pspeed/1000000)+"M";
					}else if(pspeed>1000){
						pspeed = Math.round(pspeed/1000)+"K";
					}else if(pspeed>100){
						pspeed = Math.round(pspeed/1)+"";
					}else if(pspeed>10){
						pspeed = Math.round(pspeed/1)+"";
					}else if(pspeed>1){
						pspeed = Math.round(pspeed/1)+"";
					}else{
						pspeed = "0";
					}
					
					$('.Read_Master_Log_Pos_Diff',$('#mysql' + data.record.id)).append(est_time+'<br/>['+pspeed+'/s]');					
					
					
				}
				
			}


			
			data.record.rate = rate;
			data.record.lastfresh = nowdate;	
			lastRefresh[hostname] = data.record;
			threadAttempt[unique] = 0;




			
			UpdateRecordList();	

			

			for(h in lastRefresh){
				var r = lastRefresh[h].rate;
				if(r<1500)continue;
				var sec = Math.round((r-(nowdate-lastRefresh[h].lastfresh))/1000);
				var i = lastRefresh[h].id;
				if(sec<0){
					$('#timediff'+i).html("<font color=#F00>("+sec+"s)</font>");	
				}else{
					$('#timediff'+i).html("("+sec+"s)");
				}
			}
			
			return true;
		} else {
			LoggerNofity('Error '+hostname,data.messages);
			return false;
		}
	});

	threadRefresh[hostname] = setTimeout("Refresh('"+hostname+"',0,"+rate+")",rate+delay);
}


</script>

		<? include '../../app_hexa/_share/html_footer.php'; ?>
		<?
	}
}
	

/*

			$master_status = array(
				"File"=>"mysql-bin.000015",
				"Position"=>"22341481",
				"Binlog_Do_DB"=>"",
				"Binlog_Ignore_DB"=>"mysql,eximstats,horde,mail,cphulkd,eximstats,horde,information_schema,leechprotect,massage_wrdp1,modsec,roundcube,httpd_session,httpd_%,munin%"
			);
			$slave_status = array(
				"Slave_IO_State"=>"Waiting for master to send event",
				"Master_Host"=>"67.227.223.32",
				"Master_User"=>"hexa_sync",
				"Master_Port"=>"3306",
				"Connect_Retry"=>"60",
				"Master_Log_File"=>"mysql-bin.000004",
				"Read_Master_Log_Pos"=>"887791493",
				"Relay_Log_File"=>"db2-relay-bin.000002",
				"Relay_Log_Pos"=>"30859706",
				"Relay_Master_Log_File"=>"mysql-bin.000004",
				"Slave_IO_Running"=>"Yes",
				"Slave_SQL_Running"=>"Yes",
				"Replicate_Do_DB"=>"",
				"Replicate_Ignore_DB"=>"mysql,eximstats,horde,mail,cphulkd,eximstats,horde,information_schema,leechprotect,massage_wrdp1,modsec,roundcube,httpd_session,httpd_%,munin%",
				"Replicate_Do_Table"=>"",
				"Replicate_Ignore_Table"=>"",
				"Replicate_Wild_Do_Table"=>"",
				"Replicate_Wild_Ignore_Table"=>"",
				"Last_Errno"=>"0",
				"Last_Error"=>"",
				"Skip_Counter"=>"0",
				"Exec_Master_Log_Pos"=>"887791493",
				"Relay_Log_Space"=>"30859706",
				"Until_Condition"=>"None",
				"Until_Log_File"=>"",
				"Until_Log_Pos"=>"0",
				"Master_SSL_Allowed"=>"No",
				"Master_SSL_CA_File"=>"",
				"Master_SSL_CA_Path"=>"",
				"Master_SSL_Cert"=>"",
				"Master_SSL_Cipher"=>"",
				"Master_SSL_Key"=>"",
				"Seconds_Behind_Master"=>"0"
				
*/
