@component('mail::message')
    # Introduction

    Hola {{ $user->name }},

    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquid commodi dolore inventore laborum magni minima, modi molestiae, nulla pariatur placeat praesentium quae qui quo saepe suscipit vitae, voluptas voluptate.

    @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent

@component('mail::panel')
    This is the panel content.
@endcomponent

@component('mail::table')
    | Laravel       | Table         | Example  |
    | ------------- |:-------------:| --------:|
    | Col 2 is      | Centered      | $10      |
    | Col 3 is      | Right-Aligned | $20      |
@endcomponent