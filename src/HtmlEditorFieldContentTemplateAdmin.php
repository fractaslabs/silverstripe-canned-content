<?php

namespace Fractas\HtmlContentTemplate;

use SilverStripe\Admin\ModelAdmin;
use Fractas\HtmlContentTemplate\HtmlEditorFieldContentTemplate;

class HtmlEditorFieldContentTemplateAdmin extends ModelAdmin
{
    private static $managed_models = array(
        HtmlEditorFieldContentTemplate::class
    );

    private static $url_segment = 'contenttemplates';

    private static $menu_title = 'Content Templates';

    public $showImportForm = false;
}
