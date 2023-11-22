<!-- markdownlint-configure-file {
  "MD013": {
    "code_blocks": false,
    "tables": false
  },
  "MD033": false,
  "MD041": false
} -->

<div align="center">
  
# hyva-photo-swipe

[![Latest Stable Version](https://img.shields.io/badge/version-1.0.0-blue)](https://packagist.org/packages/blackbird/hyva-photo-swipe)
[![SplideJS Version](https://img.shields.io/badge/photoswipe-5.4.1-purple)](https://github.com/dimsemenov/PhotoSwipe/releases/tag/v5.4.1)
[![License: MIT](https://img.shields.io/github/license/blackbird-agency/hyva-photo-swipe.svg)](./LICENSE)


An implementation of [PhotoSwipe library](https://photoswipe.com/) in [Hyvä Theme for Magento 2](https://www.hyva.io/hyva-themes-license.html)

You no longer need to worry about how to implement PhotoSwipe in your Magento 2 Hyvä Theme projects.</br>
No manipulations required, instant use after installation.

PhotoSwipe allows you to create full-screen sliders, zoomable, and fully customizable.

The librairy is lazily loaded and does not affect performances accoding to [Hyvä documentation](https://docs.hyva.io/hyva-themes/writing-code/patterns/loading-external-javascript.html).

[How It Works](#how-it-works) •
[Installation](#installation) •
[Usage](#usage) •
[More modules](#more-modules)

</div>

## How It Works

The module simply loads PhotoSwipe on all pages that use the `PhotoSwipeLightbox` class in the DOM</br>
(the class provied by PhotoSwipe).

When the library has been loaded on the page, a state stored in the [Alpine.store](https://alpinejs.dev/globals/alpine-store) is updated, indicating that PhotoSwipe is ready for use.

The state can also be used to force the library to be loaded at any time, here is an example using [forceLoad()](#example--usage-of-forceload)

## Installation

> ### Requirements
> - [Hyvä Magento 2 Theme](https://www.hyva.io/hyva-themes-license.html)

```
composer require blackbird/hyva-photo-swipe
```
```
php bin/magento setup:upgrade
```
*In production mode, do not forget to recompile and redeploy the static resources.*

## Usage

Once the module has been installed, simply add the HTML code required to create a slider, don't forget to specify for each child the `data-pswp-width` and `data-pswp-height`.

```html
<div id="my-gallery">
  <a href="https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-2500.jpg" 
    data-pswp-width="1669" 
    data-pswp-height="2500" 
    target="_blank">
    <img src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-200.jpg" alt="" />
  </a>
  <a href="https://cdn.photoswipe.com/photoswipe-demo-images/photos/7/img-2500.jpg" 
    data-pswp-width="1875" 
    data-pswp-height="2500" 
    target="_blank">
    <img src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/7/img-200.jpg" alt="" />
  </a>
  <a href="https://unsplash.com" 
    data-pswp-src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-2500.jpg"
    data-pswp-width="2500" 
    data-pswp-height="1666" 
    target="_blank">
    <img src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-200.jpg" alt="" />
  </a>
</div>
```

Next, create a function to listen the [Alpine.store](https://alpinejs.dev/globals/alpine-store) state `is_loading` indicating that PhotoSwipe has been loaded, and apply PhotoSwipe to the HTML elements, as described in the [PhotoSwipe documentation](https://photoswipe.com/getting-started/#initialization).

Don't forget to fill in the important options :
- **gallery**: query selection of your parent gallery node
- **children**: query selection of your children repetiting nodes
- **pswpModule**: just give it PhotoSwipe

```html
<?php
use \Blackbird\HyvaPhotoSwipe\Api\HyvaPhotoSwipeInterface;
?>
<script>
    function myXData () {
        return {
            initPhotoSwipe() {
                if (Alpine.store('<?= HyvaPhotoSwipeInterface::HYVA_PHOTO_SWIPE ?>').is_loaded) {
                    new PhotoSwipeLightbox({
                        gallery: '#my-gallery',
                        children: 'a',
                        pswpModule: PhotoSwipe,
                        ...options
                    }).init();
                }
            }
        }
     }
</script>
```
*You can specify any of the PhotoSwipe options as shown [here](https://photoswipe.com/options/)*

Finally, set up the [x-data](https://alpinejs.dev/directives/data) directive and do not forget to call the previous function in an [x-effect](https://alpinejs.dev/directives/effect), to prevent PhotoSwipe being applied until the library is loaded, and to allow it to be automatically applied when the library is loaded.

```html
<div id="my-gallery" x-data="myXData()" x-effect="initPhotoSwipe">
  ...
</div>
```

### Full example

```html
<?php
use \Blackbird\HyvaPhotoSwipe\Api\HyvaPhotoSwipeInterface;
?>
<div id="my-gallery" x-data="myXData()" x-effect="initPhotoSwipe">
  <a href="https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-2500.jpg" 
    data-pswp-width="1669" 
    data-pswp-height="2500" 
    target="_blank">
    <img src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-200.jpg" alt="" />
  </a>
  <a href="https://cdn.photoswipe.com/photoswipe-demo-images/photos/7/img-2500.jpg" 
    data-pswp-width="1875" 
    data-pswp-height="2500" 
    target="_blank">
    <img src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/7/img-200.jpg" alt="" />
  </a>
  <a href="https://unsplash.com" 
    data-pswp-src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-2500.jpg"
    data-pswp-width="2500" 
    data-pswp-height="1666" 
    target="_blank">
    <img src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-200.jpg" alt="" />
  </a>
</div>
<script>
    function myXData () {
        return {
            initPhotoSwipe() {
                if (Alpine.store('<?= HyvaPhotoSwipeInterface::HYVA_PHOTO_SWIPE ?>').is_loaded) {
                    new PhotoSwipeLightbox({
                        gallery: '#my-gallery',
                        children: 'a',
                        pswpModule: PhotoSwipe,
                        ...options
                    }).init();
                }
            }
        }
     }
</script>
```
*You can specify any of the PhotoSwipe options as shown [here](https://photoswipe.com/options/)*

### Example : usage of `forceLoad()`

Imagine the following case: you do not have the script calling the `PhotoSwipeLightbox` class provided by the librairy in your DOM, and you want to add it when a user's action is triggered.

In this case, PhotoSwipe won't be loaded by default on the page, you will have to explicitly request that PhotoSwipe be loaded.

```js
Alpine.store('<?= HyvaPhotoSwipeInterface::HYVA_PHOTO_SWIPE ?>').forceLoad()
```
or
```js
$store.<?= HyvaPhotoSwipeInterface::HYVA_PHOTO_SWIPE ?>.forceLoad()
```
*To find out exactly which one to use, please see the official Alpine documentation for [$store](https://alpinejs.dev/magics/store) or for [Alpine.store](https://alpinejs.dev/globals/alpine-store).*

This will force the library to load on the page, even if no script call the `PhotoSwipeLightbox` class. You can then follow the classic [Usage](#usage) procedure to apply PhotoSwipe.

## More modules

<div justify="center">
  
[hyva-splide-js](https://github.com/blackbird-agency/hyva-splide-js) : An implementation of SplideJS library in Hyvä Theme for Magento 2, highly optimized and customizable sliders.

</div>
