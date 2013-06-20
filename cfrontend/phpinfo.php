<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Frontend</title>
<style type="text/css">
body { 
margin: 0 auto; 
padding: 0px; 
background-color:#F5F5F5; 
font-family: Tahoma, Verdana, sans-serif; 
font-size: 0.8em; 
color: #000000; 
} 
/*เพิ่มรายละเอียดให้กับ h1-h6*/ 
h1 { 
margin: 0; 
padding: 0; 
} 
#header { 
position: relative; 
float: none; 
width: 100%; 
height:37px; 
margin: 0 auto; 
background-color: #222222;
background-image:url(images/header);
} 

#wrapper { 
width: 100%;
position: relative; 
float: none; 
margin: 0 auto; 
background-color: #FFFFFF;
display:table; 
} 
#wrapper .content-left { 
width:70%; 
position: relative; 
float: left; 
margin: 0; 
padding: 0; 
background: #000000; 
color: #FFFFFF; 
} 
#wrapper .content-right { 
width:30%; 
position: relative; 
float: left; 
margin: 0; 
padding: 0; 
} 
#footer { 
position: relative; 
float: none; 
width: 100%; 
height: 100px; 
margin: 0 auto; 
background-color: #FF9900; 
color: #FFFFFF; 
} 
</style>
</head>

<body>
<div id="header">
<h1>ส่วนของ header</h1>
</div>
<div id="wrapper">
  <div class="content-left">
	<h5>คอลัมน์ฝั่งซ้าย</h5>
  </div>
	<div class="content-right">
	<h5>คอลัมน์ฝั่งขวา</h5>
  </div>
</div>
<div id="footer">
<h1>ส่วนของ footer</h1>
</div>
</body>
</html>
