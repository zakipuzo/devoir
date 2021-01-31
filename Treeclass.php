<?php

class Tree
{
    public $id;
    public $name;
    public $parent;
    public $node;
    public $isquestion;
    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
    
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
    public function setNode($node)
    {
        $this->node = $node;
    }
    public function setIsQuestion($isquestion)
    {
        $this->isquestion = $isquestion;
    }
}
