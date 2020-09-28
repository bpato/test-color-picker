<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

$autoloadPath = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
}

class TestColor extends Module
{
    /** @var string Unique name */
    public $name = 'testcolor';

    /** @var string Admin tab corresponding to the module */
    public $tab = 'back_office_features';

    /** @var string Version */
    public $version = '1.0.0';

    /** @var string author of the module */
    public $author = 'bpato';

    /** @var int need_instance */
    public $need_instance = 0;

    /** @var array filled with known compliant PS versions */
    public $ps_versions_compliancy = array(
        'min' => '1.7.3.3',
        'max' => '1.7.9.99'
    );

    /** Name of ModuleAdminController used for configuration */
    const MODULE_ADMIN_CONTROLLER = 'AdminTestColor';
    
    /**
     * Constructor of module
     */
    public function __construct()
    {
        parent::__construct();

        $this->displayName = 'test color';
        $this->description = 'test color';
        $this->confirmUninstall = 'Are you sure you want to uninstall?';
    }

    /**
     * @return bool
     */
    public function install()
    {
        return parent::install()
        && $this->installTabs();
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        return parent::uninstall()
        && $this->uninstallTabs();
    }

    /**
     * Install Tabs
     *
     * @return bool
     */
    public function installTabs()
    {
        if (Tab::getIdFromClassName(static::MODULE_ADMIN_CONTROLLER)) {
            return true;
        }

        $tab = new Tab();
        $tab->class_name = static::MODULE_ADMIN_CONTROLLER;
        $tab->module = $this->name;
        $tab->active = true;
        $tab->id_parent = -1;
        $tab->name = array_fill_keys(
            Language::getIDs(false),
            $this->displayName
        );

        return (bool) $tab->add();
    }

    public function uninstallTabs()
    {
        $id_tab = (int) Tab::getIdFromClassName(static::MODULE_ADMIN_CONTROLLER);

        if ($id_tab) {
            $tab = new Tab($id_tab);

            return (bool) $tab->delete();
        }

        return true;
    }

    public function getContent()
    {
        Tools::redirectAdmin(Context::getContext()->link->getAdminLink(self::MODULE_ADMIN_CONTROLLER));
        return null;
    }

}