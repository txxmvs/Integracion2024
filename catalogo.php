<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FERREMAS</title>
    <link rel="stylesheet" href="css/catalogo.css"> 
</head>
<body>
    <header>
        <h1>Catálogo de Productos - FERREMAS</h1>
        <nav>
            <ul>
                <li><a href="php/datos.php">Datos de Envio</a></li>
                <li><a href="">contacto</a></li>
                <li><a href="index.php">Salir</a></li>
            </ul>
        </nav>
    </header>

    <section class="product-container">
        <h2>Herramientas Manuales</h2>
        <div class="product" data-id="1" data-name="Martillo" data-price="20.00">
            <img src="img/martillo.jpg" alt="Martillo">
            <h3>Martillo Stanley</h3>
            <p>Un martillo resistente y duradero, perfecto para trabajos de carpintería y construcción.</p>
            <p>Precio:</p>
            <p class="price">$20.00</p>
            <button class="add-to-cart">Agregar al Carrito</button>
        </div>
        <div class="product" data-id="2" data-name="Destornillador" data-price="15.00">
            <img src="img/des.jpg" alt="Destornillador">
            <h3>Destornillador</h3>
            <p>Herramienta imprescindible para cualquier caja de herramientas, ideal para apretar o aflojar tornillos con facilidad y precisión.</p>
            <p>Precio:</p>
            <p class="price">$15.00</p>
            <button class="add-to-cart">Agregar al Carrito</button>
        </div>
    </section>

    <section class="product-container">
        <h2>Herramientas Eléctricas</h2>
        <div class="product" data-id="3" data-name="Taladro" data-price="80.00">
            <img src="img/taladro.jpg" alt="Taladro">
            <h3>Taladro Bosch</h3>
            <p>Potente taladro eléctrico que te permitirá perforar agujeros limpios y precisos en diferentes materiales, desde madera hasta metal.</p>
            <p>Precio:</p>
            <p class="price">$80.00</p>
            <button class="add-to-cart">Agregar al Carrito</button>
        </div>
        <div class="product" data-id="4" data-name="Sierra" data-price="100.00">
            <img src="img/sierra.jpg" alt="Sierra">
            <h3>Sierra Bosch</h3>
            <p>La sierra eléctrica que necesitas para tus proyectos de bricolaje y construcción, cortando de manera eficiente y segura a través de distintos tipos de materiales.</p>
            <p>Precio:</p>
            <p class="price">$100.00</p>
            <button class="add-to-cart">Agregar al Carrito</button>
        </div>
    </section>

    <section class="cart">
        <h2>Carrito de Compras</h2>
        <ul class="cart-list"></ul>
        <p class="total">Total de la compra (USD): $<span id="paypal-total">0.00</span></p>
        <p class="total-multiplicado">Total de la compra (CLP): $<span>0.00</span></p>
        <button class="clear-cart">Limpiar Carrito</button>
        <button class="checkout-btn" style="background-color: #007BFF; color: white; border: 1px solid #333; border-radius: 5px; padding: 5px 10px; cursor: pointer; margin-top: 10px;"><a href="php/pagar.php" style="text-decoration: none; color: white;">Pago WebPay</a></button>
        <button class="transfer-btn" style="background-color: #FF5733; color: white; border: 1px solid #333; border-radius: 5px; padding: 5px 10px; cursor: pointer; margin-top: 10px;">Transferir</button>
    </section>

    <div id="transfer-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Datos para Transferencia:</h3>
            <p>Ferramas</p>
            <p>99.999.999-9</p>
            <p>Banco</p>
            <p>Cuenta Corriente</p>
            <p>99-99999-9</p>
            <p>contacto.ferramas@email.cl</p>
            <b>*Poner en la descripcion el numero de pedido*</b>
        </div>
    </div>

    <div id="paypal-button-container"></div>
    <script src="https://www.paypal.com/sdk/js?client-id=AYCuKvR-oLCylPKgfp-bUBu9-l8vvSvld6fIH6fiwPUqWbs_kDiamDnsocxtDcBom68Tyxx5mMIu_ehK&currency=USD" data-sdk-integration-source="button-factory"></script>
    <script src="js/app.js"></script>
    <script>
        function initPayPalButton() {
            paypal.Buttons({
                style: {
                    shape: 'rect',
                    color: 'blue',
                    layout: 'vertical',
                    label: 'pay',
                },
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            description: "Ferramas",
                            amount: {
                                currency_code: "USD",
                                value: document.querySelector('#paypal-total').textContent
                            }
                        }]
                    });
                },
                onCancel: function(data) {
                    alert("Pago Cancelado");
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                        actions.redirect('LA URL DE TU PAGINA DE GRACIAS');
                    });
                },
                onError: function(err) {
                    console.log(err);
                }
            }).render('#paypal-button-container');
        }
        initPayPalButton();
    </script>
     <style>
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 300px; 
            border-radius: 5px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <footer>
        <p>&copy; 2024 FERREMAS - Todos los derechos reservados</p>
    </footer>
</body>
</html>