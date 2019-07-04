<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * 请求id
     *
     * @var string
     */
    static $identifies;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (0 || env('APP_ENV', 'product') == 'local') {
            $this->debugSql();
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     *
     *
     */
    protected function debugSql()
    {
        DB::listen(function ($db) {
            $file = storage_path('logs/sql.log');
            if (empty(self::$identifies)) {
                self::$identifies = (microtime(true) * 10000) . rand(11111, 99999);
                $logStr = "\r\n" . date('Y-m-d H:i:s') . "\t" . PHP_SAPI . "\r\n" . '/*' . self::$identifies . '*/';
            } else {
                $logStr = '/*' . self::$identifies . '*/';
            }

            if (!empty($db->bindings)) {
                $sql = str_replace("\r\n", " ", $db->sql);
                $sql = explode('?', $sql);
                $log = '';
                foreach ($db->bindings as $key => $v) {
                    if (!is_numeric($v) && !is_null($v)) {
                        $v = "'{$v}'";
                    }
                    if (!isset($sql[$key])) {
                        $log = '/*' . self::$identifies . '*/ 出错啦:' . $db->sql . "\r\n";
                        $log .= '/*' . self::$identifies . '*/ 出错啦:' . json_encode($db->bindings) . "\r\n";
                        file_put_contents($file, $log, FILE_APPEND);
                        return null;
                    }
                    if (is_null($v)) {
                        $v = 'null';
                    }
                    $log .= $sql[$key] . $v;
                }
                $log .= end($sql);
            } else {
                $log = $db->sql;
            }
            $log = $logStr . "\t" . $log . ";\r\n";
            return file_put_contents($file, $log, FILE_APPEND);
        });
    }
}
