<?php
namespace PoP\QueriedObject\ModuleProcessors;

trait SingleModuleProcessorTrait
{
    public function getDBObjectIDOrIDs($data_properties)
    {
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        return $vars['routing-state']['queried-object-id'];
    }
}
