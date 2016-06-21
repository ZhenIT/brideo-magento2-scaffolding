<?php

namespace Brideo\Magento2Scaffolding\Service;

class FrontendRoute extends Base implements ServiceInterface
{

    /**
     * AdminhtmlRoute constructor.
     *
     * @param             $namespace
     * @param             $module
     * @param string      $frontName
     * @param string $actionName
     * @param             $version
     * @param             $directory
     */
    public function __construct($namespace, $module, $frontName, $actionName, $version, $directory)
    {
        $this->data['front_name'] = $frontName;
        $this->data['action_name'] = $actionName;

        parent::__construct($namespace, $module, $version, $directory);
    }

    protected function _construct()
    {
        parent::_construct();
        $directories = [
            'src/etc/frontend',
            'src/Controller',
            $this->getControllerDirectoryName(),
            'src/view/frontend/layout',
            $this->getTemplateDirectory(),
            'src/Test/Controller/',
            $this->getControllerTestDirectoryName()
        ];

        $files = [
            'src/etc/frontend/routes.phtml' => 'src/etc/frontend/routes.xml',
            'src/Controller/IndexController.phtml' => $this->getControllerFileName(),
            'src/view/frontend/layout/module_layout_index.phtml' => 'src/view/frontend/layout/'. $this->getLayoutXmlName(),
            'src/view/frontend/templates/template.phtml' => $this->getTemplateFileName(),
            'src/Test/Controller/IndexControllerTest.phtml' => $this->getControllerTestFileName()
        ];

        $this->directories = array_merge($this->directories, $directories);
        $this->files = array_merge($this->files, $files);

    }

    /**
     * @return string
     */
    protected function getControllerFileName()
    {
        return $this->getControllerDirectoryName() . DIRECTORY_SEPARATOR . $this->data['action_name'] . '.php';
    }

    /**
     * @return string
     */
    protected function getControllerTestFileName()
    {
        return $this->getControllerTestDirectoryName() . DIRECTORY_SEPARATOR . $this->data['action_name'] . 'Test.php';
    }

    /**
     * @return string
     */
    protected function getControllerTestDirectoryName()
    {
        return 'src/Test/Controller/' . $this->data['front_name'];
    }

    /**
     * @return string
     */
    protected function getControllerDirectoryName()
    {
        return 'src/Controller/' . $this->data['front_name'];
    }

    /**
     * @return string
     */
    protected function getLayoutXmlName()
    {
        return strtolower($this->data['namespace'] . '_' . $this->data['module'] . '_' . $this->data['front_name'] . '_' . $this->data['action_name'] .'.xml');
    }

    protected function getTemplateDirectory()
    {
        return 'src/view/frontend/templates/'.strtolower($this->data['front_name']);
    }

    protected function getTemplateFileName()
    {
        return  $this->getTemplateDirectory() . DIRECTORY_SEPARATOR . strtolower($this->data['action_name']) .'.phtml';
    }

}
