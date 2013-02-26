<?php

namespace Album\Resource\Mandango\Base;

/**
 * Base class of Album\Resource\Mandango\Album document.
 */
abstract class Album extends \Mandango\Document\Document implements \Zend\Stdlib\ArraySerializableInterface
{
    /**
     * Initializes the document defaults.
     */
    public function initializeDefaults()
    {
    }

    /**
     * Set the document data (hydrate).
     *
     * @param array $data  The document data.
     * @param bool  $clean Whether clean the document.
     *
     * @return \Album\Resource\Mandango\Album The document (fluent interface).
     */
    public function setDocumentData($data, $clean = false)
    {
        if ($clean) {
            $this->data = array();
            $this->fieldsModified = array();
        }

        if (isset($data['_query_hash'])) {
            $this->addQueryHash($data['_query_hash']);
        }
        if (isset($data['_id'])) {
            $this->setId($data['_id']);
            $this->setIsNew(false);
        }
        if (isset($data['artist'])) {
            $this->data['fields']['artist'] = (string) $data['artist'];
        } elseif (isset($data['_fields']['artist'])) {
            $this->data['fields']['artist'] = null;
        }
        if (isset($data['title'])) {
            $this->data['fields']['title'] = (string) $data['title'];
        } elseif (isset($data['_fields']['title'])) {
            $this->data['fields']['title'] = null;
        }

        return $this;
    }

    /**
     * Set the "artist" field.
     *
     * @param mixed $value The value.
     *
     * @return \Album\Resource\Mandango\Album The document (fluent interface).
     */
    public function setArtist($value)
    {
        if (!isset($this->data['fields']['artist'])) {
            if (!$this->isNew()) {
                $this->getArtist();
                if ($value === $this->data['fields']['artist']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['artist'] = null;
                $this->data['fields']['artist'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['artist']) {
            return $this;
        }

        if (!isset($this->fieldsModified['artist']) && !array_key_exists('artist', $this->fieldsModified)) {
            $this->fieldsModified['artist'] = $this->data['fields']['artist'];
        } elseif ($value === $this->fieldsModified['artist']) {
            unset($this->fieldsModified['artist']);
        }

        $this->data['fields']['artist'] = $value;

        return $this;
    }

    /**
     * Returns the "artist" field.
     *
     * @return mixed The $name field.
     */
    public function getArtist()
    {
        if (!isset($this->data['fields']['artist'])) {
            if ($this->isNew()) {
                $this->data['fields']['artist'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('artist', $this->data['fields'])) {
                $this->addFieldCache('artist');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('artist' => 1));
                if (isset($data['artist'])) {
                    $this->data['fields']['artist'] = (string) $data['artist'];
                } else {
                    $this->data['fields']['artist'] = null;
                }
            }
        }

        return $this->data['fields']['artist'];
    }

    /**
     * Set the "title" field.
     *
     * @param mixed $value The value.
     *
     * @return \Album\Resource\Mandango\Album The document (fluent interface).
     */
    public function setTitle($value)
    {
        if (!isset($this->data['fields']['title'])) {
            if (!$this->isNew()) {
                $this->getTitle();
                if ($value === $this->data['fields']['title']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['title'] = null;
                $this->data['fields']['title'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['title']) {
            return $this;
        }

        if (!isset($this->fieldsModified['title']) && !array_key_exists('title', $this->fieldsModified)) {
            $this->fieldsModified['title'] = $this->data['fields']['title'];
        } elseif ($value === $this->fieldsModified['title']) {
            unset($this->fieldsModified['title']);
        }

        $this->data['fields']['title'] = $value;

        return $this;
    }

    /**
     * Returns the "title" field.
     *
     * @return mixed The $name field.
     */
    public function getTitle()
    {
        if (!isset($this->data['fields']['title'])) {
            if ($this->isNew()) {
                $this->data['fields']['title'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('title', $this->data['fields'])) {
                $this->addFieldCache('title');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('title' => 1));
                if (isset($data['title'])) {
                    $this->data['fields']['title'] = (string) $data['title'];
                } else {
                    $this->data['fields']['title'] = null;
                }
            }
        }

        return $this->data['fields']['title'];
    }

    /**
     * Process onDelete.
     */
    public function processOnDelete()
    {
    }

    private function processOnDeleteCascade($class, array $criteria)
    {
        $repository = $this->getMandango()->getRepository($class);
        $documents = $repository->createQuery($criteria)->all();
        if (count($documents)) {
            $repository->delete($documents);
        }
    }

    private function processOnDeleteUnset($class, array $criteria, array $update)
    {
        $this->getMandango()->getRepository($class)->update($criteria, $update, array('multiple' => true));
    }

    /**
     * Set a document data value by data name as string.
     *
     * @param string $name  The data name.
     * @param mixed  $value The value.
     *
     * @return mixed the data name setter return value.
     *
     * @throws \InvalidArgumentException If the data name is not valid.
     */
    public function set($name, $value)
    {
        if ('artist' == $name) {
            return $this->setArtist($value);
        }
        if ('title' == $name) {
            return $this->setTitle($value);
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Returns a document data by data name as string.
     *
     * @param string $name The data name.
     *
     * @return mixed The data name getter return value.
     *
     * @throws \InvalidArgumentException If the data name is not valid.
     */
    public function get($name)
    {
        if ('artist' == $name) {
            return $this->getArtist();
        }
        if ('title' == $name) {
            return $this->getTitle();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Album\Resource\Mandango\Album The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['artist'])) {
            $this->setArtist($array['artist']);
        }
        if (isset($array['title'])) {
            $this->setTitle($array['title']);
        }

        return $this;
    }

    /**
     * Export the document data to an array.
     *
     * @param Boolean $withReferenceFields Whether include the fields of references or not (false by default).
     *
     * @return array An array with the document data.
     */
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => $this->getId());

        $array['artist'] = $this->getArtist();
        $array['title'] = $this->getTitle();

        return $array;
    }

    /**
     * Query for save.
     */
    public function queryForSave()
    {
        $isNew = $this->isNew();
        $query = array();
        $reset = false;

        if (isset($this->data['fields'])) {
            if ($isNew || $reset) {
                if (isset($this->data['fields']['artist'])) {
                    $query['artist'] = (string) $this->data['fields']['artist'];
                }
                if (isset($this->data['fields']['title'])) {
                    $query['title'] = (string) $this->data['fields']['title'];
                }
            } else {
                if (isset($this->data['fields']['artist']) || array_key_exists('artist', $this->data['fields'])) {
                    $value = $this->data['fields']['artist'];
                    $originalValue = $this->getOriginalFieldValue('artist');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['artist'] = (string) $this->data['fields']['artist'];
                        } else {
                            $query['$unset']['artist'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['title']) || array_key_exists('title', $this->data['fields'])) {
                    $value = $this->data['fields']['title'];
                    $originalValue = $this->getOriginalFieldValue('title');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['title'] = (string) $this->data['fields']['title'];
                        } else {
                            $query['$unset']['title'] = 1;
                        }
                    }
                }
            }
        }
        if (true === $reset) {
            $reset = 'deep';
        }

        return $query;
    }

    /**
     * Return an array representation of the object
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return $this->toArray();
    }

    /**
     * Exchange internal values from provided array
     *
     * @param array $array
     *
     * @return \Album\Resource\Mandango\Album The document (fluent interface).
     */
    public function exchangeArray(array $array)
    {
        return $this->fromArray($array);
    }
}