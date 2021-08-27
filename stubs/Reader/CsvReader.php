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
        $this->iterator->current();
    }

    public function next()
    {
        $this->iterator->next();
    }

    public function key()
    {
        $this->iterator->key();
    }

    public function valid()
    {
        $this->iterator->valid();
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
