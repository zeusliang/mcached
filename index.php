<?php
// init memcached provide sevices
require_once'mcached.php';

// init mysql connect
require_once'connect.php';

// get memcached connect
$m = add_servers(@$servers);

// get mysql connect
$pdo = connect();

// make virtual cache
echo "mysql query start </br>";
$query = "select * from p";
$rs = $pdo->query($query)->fetchAll(PDO :: FETCH_CLASS);

echo "query result: <br/>";
var_dump($rs);

echo "format to json: <br/>";
$data = json_encode($rs);
var_dump($data);
$set_key = 'p';

//echo "set cache <br/>";
// set cache if not cached 
$rs = set_cache($set_key,$data,$m);

if($rs == '100'){
 echo "first cache [100]";
}else if($rs == '0000'){
 echo 'cach data erro [0000]';
}else{
  // get cache
  echo "get cached [1111] </br>";
  var_dump($rs);
}

/** get cache **/
function get_cache($mcached,$key){
  $rs = $mcached->get($key);
  return $rs;
}

/** cach data to memcached **/
function set_cache($set_key,$data,$mcached){
  // set cache state
  $flag = '0';
  $rs = chk_cache($set_key,$mcached); 
  // no cached
  if($rs == false){
    $state = $mcached->set($set_key,$data);
    if($state == true){
	return $flag = '100';
    }else{
	return $flag = '0000';
    }
  }else{
    // cached return data
    $rs = get_cache($mcached,$set_key);
    return $rs;
  }
}

/** check cached data **/
function chk_cache($chk_key,$mcached){
  $flag = false;
  if($mcached->get($chk_key)){
    return $flag = true;
  }else{
    return $flag;
  }
}
