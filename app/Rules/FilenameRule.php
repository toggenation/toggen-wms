<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

class FilenameRule implements Rule
{

    protected $regex;

    protected $extensions = ['glabels', 'nlbl'];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(?array $extensions = null)
    {
        $this->extensions = $extensions ?? $this->extensions;
        // $file = 'file-name_2020.png';
        // $extensions = array('png', 'jpg', 'jpeg', 'gif', 'svg');
        // $pattern = 
        // remove space between ? >

        // if(preg_match($pattern, $discount)) {
        //     // Returns true
        // }
        $this->regex = '/^[^`~!@#$%^&*()+=[\];\',.\/?><":}{]+\.(' . implode('|', $this->extensions) . ')$/u';
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // dd($value->isValid());
        if (!($value instanceof UploadedFile) || !$value->isValid()) {
            return false;
        }

        return preg_match($this->regex, $value->getClientOriginalName()) > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute file name is invalid';
    }
}
