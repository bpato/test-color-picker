<?php


if (!defined('_PS_VERSION_')) {
    exit;
}

class AdminTestColorController extends ModuleAdminController
{
    /** @var Test_Color $module */
    public $module;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'configuration';
        $this->className = 'Configuration';

        parent::__construct();

        $this->fields_options = array();
        $this->fields_options[$this->module->name] = array(
            'fields' => array(
                array(
                    'type' => 'textareaLang',
                    'lang' => true,
                    'title' => 'title',
                    'validation' => 'isCleanHtml',
                ),                
                array(
                    'type' => 'color',
                    'title' => 'Color',
                    'validation' => 'isColor',
                    'size' => 20,
                    'value' => '#ffffff',
                    'name' => 'test_name'
                ),
                array(
                    'type' => 'color',
                    'title' => 'Color',
                    'validation' => 'isColor',
                    'value' => '#ffffff',
                ),
            ),
            'submit' => array(
                'title' => $this->trans('Save', array(), 'Admin.Actions')
            )
        );
    }
}