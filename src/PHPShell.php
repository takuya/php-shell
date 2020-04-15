<?php

namespace Takuya\SystemUtil;

class PHPShell {
  
  
  public static function getPATH(){
    return getenv("PATH");
  }
  public static function setPATH(){
    if ( $_SERVER ){
      self::addPATH($_SERVER['PATH']);
    }
  }
  public static function addPATH($path){
    putenv("PATH=\$PATH:${path}");
  }
  public static function command_exists($cmd) {
    $ret = self::which($cmd);
    if ( $ret ) {
      return true;
    } else {
      return false;
    }
  }
  public static function exec_command($command, $env_variables=array()){
    foreach( $env_variables as $k=>$v ){ // set arguments as variable
      putenv("${k}=${v}");
    }
    $ret = shell_exec($command);
    foreach( $env_variables as $k=>$v ){ // unset env
      putenv("$k=''");
    }
    return $ret;
  }
  public static function which($cmd){
    return self::whereis($cmd);
  }
  public static function whereis($cmd){
    return  trim(self::exec_command( 'which $name 2>/dev/null' , [ "name" => $cmd ] ));
  }
  
}
