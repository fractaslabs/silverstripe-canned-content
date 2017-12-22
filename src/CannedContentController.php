<?php

namespace Fractas\CannedContent;

use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;

class CannedContentController extends Controller
{
    private static $url_segment = 'cannedcontent';

    private static $allowed_actions = array(
        'templates',
        'template',
    );

    public function templates(HTTPRequest $request)
    {
        $items = CannedContent::get()->where(array('IsActive' => '1'));
        $output = array();

        if ($items->exists()) {
            foreach ($items as $item) {
                if ($item->exists()) {
                    $output[] = array(
                        'title' => $item->Name,
                        'url' => $item->Link(),
                        'description' => isset($item->Description) ? $item->Description : $item->Name,
                    );
                }
            }
        }

        $this->getResponse()->setBody(json_encode($output));
        $this->getResponse()->addHeader('Content-type', 'application/json');

        return $this->getResponse();
    }

    public function template(HTTPRequest $request)
    {
        if (null !== $request->Param('ID')) {
            $item = CannedContent::get()->byID($request->Param('ID'));
            $this->getResponse()->setBody($item->Content);
        } else {
            $this->getResponse()->setStatusCode(400);
        }

        return $this->getResponse();
    }

    public static function FetchTemplates()
    {
        return self::$url_segment.'/templates';
    }
}
