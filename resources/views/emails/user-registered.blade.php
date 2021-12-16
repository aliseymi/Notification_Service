@component('mail::message')
# Introduction

- list1
- list2

The body of your message.

@component('mail::button', ['url' => url('/'), 'color' => 'success'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
