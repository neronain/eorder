<? date_default_timezone_set('Asia/Bangkok');
include '../framework/core/action.class.php';
include '../app_hexa/admin/_ac_service.php'; 
//echo urlencode("?affiliateid=xxxxx");
?>
	<? /**/ include("../framework/conf/classpath.gen.php") ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Compiler helper</title>
</head>
<body>
<script type="text/javascript" src="../resources/js/jquery-1.7.2.min.js"></script>
<iframe name="output" id="output"  style="float:right;width:800px;height:600px"></iframe>

<span>Logreader</span>
<div style="display:block;">
	<select id="modelserver" >
		<option value="hexaceram">hexaceram</option>
	</select>
	<select id="modelclass" style="width:150px;">
	<?

	foreach($classpath as $class => $path){
		if(strpos($class,"MD_")!==0)continue;
		if(strpos($class,"Array")>0)continue;
		if(strpos($class,"TXT")>0)continue;
	?>
		<option value="<?=$class?>"><?=$class?></option>
	<? } ?>
	</select>
	<input type="text" id="modelid" style="width:100px;"/>
	<button onclick="loadlog()">Load</button>
</div>
<div style="display:block;">
	<input type="text" id="logpath" style="width:300px;" />
	<button onclick="loadbypath()">Load by path</button>
</div>
<script>
function loadlog(){
	var domain = $('#modelserver').val();
	var cname = $('#modelclass').val();
	var modelid = $('#modelid').val();

	var path = "../../log/model/"+cname+"/"+modelid+".log";
	
	var url = 'https://'+domain+'/index.php?act=service&todo=readfile&key=<?=Joay_Action_service::GenKey()?>&filepath='+path+'&pretag=<?=urlencode('style="font-size:11px;"')?>';
	$('#output').attr('src',url);
}

function loadbypath(){
	var domain = $('#modelserver').val();
	var path = $('#logpath').val();
	
	var url = 'https://'+domain+'/index.php?act=service&todo=readfile&key=<?=Joay_Action_service::GenKey()?>&filepath='+path+'&pretag=<?=urlencode('style="font-size:11px;"')?>';
	$('#output').attr('src',url);
}
</script>
<? $indexNumber = 0; ?>

	<p>
		<?=$indexNumber++?>.) <br/>
		<a href="generatedb.php?s=<?=md5(date('Ymd')."X")?>" target="output">Generate Main Hexa DB</a> <br/>
		<a href="generatedb.php?unit=1&s=<?=md5(date('Ymd')."X")?>" target="output">Generate Unit testing DB </a> <br/>
		
	</p>

	
	
	<p>
		<?=$indexNumber++?>.) <a href="rewrite_templates.php" target="output">Generate repeat template</a>
	</p>

	

	<p>
		<?=$indexNumber++?>.) Generate class path<br /> <a href="compile_classpath.php" target="output">Compile classpath</a><br />
	</p>
	
	
	<p>
		<?=$indexNumber++?>.) Verify variable<br /> <a href="compile_verifyvar.php" target="output">Verify variable</a><br />
	</p>
	
	
	
	<p>
		<?=$indexNumber++?>.) Test class<br />
	
		<br /> or<br /> <a href="test_all.php" target="_blank">Test All</a><br />
		<form method="get" action="../index.php" target="_blank">
			<input type="hidden" name="act" value="test" /> <input type="hidden" name="todo" value="testclass" /> <input type="text" name="class" /> <input type="submit" />
		</form>
		or<br />
		<form method="get" action="../index.php" target="_blank">
			<input type="hidden" name="act" value="test" /> <input type="hidden" name="todo" value="testclass" /> <select name="class" style="width:200px">
			<?
			foreach($classpath as $class => $path){
				if(strpos($class,"Joay_Action")===0)continue;
				if(strpos($class,"Abstract_")===0)continue;
				if(strpos($class,"MD_")===0)continue;
				if(strpos($path,"../../framework")===0)continue;
				if(strpos($path,"../../lib")===0)continue;
				if(strpos($path,"../../app_hexa/_")===0)continue;
				if(strpos($path,"../../model")===0)continue;
				if(strpos($path,"../../resource")===0)continue;
				//if(strpos($path,"../../app_hexa/bulksites")===0)continue;
				//if(strpos($path,"../../app_hexa/memsites")===0)continue;
				if(strpos($path,"../../app_hexa/wizard")===0)continue;


				?>
				<option value="<?=$class?>">
				<?=$class?>
				<?=$path?>
				</option>
				<? } ?>
			</select> <input type="submit" />
		</form>
		<?
		/*
		foreach($classpath as $class => $path){
			if(strpos($class,"Joay_Action")===0)continue;
			if(strpos($class,"MD_")===0)continue;
			if(strpos($class,"Abstract_")===0)continue;			
			if(strpos($path,"../../framework")===0)continue;
			if(strpos($path,"../../lib")===0)continue;
			if(strpos($path,"../../app_hexa/_")===0)continue;
			if(strpos($path,"../../model")===0)continue;
			if(strpos($path,"../../resource")===0)continue;
			if(strpos($path,"../../app_hexa/bulksites")===0)continue;
			if(strpos($path,"../../app_hexa/memsites")===0)continue;
			if(strpos($path,"../../app_hexa/wizard")===0)continue;


			?>
		<a href="../index.php?act=test&todo=testclass&class=<?=$class?>" target="_blank"><?=$class?> </a>&nbsp;
		<?
		}*/
		?>
	</p>
		<p>
		5.) Verify all call URL<br /> <a href="test_call.php" target="_blank">Test call</a><br />
	</p>
	
	<p>
		6.) Generate Dynamic Configuration<br /> <a href="generate_dynamic_conf.php" target="output">Generate</a><br />
	</p>
	
	
	
</body>
</html>
