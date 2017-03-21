<?php

/**
 * Created by IntelliJ IDEA.
 * User: neo
 * Date: 2017/3/22
 * Time: 01:09
 */

class SqlList
{
    public $elem;

    public $length;

    public $size;
}
class linearTable
{
    const OK = 1;

    const ERROR = 0;

    const LIST_MAX_SIZE = 20;

    const LIST_INC = 5;

    /**
     * @var null|SqlList
     */
    private $list = null;

    /**
     * linearTable constructor.
     */
    public function initLinear ()
    {
        $this->list = new SqlList();

        $this->list->size = self::LIST_MAX_SIZE;

        $this->list->length = 0;

        $this->list->elem = [];
    }

    private function isVal($cursor)
    {
        if($cursor < 1 || $cursor > $this->list->length ){
            throw new Exception("$cursor is invalid!!!");
        }
    }

    public function desLinear()
    {
        if(is_object($this->list)){
            $this->list = null;
        }

        return self::OK;
    }

    public function getElem($cursor, &$res)
    {
        $this->isVal($cursor);

        $res = $this->list->elem[$cursor-1];

        return self::OK;
    }

    public function listIns($cursor, $value)
    {
        $this->isVal($cursor);

        if($this->list->length >= $this->list->size){
            return self::ERROR;
        }

        if($cursor <= $this->list->length){
            for($start = $this->list->length; $start > $cursor; $start--){
                $this->list->elem[$cursor] = $this->list->elem[$cursor-1];
            }
        }

        $this->list->elem[$cursor-1] = $value;

        $this->list->length++;

        return self::OK;
    }

    public function listDel($cursor, &$res)
    {
        $this->isVal($cursor);

        if($this->list->length <= 0){
            return self::ERROR;
        }

        $res = $this->list->elem[$cursor-1];

        for($start = $cursor-1; $start < $this->list->length; $start++){
            $this->list->elem[$cursor] = $this->list->elem[$cursor+1];
        }

        unset($this->list->elem[$this->list->length -1]);

        $this->list->length --;

        return self::OK;
    }
}