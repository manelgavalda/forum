<?php

namespace App;

use Redis;

class Visits
{
    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }

    public function record()
    {
        Redis::incr($this->cacheKey());

        return $this;
    }

    public function reset()
    {
        Redis::del($this->cacheKey());

        return $this;
    }

    public function count()
    {
        return (int) Redis::get($this->cacheKey());
    }

    protected function cacheKey()
    {
        return "threads.{$this->thread->id}.visits";
    }

    public function __toString()
    {
        return (string) $this->count();
    }
}
