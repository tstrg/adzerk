#adzerk - ALPHA DO NOT USE!

####PHP Client for Adzerk REST API

Adzerk thin client (https://github.com/positivezero/adzerk)

Copyright (c) 2013 PositiveZero ltd. (http://www.positivezero.co.uk)
 
For the full copyright and license information, please view
the file license.md that was distributed with this source code.
 
API: https://github.com/adzerk/adzerk-api/wiki
 
Usage:

```php
$adzerk = new Adzerk(API_KEY)
$response = $adzerk->site()->get();
```

First of all, you have to select api method (advertiser, channel, site etc.).
All methods are documented in Adzerk class annotation.

example:
```php
$adzerk->advertiser
$adzerk->channel
$adzerk->site
...
```
 
This will return Adzerk\Wrapper object, which do rest - Send curl request and return response.
@see \Positivezero\RestClient
```php
$adzerk->channel()->create()
$adzerk->channel(/*optional*/ $id)->get()
$adzerk->channel($id)->update()
$adzerk->channel($id)->delete()
```

You have to define all required properties in annotation. Validation before post/put is automatic.

example of list all Channels
```php
$list = $adzerk->channel()->get();
```
or get some spcecific item
```php
$list = $adzerk->channel(5541)->get();
```
 
example of creating Channel:
```php
$object = $adzerk->channel();
$object->Id = 0;
$object->Title = 'Some name';
$object->AdTypes = array(1,3,4);
$object->Engine = 'CPM';
$object->CPM   = 10.00;
$response = $object->create();
```

example of updating Channel:
```php
$object = $adzerk->channel(5541);
$object->Title = 'Some name';
$object->CPM   = 10.00;
$response = $object->update();
```

example of removing Channel:
```php
$object = $adzerk->channel(5541);
$object->delete();
```

it will generate endpoint url like:
```
http://api.adzerk.net/v1/channel/15311
```

and put this object as string:
```
channel={"Id":15311,"Title":"Some name","AdTypes":[1,3,4],"Engine":"CPM","CPM":10}
```
 
All responses are returned by default, as an associative PHP array