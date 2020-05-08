<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Backpack Crud Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the CRUD interface.
    | You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    // Forms
    'save_action_save_and_new' => '儲存並新增',
    'save_action_save_and_edit' => '儲存並繼續編輯',
    'save_action_save_and_back' => '儲存並返回',
    'save_action_changed_notification' => '若儲存後有更動的預設動作',

    // Create form
    'add'                 => '新增',
    'back_to_all'         => '回到所有清單 ',
    'cancel'              => '取消',
    'add_a_new'           => '新增一項 ',

    // Edit form
    'edit'                 => '編輯',
    'save'                 => '儲存',

    // Revisions
    'revisions'            => '修改',
    'no_revisions'         => '查無任何修改',
    'created_this'         => '新增此',
    'changed_the'          => '更換',
    'restore_this_value'   => '保存此輸入值',
    'from'                 => '由',
    'to'                   => '至',
    'undo'                 => '重做',
    'revision_restored'    => '已儲存修改',
    'guest_user'           => 'Guest User',

    // Translatable models
    'edit_translations' => 'EDIT TRANSLATIONS',
    'language'          => 'Language',

    // CRUD table view
    'all'                       => '全部 ',
    'in_the_database'           => '',
    'list'                      => '清單',
    'actions'                   => '操作',
    'preview'                   => '預覽',
    'delete'                    => '刪除',
    'admin'                     => '管理員',
    'details_row'               => '這是細節欄，請輸入',
    'details_row_loading_error' => '載入出現問題，請再試一次',

        // Confirmation messages and bubbles
        'delete_confirm'                              => '確定要移除此項目嗎？?',
        'delete_confirmation_title'                   => '項目刪除',
        'delete_confirmation_message'                 => '此項目已被成功刪除',
        'delete_confirmation_not_title'               => '未刪除',
        'delete_confirmation_not_message'             => "噢哦！發生了一些問題，項目可能沒有被刪除",
        'delete_confirmation_not_deleted_title'       => '未刪除',
        'delete_confirmation_not_deleted_message'     => '沒有任何事發生，此項目仍然存在',

        // DataTables translation
        'emptyTable'     => '表單中沒有任何資料',
        'info'           => '列出由 _START_ 至 _END_ 的所有 _TOTAL_ 項目',
        'infoEmpty'      => '列出由 0 至 0 of 0 項目',
        'infoFiltered'   => '(從所有項目 _MAX_ 過濾)',
        'infoPostFix'    => '',
        'thousands'      => ',',
        'lengthMenu'     => '_MENU_ 個項目',
        'loadingRecords' => '載入中...',
        'processing'     => '處理中...',
        'search'         => '搜尋: ',
        'zeroRecords'    => '沒有符合的相關項目',
        'paginate'       => [
            'first'    => '第一',
            'last'     => '最後',
            'next'     => '下一',
            'previous' => '前一',
        ],
        'aria' => [
            'sortAscending'  => ': activate to sort column ascending',
            'sortDescending' => ': activate to sort column descending',
        ],

    // global crud - errors
        'unauthorized_access' => 'Unauthorized access - you do not have the necessary permissions to see this page.',
        'please_fix' => 'Please fix the following errors:',

    // global crud - success / error notification bubbles
        'insert_success' => '上傳成功！',
        'update_success' => 'The item has been modified successfully.',

    // CRUD reorder view
        'reorder'                      => '排序',
        'reorder_text'                 => '請使用拖曳來排序',
        'reorder_success_title'        => '完成',
        'reorder_success_message'      => '排序已成功更新',
        'reorder_error_title'          => '錯誤',
        'reorder_error_message'        => '排序未被保存',

    // CRUD yes/no
        'yes' => 'Yes',
        'no' => 'No',

    // CRUD filters navbar view
        'filters' => '過濾條件',
        'toggle_filters' => '過濾條件開/關',
        'remove_filters' => '刪除過濾條件',

    // Fields
        'browse_uploads' => '瀏覽上傳',
        'clear' => '清除',
        'page_link' => '頁面連結',
        'page_link_placeholder' => 'http://example.com/your-desired-page',
        'internal_link' => '內部連結',
        'internal_link_placeholder' => 'Internal slug. Ex: \'admin/page\' (no quotes) for \':url\'',
        'external_link' => '外部連結',
        'choose_file' => '選擇檔案',

    //Table field
        'table_cant_add' => '無法新增 :entity',
        'table_max_reached' => '已達到最大上限數量 :max ',

    // File manager
    'file_manager' => '檔案總管',
    'settings'     => '設定',
    'manage_sources' => '影片來源管理',
    'source' => '來源',
    'sources' => '來源',
    'name' => '名稱',
    'slug'  => '短網址Slug',
    'base_url' => '原始網址',
    'embed_url' => '嵌入網址',
    'embed_type' => '嵌入式',

    'video' => '影片',
    'videos' => '影片',
    'video_id' => '影片ID',
    'alternate_vid' => '站外影片ID',

	'old_video' => '舊影片',
    'old_videos' => '舊影片',
    'old_video_id' => '舊影片ID',
    'old_alternate_vid' => '站外舊影片ID',

	'type' => '',

    'new_video' => '新影片',
    'new_videos' => '新影片',
    'new_video_id' => '新影片ID',
    'new_alternate_vid' => '站外新影片ID',

    'part_name' => 'Part名稱',
    'title' => '標題',
    'title_cn' => '簡中標題',
    'video_source' => '影片來源',
    'episode' => '集數Ep No.',
    'thumbnail' => '縮圖',
    'thumbnail_url' => '縮圖網址',
    'image' => '圖片',
    'image_slide' => '圖片 (最小尺寸: 750x500)',
    'series_link' => '影集連結',
    'home_slider' => '首頁輪播',
    'slide' => '輪播圖',
    'slides' => '輪播圖',
    'section' => '首頁熱門',
    'sections' => '首頁熱門',
    'home_section' => '首頁熱門',

    'select_a_country' => '選擇國家',
    'select_a_category' => '選擇分類',
    'select_a_series' => '選擇影集系列',
    'select_tags' => '最近更新分類（非必填）',
    'select_series' => '選擇系列',
    'series' => '影集系列',
    'poster' => '海報',
    'poster_field' => '海報 (請上傳2:3的圖片大小（例：400x600)',
    'writer' => '編劇',
    'director' => '導演',
    'casts' => '卡司',
    'host' => '主持',
    'priority' => '優先',
    'priority_field' => '優先 (熱門)',

    'country' => '國家',
    'countries' => '國家',
    'categories' => '類型',
    'category' => '類型',
    'tag' => '最近更新分類',
    'year' => '年',
    'intro' => '介紹',
    'color' => '顏色',
	'ads'  => 'Advertisement',
	'position' => 'Position',
    "export" => [
        "export" => "匯出"
    ]

];
