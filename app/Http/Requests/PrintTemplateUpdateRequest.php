<?php

namespace App\Http\Requests;

use App\Models\PrintTemplate;
use App\Rules\FilenameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;

class PrintTemplateUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //dd($this->request);
        $id = $this->route()->parameters()['print_template']->id;

        return [
            // active: print_template.active || '',
            // name: print_template.name || '',
            // description: print_template.description || '',
            // template: print_template.template || '',
            // image: print_template.image || '',
            // show_in_ui: print_template.show_in_ui || '',
            // print_class: print_template.print_class || ''
            'active' => ['boolean'],
            'name' => [
                'required',
                Rule::unique('print_templates', 'name')->ignore($id)
            ],
            'description' => ['nullable'],
            'template' => [
                'nullable',
                new FilenameRule(['glabels', 'nlbl', 'cablbl', 'txt', 'csv']),
                // function ($attribute, $value, $fail) use ($id) {
                //     $file = $value->getClientOriginalName();
                //     $count = PrintTemplate::query()->where('template', 'LIKE', "%/{$file}")->where('id', '!=', $id)->count();

                //     if ($count > 0) {
                //         $fail("Name for {$attribute} already taken");
                //     }
                // }
            ],
            'imageUrl' => [
                'nullable',
                'image',
                // function ($attribute, $value, $fail) use ($id) {
                //     $file = $value->getClientOriginalName();
                //     $count = PrintTemplate::query()->where('image', 'LIKE', "%/{$file}")->where('id', '!=', $id)->count();

                //     if ($count > 0) {
                //         $fail("Name for {$attribute} already taken");
                //     }
                // }
            ],
            'show_in_ui' => ['boolean'],
            'print_class' => ['nullable']
        ];
    }
}
