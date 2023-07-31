// Создаем наблюдателя
const observer1 = new MutationObserver((mutationsList, observer) => {
    const chosenSelect = $(".chosen-select");
    if (chosenSelect.length && !chosenSelect.hasClass("chzn-done")) {
        chosenSelect.addClass("chzn-done");

        // Fetch data from server
        fetch('/modals/callOrder.php')
            .then(response => response.json())
            .then(data => {
                // Define a map to store product price by id
                const productPriceById = {};

                // Initialize Chosen with custom placeholder
                chosenSelect.chosen({allow_single_deselect: true,  placeholder_text_multiple: "Выберите товар"});

                // Clear the select
                chosenSelect.empty();

                // For each product
                // For each product
                data.forEach(product => {
                    // Create new option
                    let option = $('<option>', { text: `${product.name} - ${parseInt(product.price)}`, 'data-id': product.id, 'data-price': parseInt(product.price) });
                    // Append the option to the select
                    chosenSelect.append(option);

                    productPriceById[product.id] = parseInt(product.price);
                });


                // Set click event to clear placeholder
                chosenSelect.on('chosen:showing_dropdown', function() {
                    $(this).attr('data-placeholder', '');
                });

                // Update Chosen
                chosenSelect.trigger("chosen:updated");

                // Handle change event to update total price
                chosenSelect.on('change', function() {
                    // Get all options
                    $(this).find('option').each(function() {
                        // Reset the chosen-id of all options
                        $(this).removeAttr('chosen-id');
                    });

                    // Get selected product ids
                    const selectedProducts = $(this).find('option:selected').each(function() {
                        // Set the chosen-id of the selected options
                        $(this).attr('data-chosen', 'true');
                    });

                    // Calculate total price
                    let totalPrice = 0;
                    selectedProducts.each(function() {
                        const id = $(this).attr('data-id');
                        totalPrice += productPriceById[id];
                    });

                    // Update total price text
                    $('.total').text(`Итог: ${totalPrice}`);
                });
            });
    }
});

// Начинаем наблюдение
observer1.observe(document, { childList: true, subtree: true });
