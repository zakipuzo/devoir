<?php

class Tree
{
    public $id;
    public $name;
    public $parent;
    public $node; 
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
    
}
