<?php

namespace ReaderStub;

class XmlReader extends \SimpleXMLElement
{
    public function toArray(): array
    {
        return json_decode(json_encode($this), true);
    }
}
