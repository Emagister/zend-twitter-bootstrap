# Zend View Helpers for Twitter's Bootstrap #

This is a small set of view helpers to render specific Twitter Bootstrap (v2.1) markup.

## How to register this view helpers? ##

```php
<?php

$view = new Zend_View();
$view->addHelperPath('/path/to/zend/twitter/bootstrap/src', 'Twitter');

echo $view->lead('Hi from Twitter\'s Bootstrap!');
```