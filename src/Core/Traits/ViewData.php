<?php

namespace SickCRUD\CRUD\Core\Traits;

trait ViewData
{
    /**
     * The data that will be sent to the view.
     *
     * @var array
     */
    protected $data = [
        'pageTitle' => '',
        'bodyClasses' => [],
    ];

    /**
     * Set the page title.
     *
     * @param string $title
     *
     * @return bool
     */
    public function setPageTitle($title = null)
    {
        if ($title) {
            $this->data['pageTitle'] = $title;

            return true;
        }

        return false;
    }

    /**
     * Add a body class if it's not already in it.
     *
     * @param string $bodyClass
     *
     * @return bool
     */
    public function addBodyClass(string $bodyClass = null)
    {
        // cast to array
        $bodyClass = (array) $bodyClass;

        return $this->addBodyClasses($bodyClass);
    }

    /**
     * Remove a body class if it's in.
     *
     * @param string $bodyClass
     *
     * @return bool
     */
    public function removeBodyClass(string $bodyClass = null)
    {
        // cast to array
        $bodyClass = (array) $bodyClass;

        return $this->removeBodyClasses($bodyClass);
    }

    /**
     * Add classes from the body (bulk).
     *
     * @param array $bodyClasses
     *
     * @return bool
     */
    public function addBodyClasses(array $bodyClasses = [])
    {
        // cast to array
        $bodyClasses = (array) $bodyClasses;

        if ($bodyClasses) {
            $this->data['bodyClasses'] = array_merge(array_diff($bodyClasses, $this->data['bodyClasses']), $this->data['bodyClasses']);

            return true;
        }

        return false;
    }

    /**
     * Remove classes from the body (bulk).
     *
     * @param array $bodyClasses
     *
     * @return bool
     */
    public function removeBodyClasses(array $bodyClasses = [])
    {

        // cycle the classes
        foreach ($bodyClasses as $key => $bodyClass) {

            // unset from the array
            if (($key = array_search($bodyClass, $this->data['bodyClasses'])) !== false) {
                unset($this->data['bodyClasses'][$key]);
            }
        }

        return true;
    }

    /**
     * Set a variable that will be passed to the view.
     *
     * @param string   $key
     * @param mixed $value
     *
     * @return bool
     */
    public function setViewData($key = null, $value = null)
    {
        if ($key && $value) {
            $this->data[$key] = $value;

            return true;
        }

        return false;
    }

    /**
     * Get the variable that will be passed to the view.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getViewData($key = null)
    {
        if ($key && array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return $this->data;
    }

    /**
     * Delete the data from the variable that will be passed to the view.
     *
     * @param string $key
     *
     * @return bool
     */
    public function deleteViewData($key = null)
    {
        if ($key && array_key_exists($key, $this->data)) {
            unset($this->data[$key]);

            return ! array_key_exists($key, $this->data);
        }

        return false;
    }

    /**
     * Set the view data with a passed array.
     *
     * @param array $data
     *
     * @return bool
     */
    public function updateViewData(array $data)
    {
        foreach ($data as $key => $datum) {

            if($datum && array_key_exists($key, $this->data) && $this->data[$key] !== $datum) {
                $this->data[$key] = $datum;
            }

        }

        return true;
    }
}
