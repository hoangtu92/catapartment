<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | 該 following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => '該 :attribute 必須接受。',
    'active_url'           => '該 :attribute 不是有效的網址。',
    'after'                => '該 :attribute 必須是一個約會 :date.',
    'after_or_equal'       => '該 :attribute 必須是以後或等於的日期 :date.',
    'alpha'                => '該 :attribute 可能只包含字母。',
    'alpha_dash'           => '該 :attribute 可能只包含字母，數字和破折號。',
    'alpha_num'            => '該 :attribute 可能只包含字母和數字。',
    'array'                => '該 :attribute 必須是一個數組。',
    'before'               => '該 :attribute 必須是以前的日期 :date.',
    'before_or_equal'      => '該 :attribute 必須是之前或之前的日期 :date.',
    'between'              => [
        'numeric' => '該 :attribute 必須在之間 :min 和 :max.',
        'file'    => '該 :attribute 必須在之間 :min 和 :max kilobytes.',
        'string'  => '該 :attribute 必須在之間 :min 和 :max characters.',
        'array'   => '該 :attribute 必須在之間 :min 和 :max items.',
    ],
    'boolean'              => '該 :attribute 字段必須為true或false。',
    'confirmed'            => '該 :attribute 確認不符。',
    'date'                 => '該 :attribute 不是有效的日期。',
    'date_format'          => '該 :attribute 不符合格式 :format.',
    'different'            => '該 :attribute 和 :other 一定是不同的',
    'digits'               => '該 :attribute must be :digits digits.',
    'digits_between'       => '該 :attribute must be between :min and :max digits.',
    'dimensions'           => '該 :attribute has invalid image dimensions.',
    'distinct'             => '該 :attribute field has a duplicate value.',
    'email'                => '該 :attribute must be a valid email address.',
    'exists'               => '該 selected :attribute is invalid.',
    'file'                 => '該 :attribute must be a file.',
    'filled'               => '該 :attribute field must have a value.',
    'image'                => '該 :attribute must be an image.',
    'in'                   => '該 selected :attribute is invalid.',
    'in_array'             => '該 :attribute field does not exist in :other.',
    'integer'              => '該 :attribute must be an integer.',
    'ip'                   => '該 :attribute must be a valid IP address.',
    'ipv4'                 => '該 :attribute must be a valid IPv4 address.',
    'ipv6'                 => '該 :attribute must be a valid IPv6 address.',
    'json'                 => '該 :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => '該 :attribute may not be greater than :max.',
        'file'    => '該 :attribute may not be greater than :max kilobytes.',
        'string'  => '該 :attribute may not be greater than :max characters.',
        'array'   => '該 :attribute may not have more than :max items.',
    ],
    'mimes'                => '該 :attribute must be a file of type: :values.',
    'mimetypes'            => '該 :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => '該 :attribute must be at least :min.',
        'file'    => '該 :attribute must be at least :min kilobytes.',
        'string'  => '該 :attribute must be at least :min characters.',
        'array'   => '該 :attribute must have at least :min items.',
    ],
    'not_in'               => '該 selected :attribute is invalid.',
    'numeric'              => '該 :attribute must be a number.',
    'present'              => '該 :attribute field must be present.',
    'regex'                => '該 :attribute format is invalid.',
    'required'             => '該 :attribute 字段是必需的。',
    'required_if'          => '該 :attribute field is required when :other is :value.',
    'required_unless'      => '該 :attribute field is required unless :other is in :values.',
    'required_with'        => '該 :attribute field is required when :values is present.',
    'required_with_all'    => '該 :attribute field is required when :values is present.',
    'required_without'     => '該 :attribute field is required when :values is not present.',
    'required_without_all' => '該 :attribute field is required when none of :values are present.',
    'same'                 => '該 :attribute and :other must match.',
    'size'                 => [
        'numeric' => '該 :attribute must be :size.',
        'file'    => '該 :attribute must be :size kilobytes.',
        'string'  => '該 :attribute must be :size characters.',
        'array'   => '該 :attribute must contain :size items.',
    ],
    'string'               => '該 :attribute must be a string.',
    'timezone'             => '該 :attribute must be a valid zone.',
    'unique'               => '該 :attribute 已經存在。',
    'uploaded'             => '該 :attribute failed to upload.',
    'url'                  => '該 :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',

        ],

        'email'   =>    [
            'required' => '電子郵件字段是必需的。'
        ],
        'password'   =>    [
            'required' => '該密碼字段是必需的。'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
