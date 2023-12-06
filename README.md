## SERVER-STATUS-CLIENT

To send metrics to the API every 5 minutes (on a system with cron utility installed), add this line to your cron table
```$crontab -e```:

```shell
*/5 * * * * /home/your-user/server-status-client/bin/server-status-client api:send-metrics
```

To enable client listening for API Live Metrics Request (on a system with systemd utility installed), you can create a
systemd Unit file at ```/etc/systemd/system/server-status-client.service``` with this content:

```shell
[Unit]
Description=Server Status Client (Live Mode)

[Service]
Type=simple
Restart=always
ExecStart=/home/your-user/server-status-client/bin/server-status-client api:list

[Install]
WantedBy=multi-user.target
```

Reload systemd daemon:

```shell
$systemctl daemon-reload
```

Then start the service manually with the command:

```shell
$systemctl start server-status-client
```

To stop the service:

```shell
$systemctl stop server-status-client
```

Or enable on-boot loading of the service:

```shell
$systemctl enable server-status-client
```

To disable on-boot loading:

```shell
$systemctl disable server-status-client
```
