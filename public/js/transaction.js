const errorAlert = document.querySelector('#errorAlert');
const withdrawErrorAlert = document.querySelector('#withdrawErrorAlert');
const submitTopup = document.querySelector('#submitTopup');
const submitWithdraw = document.querySelector('#submitWithdraw');
const _token = document.getElementsByName('_token')[0].value;

const topup = async () => {
    const amount = document.querySelector('#amount').value;
    const receiverInput = document.querySelector('#receiver_id');

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
    .catch((error) => {
        console.log(error);
        errorAlert.classList.remove('d-none');
        errorAlert.innerHTML= 'Server Error. Please Try Again';
    });
}

const purchase = (product) => {
    document.querySelector('#productId').value = product.id;
    document.querySelector('#productImage').src = `${location.href}storage/${product.image}`;
    document.querySelector('#productDescription').innerHTML = `${product.description}`;
    document.querySelector('#productPrice').innerHTML = `Rp${product.price}`;
    document.querySelector('#productName').innerHTML = `${product.name}`;
}

const withdraw = async () => {
    const amount = document.querySelector('#amountWithdraw').value;

    await fetch('/withdraw', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({_token, amount}),
    })
    .then((res) => res.json())
    .then((resJson) => {
        if (resJson.code >= 300) {
            withdrawErrorAlert.classList.remove('d-none');
            withdrawErrorAlert.innerHTML= resJson.message;
            return;
        }

        alert('Widraw Success. Confirm to mini bank clerk');
        document.location.href = document.location.href;
    })
    .catch((error) => {
        console.log(error)
        withdrawErrorAlert.classList.remove('d-none');
        withdrawErrorAlert.innerHTML= 'Server Error. Please Try Again';
    });
}

submitTopup.addEventListener('click', topup);
submitWithdraw.addEventListener('click', withdraw);
