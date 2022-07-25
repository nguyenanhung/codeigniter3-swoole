<?php
// ------------------------------------------------------------------------------
if (!function_exists('getCiSwooleConfig')) {
    /**
     * Function getCiSwooleConfig
     *
     * @param string $name
     *
     * @return array
     * @throws \Exception
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 25/07/2022 19:45
     */
    function getCiSwooleConfig(string $name)
    {
        $pathA = APPPATH . "config/{$name}.php";

        $pathB = dirname(__FILE__) . "/{$name}.php";

        $data = file_exists($pathA) ? include($pathA) : include($pathB);

        if (!is_array($data)) {
            throw new \Exception("{$name} config file must return as array");
        }

        return $data;
    }
}


// ------------------------------------------------------------------------------
if (!function_exists('____intercepter____')) {
    /**
     * CI swoole intercepter
     *
     */
    function ____intercepter____()
    {
        try {
            if (!is_cli()) {
                return;
            }

            $command = trim($_SERVER['argv'][1] ?? '', '/');

            switch ($command) {
                // start server
                case 'swoole/server/start':
                    $start = \nguyenanhung\CodeIgniter\Swoole\Core\Server::start();
                    die("Start Server: {$start}\n");

                // stop server
                case 'swoole/server/stop':
                    \nguyenanhung\CodeIgniter\Swoole\Core\Client::shutdown();
                    die("Stop Server.\n");

                // reload server
                case 'swoole/server/reload':
                    \nguyenanhung\CodeIgniter\Swoole\Core\Client::reload();
                    die("Reload Workers.\n");

                default:
                    return;
            }
        } catch (\Throwable $e) {
            $log = "{$e->getMessage()}\n";
            $log .= "{$e->getTraceAsString()}\n";

            die("Operation Failed.\n{$log}");
        }
    }

    // ------------------------------------------------------------------------------

    /**
     * Let's start perform magic tricks
     */
    ____intercepter____();
}
