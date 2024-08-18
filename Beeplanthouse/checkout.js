document.addEventListener('DOMContentLoaded', function() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const orderSummaryElement = document.querySelector('.order-summary');
    const totalAmountElement = document.getElementById('total-amount');

    let totalAmount = 0;
    orderSummaryElement.innerHTML = ''; // Clear existing content

    cart.forEach(item => {
        const productLine = document.createElement('p');
        productLine.textContent = `${item.name} (x${item.quantity}): Rs. ${item.totalPrice.toFixed(2)}`;
        orderSummaryElement.appendChild(productLine);
        totalAmount += item.totalPrice;
    });

    totalAmountElement.textContent = `Rs. ${totalAmount.toFixed(2)}`;

    // Add payment success message on form submission
    const form = document.querySelector('.checkout-form form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        alert('Payment Successful!');
        localStorage.removeItem('cart'); // Clear cart after successful payment
        form.submit();
    });
});
