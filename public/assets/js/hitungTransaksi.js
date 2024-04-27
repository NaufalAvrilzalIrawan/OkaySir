document.addEventListener('DOMContentLoaded', function() {
    var produkSelect = document.getElementById('produkID');
    var jumlahInput = document.getElementById('jumlah');
    var subtotalInput = document.getElementById('subtotal');
    var tambahBtn = document.getElementById('tambahProduk');

    var totalAkhirInput = document.getElementById('totalAkhir');
    var bayarInput = document.getElementById('bayar');
    var kembalianInput = document.getElementById('kembalian');
    var selesaiBtn = document.getElementById('selesaiBtn');
    
    function calculateSubtotal() {
        var selectedProduk = produkSelect.options[produkSelect.selectedIndex];
        var harga = parseFloat(selectedProduk.getAttribute('data-harga'));
        var jumlah = parseFloat(jumlahInput.value);
        var stok = parseInt(selectedProduk.getAttribute('data-stok'));

        if (stok <= 0) {
            tambahBtn.disabled = true;
        } else {
            tambahBtn.disabled = false;
        }
        
        if (isNaN(jumlah) || jumlah < 1) {
            jumlahInput.value = 1;
            jumlah = 1;
        } else if (!isNaN(jumlah) && jumlah > stok) {
            jumlahInput.value = stok;
            jumlah = stok;
        }

        subtotalInput.value = harga * jumlah;
    }

    function calculateKembalian() {
        var totalAkhir = parseFloat(totalAkhirInput.value);
        var bayar = parseFloat(bayarInput.value);

        kembalianInput.value = bayar - totalAkhir;
        var kembalian = parseFloat(kembalianInput.value);
        if (kembalian >= 0) {
            selesaiBtn.disabled = false;
        } else {
            selesaiBtn.disabled = true;
        }
    }

    produkSelect.addEventListener('change', calculateSubtotal);
    jumlahInput.addEventListener('input', calculateSubtotal);
    bayarInput.addEventListener('input', calculateKembalian);
    

    calculateSubtotal();
});