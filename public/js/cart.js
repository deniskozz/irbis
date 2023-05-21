/* $(document).on("click", ".plus-btn, .minus-btn", function () {
    const $input = $(this).siblings(".product-quantity");
    let quantity = parseInt($input.val());

    quantity = $(this).hasClass("plus-btn")
        ? quantity + 1
        : Math.max(1, quantity - 1);

    updateQuantity($input, quantity);
});

function updateQuantity($input, quantity) {
    $input.val(quantity);
}

$(document).on("submit", ".update-form", function (event) {
    event.preventDefault();
    const form = event.target;
    const url = form.action;
    const data = new FormData(form);

    fetch(url, {
        method: "POST",
        body: data,
    })
        .then((response) => {
            // Update the total amount in the cart
            $(".cart-total").text(response.total);

            // Show a success message
            alert("Cart updated successfully!");
        })
        .catch(() => {
            // Show an error message
            alert("Error updating cart");
        });
});
 */
