# logz-io-handler

Please define the following in your `config/prod/monolog.yaml` file:

```diff
monolog:
    handlers:
        main:
            type: fingers_crossed
            action_level: error
            handler: nested
            excluded_http_codes: [404, 405]
            buffer_size: 50 # How many messages should be saved? Prevent memory leaks
        nested:
            type: stream
            path: php://stderr
            level: debug
        console:
            type: console
            process_psr_3_messages: false
            channels: ["!event", "!doctrine"]
+       logz.io:
+           type: fingers_crossed
+           action_level: error
+           handler: logz.io_handler
+           excluded_http_codes: [404, 405]
+           buffer_size: 50 # How many messages should be saved? Prevent memory leaks
+       logz.io_handler:
+           type: service
+           id: 'Inpsyde\LogzIoMonolog\Handler\LogzIoHandler'
```
