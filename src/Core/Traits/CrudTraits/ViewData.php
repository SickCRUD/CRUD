<?php

namespace SickCRUD\CRUD\Core\Traits\CrudTraits;

use SickCRUD\CRUD\Core\Traits\ViewData as BaseViewData;

trait ViewData
{
    use BaseViewData;

    /**
     * Set the page title.
     *
     * @param string $singular
     * @param string $plural
     *
     * @return bool
     */
    public function setEntityNameStrings($singular = null, $plural = null)
    {

        if ($singular || $plural) {

            if($singular) {
                $this->data['entitySingular'] = $singular;
            }

            if($plural) {
                $this->data['entityPlural'] = $plural;
            }

            return true;
        }

        return false;
    }

}
