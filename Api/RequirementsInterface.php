<?php

declare(strict_types=1);

namespace Blackbird\HyvaPhotoSwipe\Api;

interface RequirementsInterface
{
    public const URL_PHOTO_SWIPE_MIN_JS = 'Blackbird_HyvaPhotoSwipe::js/photoswipe.esm.min.js';
    public const URL_PHOTO_SWIPE_LIGHTBOX_MIN_JS = 'Blackbird_HyvaPhotoSwipe::js/photoswipe-lightbox.esm.min.js';
    public const URL_PHOTO_SWIPE_MIN_CSS = 'Blackbird_HyvaPhotoSwipe::css/photoswipe.min.css';

    public const HYVA_PHOTO_SWIPE_LIGHTBOX_CLASS = 'PhotoSwipeLightbox';
    public const HYVA_PHOTO_SWIPE_CLASS = 'PhotoSwipe';

    public const REQUIRED_CLASSES = [
        self::HYVA_PHOTO_SWIPE_CLASS,
        self::HYVA_PHOTO_SWIPE_LIGHTBOX_CLASS
    ];
}
