<?php

class GetContentTemplateData extends Controller {

	private static $url_segment = "getcontenttemplates";

	private static $allowed_actions = array(
		'json',
		'show'
	);

	public static function GetJson() {
		return self::show();
	}

	public function json() {
		return HtmlEditorFieldContentTemplate::FetchDataArray();
	}

	// public function show() {
	// 	if(!isset($this->urlParams['ID'])) return false;
	// 	$id = Convert::raw2sql($this->urlParams['ID']);
	// 	$item = Page::get()->byID($id);

	// 	if(!isset($item)) return false;

	// 	$data = array(
	// 		'Page' => $item
	// 	);

	// 	return $this->customise($data)->renderWith("ContentTemplates_show");
	// }

}
