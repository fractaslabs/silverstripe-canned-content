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
}
