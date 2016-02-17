<?php

class Shopware_Plugins_Frontend_ScnSubresourceIntegrity_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    private function getPluginJson()
    {
        $json = json_decode(file_get_contents(__DIR__ . '/plugin.json'), true);

        if ($json) {
            return $json;
        } else {
            throw new Exception('Cannot find plugin.json');
        }
    }

    public function getInfo()
    {
        $json = $this->getPluginJson();

        return array(
            'version' => $json['currentVersion'],
            'label' => $json['label']['de'],
            'copyright' => $json['copyright'],
            'author' => $json['author'],
            'supplier' => $json['supplier'],
            'description' => $json['description'],
            'support' => $json['support'],
            'link' => $json['link']
        );
    }

    public function getCapabilities()
    {
        return array(
            'install' => true,
            'update' => true,
            'enable' => true
        );
    }

    public function install()
    {
        $this->registerEvents();
        //$this->createConfiguration();

        return array('success' => true, 'invalidateCache' => array('frontend', 'theme'));
    }

    public function uninstall()
    {
        return array('success' => true, 'invalidateCache' => array('frontend', 'theme'));
    }

    private function registerEvents()
    {
        $this->subscribeEvent('Enlight_Controller_Action_Init', 'onActionInit', 401);
        $this->subscribeEvent('Enlight_Controller_Action_PostDispatchSecure_Frontend', 'onPostDispatchFrontend');
    }

    public function onActionInit(Enlight_Event_EventArgs $args)
    {
        $subject = $args->getSubject();
        $view = $subject->View();
        $engine = $view->Engine();
        if (!isset($engine->smarty->registered_plugins['function']['sri'])) {
            $engine->registerPlugin('function', 'sri', array(get_class($this), 'smarty_function_sri'));
        }
    }

    public function onPostDispatchFrontend(Enlight_Event_EventArgs $args)
    {
        $subject = $args->getSubject();
        $view = $subject->View();
        $view->addTemplateDir($this->Path() . 'Views');
    }

    public static function smarty_function_sri($params, $smarty)
    {
        $algo = 'sha384';

        if (empty($params['file'])) {
            throw new Exception('assign: missing \'file\' parameter');
            return;
        }

        $filepath = '/' . trim(Shopware()->DocPath(), '/') . '/' . trim($params['file'], '/');

        $fileContents = file_get_contents($filepath);;
        if (!$fileContents) {
            throw new Exception('fs: file \'' . $filepath . '\' not found');
        }

        if (!empty($params['algo'])) {
            $algo = $params['algo'];
        }

        $hash = hash($algo, $fileContents, true);
        $sri = $algo . '-' . base64_encode($hash);

        if (!empty($params['assign'])) {
            $smarty->assign($params['assign'], $sri);
            return;
        }

        return $sri;
    }
}
