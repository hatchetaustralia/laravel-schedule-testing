# Custom Assertions
If you require some more fine grained control over the assertions you need to make against your scheduled events you can pass a closure to the `assertSchedule()` method.

If at least one scheduled event passes the given truth test in your callback, the assertion will be considered successful.

> This works in a similar fashion to the mocking assertions Laravel makes available for the Mail, Bus, Queue, Notification and Event facades.

```php
$this->assertSchedule('command', function (Event $event) {
    return $event->description = 'My command has this description';
});
```

---

Your callback will have Laravel's [Scheduling Event](https://laravel.com/api/master/Illuminate/Console/Scheduling/Event.html) class available to inspect.

Here's a quick example preview of what's available within the class to craft your assertions on:
```php
Illuminate\Console\Scheduling\Event {
  +command: "'/usr/local/Cellar/php@8.1/8.1.14_1/bin/php' 'artisan' fake:command"
  +expression: "* * * * *"
  +timezone: "UTC"
  +user: null
  +environments: []
  +evenInMaintenanceMode: false
  +withoutOverlapping: false
  +onOneServer: false
  +expiresAt: 1440
  +runInBackground: false
  #filters: []
  #rejects: []
  +output: "/dev/null"
  +shouldAppendOutput: false
  #beforeCallbacks: []
  #afterCallbacks: []
  +description: null
  +mutex: Illuminate\Console\Scheduling\CacheEventMutex^ {#597
    +cache: Illuminate\Cache\CacheManager^ {#374
      #app: Illuminate\Foundation\Application^ {#570 …37}
      #stores: array:1 [
        "array" => Illuminate\Cache\Repository^ {#376
          #store: Illuminate\Cache\ArrayStore^ {#375
            #storage: []
            +locks: []
            #serializesValues: false
          }
          #events: Illuminate\Events\Dispatcher^ {#508 …5}
          #default: 3600
        }
      ]
      #customCreators: []
    }
    +store: null
  }
  +mutexNameResolver: null
  +exitCode: null
}
```
