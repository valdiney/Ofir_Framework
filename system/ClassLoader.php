<?php
class ClassLoader
{
    public $directory;
    public $dirName;
    public $className = array();

    public function setDirClass($dir)
    {
        $this->dirName = trim($dir);
        $this->directory = dir($dir);
    }

    public function readClassName()
    {
        while ($archives = $this->directory->read()) {
            if ($archives != '.' AND $archives != '..') {
                $archives = explode('.php', $archives);
                $this->className[] = trim($archives[0]);
            }
        }
    }

    public function loader()
    {
        foreach ($this->className as $class) {
            require_once("{$this->dirName}{$class}.php");
        }
    }

    public function prepareClassToInstantiate()
    {
        $this->readClassName();
        $this->loader();

        $objects = array();
        foreach ($this->className as $className) {
            $objects[$className] = new $className(Database::connect());
        }

        return $objects;
    }
}
