<div @if(isset($size))
         style="width:{{ ($size['width'] === 'auto' ? 'auto' : $size['width'] . 'px') }};
            height:{{ ($size['height'] === 'auto' ? 'auto' : $size['height'] . 'px') }}"
        @endif
>
    <img
            src="{{imageview.blade.phpconfig('services.cdnServer.url'). $value}}"
            title="userimage"
    />
</div>

