<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset("images/eae_logo.png")}}" class="logo" alt="EaE Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
