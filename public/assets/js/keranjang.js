$(document).ready(function () {
    var rowCount = 0;
    
    $('#tambahProduk').click(function(event){
        event.preventDefault();
        
        var produkData = $('#produkForm').serialize();
        $.ajax({
            url: "/detailpenjualan/simpan",
            type: "POST",
            data: produkData,
            success: function (response) {
                rowCount++;

                var newRow = '<tr>' +
                    '<td>' + rowCount + '</td>' +
                    '<td>' + response.produk + '</td>' +
                    '<td>' + response.jumlah + '</td>' +
                    '<td>' + response.subtotal + '</td>' +
                    '<td><a class="btn btn-danger deleteBtn" id="deleteBtn" data-dID="'+ response.detailID +'"><i class="fa fa-trash" aria-hidden="true"></i></a></td>' +
                    '</tr>';

                $('tbody').append(newRow);

                $('#totalCol').text(response.total);
                $('#diskon').text(response.persen);
                $('#total').val(response.total);
                $('#totalAkhir').val(response.totalAkhir);
            },
            error: function(error, tis) {
                console.log(tis);
                alert(error);
            }
        });
    });

    $('body').on('click', '.deleteBtn', function() {
        var detailID = $(this).attr('data-dID');
        var row = $(this).closest('tr');
        $.ajax({
            url: "/detailpenjualan/hapus"+ detailID,
            type: "GET",
            success: function (response) {
                row.remove();

                $('#totalCol').text(response.total);
                $('#diskon').text(response.persen);
                $('#total').val(response.total);
                $('#totalAkhir').val(response.totalAkhir);
            },
            error: function(error, tis) {
                console.log(tis);
                alert(error);
            }
        });
    });

});