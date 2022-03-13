<?php
namespace App\Models\Modifiers;

use Illuminate\Http\Request;

abstract class AbstractBaseModifier implements ModifiersInterface
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
