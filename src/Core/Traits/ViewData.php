<?php

namespace SickCRUD\CRUD\Core\Traits;

trait ViewData
{
    /**
     * The data that will be sent to the view
     *
     * @var array
     */
    protected $data = [];

    /**
     * Set the page title
     *
     * @param string $title
     *
     * @return bool
     */
    public function setPageTitle($title = null)
    {
        if($title) {
            $this->data['pageTitle'] = $title;
            return true;
        }
        return false;
    }

    /**
     * Set a variable that will be passed to the view
     *
     * @param string   $key
     * @param mixed $value
     *
     * @return bool
     */
    public function setViewData($key = null, $value = null)
    {
        if($key && $value) {
            $this->data[$key] = $value;
            return true;
        }
        return false;
    }

    /**
     * Get the variable that will be passed to the view
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getViewData($key = null)
    {
        if($key && array_key_exists($this->data[$key])) {
            return $this->data[$key];
        }
        return $this->data;
    }

    /**
     * Delete the data from the variable that will be passed to the view
     *
     * @param string $key
     *
     * @return bool
     */
    public function deleteViewData($key = null)
    {
        if($key && array_key_exists($this->data[$key])) {
            unset($this->data[$key]);
            return !array_key_exists($this->data[$key]);
        }
        return false;
    }

}