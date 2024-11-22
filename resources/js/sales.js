document.addEventListener('DOMContentLoaded', function() {
    const now = new Date();
    const input = document.getElementById('emission_date');
    const totalInput = document.getElementById('total');
    const productContainer = document.getElementById('product_container');
    const productHeaders = document.querySelector('.product_headers');
    const productMessage = document.querySelector('.product_message');
    const saleItems = document.getElementById('items');

    // Función para formatear la fecha y hora
    const formatLocalDateTime = (date) => date.toLocaleString('sv-SE', { timeZone: 'America/Lima' }).replace(' ', 'T');

    // Establecer valores iniciales
    input.value = formatLocalDateTime(now);
    input.min = formatLocalDateTime(new Date(now - 7 * 24 * 60 * 60 * 1000));
    input.max = formatLocalDateTime(new Date(now + 7 * 24 * 60 * 60 * 1000));

    // Función para agregar un producto
    const addProductRow = (productCode, productName, productPrice) => {
        const existingRow = [...productContainer.children].find(row => row.querySelector('input[type="text"]').value === productName);
        if (existingRow) {
            console.log("El producto ya existe");
            return;
        }

        const productRow = document.createElement('div');
        productRow.className = 'mb-2 flex space-x-6 product_row';
        productRow.innerHTML = `
            <div class="flex-1 w-1/2">
                <input type="hidden" value="${productCode}" class="code">
                <input type="text" value="${productName}" class="block w-full p-2 border border-gray-300 rounded" readonly>
            </div>
            <div class="flex-1 w-1/4">
                <input type="number" min="0" value="1" class="block w-full p-2 border border-gray-300 rounded quantity" required>
            </div>
            <div class="flex-1 w-1/4">
                <input type="number" value="${productPrice}" min="0" step="0.01" class="block w-full p-2 border border-gray-300 rounded price" readonly>
            </div>
        `;

        productContainer.appendChild(productRow);
        updateVisibility();
        updateTotal();

        productRow.querySelector('.quantity').addEventListener('input', function() {
            if (this.value <= 0) {
                productRow.remove();
                updateVisibility();
            }
            updateTotal();
        });
    };

    // Actualizar total
    const updateTotal = () => {
        const total = [...document.querySelectorAll('.product_row')].reduce((acc, row) => {
            const quantity = row.querySelector('.quantity').value;
            const price = row.querySelector('.price').value;
            return acc + parseInt(quantity) * parseFloat(price);
        }, 0);
        totalInput.value = total.toFixed(2);
    };

    // Actualizar visibilidad de encabezados y mensajes
    const updateVisibility = () => {
        const hasProducts = productContainer.children.length > 0;
        productHeaders.classList.toggle('hidden', !hasProducts);
        productMessage.classList.toggle('hidden', !hasProducts);
    };

    // Manejar selección de productos
    document.getElementById('product_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const productCode = selectedOption.getAttribute('data-code');
        const productName = selectedOption.getAttribute('data-name');
        const productPrice = selectedOption.getAttribute('data-price');
        addProductRow(productCode, productName, productPrice);
        this.selectedIndex = 0; // Reiniciar selección
    });

    // Manejar envío del formulario
    document.getElementById('sales_form').addEventListener('submit', function(event) {
        event.preventDefault();
        const items = [...document.querySelectorAll('.product_row')].map(row => {
            const quantity = row.querySelector('.quantity').value;
            const price = row.querySelector('.price').value;
            const productName = row.querySelector('input[type="text"]').value;
            return {
                code: row.querySelector('.code').value,
                name: productName,
                price: parseFloat(price),
                quantity: parseInt(quantity),
                total_item: (quantity * price).toFixed(2)
            };
        });

        saleItems.value = JSON.stringify(items);
        this.submit(); // Enviar el formulario
    });
});
