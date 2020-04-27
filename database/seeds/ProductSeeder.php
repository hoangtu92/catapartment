<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("products")->insert([
            'category_id' => 1,
            'name' => 'Smart watches wood edition',
            'slug' => "smart-watches-wood-edition",
            'sku' => 'P001',
            'price' => 500,
            'sale_price' => 400,
            'image' => '/images/product01.jpg',
            'brand_id' => 1,
            'measures' => "M",
            'origin' => 'Taiwan',
            "short_description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text. ",
            "content" => "玩膩了一般的紙製拼圖了嗎？甫上線募資3天，就快速達標的「海裡魚HelloFish」木質拼圖，耗時兩年設計、研發，每幅圖中隱藏著特殊的「圖中圖」設計，每幅拼圖還可另外拼成臺灣形狀，別具巧思，已在臺申請專利，目前即將到國外申請專利，進軍國際。 此木質拼圖的幕後推手，是一位7年級生、年僅26歲的王詠心。看似順利的創業過程背後，隱含著她對各樣事物的關懷與想像，並希望藉此讓世界可以看見臺灣，「可以的話，我想用拼圖說出想說的故事！」王詠心如此說。 拼圖背後的小手 將整個臺灣串聯 「這個拼圖很酷喔！你看，有幾塊拼圖是臺灣縣市的模樣，拼起來就是一個臺灣的形狀。」王詠心與她的創業夥伴Stanley，一邊介紹一邊興奮地拼了起來，不到5分鐘，一個精緻的臺灣，就出現在我們眼前。 臺灣形狀的背面，是一隻隻小手，牽著臺灣的各個縣市，彼此串聯在一起。Stanley說，這就是整套木質拼圖產品最初的發想。"
        ]);

        DB::table("products")->insert([
            'category_id' => 1,
            'name' => 'Penatibus parturient',
            'slug' => "penatibus-parturient",
            'sku' => 'P002',
            'price' => 500,
            'sale_price' => 400,
            'image' => '/images/product02.jpg',
            'brand_id' => 1,
            'measures' => "M",
            'origin' => 'Taiwan',
            "short_description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text. ",
            "content" => "玩膩了一般的紙製拼圖了嗎？甫上線募資3天，就快速達標的「海裡魚HelloFish」木質拼圖，耗時兩年設計、研發，每幅圖中隱藏著特殊的「圖中圖」設計，每幅拼圖還可另外拼成臺灣形狀，別具巧思，已在臺申請專利，目前即將到國外申請專利，進軍國際。 此木質拼圖的幕後推手，是一位7年級生、年僅26歲的王詠心。看似順利的創業過程背後，隱含著她對各樣事物的關懷與想像，並希望藉此讓世界可以看見臺灣，「可以的話，我想用拼圖說出想說的故事！」王詠心如此說。 拼圖背後的小手 將整個臺灣串聯 「這個拼圖很酷喔！你看，有幾塊拼圖是臺灣縣市的模樣，拼起來就是一個臺灣的形狀。」王詠心與她的創業夥伴Stanley，一邊介紹一邊興奮地拼了起來，不到5分鐘，一個精緻的臺灣，就出現在我們眼前。 臺灣形狀的背面，是一隻隻小手，牽著臺灣的各個縣市，彼此串聯在一起。Stanley說，這就是整套木質拼圖產品最初的發想。"

        ]);

        DB::table("products")->insert([
            'category_id' => 2,
            'name' => 'Wooden bow tie man',
            'slug' => "wooden-bow-tie-man",
            'sku' => 'P003',
            'price' => 500,
            'sale_price' => 400,
            'image' => '/images/product03.jpg',
            'brand_id' => 2,
            'measures' => "M",
            'origin' => 'Taiwan',
            "short_description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text. ",
            "content" => "玩膩了一般的紙製拼圖了嗎？甫上線募資3天，就快速達標的「海裡魚HelloFish」木質拼圖，耗時兩年設計、研發，每幅圖中隱藏著特殊的「圖中圖」設計，每幅拼圖還可另外拼成臺灣形狀，別具巧思，已在臺申請專利，目前即將到國外申請專利，進軍國際。 此木質拼圖的幕後推手，是一位7年級生、年僅26歲的王詠心。看似順利的創業過程背後，隱含著她對各樣事物的關懷與想像，並希望藉此讓世界可以看見臺灣，「可以的話，我想用拼圖說出想說的故事！」王詠心如此說。 拼圖背後的小手 將整個臺灣串聯 「這個拼圖很酷喔！你看，有幾塊拼圖是臺灣縣市的模樣，拼起來就是一個臺灣的形狀。」王詠心與她的創業夥伴Stanley，一邊介紹一邊興奮地拼了起來，不到5分鐘，一個精緻的臺灣，就出現在我們眼前。 臺灣形狀的背面，是一隻隻小手，牽著臺灣的各個縣市，彼此串聯在一起。Stanley說，這就是整套木質拼圖產品最初的發想。"

        ]);

        DB::table("products")->insert([
            'category_id' => 1,
            'sku' => 'P004',
            'name' => 'Lorem ip sum',
            'slug' => "lorem-ip-sum",
            'price' => 500,
            'sale_price' => 400,
            'image' => '/images/product01.jpg',
            'brand_id' => 2,
            'measures' => "M",
            'origin' => 'Taiwan',
            "short_description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text. ",
            "content" => "玩膩了一般的紙製拼圖了嗎？甫上線募資3天，就快速達標的「海裡魚HelloFish」木質拼圖，耗時兩年設計、研發，每幅圖中隱藏著特殊的「圖中圖」設計，每幅拼圖還可另外拼成臺灣形狀，別具巧思，已在臺申請專利，目前即將到國外申請專利，進軍國際。 此木質拼圖的幕後推手，是一位7年級生、年僅26歲的王詠心。看似順利的創業過程背後，隱含著她對各樣事物的關懷與想像，並希望藉此讓世界可以看見臺灣，「可以的話，我想用拼圖說出想說的故事！」王詠心如此說。 拼圖背後的小手 將整個臺灣串聯 「這個拼圖很酷喔！你看，有幾塊拼圖是臺灣縣市的模樣，拼起來就是一個臺灣的形狀。」王詠心與她的創業夥伴Stanley，一邊介紹一邊興奮地拼了起來，不到5分鐘，一個精緻的臺灣，就出現在我們眼前。 臺灣形狀的背面，是一隻隻小手，牽著臺灣的各個縣市，彼此串聯在一起。Stanley說，這就是整套木質拼圖產品最初的發想。"

        ]);

        DB::table("products")->insert([
            'category_id' => 1,
            'name' => 'Product 1',
            'slug' => "product-1",
            'sku' => 'P005',
            'price' => 500,
            'sale_price' => 400,
            'image' => '/images/product02.jpg',
            'brand_id' => 1,
            'measures' => "M",
            'origin' => 'Taiwan',
            "short_description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text. ",
            "content" => "玩膩了一般的紙製拼圖了嗎？甫上線募資3天，就快速達標的「海裡魚HelloFish」木質拼圖，耗時兩年設計、研發，每幅圖中隱藏著特殊的「圖中圖」設計，每幅拼圖還可另外拼成臺灣形狀，別具巧思，已在臺申請專利，目前即將到國外申請專利，進軍國際。 此木質拼圖的幕後推手，是一位7年級生、年僅26歲的王詠心。看似順利的創業過程背後，隱含著她對各樣事物的關懷與想像，並希望藉此讓世界可以看見臺灣，「可以的話，我想用拼圖說出想說的故事！」王詠心如此說。 拼圖背後的小手 將整個臺灣串聯 「這個拼圖很酷喔！你看，有幾塊拼圖是臺灣縣市的模樣，拼起來就是一個臺灣的形狀。」王詠心與她的創業夥伴Stanley，一邊介紹一邊興奮地拼了起來，不到5分鐘，一個精緻的臺灣，就出現在我們眼前。 臺灣形狀的背面，是一隻隻小手，牽著臺灣的各個縣市，彼此串聯在一起。Stanley說，這就是整套木質拼圖產品最初的發想。"

        ]);

        DB::table("products")->insert([
            'category_id' => 2,
            'name' => 'Product 2',
            'slug' => "product-2",
            'sku' => 'P006',
            'price' => 500,
            'sale_price' => 400,
            'image' => '/images/product03.jpg',
            'brand_id' => 1,
            'measures' => "M",
            'origin' => 'Taiwan',
            "short_description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text. ",
            "content" => "玩膩了一般的紙製拼圖了嗎？甫上線募資3天，就快速達標的「海裡魚HelloFish」木質拼圖，耗時兩年設計、研發，每幅圖中隱藏著特殊的「圖中圖」設計，每幅拼圖還可另外拼成臺灣形狀，別具巧思，已在臺申請專利，目前即將到國外申請專利，進軍國際。 此木質拼圖的幕後推手，是一位7年級生、年僅26歲的王詠心。看似順利的創業過程背後，隱含著她對各樣事物的關懷與想像，並希望藉此讓世界可以看見臺灣，「可以的話，我想用拼圖說出想說的故事！」王詠心如此說。 拼圖背後的小手 將整個臺灣串聯 「這個拼圖很酷喔！你看，有幾塊拼圖是臺灣縣市的模樣，拼起來就是一個臺灣的形狀。」王詠心與她的創業夥伴Stanley，一邊介紹一邊興奮地拼了起來，不到5分鐘，一個精緻的臺灣，就出現在我們眼前。 臺灣形狀的背面，是一隻隻小手，牽著臺灣的各個縣市，彼此串聯在一起。Stanley說，這就是整套木質拼圖產品最初的發想。"

        ]);
    }
}
