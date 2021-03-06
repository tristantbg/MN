<?php

/*

---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby on http://getkirby.com/buy

It is not permitted to run a public website without a
valid license key. Please read the End User License Agreement
for more information: http://getkirby.com/license

*/

c::set('license', 'put your license key here');

/*

---------------------------------------
Kirby Configuration
---------------------------------------

By default you don't have to configure anything to
make Kirby work. For more fine-grained configuration
of the system, please check out http://getkirby.com/docs/advanced/options

*/

c::set('oembed.lazyvideo', true);
c::set('autopublish.templates', array('project', 'item'));
c::set('thumb.quality', 100);
c::set('sitemap.exclude', array('error'));
c::set('routes', array(
    array(
        'pattern' => 'work/(:all)',
        'action'  => function($uri,$uid) {
          $page = page('work/' . $uid);

      		// redirect to the article or the error page
      		go($page ? '/#!/page/work/'.$uri : 'error');
        }
    )
));