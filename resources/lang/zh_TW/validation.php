<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    |  following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ' :attribute 必須接受。',
    'active_url'           => ' :attribute 不是有效的網址。',
    'after'                => ' :attribute 必須是一個約會 :date.',
    'after_or_equal'       => ' :attribute 必須是以後或等於的日期 :date.',
    'alpha'                => ' :attribute 可能只包含字母。',
    'alpha_dash'           => ' :attribute 可能只包含字母，數字和破折號。',
    'alpha_num'            => ' :attribute 可能只包含字母和數字。',
    'array'                => ' :attribute 必須是一個數組。',
    'before'               => ' :attribute 必須是以前的日期 :date.',
    'before_or_equal'      => ' :attribute 必須是之前或之前的日期 :date.',
    'between'              => [
        'numeric' => ' :attribute 必須在之間 :min 和 :max.',
        'file'    => ' :attribute 必須在之間 :min 和 :max kilobytes.',
        'string'  => ' :attribute 必須在之間 :min 和 :max characters.',
        'array'   => ' :attribute 必須在之間 :min 和 :max items.',
    ],
    'boolean'              => ' :attribute 字段必須為true或false。',
    'confirmed'            => ' :attribute 確認不符。',
    'date'                 => ' :attribute 不是有效的日期。',
    'date_format'          => ' :attribute 不符合格式 :format.',
    'different'            => ' :attribute 和 :other 一定是不同的',
    'digits'               => ' :attribute 必須 :digits digits.',
    'digits_between'       => ' :attribute 必須 between :min and :max digits.',
    'dimensions'           => ' :attribute has invalid image dimensions.',
    'distinct'             => ' :attribute field has a duplicate value.',
    'email'                => ' :attribute 必須 a valid email address.',
    'exists'               => ' selected :attribute is invalid.',
    'file'                 => ' :attribute 必須 a file.',
    'filled'               => ' :attribute field must have a value.',
    'image'                => ' :attribute 必須 an image.',
    'in'                   => ' selected :attribute is invalid.',
    'in_array'             => ' :attribute field does not exist in :other.',
    'integer'              => ' :attribute 必須 an integer.',
    'ip'                   => ' :attribute 必須 a valid IP address.',
    'ipv4'                 => ' :attribute 必須 a valid IPv4 address.',
    'ipv6'                 => ' :attribute 必須 a valid IPv6 address.',
    'json'                 => ' :attribute 必須 a valid JSON string.',
    'max'                  => [
        'numeric' => ' :attribute may not be greater than :max.',
        'file'    => ' :attribute may not be greater than :max kilobytes.',
        'string'  => ' :attribute may not be greater than :max characters.',
        'array'   => ' :attribute may not have more than :max items.',
    ],
    'mimes'                => ' :attribute 必須 a file of type: :values.',
    'mimetypes'            => ' :attribute 必須 a file of type: :values.',
    'min'                  => [
        'numeric' => ' :attribute 必須 at least :min.',
        'file'    => ' :attribute 必須 at least :min kilobytes.',
        'string'  => '密碼請至少輸入:min位字元',
        'array'   => ' :attribute must have at least :min items.',
    ],
    'not_in'               => ' selected :attribute is invalid.',
    'numeric'              => ' :attribute 必須 a number.',
    'present'              => ' :attribute field 必須 present.',
    'regex'                => ' :attribute format is invalid.',
    'required'             => ' :attribute 字段是必需的。',
    'required_if'          => ' :attribute 欄位為必填 when :other is :value.',
    'required_unless'      => ' :attribute 欄位為必填 unless :other is in :values.',
    'required_with'        => ' :attribute 欄位為必填 when :values is present.',
    'required_with_all'    => ' :attribute 欄位為必填 when :values is present.',
    'required_without'     => ' :attribute 欄位為必填 when :values is not present.',
    'required_without_all' => ' :attribute 欄位為必填 when none of :values are present.',
    'same'                 => ' :attribute and :other must match.',
    'size'                 => [
        'numeric' => ' :attribute 必須 :size.',
        'file'    => ' :attribute 必須 :size kilobytes.',
        'string'  => ' :attribute 必須 :size 字元.',
        'array'   => ' :attribute must contain :size items.',
    ],
    'string'               => ' :attribute 格式應為文字',
    'timezone'             => ' :attribute 應為正確時區',
    'unique'               => ' :attribute 已經存在。',
    'uploaded'             => ' :attribute 上傳失敗',
    'url'                  => ' :attribute 格式錯誤',

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

        'product_id' => [
            "unique" => "已超過版面限制數量"
        ],

        'email'   =>    [
            'required' => '電子郵件字段是必需的。'
        ],
        'password'   =>    [
            'required' => '密碼字段是必需的。',
            'confirmed' => '密碼輸入不一致，請重新輸入'
        ],
        'password_confirm' => [
            'required' => '密碼字段是必需的。',
            'confirmed' => '密碼輸入不一致，請重新輸入'
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
