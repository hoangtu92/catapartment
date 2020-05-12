<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * The settings to add
     */
    protected $settings = [
        ['key' => 'site_logo', 'name' => 'Logo', 'description' => 'Site Logo', 'value' => '/images/logo.jpg', 'field' => '{"name":"value","label":"Image","type":"browse"}'],
        ['key' => 'contact_email', 'name' => 'Email', 'description' => '店家聯絡Email', 'value' => 'admin@updivision.com', 'field' => '{"name":"value","label":"聯絡信箱","type":"email"}'],
        ['key' => 'banner_single_news', 'name' => '首圖-最新情報內容頁', 'description' => '首圖-最新情報內容頁', 'value' => 'uploads/banner/catshop-banner15.jpg', 'field' => '{"name":"value","label":"Image <span>(1920x440)</span>","type":"browse"}'],
        ['key' => 'banner_page', 'name' => '內頁首圖', 'description' => '所有其他內頁的輪播圖', 'value' => 'uploads/banner/catshop-banner15.jpg', 'field' => '{"name":"value","label":"Image <span>(1920x440)</span>","type":"browse"}'],
        ['key' => 'banner_faq', 'name' => '首圖-問與答', 'description' => '首圖-問與答', 'value' => 'uploads/banner/catshop-banner07.jpg', 'field' => '{"name":"value","label":"Image <span>(1920x440)</span>","type":"browse"}'],
        ['key' => 'banner_wishlist', 'name' => '首圖-願望清單', 'description' => '首圖-願望清單', 'value' => 'uploads/banner/catshop-banner11.jpg', 'field' => '{"name":"value","label":"Image <span>(1920x440)</span>","type":"browse"}'],
        ['key' => 'banner_news', 'name' => '首圖-最新情報列表頁', 'description' => '首圖-最新情報列表頁', 'value' => 'uploads/banner/catshop-banner04.jpg', 'field' => '{"name":"value","label":"Image <span>(1920x440)</span>","type":"browse"}'],
        ['key' => 'banner_search', 'name' => '首圖-搜尋列表頁', 'description' => '首圖-搜尋列表頁', 'value' => 'uploads/banner/catshop-banner05.jpg', 'field' => '{"name":"value","label":"Image <span>(1920x440)</span>","type":"browse"}'],
        ['key' => 'banner_customized_product', 'name' => '首圖-裱框服務', 'description' => '首圖-裱框服務', 'value' => 'uploads/banner/catshop-banner05.jpg', 'field' => '{"name":"value","label":"Image <span>(1920x440)</span>","type":"browse"}'],
        ['key' => 'banner_product_list', 'name' => '首圖-商品列表', 'description' => '首圖-商品列表', 'value' => 'uploads/banner/catshop-banner05.jpg', 'field' => '{"name":"value","label":"Image <span>(1920x440)</span>","type":"browse"}'],
        ['key' => 'banner_account', 'name' => '首圖-我的帳戶', 'description' => '首圖-我的帳戶', 'value' => 'uploads/banner/catshop-banner08.jpg', 'field' => '{"name":"value","label":"Image <span>(1920x440)</span>","type":"browse"}'],
        ['key' => 'banner_pre_order_product', 'name' => '首圖-預購頁面', 'description' => '首圖-預購頁面', 'value' => 'uploads/banner/catshop-banner08.jpg', 'field' => '{"name":"value","label":"Image <span>(1920x440)</span>","type":"browse"}'],
        ['key' => 'banner_checkout', 'name' => '首圖-結帳頁面', 'description' => '首圖-結帳頁面', 'value' => 'uploads/banner/catshop-banner13.jpg', 'field' => '{"name":"value","label":"Image <span>(1920x440)</span>","type":"browse"}'],
        ['key' => 'footer_about', 'name' => '簡介', 'description' => '頁尾店家簡介敘述', 'value' => '貓公寓是一家位於高雄的拼圖狂熱份子所經營的專業拼圖館。專賣日本、歐美進口拼圖、以及限量收藏拼圖，我們都有。同時貓公寓也服務拼圖迷藝術裱框，歡迎逛逛。', 'field' => '{"name":"value","label":"店家簡介","type":"textarea"}'],
        ['key' => 'footer_working_hour', 'name' => '營業時間', 'description' => '頁尾營業時間', 'value' => '星期一到日，12:00~21:00', 'field' => '{"name":"value","label":"營業時間","type":"text"}'],
        ['key' => 'footer_address', 'name' => '地址', 'description' => '頁尾地址', 'value' => '高雄市三⺠區平等路41號1F', 'field' => '{"name":"value","label":"地址","type":"address_google"}'],
        ['key' => 'footer_phone', 'name' => '電話', 'description' => '頁尾電話', 'value' => '0908-913-019', 'field' => '{"name":"value","label":"電話","type":"text"}'],
        ['key' => 'shipping_fee', 'name' => '運費', 'description' => '', 'value' => 80, 'field' => '{"name":"value","label":"運費","type":"number"}'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $result = DB::table('settings')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }

        $this->command->info('Inserted ' . count($this->settings) . ' records.');
    }
}
