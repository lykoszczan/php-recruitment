<?php

namespace ReaderStub;

class CsvReader implements \SeekableIterator
{
    private \SeekableIterator $iterator;

    public function __construct(\SplFileObject $csvFile)
    {
        $this->iterator = new \ArrayIterator(array_map(
            fn (string $line) => str_getcsv($line),
            array_slice(iterator_to_array($csvFile), 1)
        ));
    }

    public function current()
    {
        return $this->iterator->current();
    }

    public function next()
    {
        $this->iterator->next();
    }

    public function key()
    {
        return $this->iterator->key();
    }

    public function valid()
    {
        return $this->iterator->valid();
    }

    public function rewind()
    {
        $this->iterator->rewind();
    }

    public function seek($position)
    {
        $this->iterator->seek($position);
    }
}
