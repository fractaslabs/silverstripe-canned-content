<?php

class LeftAndMainContentTemplateDecorator extends LeftAndMainExtension {

	function init() {
		parent::init();

		HtmlEditorConfig::get('cms')->enablePlugins('template');
		HtmlEditorConfig::get('cms')->insertButtonsAfter('tablecontrols', 'template');
		HtmlEditorConfig::get('cms')->setOptions(array('template_templates' => HtmlEditorFieldContentTemplate::FetchDataArray()));
	}
}
