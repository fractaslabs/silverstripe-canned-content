<?php

namespace Fractas\CannedContent;

use SilverStripe\Admin\ModelAdmin;
use Fractas\CannedContent\CannedContent;

class CannedContentAdmin extends ModelAdmin
{
    private static $managed_models = [
        CannedContent::class
    ];

    private static $url_segment = 'cannedsoup';

    private static $menu_title = 'Canned Content';

    public $showImportForm = false;
}
