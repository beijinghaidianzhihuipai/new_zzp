<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SendPhone::class,         //专项监听
        Commands\SendAchievement::class,   //业绩 中标
        Commands\SendFenPai::class,  //权益分派
        Commands\SendNewInfo::class,  //深证24小时最新
        Commands\SendShPDF::class,  //上海24小时最新
        Commands\GetSHStockInfo::class,  //获取上海股票信息
        Commands\GetSZStockInfo::class,  //获取深圳股票信息
        Commands\GetStockBasic::class,  //获取股票基本面信息
        Commands\GetStockBonus::class,  //获取股票基本面信息
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('send:phone')->everyMinute()->withoutOverlapping();
        //$schedule->command('send:achievement')->everyMinute()->withoutOverlapping();
        //$schedule->command('send:fenpai')->everyMinute()->withoutOverlapping();
        $schedule->command('send:newinfo')->everyMinute()->withoutOverlapping();
        $schedule->command('send:shpdf')->everyMinute()->withoutOverlapping();
        $schedule->command('get:stock_bonus')->weekly();
        $schedule->command('get:stock_basic')->weekly();
        $schedule->command('get:sh_stock_info')->dailyAt('15:35')->withoutOverlapping();
        $schedule->command('get:sz_stock_info')->dailyAt('16:00')->withoutOverlapping();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
