const errorAlert = document.querySelector('#errorAlert');
const submitTopup = document.querySelector('#submitTopup');

const topup = async () => {
    const amount = document.querySelector('#amount').value;
    const receiverInput = document.querySelector('#receiver_id');
    const _token = document.getElementsByName('_token')[0].value;

    const receiver_id = receiverInput ? receiverInput.value : 0;

    await fetch('/topup', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({_token, amount, receiver_id}),
    })
    .then((res) => res.json())
    .then((resJson) => {
        if (resJson.code >= 300) {
            errorAlert.classList.remove('d-none');
            errorAlert.innerHTML= resJson.message;
            return;
        }

        alert('Top Up Success. Pay to mini bank clerk');
        document.location.href = document.location.href;
    })
    .catch((error) => console.log(error))
}

submitTopup.addEventListener('click', topup);
