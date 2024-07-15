document.addEventListener('DOMContentLoaded', function () {
    const products = document.querySelectorAll('.product');
    const cartList = document.querySelector('.cart-list');
    const totalElement = document.querySelector('.total span');
    const totalMultiplicadoElement = document.querySelector('.total-multiplicado span');
    const clearCartButton = document.querySelector('.clear-cart');
    const checkoutButton = document.querySelector('.checkout-btn');
    const transferButton = document.querySelector('.transfer-btn');
    const modal = document.getElementById('transfer-modal');
    const closeModal = document.querySelector('.close');

    let cart = [];

    products.forEach(product => {
        const addToCartButton = product.querySelector('.add-to-cart');
        addToCartButton.addEventListener('click', () => {
            console.log('Adding to cart:', product);
            addToCart(product);
        });
    });

    clearCartButton.addEventListener('click', () => {
        console.log('Clearing cart');
        clearCart();
    });

    checkoutButton.addEventListener('click', () => {
        console.log('Checkout button clicked');
        openCheckoutPage();
    });

    transferButton.addEventListener('click', () => {
        console.log('Transfer button clicked');
        modal.style.display = 'block';
    });

    closeModal.addEventListener('click', () => {
        console.log('Closing modal');
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    function addToCart(product) {
        const productId = product.dataset.id;
        const productName = product.dataset.name;
        const productPrice = parseFloat(product.querySelector('.price').textContent.replace('$', ''));

        const existingProduct = cart.find(item => item.id === productId);

        if (existingProduct) {
            existingProduct.quantity += 1;
        } else {
            cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 });
        }

        updateCartUI();
    }

    function updateCartUI() {
        cartList.innerHTML = '';
        let total = 0;
        cart.forEach(item => {
            const listItem = document.createElement('li');
            listItem.innerHTML = `${item.name} x${item.quantity} - $${(item.price * item.quantity).toFixed(2)}`;

            const removeButton = document.createElement('button');
            removeButton.textContent = 'Eliminar';
            removeButton.classList.add('remove-item');
            removeButton.setAttribute('data-id', item.id);

            const quantityInput = document.createElement('input');
            quantityInput.type = 'number';
            quantityInput.min = 1;
            quantityInput.value = 1;
            quantityInput.classList.add('remove-quantity');
            listItem.appendChild(quantityInput);

            removeButton.addEventListener('click', () => {
                console.log('Removing item:', item.id, 'Quantity:', quantityInput.value);
                removeItem(item.id, parseInt(quantityInput.value));
            });

            listItem.appendChild(removeButton);

            cartList.appendChild(listItem);
            total += item.price * item.quantity;
        });

        const totalSinMultiplicar = total.toFixed(2);
        const totalMultiplicado = Math.floor(total * 905.29).toLocaleString('es', { minimumFractionDigits: 0 });

        console.log('Total sin multiplicar:', totalSinMultiplicar);
        console.log('Total multiplicado:', totalMultiplicado);

        totalElement.textContent = totalSinMultiplicar;
        totalMultiplicadoElement.textContent = totalMultiplicado;
    }

    function removeItem(productId, quantity) {
        const index = cart.findIndex(item => item.id === productId);
        if (index !== -1) {
            if (cart[index].quantity > quantity) {
                cart[index].quantity -= quantity;
            } else {
                cart.splice(index, 1);
            }
            updateCartUI();
        }
    }

    function clearCart() {
        cart = [];
        updateCartUI();
    }

    updateCartUI();
});