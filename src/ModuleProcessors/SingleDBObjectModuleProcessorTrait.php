<?php
namespace PoP\QueriedObject\ModuleProcessors;

trait SingleDBObjectModuleProcessorTrait
{
    public function getDBObjectIDOrIDs($data_properties)
    {
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        return $vars['routing-state']['queried-object-id'];
    }
}
