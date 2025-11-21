
// Remplit automatiquement le prix basé sur le produit sélectionné
document.getElementById("productSelect").addEventListener("change", function() {
    let price = this.options[this.selectedIndex].getAttribute("data-price");
    let supplier = this.options[this.selectedIndex].getAttribute("data-supplier");
    if (price) {
        document.getElementById("priceInput").value = price;
    }
    if (supplier) {
        document.getElementById("supplierInput").value = supplier;
    }
});

function addProduct() {
    let productSelect = document.getElementById("productSelect");
    let productId = productSelect.value;
    let productName = productSelect.options[productSelect.selectedIndex].text;

    let quantity = parseInt(document.getElementById("quantityInput").value);
    let price = parseFloat(document.getElementById("priceInput").value);
    let supplier = parseFloat(document.getElementById("supplierInput").value);

    if (!productId || quantity <= 0 || price <= 0) {
        alert("Veuillez remplir tous les champs produit.");
        return;
    }

    let subtotal = quantity * price;

    let table = document.getElementById("tableBody");
    let row = document.createElement("tr");

    row.innerHTML = `
        <td>
            ${productName}
            <input type="hidden" name="productID[]" value="${productId}">
        </td>
        <td>
            ${quantity}
            <input type="hidden" name="quantity[]" value="${quantity}">
        </td>
        <td>
            ${price.toFixed(2)}
            <input type="hidden" name="price[]" value="${price}">
        </td>
        <td>${subtotal.toFixed(2)}</td>
        <td><button type="button" onclick="removeRow(this)">X</button></td>
    `;

    table.appendChild(row);

    updateTotal();
}

function removeRow(btn) {
    btn.parentElement.parentElement.remove();
    updateTotal();
}

function updateTotal() {
    let rows = document.querySelectorAll("#tableBody tr");
    let total = 0;

    rows.forEach(row => {
        let subtotal = parseFloat(row.children[3].textContent);
        total += subtotal;
    });

    document.getElementById("totalInput").value = total.toFixed(2);
}



//function vente


function addVente() {
    let select = document.getElementById("productSelect");
    let productName = select.options[select.selectedIndex].text;
    let productID = select.value;

    let qty = document.getElementById("quantityInput").value;
    let price = document.getElementById("priceInput").value;

    if (!productID || qty <= 0 || price <= 0) {
        alert("Veuillez remplir tous les champs.");
        return;
    }

    let subtotal = qty * price;

    let table = document.getElementById("tableBody");
    let row = document.createElement("tr");

    row.innerHTML = `
        <td>${productName}
            <input type="hidden" name="productID[]" value="${productID}">
        </td>

        <td>${qty}
            <input type="hidden" name="quantity[]" value="${qty}">
        </td>

        <td>${price}
            <input type="hidden" name="price[]" value="${price}">
        </td>

        <td>${subtotal.toFixed(2)}</td>

        <td><button type="button" onclick="removeRow(this)">X</button></td>
    `;

    table.appendChild(row);
    updateTotal();
}


function removeRow(btn) {
    btn.parentElement.parentElement.remove();
    updateTotal();
}

function updateTotal() {
    let rows = document.querySelectorAll("#tableBody tr");
    let total = 0;

    rows.forEach(r => {
        total += parseFloat(r.children[3].textContent);
    });

    document.getElementById("total_sale").value = total.toFixed(2);
}










   
    document.getElementById("productSelect").addEventListener("change", function() {
        let selected = this.options[this.selectedIndex];
        let price = selected.getAttribute("data-price");
        
        if (price) {
            document.getElementById("priceInput").value = price;
        } else {
            document.getElementById("priceInput").value = "";
        }
    });

