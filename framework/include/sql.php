<?php
class Inc_SQL{
	public static function /*@string*/Build(/*@string*/$sql,$param){
		$safe_param = array();
		foreach($param as $key => $val){
			$sval = self::CheckSafe($val);
			$sql = str_replace("{".$key."}",$sval,$sql);
		}
		return $sql;
	}
	public static function /*@string*/CheckSafe(/*@string*/$val){
		$ret = $val;

		//$ret = str_replace("''","\\'\\'",$ret);
		$ret = preg_replace("/(\\\(\\\\)*\\\)'/","\'",$ret);
		//if($ret!=$val)echo "M";
		$ret = preg_replace("/([^\\\])'/","$1\\'",$ret);
		$ret = preg_replace("/([^\\\])'/","$1\\'",$ret);
		//if($ret!=$val)echo "M";
		return $ret;
	}
}