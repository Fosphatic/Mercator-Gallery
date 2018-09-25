Mercator Gallery Extension for Pagekit

Copyright (C) 2018 Helmut Kaufmann (software@mercator.li)

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

This plugin uses the Blueimp library provided by Sebastian Tschann (https://github.com/blueimp/).

To use this plugin within Pagekit:
- Create a directory called "Images" within Storage.
- For each slideshow you want to produce, create a directory within Images, e.g., show1.
- To include a preview of your images onto your page, simply use (mercator_gallery){"dir":"show1"} .
- The script will automatically produce a preview of the images.

Options (add after ""dir":"show1", eg. (mercator_gallery){"fullscreen":"false"}:
- "mode":"carousel"		 ---	Do not show thumbnails but produce a Carousel (see Blueimp Gallery)
- "duration":"300"		 ---	Change the duration (in ms) each image is shown, e.g., 300ms
- "fullscreen":"false"	 --- 	When clicking on thumbs, a slideshow will start. By default it starts fullscreen. When set to false, the show will run in the current window.
- "postion":"uk-width-1-2 uk-container-center" --- When using a carousel, you can use and UIKit width statement to determine the and positioning of the carousel. If not specified, it is uk-width-1-2 uk-container-center


A special "thank you" to Sven Suchan, who has been instrumental in getting this into the Pagekit Marketplace.