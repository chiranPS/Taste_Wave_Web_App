document.addEventListener('DOMContentLoaded', function () {
  const checkboxes = document.querySelectorAll('.select-item');
  const totalPriceElement = document.getElementById('total-price');
  const deliveryMethod = document.getElementById('delivery-method');
  const deliveryAddressSection = document.getElementById('delivery-address-section');
  const deliveryAddressInput = document.getElementById('delivery-address');
  const checkoutButton = document.getElementById('checkout-button');
  const receiptModal = document.getElementById('receipt-modal');
  const receiptContent = document.getElementById('receipt-content');
  const closeReceipt = document.getElementById('close-receipt');

  let deliveryCharge = 0;

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateTotalPrice);
  });

  deliveryMethod.addEventListener('change', () => {
    if (deliveryMethod.value === 'delivery') {
      deliveryCharge = 300;
      deliveryAddressSection.classList.remove('hidden');
    } else {
      deliveryCharge = 0;
      deliveryAddressSection.classList.add('hidden');
    }
    updateTotalPrice();
  });

  function updateTotalPrice() {
    let totalPrice = 0;
    checkboxes.forEach(checkbox => {
      if (checkbox.checked) {
        const price = parseFloat(checkbox.dataset.price) || 0;
        totalPrice += price;
      }
    });
    totalPrice += deliveryCharge;
    totalPriceElement.textContent = `LKR ${totalPrice.toFixed(2)}`;
  }

  checkoutButton.addEventListener('click', () => {
    const selectedItems = Array.from(checkboxes)
      .filter(checkbox => checkbox.checked)
      .map(checkbox => ({
        product: checkbox.dataset.product,
        quantity: checkbox.dataset.quantity,
        price: checkbox.dataset.price,
      }));

    const userDeliveryAddress = deliveryAddressInput.value;
    const selectedDeliveryMethod = deliveryMethod.value;

    let receiptHtml = '<ul>';
    selectedItems.forEach(item => {
      receiptHtml += `<li>${item.product} - Quantity: ${item.quantity}, Price: LKR ${item.price}</li>`;
    });
    receiptHtml += `</ul><p class="mt-2">Delivery Method: ${selectedDeliveryMethod}</p>`;

    if (selectedDeliveryMethod === 'delivery') {
      receiptHtml += `<p>Delivery Address: ${userDeliveryAddress}</p>`;
    }

    receiptHtml += `<p class="mt-2 font-bold">Final Total: ${totalPriceElement.textContent}</p>`;

    receiptContent.innerHTML = receiptHtml;
    receiptModal.classList.remove('hidden');
  });

  closeReceipt.addEventListener('click', () => {
    receiptModal.classList.add('hidden');
  });
});