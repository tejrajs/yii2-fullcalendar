# yii2-fullcalendar
fullcalendar yii2 widget

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist tejrajs/yii2-fullcalendar "dev-master"
```

or add

```
"tejrajs/yii2-fullcalendar": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php 
<?php
use tejrajs\fullcalendar\FullCalendar;
?>
<?= FullCalendar::widget([
	'options'=>['id'=>'calender'],
	
    'config' => [
	    'header' => ['left'=>'prev,next today','center'=> 'title','right'=> 'month,agendaWeek,agendaDay'],
	    'defaultDate' => date('Y-m-d'),
	    'editable' =>  true,
        'lang' => 'en-gb', // optional, if empty get app language
        // put your options and callbacks here
        // see http://arshaw.com/fullcalendar/docs/
        //@eg 'eventSources'=> ['http://localhost/new_crm_branch/crm/marketing/feed'],
	], 
]); ?>
```
