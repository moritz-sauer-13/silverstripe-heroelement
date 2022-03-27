<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class Slide extends DataObject{
    private static $db = [
        'SortOrder' => 'Int',
        'Title' => 'Text',
    ];

    private static $has_one = [
        'HeroElement' => HeroElement::class,
        'Image' => Image::class
    ];

    public function getCMSFields(): \SilverStripe\Forms\FieldList
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'SortOrder',
            'HeroElementID'
        ]);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title', _t('General.TITLE', 'Title')),
            UploadField::create('Image', _t('Slide.IMAGE', 'Image')),
        ]);

        $this->extend('updateSlideCMSFields', $fields);

        return $fields;
    }
}