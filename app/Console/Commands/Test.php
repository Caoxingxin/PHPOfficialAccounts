<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Log;

class Test extends Command {

    protected $name = 'test';//命令名称

    protected $description = '测试'; // 命令描述，没什么用

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //log::info('test');

        // 功能代码写到这里
    }

}
