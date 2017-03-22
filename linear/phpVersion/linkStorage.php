<?php

/**
 * Created by IntelliJ IDEA.
 * User: neo
 * Date: 2017/3/22
 * Time: 01:09
 */

class LinkList
{
    public $data;

    public $next;

    public function __construct ($data)
    {
        $this->data = $data;
        $this->next = NULL;
    }
}

class SingleLinkedList
{

}