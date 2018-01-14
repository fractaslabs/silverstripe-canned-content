<?php

use SilverStripe\Forms\HTMLEditor\HtmlEditorConfig;
use Fractas\CannedContent\CannedContentController;
use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;

HtmlEditorConfig::get('cms')->enablePlugins('template');
HtmlEditorConfig::get('cms')->setOptions(array('templates' => CannedContentController::FetchTemplates()));
HtmlEditorConfig::get('cms')->addButtonsToLine(1, 'template');
