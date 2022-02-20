<?php
namespace App\Models\Filters;
;
use Illuminate\Http\Request;

abstract class AbstractBaseFilter implements FilterInterface
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
