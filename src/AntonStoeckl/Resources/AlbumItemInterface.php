<?php

namespace AntonStoeckl\Resources;

use Zend\InputFilter\InputFilterInterface;

interface AlbumItemInterface
{
    public function getInputFilter();
    public function setInputFilter(InputFilterInterface $inputFilter);
}
