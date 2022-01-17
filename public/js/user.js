const loginSubmit = document.querySelector('#loginSubmit');
const errorAlert = document.querySelector('#errorAlert');
const errorMessage = document.querySelector('#errorMessage');

const login = async () => {
    const name = document.querySelector('#name').value;
    const email = document.querySelector('#email').value;
    const role = document.querySelector('#role').value;
    const password = document.querySelector('#password').value;
    const _token = document.getElementsByName('_token')[0].value;

    await fetch('/users', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ _token, name, email, password, role })
    })
    .then((res) => res.json())
    .then((resJson) => {
        if (resJson.code >= 300) {
            errorAlert.classList.remove('d-none');
            errorMessage.innerHTML = resJson.error;
            return
        }

        window.location.href = '/users';
    })
    .catch((error) => console.log(error));
}

loginSubmit.addEventListener('click', login);
