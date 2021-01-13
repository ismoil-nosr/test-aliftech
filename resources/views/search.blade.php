@extends('layout.app')

@section('content')
    <div class="row top">
        <h2>
            <a href="/">Контакты </a>
        </h2>
        <a href="{{ route('contacts.create') }}">
            <i class="fa fa-plus add-button"></i>
        </a>
    </div>
    <div class="row">
        <form class="search-form" action="/search" method="get">
            @csrf
            <i class="fa fa-search"></i>
            <input type="text" placeholder="Поиск" name="find" value="{{ old('find') ?? '' }}">
        </form>
    </div>
    <div class="row contacts-list">
        <ul>
            @foreach ($result as $contact)
                <a href="{{ route('contacts.show', $contact->name) }}">
                    <li>
                        {{ $contact->name }}
                    </li>
                </a>
            @endforeach
        </ul>
    </div>

    {{ $result->withQueryString()->links('layout.pagination.default') }}
@endsection
