/* ===================================================
   1. SAMPLE PRODUCT DATA
   =================================================== */
const products = [
    {
        id: 1,
        code: "BRG001",
        barcode: "899123456001",
        name: "Indomie Goreng",
        price: 3500
    },
    {
        id: 2,
        code: "BRG002",
        barcode: "899123456002",
        name: "Aqua 600ml",
        price: 4000
    },
    {
        id: 3,
        code: "BRG003",
        barcode: "899123456003",
        name: "Teh Botol Sosro",
        price: 5000
    },
    {
        id: 4,
        code: "BRG004",
        barcode: "899123456004",
        name: "Beras 5 Kg",
        price: 75000
    },
    {
        id: 5,
        code: "BRG005",
        barcode: "899123456005",
        name: "Minyak Goreng 1 Liter",
        price: 18000
    },
    {
        id: 6,
        code: "BRG006",
        barcode: "899123456006",
        name: "Gula Pasir 1 Kg",
        price: 17000
    }
];

/* ===================================================
   2. FORMAT RUPIAH
   =================================================== */
function formatRupiah(value) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0
    }).format(value);
}

/* ===================================================
   3. SEARCH PRODUCT & AUTOCOMPLETE
   =================================================== */
const searchInput = document.getElementById("searchProduct");
if (searchInput) {
    searchInput.addEventListener("input", searchProduct);
}

function searchProduct() {
    const keyword = searchInput.value.toLowerCase().trim();
    const resultBox = document.getElementById("productResults");

    if (!keyword) {
        if (resultBox) resultBox.style.display = "none";
        return;
    }

    const results = products.filter(
        (product) =>
            product.name.toLowerCase().includes(keyword) ||
            product.code.toLowerCase().includes(keyword) ||
            product.barcode.includes(keyword)
    );

    if (resultBox) {
        if (results.length === 0) {
            resultBox.innerHTML = `
                <div class="product-item">
                    Barang tidak ditemukan
                </div>
            `;
        } else {
            resultBox.innerHTML = results
                .map(
                    (product) => `
                        <div class="product-item" onclick="addToCart(${product.id})">
                            <div>
                                <div class="product-name">${product.name}</div>
                                <div class="product-code">${product.code} - ${product.barcode}</div>
                            </div>
                            <div class="product-price">${formatRupiah(product.price)}</div>
                        </div>
                    `
                )
                .join("");
        }
        resultBox.style.display = "block";
    }
}

/* ===================================================
   4. CART MANAGEMENT
   =================================================== */
let cart = [];

function addToCart(productId) {
    const product = products.find((p) => p.id === productId);
    const existing = cart.find((item) => item.id === productId);

    if (existing) {
        existing.qty++;
    } else {
        cart.push({
            ...product,
            qty: 1
        });
    }

    if (searchInput) searchInput.value = "";
    const resultBox = document.getElementById("productResults");
    if (resultBox) resultBox.style.display = "none";

    renderCart();
}

function renderCart() {
    const body = document.getElementById("cartBody");

    if (cart.length === 0) {
        body.innerHTML = `
            <tr>
                <td colspan="6" class="empty-cart text-center py-4">
                    Keranjang masih kosong.<br>
                    Silakan cari atau scan barang.
                </td>
            </tr>
        `;
        calculateTotal();
        return;
    }

    body.innerHTML = cart
        .map(
            (item, index) => `
            <tr>
                <td>${index + 1}</td>
                <td>
                    <strong>${item.name}</strong>
                    <div style="font-size:11px; color:#6c757d">${item.code}</div>
                </td>
                <td>${formatRupiah(item.price)}</td>
                <td>
                    <div class="qty-control d-flex align-items-center gap-1">
                        <button class="btn btn-sm btn-secondary" onclick="changeQty(${item.id}, -1)">-</button>
                        <input type="number" class="form-control form-control-sm text-center" style="width: 50px;" value="${item.qty}" min="1" onchange="updateQty(${item.id}, this.value)">
                        <button class="btn btn-sm btn-secondary" onclick="changeQty(${item.id}, 1)">+</button>
                    </div>
                </td>
                <td class="text-end">
                    <strong>${formatRupiah(item.price * item.qty)}</strong>
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-danger remove-btn" onclick="removeItem(${item.id})">&times;</button>
                </td>
            </tr>
        `
        )
        .join("");

    calculateTotal();
}

function changeQty(id, amount) {
    const item = cart.find((item) => item.id === id);
    if (!item) return;

    item.qty += amount;

    if (item.qty <= 0) {
        removeItem(id);
        return;
    }

    renderCart();
}

function updateQty(id, qty) {
    const item = cart.find((item) => item.id === id);
    if (!item) return;

    item.qty = Math.max(1, parseInt(qty) || 1);
    renderCart();
}

function removeItem(id) {
    cart = cart.filter((item) => item.id !== id);
    renderCart();
}

/* ===================================================
   5. CALCULATIONS
   =================================================== */
