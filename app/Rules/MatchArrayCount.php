<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MatchArrayCount implements ValidationRule
{
    protected $otherArray;
    public function __construct($otherArray)
    {
        $this->otherArray = $otherArray;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
            $value=array_filter($value);
        if (count($value) !== count($this->otherArray)) {
            $fail("لطفا برای تمام محصولات مقدار تعیین کنید");
        }
    }

}
