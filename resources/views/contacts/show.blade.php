@extends('layout.app')

@section('content')
    <div class="row top">
        <div class="menu-back">
            <i class="fa fa-angle-left fa-2x" id="angle-left"></i>
            <a href="{{ route('contacts.index') }}">
                <p>Назад</p>
            </a>
        </div>
        <div class="menu-edit">
            <a href="{{ route('contacts.edit', $contact->name) }}">
                Редактировать
            </a>
        </div>
    </div>
    <div class="row contacts-info">
        <h3>
            {{ $contact->name }}
        </h3>
        <a id="phone-wrap" href="tel: {{ $contact->phones->first()->value ?? '' }}"><i class="fa fa-phone"></i></a>
    </div>

    <div class="contacts-list-show">
        <div>
            <p>Номера: </p>
            <ul>
                @foreach ($contact->phones as $phone)
                    <a href="tel:{{ $phone->value }}">
                        <li>
                            {{ $phone->value }}
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
        <div>
            <p>Email-адреса: </p>
            <ul>
                @foreach ($contact->emails as $email)
                    <a href="mailto:{{ $email->value }}">
                        <li>
                            {{ $email->value }}
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>
    <form action="{{ route('contacts.destroy', $contact->name) }}" method="post">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn del-btn">
            Удалить контакт
        </button>
    </form>
@endsection
