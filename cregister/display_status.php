<? $SKIPPERMISSION = true;?>
<? include_once("../core/default.php"); ?>

<?	
	getVar($type,"type");
    getVar($addtype,"addtype");
    getVar($customerid,"cid");
    getVar($register_username,"uname"); 
    getVar($password,"passwd");
	getVar($binary,"empty");
	
	//$type = strtoupper($type);
	switch($type) {
		case "FILLALLTEXTBOX":
			$empty_textbox["Username"] = ($binary >> 0) & 1;
			$empty_textbox["Password"] = ($binary >> 1) & 1;
			$empty_textbox["Retype Password"] = ($binary >> 2) & 1;
			$empty_textbox["e-mail"] = ($binary >> 3) & 1;
			$empty_textbox["Retype e-mail"] = ($binary >> 4) & 1;
			$empty_textbox["Lab. name"] = ($binary >> 5) & 1;
?>
		<p align="center">
            <font color="#FF0000">
            	<strong><?=T_FILLALLTEXT;?></strong><br />
                <?
					if($binary != 0) {
						$i = 0;
						foreach($empty_textbox as $key => $value) {
							if($value == 1) {
								$display_empty[$i] = $key; $i++;
							}
						}
						echo implode(", ",$display_empty)." field(s) is empty.";					
					}
				?>           
            </font><br /><br />
            <a href="<?= ($addtype=="old") ? "../cregister/customer_register.php?act=add&utype=old&cid=$customerid" : "../cregister/customer_register.php?act=add&utype=new"; ?>">Back</a>
        </p>
<?
            break;
		case "INCORRECTPASSWORD":
?>
        <p align="center">
            <font color="#FF0000"><strong><?=T_INCORRECTPASSWORD;?></strong></font><br /><br />
            <a href="<?= ($addtype=="old") ? "../cregister/customer_register.php?act=add&utype=old&cid=$customerid" : "../cregister/customer_register.php?act=add&utype=new"; ?>">Back</a>
        </p>
<?
            break;
		case "INCORRECTEMAIL":
?>
        <p align="center">
            <font color="#FF0000"><strong><?=T_INCORRECTEMAIL;?></strong></font><br /><br />
            <a href="<?= ($addtype=="old") ? "../cregister/customer_register.php?act=add&utype=old&cid=$customerid" : "../cregister/customer_register.php?act=add&utype=new"; ?>">Back</a>
        </p>
<?
            break;           
		case "EMAILINVALID":
?>
        <p align="center">
            <font color="#FF0000"><strong><?=T_EMAILINVALID;?></strong></font><br /><br />
            <a href="<?= ($addtype=="old") ? "../cregister/customer_register.php?act=add&utype=old&cid=$customerid" : "../cregister/customer_register.php?act=add&utype=new"; ?>">Back</a>
        </p>
<?
           break;           
		case "DUPLICATEUSERNAME":
?>
        <p align="center">
            <font color="#FF0000"><strong><?=T_DUPLICATEUSERNAME;?></strong></font><br /><br />
            <a href="<?= ($addtype=="old") ? "../cregister/customer_register.php?act=add&utype=old&cid=$customerid" : "../cregister/customer_register.php?act=add&utype=new"; ?>">Back</a>
        </p>
<?
            break;           
		case "COMPLETE":
?>
	<p align="center"><font color="#0000FF">
    <strong><?=T_REGISTRATION;?> <?=T_COMPLETED;?></strong></font>
    <br /> <?=T_YR_USR_IS;?> <strong><?=$register_username?></strong>
    <br /> <?=T_YR_PSSW_IS;?> <strong><?=$password?></strong>
    <br /> <?=T_NOTEUSERANDPASS;?>
    <br /><br /><a href='../cfrontend/login.php'><?=T_GTLOGINPAGE;?></a></p>
<?
            break;           
		case "EXISTINGACCOUNT":
?>
	<p align="center"><font color="#FF0000">
    <strong><?=T_EXISTACCOUNT;?></strong>
    <br /> <?=T_CONTACT;?>
    <br /> <?=T_EMAILADDR;?>: pppstudio@gmail.com
    <br /> <?=T_TELNO;?>: (+66) 08-6728-3309 (prince) </font>
    <br /><br /><a href='../cregister/customer_register.php'><?=T_BTMAINPAGE;?></a></p>
<?
            break; 
        case "AUTHENFAIL":          
		default:
?>
	<p align="center"><font color="#FF0000">
    <strong><?=T_AUTHENFAIL;?></strong>
    <br /> <?=T_CONTACT;?>
    <br /> <?=T_EMAILADDR;?>: pppstudio@gmail.com
    <br /> <?=T_TELNO;?>: (+66) 08-6728-3309 (prince) </font>
    <br /><br /><a href='../cregister/customer_register.php'><?=T_BTMAINPAGE;?></a></p>
<?
            break;           
	}
?>