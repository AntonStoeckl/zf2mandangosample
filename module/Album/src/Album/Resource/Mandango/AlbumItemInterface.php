<?php

namespace Album\Resource\Mandango;

use Zend\InputFilter\InputFilterInterface;

interface AlbumItemInterface
{
    public function getInputFilter();
    public function setInputFilter(InputFilterInterface $inputFilter);
}
