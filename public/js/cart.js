function increaseQuantity(button) {
    var quantityInput = button.parentNode.querySelector(".product-quantity");
    var currentQuantity = parseInt(quantityInput.value);
    quantityInput.value = currentQuantity + 1;
    updateTotal();
}

function decreaseQuantity(button) {
    var quantityInput = button.parentNode.querySelector(".product-quantity");
    var currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
        updateTotal();
    }
}

function updateTotal() {
    var productSums = document.querySelectorAll(".product-sum");
    var total = 0;

    productSums.forEach(function (productSum) {
        var price = parseInt(productSum.previousElementSibling.textContent);
        var quantity = parseInt(
            productSum.parentNode.querySelector(".product-quantity").value
        );
        var sum = price * quantity;
        productSum.textContent = sum + " руб.";
        total += sum;
    });

    document.getElementById("total").textContent = total + " руб.";
}
