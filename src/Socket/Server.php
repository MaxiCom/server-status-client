<?php

namespace App\Socket;

use App\Service\API\ServerStatusClientApiService;

class Server
{
    // exit() on socket error not just echo!
    public static function run(): void
    {
        set_time_limit(0);

        if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
            echo 'socket_create() failed: reason: ' . socket_strerror(socket_last_error()) . PHP_EOL;
        }

        if (socket_bind($sock, '127.0.0.1', 5151) === false) {
            echo 'socket_bind() failed: reason: ' . socket_strerror(socket_last_error($sock)) . PHP_EOL;
        }

        if (socket_listen($sock) === false) {
            echo 'socket_listen() failed: reason: ' . socket_strerror(socket_last_error($sock)) . PHP_EOL;
        }

        do {
            if (($msgSock = socket_accept($sock)) === false) {
                echo 'socket_accept() failed: reason: ' . socket_strerror(socket_last_error($sock)) . PHP_EOL;

                break;
            }

            if (($buf = socket_read($msgSock, 32, PHP_NORMAL_READ)) === false) {
                echo 'socket_read() failed: reason: ' . socket_strerror(socket_last_error($msgSock)) . PHP_EOL;

                break;
            }

            if (!$buf = trim($buf)) {
                continue;
            }

            // ERROR MANAGEMENT APIUPDATE NO WAY OF KNOWING CURRENTLY
            // COTÉ API DÉFINIS LIVE (backend loaded INVOLES WAIT or SPA dynamic loading)
            // SUCCESS/ERROR MESSAGE OR NOT??
            if ($buf == 'GET live_metrics') {
                ServerStatusClientApiService::apiUpdate();
            }

            socket_close($msgSock);
        } while (true);

        // CLOSE SOCKET CORRECTLY socket_close($sock);
    }
}
