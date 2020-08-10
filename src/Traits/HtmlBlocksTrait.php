<?php

namespace ClaudiusNascimento\HtmlBlocks\Traits;

use ClaudiusNascimento\HtmlBlocks\Models\HtmlBlock as Block;

trait HtmlBlocksTrait
{

    public function getBlocksWhereKeyStartsWith($start_string)
    {
        return $this->htmlBlocks->filter(function($block) use ($start_string) {
            return starts_with($block->key, $start_string);
        });
    }

    public function getBlocksWhereKeyEndsWith($end_string)
    {
        return $this->htmlBlocks->filter(function($block) use ($end_string) {
            return ends_with($block->key, $end_string);
        });
    }

    public function getBlocksWhereKeyIsNotEqualTo($key)
    {
        return $this->htmlBlocks->reject(function($block) use ($key) {
            return $block->key == $key;
        });
    }

    /**
     * $fn = 'first' | 'last'
     */
    public function getBlockByAttr($attr, $value, $fn = 'first')
    {
        $_fn = $fn == 'first' ? 'first' : 'last';

        return $this->getBlocksByAttr($attr, $value)->{$_fn}();
    }

    public function getBlocksByAttr($attr, $value)
    {
        return $this->htmlBlocks->where($attr, $value);
    }

    public function getBlocksByKey($key)
    {
        return $this->htmlBlocks->where('key', $key);
    }

    public function getBlockByKey($key)
    {
        return $this->htmlBlocks->where('key', $key)->first();
    }

    public function generateHtmlBlocks()
    {

        $relationString = htmlblocksRelationString($this);

        if(empty($relationString))
            throw new Exception('The Obj ' . $this->__toString() . ' must have a property to relation', 1);

        $blocks = Block::where('rel', $relationString)
                    ->where('rel_id', $this->id)
                    ->orderBy('order', 'asc')
                    ->orderBy('key', 'asc')
                    ->get();

        $model_id = $this->id;

        return view('html-blocks::form', compact(['blocks', 'relationString', 'model_id']));

    }

    public function htmlBlocks()
    {

        $relationString = htmlblocksRelationString($this);

        if(empty($relationString))
            throw new Exception('The Obj ' . $this->__toString() . ' must have a property to relation', 1);

        return $this->hasMany('\ClaudiusNascimento\HtmlBlocks\Models\HtmlBlock', 'rel_id')
                    ->where('rel', $this->htmlblocksRelationString);
    }


}
