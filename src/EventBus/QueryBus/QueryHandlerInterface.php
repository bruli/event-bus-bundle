<?php

namespace EventBus\QueryBus;

interface QueryHandlerInterface
{
    /**
     * @param QueryInterface $query
     *
     * @return mixed
     */
    public function handle(QueryInterface $query);
}
