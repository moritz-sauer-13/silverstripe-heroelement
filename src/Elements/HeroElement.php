<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class HeroElement extends BaseElement{
    private static $db = [
        'Title' => 'Text',
    ];

    private static $has_many = [
        'Slides' => Slide::class
    ];

    public function getCMSFields(): \SilverStripe\Forms\FieldList
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'Slides',
        ]);

        $fields->addFieldsToTab('Root.Main', [
            GridField::create(
                'Slides',
                _t('Element.SLIDES', 'Slides'),
                $this->Slides()->sort('SortOrder ASC'),
                GridFieldConfig_RecordEditor::create()
                    ->addComponent(GridFieldOrderableRows::create('SortOrder'))
            ),
        ]);

        return $fields;
    }

    public function inlineEditable(): bool
    {
        return false;
    }

    public function getType(): string
    {
        return _t('Element.HEROELEMENT', 'Hero Element');
    }

    public function getASCSortedSlides(){
        return $this->Slides()->sort('SortOrder ASC');
    }

    public function getDESCSortedSlides(){
        return $this->Slides()->sort('SortOrder DESC');
    }

    public function getRANDOMSortedSlides(){
        return $this->Slides()->sort('RAND()');
    }
}