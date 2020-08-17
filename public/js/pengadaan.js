var nomorPengadaanBarang = 0;
var arrPengadaanDetail = [];

function hapusItem(index)
{
    let datatable =  $('#tbl_pengadaan_detail').DataTable();
    datatable.row('#pengadaan-detail-'+index).remove().draw();
    arrPengadaanDetail.splice(arrPengadaanDetail.indexOf($('#kode-'+index).val()), 1);
    showAlert('success', 'Berhasil hapus data barang pada detail pengadaan');
    setNetto();
}

function setNetto()
{
    let netto = 0;
    $('input[name="totalHarga[]"]').each(function() {
       netto += parseInt($(this).val());
    });
    $('#netto').val(convertNumberToRupiah(netto));
}

function setTotalHarga(index, value, qty)
{
    let totalHarga = value * qty;
    $('#totalHarga-'+index).val(totalHarga);
    $('#totalHargaSpan-'+index).html(convertNumberToRupiah(totalHarga));
    setNetto();
}

function setQty(index, value)
{
    value = value.replace(/[^0-9]/g, '');
    let harga = $('#harga-'+index).val();
    $('#qty-'+index).val(value);
    setTotalHarga(index, harga, value);
}

function setHarga(index, value)
{
    value = value.replace(/[^0-9]/g, '');
    let qty = $('#qty-'+index).val();
    $('#harga-'+index).val(value);
    setTotalHarga(index, value, qty);
}

$(document).ready(function(){
  var table = $('#tbl_pengadaan_detail').DataTable({
                  searching: false,
                  ordering:  false,
                  responsive: true,
                  autoWidth: false,
                });

  $('.cari').select2({
    placeholder: 'Cari berdasarkan kode/nama ..',
    ajax: {
      url: urlCari,
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.b_kode+" - "+item.b_nama,
              id: item.b_kode,
            }
          })
        };
      },
      cache: true
    }
  });

  $('#cari').change(function(){
      $.ajax({
          type: 'GET', //THIS NEEDS TO BE GET
          url: urlGetBarang,
          dataType: 'json',
          data: {kode: $(this).val(), no_register: $('input[name="no_register"').val()},
          success: function (data) {
            if(data.status == false){
                $('#cari').empty();
                showAlert('danger', data.message);
            }else{
                let kode = data.b_kode ? data.b_kode : data.i_kode;
                let nama = data.b_nama ? data.b_nama : data.i_nama;
                let id = data.b_id ? "BRG"+data.b_id : "INV"+data.i_id;

                //Kalo data sudah ada di detail, keluar alert
                if(arrPengadaanDetail.includes(kode)){
                    showAlert('danger', 'Gagal menambahkan data, karena data '+ kode +' - '+ nama + ' Sudah dimasukkan !');
                    $('#cari').empty();
                }else{
                   table.row.add([
                                nomorPengadaanBarang+1 +' <input type="hidden" name="barang_inventaris[]" value="'+id+'">',
                                '<span id="kode-'+nomorPengadaanBarang+'">'+kode+'</span>',
                                nama,
                                '<input id="qty-'+nomorPengadaanBarang+'" class="form-control" type="text" name="qty[]" onkeyup="setQty('+nomorPengadaanBarang+', value)" value="0">',
                                '<input id="harga-'+nomorPengadaanBarang+'" class="form-control" type="text" name="harga[]" onkeyup="setHarga('+nomorPengadaanBarang+', value)" value="0">',
                                '<span id="totalHargaSpan-'+nomorPengadaanBarang+'">Rp. 0,00</span><input type="hidden" id="totalHarga-'+nomorPengadaanBarang+'" class="form-control" type="text" name="totalHarga[]" value="0" readonly>',
                                '<button type="button" class="btn btn-danger btn-sm" onclick="hapusItem('+nomorPengadaanBarang+')" data-id="'+nomorPengadaanBarang+'" data-toggle="tooltip" data-placement="top"><i class="glyph-icon icon-trash"></i></button>'
                   ]).node().id='pengadaan-detail-'+nomorPengadaanBarang;
                   table.draw(false);

                   $('#cari').empty();
                   showAlert('success', 'Berhasil menambahkan data '+ kode +' - '+nama);
                   arrPengadaanDetail.push(kode);
                   nomorPengadaanBarang++;
              }

          }

        },error:function(data){
               console.log(data);
          }
      });
  });

});
