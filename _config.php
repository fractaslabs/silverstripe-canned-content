<?php

HtmlEditorConfig::get('cms')->enablePlugins('template');
HtmlEditorConfig::get('cms')->setOptions(array('template_templates' => HtmlEditorFieldContentTemplate::FetchDataArray()));
HtmlEditorConfig::get('cms')->addButtonsToLine(1, 'template');

HtmlEditorConfig::get('cms')->enablePlugins('searchreplace');
HtmlEditorConfig::get('cms')->insertButtonsAfter('find', 'replace');

HtmlEditorConfig::get('cms')->setOption('convert_fonts_to_spans', false);
HtmlEditorConfig::get('cms')->setOption('valid_elements','*');
HtmlEditorConfig::get('cms')->setOption('extended_valid_elements','*');
