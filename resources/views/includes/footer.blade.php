<div class="footer-left">
    @php
        $footer = env('SETTING_CORE_APP') == 1 ? env('AYOCETING_APP_FOOTER') : env('GEMOI_APP_FOOTER'); 
    @endphp
    {!!$footer!!}
</div>
<div class="footer-right">
    Powered by <a href="#">DISKOMINFO KOTA PADANG</a>
</div>