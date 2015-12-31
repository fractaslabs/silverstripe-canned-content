<?php

class HtmlEditorFieldContentTemplateAdmin extends ModelAdmin
{

    private static $managed_models = array(
        'HtmlEditorFieldContentTemplate'
    );

    private static $url_segment = 'contenttemplates';

    private static $menu_title = 'Content Templates';

    // private static $menu_priority = 10;

    public $showImportForm = false;
}
