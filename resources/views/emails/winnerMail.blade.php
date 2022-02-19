@component('mail::message')
# Introduction

<p>Congratulations. Hurrah! You are the Winner.</p>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
