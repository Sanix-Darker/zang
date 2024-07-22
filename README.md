## ZANG

dumb example to tests rust processing in a php environment.

## HOW TO

```bash
$ cargo build
# this will create a shared object inside ./target/debug
# and you can inspect its exported method from the .so with `nm` :

$ nm ./target/debug/libzang.so | grep zang
0000000000011c20 t _ZN4zang10get_module8internal17hc3558098105dd764E
0000000000010ed0 t _ZN4zang10rs_process17h7dfdee01ff481793E
0000000000011230 t _ZN4zang24_internal_php_rs_process17hbc54390b7e6de054E <<< the exported method

# To run with rust method, just pass an argument to the end of this command, any string
$ php -d extension=target/debug/libzang.so ./test.php
```

### DUmB BASIC BENCHMARK ALGO

just loop over a 3 dimension array and randomly multiply/divide...

```php
$that = 1;
for ($i = 1; $i<1000; $i++){
    for ($j = 1; $j<1000; $j++){
        for ($k = 1; $k<1000; $k++){
            $that *= ($i * $j / $k);
        }
    }
}
echo $that;
return (($a + ($b * 770)) - $a) * $b;
```

### RESULTS

```bash
$ php -d extension=target/debug/libzang.so ./test.php
>> NO RUST
0/home/dk/ACTUALC/github/zang/test.php:37:
int(3080)

done in 78.418999910355s

$ php -d extension=target/debug/libzang.so ./test.php 1
>> WITH RUST
/home/dk/ACTUALC/github/zang/test.php:37:
int(3080)

done in 9.2409999370575s
```

