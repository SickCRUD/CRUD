<?php

namespace SickCRUD\CRUD\Core\Traits\CrudTraits;

trait Read
{
    /**
     * It contains the current query to be executed.
     *
     * @var mixed
     */
    public $readQuery = false;

    /**
     * Find and retrieve an entry in the database or fail.
     *
     * @param int|string The id of the row to fetch.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntry($id)
    {
        // if the entry is not set, just return it
        if (! $this->entry) {
            $this->entry = $this->model->findOrFail($id);
        }

        return $this->entry;
    }

    /**
     * Get an entries collection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getEntries()
    {
        // if the query instance isset and valid, then return it
        if ($this->readQuery && get_class($this->readQuery) == \Illuminate\Database\Eloquent\Builder::class) {
            return $this->readQuery->get();
        }

        return $this->getModel()->select('*')->get();
    }
}
