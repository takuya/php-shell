# Examples 
```php
$name = "takuya";
$ret = PHPShell::exec_command('echo $name', ['name'=>$name]);
```
Apparently, `$name` in `'echo $name` looks like php variable, but `$name` is as passed shell env variable.

# Compare to escapeshellarg

Quart is unfriendly for debugging. 
```php
$name = "takuy'a;curl -h ";
$name = escapeshellarg($name); // -> "'takuy'\''a;curl -h '" 
```

Long string arguments make code more difficult to read..
```php
$url =  escapeshellarg("too long argument ..afasdfasdfasdfasdfawefadf");
$json = escapeshellarg(json_encode($object))
$cmd = 'curl -v -L $url -X POST --data $json';
var_dump($cmd);
```

Using Environment is more simple. And become more clear code what we will do.  
```php
$env_vars =  ['url'=>$url, 'json'=>$json];
foreach( $env_vars as $k=>$v ){
  putenv("$k=$v");
}
$ret = shell_exec('curl -v -L $url -X POST --data $json');
```

For this reason, this library supports you to pass argument as Environment instead of raw string.

# Feature
Safer calling Shell Command.  To avoid escaping Shell arguments , this library using ENV.
By using Env instead of escaping, shell command call become slightly safer and simpler to avoid shell command injection. 


# since 
- First release was 2008.
 