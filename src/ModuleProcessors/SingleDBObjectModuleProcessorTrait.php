<?php
namespace PoP\QueriedObject\ModuleProcessors;

trait SingleDBObjectModuleProcessorTrait
{
    protected function getSingleDBObjectID(array $module, array &$props, &$data_properties)
    {
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        return $vars['routing-state']['queried-object-id'];
    }
}
