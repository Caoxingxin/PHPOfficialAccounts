<?php

namespace App\Console\Commands;

use App\Http\Servers\WeChatTempServers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TempYxl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:TempYxl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'YxlTmep';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $app = app('wechat.official_account');
        $wechat = new WeChatTempServers($app);
        $wechat->addTemp('YIzkauwMW4Tspe7PVqJecG-7YccWSpbB4OoXiOY9UwE','oHs895nn87fR9KKzbDH16bsC8vjE');
        $wechat->addTemp('YIzkauwMW4Tspe7PVqJecG-7YccWSpbB4OoXiOY9UwE','oHs895kJuaXo3OoEGu9os-U3YNM0');
        //Log::info('发送成功！');
    }
}
