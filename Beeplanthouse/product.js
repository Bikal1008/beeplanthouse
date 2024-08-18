document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        
        const productName = this.getAttribute('data-name');
        const productPrice = parseFloat(this.getAttribute('data-price'));
        
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        let existingProduct = cart.find(item => item.name === productName);
        if (existingProduct) {
            existingProduct.quantity += 1;
            existingProduct.totalPrice = existingProduct.quantity * productPrice;
        } else {
            cart.push({ name: productName, price: productPrice, quantity: 1, totalPrice: productPrice });
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        window.location.href = "checkout.html";
    });
});