function getGrandTotal() {
    let subtotal = 0;
    cart.forEach((item) => {
        subtotal += item.price * item.qty;
    });

    const discountPercent = parseFloat(document.getElementById("discountPercent")?.value) || 0;
    const discountAmount = parseFloat(document.getElementById("discountAmount")?.value) || 0;
    const tax = parseFloat(document.getElementById("tax")?.value) || 0;
    const otherFee = parseFloat(document.getElementById("otherFee")?.value) || 0;

    const discount = (subtotal * discountPercent) / 100 + discountAmount;

    return Math.max(0, subtotal - discount + tax + otherFee);
}

function calculateTotal() {
    let totalQty = 0;
    let subtotal = 0;

    cart.forEach((item) => {
        totalQty += item.qty;
        subtotal += item.price * item.qty;
    });

    const discountPercent = parseFloat(document.getElementById("discountPercent")?.value) || 0;
    const manualDiscount = parseFloat(document.getElementById("discountAmount")?.value) || 0;
    const tax = parseFloat(document.getElementById("tax")?.value) || 0;
    const otherFee = parseFloat(document.getElementById("otherFee")?.value) || 0;

    const percentDiscount = subtotal * (discountPercent / 100);
    const totalDiscount = percentDiscount + manualDiscount;
    const grandTotal = Math.max(0, subtotal - totalDiscount + tax + otherFee);

    if (document.getElementById("totalQty")) document.getElementById("totalQty").innerText = totalQty;
    if (document.getElementById("itemCount")) document.getElementById("itemCount").innerText = totalQty + " Item";
    if (document.getElementById("subtotal")) document.getElementById("subtotal").innerText = formatRupiah(subtotal);
    if (document.getElementById("grandTotal")) document.getElementById("grandTotal").innerText = formatRupiah(grandTotal);

    calculateChange();
}

function calculateChange() {
    const grandTotal = getGrandTotal();
    const payment = parseFloat(document.getElementById("payment")?.value) || 0;
    const change = payment - grandTotal;

    const changeBox = document.getElementById("changeBox");
    const changeElement = document.getElementById("change");
    const changeLabel = document.querySelector(".change-label");

    if (changeElement) {
        if (change >= 0) {
            if (changeBox) changeBox.classList.remove("short-payment");
            changeElement.innerText = formatRupiah(change);
            if (changeLabel) changeLabel.innerText = "KEMBALIAN";
        } else {
            if (changeBox) changeBox.classList.add("short-payment");
            changeElement.innerText = formatRupiah(Math.abs(change));
            if (changeLabel) changeLabel.innerText = "UANG KURANG";
        }
    }
}

// Event Listeners untuk kalkulasi dinamis saat input angka berubah
["discountPercent", "discountAmount", "tax", "otherFee", "payment"].forEach((id) => {
    const el = document.getElementById(id);
    if (el) {
        el.addEventListener("input", calculateTotal);
    }
});

/* ===================================================
   6. PAYMENT & ACTIONS
   =================================================== */
function selectPayment(button) {
    document.querySelectorAll(".payment-method button").forEach((btn) => {
        btn.classList.remove("active");
    });
    button.classList.add("active");
}

function holdTransaction() {
    if (cart.length === 0) {
        alert("Tidak ada transaksi untuk ditahan.");
        return;
    }
    alert("Transaksi berhasil ditahan.");
}

function processPayment() {
    if (cart.length === 0) {
        alert("Keranjang masih kosong.");
        return;
    }

    const total = getGrandTotal();
    const payment = parseFloat(document.getElementById("payment")?.value) || 0;

    if (payment < total) {
        alert("Uang pembayaran masih kurang.");
        return;
    }

    const change = payment - total;

    alert(
        "Pembayaran berhasil!\n\n" +
        "Total : " + formatRupiah(total) + "\n" +
        "Bayar : " + formatRupiah(payment) + "\n" +
        "Kembali : " + formatRupiah(change)
    );

    // Reset setelah transaksi berhasil
    cancelTransaction(false);
}

function cancelTransaction(confirmRequired = true) {
    if (confirmRequired && !confirm("Batalkan transaksi ini?")) {
        return;
    }

    cart = [];
    if (document.getElementById("payment")) document.getElementById("payment").value = "";
    if (document.getElementById("discountPercent")) document.getElementById("discountPercent").value = 0;
    if (document.getElementById("discountAmount")) document.getElementById("discountAmount").value = 0;
    if (document.getElementById("tax")) document.getElementById("tax").value = 0;
    if (document.getElementById("otherFee")) document.getElementById("otherFee").value = 0;

    renderCart();
}

/* ===================================================
   7. DATE & KEYBOARD SHORTCUTS
   =================================================== */
const dateEl = document.getElementById("currentDate");
if (dateEl) {
    dateEl.innerText = new Date().toLocaleString("id-ID");
}

document.addEventListener("keydown", function (event) {
    // F2 = Fokus Pencarian
    if (event.key === "F2") {
        event.preventDefault();
        if (searchInput) searchInput.focus();
    }

    // F4 = Fokus Pembayaran
    if (event.key === "F4") {
        event.preventDefault();
        const payInput = document.getElementById("payment");
        if (payInput) payInput.focus();
    }

    // ESC = Batalkan Transaksi
    if (event.key === "Escape") {
        cancelTransaction();
    }
});

/* ===================================================
   8. INITIALIZATION
   =================================================== */
renderCart();