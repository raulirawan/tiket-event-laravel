@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
      <tr>
        <td align="center" style="font-size:0px;padding:0px 25px 0px 25px;word-break:break-word;">
          <div style="font-family:Helvetica, sans-serif;font-size:45px;font-weight:bold;line-height:1;text-align:center;color:#0c0435;">EVNT</div>
        </td>
      </tr>
    </table>
  </div>
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} Copyright Evnt.com
@endcomponent
@endslot
@endcomponent
