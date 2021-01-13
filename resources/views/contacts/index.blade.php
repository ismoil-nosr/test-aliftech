@extends('layout.app')

@section('content')
    <div class="row top">
        <h2>Контакты</h2>
        <a href="{{ route('contacts.create') }}">
            <i class="fa fa-plus add-button"></i>
        </a>
    </div>
    <div class="row">
        <form class="search-form" action="/search" method="get">
            @csrf
            <i class="fa fa-search"></i>
            <input type="text" placeholder="Поиск по имени/номеру/почте" name="find">
        </form>
    </div>
    <div class="row contacts-list">
        <ul>
            @foreach ($contacts as $contact)
                <a href="{{ route('contacts.show', $contact->name) }}">
                    <li>
                        {{ $contact->name }}
                    </li>
                </a>
            @endforeach
        </ul>
    </div>

    {{ $contacts->links('layout.pagination.default') }}
@endsection
