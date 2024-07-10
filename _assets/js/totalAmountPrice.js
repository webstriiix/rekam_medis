$(document).ready(function () {
    function calculateTotal() {
        let total = 0;
        $('#mySelect option:selected').each(function () {
            const obatId = $(this).val();
            if (obatPrices[obatId]) {
                total += obatPrices[obatId];
            }
        });
        $('#total-amount-input').val(total);
    }

    $('#mySelect').change(function () {
        calculateTotal();
    });

    calculateTotal();
});