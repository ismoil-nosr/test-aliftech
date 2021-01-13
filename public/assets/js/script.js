function addPhoneInput() {
    let x = document.createElement('input');
    let phoneDiv = document.getElementsByClassName('phone-inputs');

    x.setAttribute('type', 'text');
    x.setAttribute('name', 'phones[]');
    x.setAttribute('class', 'new-input');
    x.setAttribute('placeholder', '+8 (800) 555-35-35');

    phoneDiv[0].appendChild(x);
}

function addEmailInput() {
    let x = document.createElement('input');
    let phoneDiv = document.getElementsByClassName('email-inputs');

    x.setAttribute('type', 'email');
    x.setAttribute('name', 'emails[]');
    x.setAttribute('class', 'new-input');
    x.setAttribute('placeholder', 'vasya@mail.ru');

    phoneDiv[0].appendChild(x);
}

(function () {
    let alert_block = document.body.getElementsByClassName('alert');

    if (alert_block.length != 0) {
        Alert7.alert("Ошибка!", "Исправьте выделенные поля", "Понял", function () {});
    }
})();