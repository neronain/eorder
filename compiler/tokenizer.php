<?
include "../../framework/core/common.inc.php";

if (!defined('T_ML_COMMENT')) {
   define('T_ML_COMMENT', T_COMMENT);
} else {
   define('T_DOC_COMMENT', T_ML_COMMENT);
}

$source = file_get_contents('../model/md_optin.php');
$tokens = token_get_all($source);

Inc_Var::vardump($tokens);
exit();
foreach ($tokens as $token) {
   if (is_string($token)) {
       // simple 1-character token
       echo $token;
   } else {
       // token array
       list($id, $text) = $token;

       switch ($id) { 
           case T_COMMENT: 
           case T_ML_COMMENT: // we've defined this
           case T_DOC_COMMENT: // and this
               // no action on comments
               break;

           default:
               // anything else -> output "as is"
               echo $text;
               break;
       }
   }
}

