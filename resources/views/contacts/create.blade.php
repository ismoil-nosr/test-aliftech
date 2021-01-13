@extends('layout.app')

@section('content')
    @if ($errors->any())
        <div class="alert hide">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contacts.store') }}" method="post">
        @csrf
        <div class="row top">
            <div class="menu-back">
                <i class="fa fa-angle-left fa-2x" id="angle-left"></i>
                <a href="{{ route('contacts.index') }}">
                    <p>Назад</p>
                </a>
            </div>
            <div class="menu-back">
                <span>Новый контакт</span>
            </div>
            <div class="menu-edit">
                <button type="submit" class="btn save-btn">
                    Сохранить
                </button>
            </div>
        </div>
        <div class="new-contact-form">
            <div>
                Имя:
                <br>

                <input type="text" name="name" class="new-input {{ $errors->has('name') ? 'error' : '' }}"
                    value="{{ old('name') }}">
                @error('name')
                    <span class="error-message">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="phone-inputs">
                Номера для связи:

                <i class="fa fa-plus add-button" onclick="addPhoneInput()"></i>

                <br>

                @if ($phones = old('phones'))
                    @foreach ($phones as $k => $phone)
                        <input type="text" name="phones[]"
                            class="new-input {{ $errors->has('phones.' . $k) ? 'error' : '' }}"
                            placeholder="+8 (800) 555-35-35" value="{{ $phone }}">

                        @error('phones.' . $k)
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror
                    @endforeach

                @else
                    <input type="text" name="phones[]" class="new-input" placeholder="+8 (800) 555-35-35">
                @endif
            </div>
            <div class="email-inputs">
                Email-адреса:
                <i class="fa fa-plus add-button" onclick="addEmailInput()"></i>

                <br>
                @if ($emails = old('emails'))
                    @foreach ($emails as $k => $email)
                        <input type="text" name="emails[]"
                            class="new-input {{ $errors->has('emails.' . $k) ? 'error' : '' }}" placeholder="vasya@mail.ru"
                            value="{{ $email }}">
                        @error('emails.' . $k)
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror
                    @endforeach

                @else
                    <input type="text" name="emails[]" class="new-input" placeholder="vasya@mail.ru">
                @endif
            </div>
        </div>
    </form>
@endsection
