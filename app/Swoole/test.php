<?php
$func = function ($index, $isCorotunine = true) {
    $count =0;
    $isCorotunine && \Swoole\Coroutine::sleep(2);
    echo "index:" . $index . ", value:" . (++$count) . PHP_EOL;
    echo "is corotunine:" . intval($isCorotunine) . PHP_EOL;
};

$func(1, false);
go($func, 2, true);
go($func, 3, true);
go($func, 4, true);
go($func, 5, true);
go($func, 6, true);
$func(7, false);

go (function(){
    echo "swoole 太棒了".PHP_EOL;
});
