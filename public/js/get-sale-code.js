function getSaleCode()
{
    const saleCode = document.getElementById("voucher-code-input").value;
    // Set input voucher code form for submit voucher code
    document.getElementById("voucher-code").value = saleCode;
}
