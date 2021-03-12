<?php
namespace frontend\components;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;
use Yii;

class ModuleUrlRules implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if(($moduleName = $this->getModuleName()) && $app->hasModule($moduleName))
        {
            $module = $app->getModule($moduleName);
            if(isset($module->urlRules))
            {
                $app->get('urlManager')->rules[] = new GroupUrlRule($module->urlRules);
            }
        }
    }

    protected function getModuleName()
    {
        $route = \Yii::$app->getRequest()->getPathInfo();
        $domains = explode('/', $route);
        $lang = array_shift($domains);
        $moduleName = array_shift($domains);

        return $moduleName;
    }
}