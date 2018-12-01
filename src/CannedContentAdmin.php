<?php

namespace Fractas\CannedContent;

use SilverStripe\Admin\ModelAdmin;

class CannedContentAdmin extends ModelAdmin
{
    private static $managed_models = [
        CannedContent::class,
    ];

    private static $url_segment = 'cannedsoup';

    private static $menu_title = 'Canned Content';

    private static $menu_icon = 'fractas/canned-content:client/dist/images/lab.svg';

    public $showImportForm = false;
}
