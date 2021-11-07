@component('mail::message')
# Introduction

{{ $new_event->eventName }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
