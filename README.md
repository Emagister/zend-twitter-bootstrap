# Zend View Helpers for Twitter's Bootstrap #

This is a small set of view helpers to render specific Twitter Bootstrap (v2.1) markup.

## How to register this view helpers? ##

```php
<?php

$view = new Zend_View();
$view->addHelperPath('/path/to/zend/twitter/bootstrap/src', 'Twitter');
$view->addHelperPath('/path/to/zend/twitter/bootstrap/src/Twitter/Bootstrap/Tables/Table', 'Twitter_Bootstrap_Tables_Table');
$view->addHelperPath('/path/to/zend/twitter/bootstrap/src/Twitter/Bootstrap/Typography', 'Twitter_Bootstrap_Typography');

echo $view->lead('Hi from Twitter\'s Bootstrap!');
```

## API documentation ##

### Images ###

There are three view helpers to render images

```php
<?php

echo $this->roundedImage('/image.jpg', array('alt' => 'image alt attribute', 'class' => 'class'));
echo $this->circledImage('/image.jpg', array('alt' => 'image alt attribute', 'class' => 'class'));
echo $this->polaroidImage('/image.jpg', array('alt' => 'image alt attribute', 'class' => 'class'));
```

### Tables ###

This view helper is specially suited to render Twitter's Bootstrap tables easily. Here is
an example

```php
<?php
// Inside a phtml/tpl file
$table = $this->table(array('class' => 'example'));

$row = $table->row();
$row
    ->add('cell'),
    ->add('cell', array('class' => 'odd'))
;
$table->add($row);

// And the same for STATE_ERROR and STATE_INFO
$rowSuccess = $table->row();
$rowSuccess
    ->setState(Twitter_Bootstrap_Tables_Table_Row::STATE_SUCCESS)
    ->add('cell'),
    ->add('cell', array('class' => 'odd'))
;
$table->add($rowSuccess);

$header = $table->row();
$header
    ->isHeader(true)
    ->add('HEAD1')
    ->add('HEAD2')
;

$table
    ->isStripped(true)
    ->isBordered(true)
    ->isHover(true)
    ->isCondensed(true)
    ->setCaption('Table caption')
    ->addHeader($header)
;

echo $table;
```

### Typography ###

#### Blockquote ####

```php
<?php echo $this->blockquote('Hello World!', 'Blockquote source', 'Blockquote cite'); ?>
```

#### Lead ####

```php
<?php echo $this->lead('Hello World!'); ?>
```

### Code ###

```php
$isPreScollable = true;
<?php echo $this->code('&lt;p&gt;Code example&lt;/p&gt;, $isPreScollable); ?>
```