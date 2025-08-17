# Invoking

?> Note, Here we want to explain to you how exactly you can use raw [functions](en/functions.md) and directly exchange your requests between your client and Telegram servers.

---

## Object-Oriented Method Chaining

```php
$peer = $client->get_input_peer('@LiveProtoChat');

$text = 'Hello <tg-emoji emoji-id = "5233599134019100925">👋</tg-emoji> | <a href = "https://t.me/LiveProto">LiveProto</a>';

list($message,$entities) = $client->html($text);

var_dump($client->messages->sendMessage(peer : $peer,message : $message,random_id : random_int(PHP_INT_MIN,PHP_INT_MAX),entities : $entities));
```

---

```php
$peer = $client->get_input_peer('@LiveProtoChat');

$text = 'Hello [👋](tg://emoji?id=5233599134019100925) | [LiveProto](https://t.me/LiveProto)';

list($message,$entities) = $client->markdown($text);

$namespace = ($client->messages);

var_dump($namespace->sendMessage(peer : $peer,message : $message,random_id : random_int(PHP_INT_MIN,PHP_INT_MAX),entities : $entities));
```

---

## Dynamic Method Invocation

```php
$peer = $client->get_input_peer('@LiveProtoChat');

$text = '<u>Hello 👋</u> | <b>LiveProto</b>';

list($message,$entities) = $client->html($text);

var_dump($client('messages.sendMessage',['peer'=>$peer,'message'=>$message,'random_id'=>random_int(PHP_INT_MIN,PHP_INT_MAX),'entities'=>$entities]));
```

---

```php
$peer = $client->get_input_peer('@LiveProtoChat');

$text = '__Hello 👋__ | **LiveProto**';

list($message,$entities) = $client->markdown($text);

var_dump($client('messages/sendMessage',array('peer'=>$peer,'message'=>$message,'random_id'=>random_int(PHP_INT_MIN,PHP_INT_MAX),'entities'=>$entities)));
```

---

## Multiple Requests

```php
$peers = ['@LiveProtoChat','@LiveProtoBot'];

$text = 'I am running the <a href = "https://t.me/LiveProto">LiveProto 🌱</a> library';

list($message,$entities) = $client->html($text);

$requests = array();

foreach($peers as $peer){
	$requests []= ['peer'=>$client->get_input_peer($peer),'message'=>$message,'random_id'=>random_int(PHP_INT_MIN,PHP_INT_MAX),'entities'=>$entities];
}

var_dump($client->messages->sendMessageMultiple(...$requests,responses : true));

$namespace = ($client->messages);

var_dump($namespace->sendMessageMultiple(['peer'=>$client->get_input_peer($peers[false]),'message'=>$message,'random_id'=>random_int(PHP_INT_MIN,PHP_INT_MAX),'entities'=>$entities],['peer'=>$client->get_input_peer($peers[true]),'message'=>$message,'random_id'=>random_int(PHP_INT_MIN,PHP_INT_MAX),'entities'=>$entities],responses : true));
```

---

```php
$peers = ['@LiveProtoChat','@LiveProtoBot'];

$text = 'I am running the [LiveProto 🌱](https://t.me/LiveProto) library';

list($message,$entities) = $client->markdown($text);

$requests = array();

foreach($peers as $peer){
	$requests []= ['peer'=>$client->get_input_peer($peer),'message'=>$message,'random_id'=>random_int(PHP_INT_MIN,PHP_INT_MAX),'entities'=>$entities];
}

var_dump($client('messages.sendMessageMultiple',[...$requests,'responses'=>true]));

var_dump($client('messages/sendMessageMultiple',[array('peer'=>$client->get_input_peer($peers[false]),'message'=>$message,'random_id'=>random_int(PHP_INT_MIN,PHP_INT_MAX),'entities'=>$entities),array('peer'=>$client->get_input_peer($peers[true]),'message'=>$message,'random_id'=>random_int(PHP_INT_MIN,PHP_INT_MAX),'entities'=>$entities),'responses'=>true]));
```

### Additional Parameters

> You can use other parameters in your requests, which are managed by the library and provide you with a number of options

| Parameter | Type | Default | Description |
| --- | --- | --- | --- |
| `raw` | `Boolean` | `false` | Gets the method without executing it , Used as parameters ( like [`query:!X`](https://core.telegram.org/api/invoking) ) of some methods
| `response` | `Boolean` | `true` | If it is false, it means you are not looking for the result of your request and are not waiting for Telegram to notify you of the answer
| `timeout` | `Float` | `0` | If zero, it is disabled, otherwise it specifies the maximum time you want to wait for the request result
| `floodwaitlimit` | `Float` | `0` | If zero, it is disabled, otherwise you specify the maximum time you want to wait before resending the request if a flood wait error is encountered

?> Note, If the flood wait time exceeds the maximum time set, we will not resend it and you will encounter a flood wait error and you will have to handle it yourself , And we also consider the maximum value you set between the `floodwaitlimit` parameter and the [`floodsleepthreshold`](en/configuration.md#flood-sleep-threshold) parameter