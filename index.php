<?php

/*
    
    Mercator's Gallery Extnesion for Pagekit
    Copyright (C) 2018 Helmut Kaufmann

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.

*/

return [

    'name' => 'mercator/gallery',

    'type' => 'extension',

    'main' => function ($app) {
        $app->subscribe(new mercator\gallery\Plugin\MercatorGallery()); // Subscribe the plugin class.
    },

    'autoload' => [
        'mercator\\gallery\\' => 'src'
    ],

    'events' => [

      'site' => function ($event, $app) {
            $app->on('view.content', function ($event, $test) use ($app) {
            $app['scripts']->add('mercator-js' , 'mercator/gallery:assets/js/blueimp-gallery.min.js' , ['jquery']);
            $app['styles']->add('mercator-css' , 'mercator/gallery:assets/css/blueimp-gallery.css');
            });
      }
   ]

];

?>
