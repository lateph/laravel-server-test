<?php

namespace App\Http\Controllers;
use Optimus\Bruno\LaravelController;

abstract class ELaravelController extends LaravelController
{
    protected function parseResourceOptions($request = null)
    {
        if ($request === null) {
            $request = request();
        }

        $this->defaults = array_merge([
            'includes' => '',
            'sort' => [],
            'limit' => null,
            'page' => null,
            'mode' => 'embed',
            'filter_groups' => []
        ], $this->defaults);

        $_includes = $request->get('includes', $this->defaults['includes']);
        $_includes = explode(',',$_includes);
        $includes = $this->parseIncludes($_includes);
        $sort = $this->parseSort($request->get('sort', $this->defaults['sort']));
        $limit = $request->get('limit', $this->defaults['limit']);
        $page = $request->get('page', $this->defaults['page']);
        $filter_groups = $this->parseFilterGroups($request->get('filter_groups', $this->defaults['filter_groups']));

        if ($page !== null && $limit === null) {
            throw new InvalidArgumentException('Cannot use page option without limit option');
        }

        return [
            'includes' => $includes['includes'],
            'modes' => $includes['modes'],
            'sort' => $sort,
            'limit' => $limit,
            'page' => $page,
            'filter_groups' => $filter_groups
        ];
    }
}
