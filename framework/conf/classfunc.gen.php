<?
 $classfunc = array (
  'Joay_Action_xxx' => 
  array (
    'yyy' => 
    array (
      'REF' => 1,
    ),
  ),
  'Joay_Action_member' => 
  array (
    'upgrade' => 
    array (
      'REF' => 2,
    ),
  ),
  'Joay_Action_service' => 
  array (
    'getfile' => 
    array (
      'REF' => 1,
      'PARAMETER' => 
      array (
        'key' => NULL,
        'filepath' => NULL,
      ),
    ),
    'mysqlstartslave' => 
    array (
      'PARAMETER' => 
      array (
        'key' => NULL,
        'callback' => NULL,
      ),
      'REF' => 1,
    ),
    'mysqlstopslave' => 
    array (
      'PARAMETER' => 
      array (
        'key' => NULL,
        'callback' => NULL,
      ),
      'REF' => 1,
    ),
    'mysqlrestartslave' => 
    array (
      'PARAMETER' => 
      array (
        'key' => NULL,
        'callback' => NULL,
      ),
      'REF' => 1,
    ),
    'fixdup' => 
    array (
      'PARAMETER' => 
      array (
        'table' => NULL,
        'indexkey' => NULL,
        'key1' => NULL,
        'key2' => NULL,
        'key3' => NULL,
        'key' => NULL,
        'callback' => NULL,
      ),
      'REF' => 1,
    ),
    'mysqlskip' => 
    array (
      'PARAMETER' => 
      array (
        'key' => NULL,
        'callback' => NULL,
      ),
      'REF' => 1,
    ),
    'mysqlfixrelay' => 
    array (
      'PARAMETER' => 
      array (
        'key' => NULL,
        'callback' => NULL,
      ),
      'REF' => 1,
    ),
    'readfile' => 
    array (
      'PARAMETER' => 
      array (
        'key' => NULL,
        'filepath' => NULL,
        'pretag' => '',
      ),
    ),
    'mysqlstatus' => 
    array (
      'PARAMETER' => 
      array (
        'key' => NULL,
        'callback' => NULL,
      ),
      'REF' => 2,
    ),
  ),
  'Joay_Action_admin' => 
  array (
    'mysqlshow' => 
    array (
      'PARAMETER' => 
      array (
      ),
    ),
  ),
  'Joay_Action_syscron' => 
  array (
    'list' => 
    array (
      'PARAMETER' => 
      array (
      ),
    ),
    'edit' => 
    array (
      'PARAMETER' => 
      array (
        'id' => NULL,
        'cronclass' => '',
      ),
      'REF' => 2,
    ),
    'save' => 
    array (
      'PARAMETER' => 
      array (
        'id' => NULL,
        'enable' => NULL,
        'allow_instant' => NULL,
        'maximum_instant' => NULL,
        'limit_instant' => NULL,
        'nextexedate' => NULL,
        'maxexecutetime' => NULL,
        'cronclass' => NULL,
        'croninterval' => NULL,
      ),
      'REF' => 1,
    ),
    'delete' => 
    array (
      'PARAMETER' => 
      array (
        'id' => NULL,
      ),
    ),
    'toggle_enable' => 
    array (
      'PARAMETER' => 
      array (
        'id' => NULL,
      ),
      'REF' => 1,
    ),
    'alter_instant' => 
    array (
      'PARAMETER' => 
      array (
        'id' => NULL,
        'diff' => NULL,
      ),
      'REF' => 1,
    ),
    'alter_limitinstant' => 
    array (
      'PARAMETER' => 
      array (
        'id' => NULL,
        'diff' => NULL,
      ),
      'REF' => 1,
    ),
    'refresh' => 
    array (
      'PARAMETER' => 
      array (
        'id' => NULL,
      ),
      'REF' => 1,
    ),
    'toggle_domain' => 
    array (
      'PARAMETER' => 
      array (
        'id' => NULL,
        'domain' => NULL,
      ),
      'REF' => 1,
    ),
  ),
  'Joay_Action_' => 
  array (
    '' => 
    array (
      'PARAMETER' => 
      array (
      ),
    ),
    'starter' => 
    array (
      'PARAMETER' => 
      array (
      ),
    ),
  ),
);