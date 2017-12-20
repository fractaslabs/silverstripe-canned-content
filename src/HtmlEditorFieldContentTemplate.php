<?php

namespace Fractas\HtmlContentTemplate;

use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\HtmlEditorField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;

class HtmlEditorFieldContentTemplate extends DataObject
{
    private static $db = array(
        'Name' => 'Varchar(255)',
        'Description' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'IsActive' => 'Boolean',
    );

    private static $defaults = array(
        'IsActive' => true,
    );

    private static $casting = array(
        'Title' => 'Varchar',
        'Link' => 'Varchar',
    );

    private static $indexes = array();

    private static $default_sort = 'ID DESC';

    private static $summary_fields = array(
        'Name',
        'IsActive.Nice',
    );

    private static $searchable_fields = array(
        'Name' => 'PartialMatchFilter',
    );

    private static $field_labels = array(
        'Name' => 'Name for Content Template',
        'IsActive.Nice' => 'Is Active',
    );

    private static $singular_name = 'Content Template';

    public function i18n_singular_name()
    {
        return _t('HtmlEditorFieldContentTemplate.CONTENTTEMPLATE', 'Content Template');
    }

    private static $plural_name = 'Content Template';

    public function i18n_plural_name()
    {
        return _t('HtmlEditorFieldContentTemplate.CONTENTTEMPLATES', 'Content Templates');
    }

    public function populateDefaults()
    {
        parent::populateDefaults();
    }

    public function getCMSFields()
    {
        $fields = new FieldList(new TabSet('Root', new Tab('Main')));

        $fields->addFieldsToTab('Root.Main', array(
            new TextField('Name', 'Name'),
            new CheckboxField('IsActive', 'Is Active'),
            new TextareaField('Description', 'Description'),
            new HtmlEditorField('Content', 'Content'),
        ));

        return $fields;
    }

    public function Title()
    {
        return $this->getTitle();
    }

    public function getTitle()
    {
        $out = '';

        return $this->Name.$out;
    }

    public static function LinkBase()
    {
        return self::getLinkBase();
    }

    public function Link()
    {
        return $this->getLink();
    }

    public function getLinkBase()
    {
        return Director::baseURL().Controller::join_links('getcontenttemplates', 'show');
    }

    public function getLink()
    {
        return Controller::join_links($this->getLinkBase(), $this->ID);
    }

    public static function GetFileBasePath()
    {
        return self::FileBasePath();
    }

    public function FileBasePath()
    {
        return Director::BaseURL().'assets/tinymce_templates/';
    }

    public function FilePath()
    {
        return $this->FileBasePath().$this->FileName();
    }

    public function FileName()
    {
        return "tmpl_$this->ID.html";
    }

    public function AssetsBasePath()
    {
        return ASSETS_PATH.'/tinymce_templates/';
    }

    public function AssetsPath()
    {
        return $this->AssetsBasePath().$this->FileName();
    }

    public function AssetsIndexPath()
    {
        return $this->AssetsBasePath().'index.json';
    }

    public function canView($member = null)
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canEdit($member = null)
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canDelete($member = null)
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canCreate($member = null, $context = array())
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
    }

    public function onAfterWrite()
    {
        parent::onAfterWrite();

        $this->SaveTemplateFile();
        $this->SaveTemplatesIndex();
    }

    private function SaveTemplateFile()
    {
        $assetsBasePath = $this->AssetsBasePath();

        if (!file_exists($assetsBasePath)) {
            mkdir($assetsBasePath, 0777, true);
        }

        file_put_contents($this->AssetsPath(), $this->Content);
    }

    private function SaveTemplatesIndex()
    {
        $items = self::get()->where(array('IsActive' => '1'));
        $output = array();

        if ($items->exists()) {
            foreach ($items as $item) {
                if ($item->exists()) {
                    $output[] = array(
                        'title' => $item->Name,
                        'src' => $item->FilePath(),
                        'description' => isset($item->Description) ? $item->Description : $item->Name,
                    );
                }
            }
        }

        file_put_contents($this->AssetsIndexPath(), json_encode($output));
    }

    public static function FetchDataArray()
    {
        $assetsBasePath = Injector::inst()->get('Fractas\HtmlContentTemplate\HtmlEditorFieldContentTemplate')->AssetsIndexPath();

        if (file_exists($assetsBasePath)) {
            return json_decode(file_get_contents($assetsBasePath), true);
        }

        return array();
    }
}
