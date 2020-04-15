<?php

namespace Tests\Units\PHPShell;

use Tests\TestCase;
use Takuya\SystemUtil\PHPShell;

class PHPShellTest  extends TestCase {

  public function testExecution(){
  
    $this->assertTrue(PHPShell::command_exists('php'));
    $this->assertNotTrue(PHPShell::command_exists('phpdfasklj2390'));
  }
  public function testArgsAsEnvironmentExec(){
    $name = "hello";
    $ret = PHPShell::exec_command('echo $name', ['name'=>$name]);
    $this->assertEquals($name, $ret);
  }
  public function testShellCommandInjection(){
    $args_tested = [
      "name;echo INJECTECED",
      "name\=;echo INJECTECED",
      "===aaa",
      "=='=aaa",
      "='='=aaa",
      "='='=a;aa; \ \ curl",
    ];
    foreach ($args_tested as $str) {
      $ret = PHPShell::exec_command('echo $name', ['name'=>$str]);
      $this->assertEquals($str, $ret);
    }
  }
  public function testCommandInArgumentString(){
    $str = "hello";
    $ret = PHPShell::exec_command('/bin/echo -n $name', ['name'=>$str]);
    $this->assertEquals($str, $ret);
  }
}