@component('mail::message')

感謝您註冊貓公寓會員！請點擊以下連結完成會員註冊

@component('mail::button', ['url' => $verifyUrl])
    驗證連結
@endcomponent
<br>
<p>若您的電腦無法點擊按鈕，請複製網址貼上瀏覽器
    <a href="{{ $verifyUrl }}">{{ $verifyUrl }}</a></p>

@endcomponent
