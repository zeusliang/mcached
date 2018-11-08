<?php
/**
* add a pool for memcached server
* @param return bool $servers 
* a array use define memcached servers,on success return true
**/
function add_servers($servers){
    $m = new Memcached();

    $servers = array(
        array('172.17.0.2', 11211, 67)
    );

    // add a pool for memcached server
    $flag = $m->addServers($servers);
    if($flag == true){
	return $m;
    }else{
	return $flag;
    }
}
?>
