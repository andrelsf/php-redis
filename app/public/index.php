<?php

$redis = new Redis();

$redis->connect('172.71.0.3', 6379, 3.5, null, 150);

$redis->set('message', 'Hello Redis');

print $redis->get('message');