var nomorMaintenanceBarang = 0;
var arrMaintenanceDetail = [];

function hapusItem(index)
{
    let datatable =  $('#tbl_maintenance').DataTable();
    datatable.row('#maintenance-detail-'+index).remove().draw();
    arrMaintenanceDetail.splice(arrMaintenanceDetail.indexOf($('#kode-'+index).val()), 1);
    showAlert('success', 'Berhasil hapus data barang pada detail pengadaan');
    setNetto();
}

function setNetto()
{
    let netto = 0;
    $('input[name="biaya[]"]').each(function() {
       netto += parseInt($(this).val());
    });
    $('#total').val(convertNumberToRupiah(netto));
}

function setHarga(index, value)
{
    value = value.replace(/[^0-9]/g, '');
    $('#biaya-'+index).val(value);
    setNetto();
}

$(document).ready(function(){
  var table = $('#tbl_maintenance').DataTable({
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
              text: item.b_id ? item.b_kode+" - "+item.b_nama : item.i_kode+" - "+item.i_nama,
              id: item.b_id ? 'BRG'+item.b_kode : 'INV'+item.i_kode,
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
              if(arrMaintenanceDetail.includes(kode)){
                showAlert('danger', 'Gagal menambahkan data, karena data '+ kode +' - '+ nama + ' Sudah dimasukkan !');
                $('#cari').empty();
              }else{
               table.row.add([
                      nomorMaintenanceBarang+1 + '<input type="hidden" name="barang_inventaris[]" value="'+id+'">',
                      '<span id="kode-'+nomorMaintenanceBarang+'">'+kode+'</span>',
                      nama,
                      '<input id="posisi-'+nomorMaintenanceBarang+'" class="form-control" type="text" name="posisi[]" value="">',
                      '<input id="biaya-'+nomorMaintenanceBarang+'" class="form-control" type="text" name="biaya[]" onkeyup="setHarga('+nomorMaintenanceBarang+', value)" value="0">',
                      '<textarea id="keterangan-'+nomorMaintenanceBarang+'" class="form-control" name="keterangan[]"></textarea>',
                      '<select class="form-control" name="status[]" value"  " id="exampleFormControlSelect1">'+
                                '<option value="Belum Mulai" >Belum Mulai</option>'+
                                '<option value="Sedang Berjalan">Sedang Berjalan</option>'+
                                '<option value="Selesai">Selesai</option>',
                      '<button type="button" class="btn btn-danger btn-sm" onclick="hapusItem('+nomorMaintenanceBarang+')" data-id="'+nomorMaintenanceBarang+'" data-toggle="tooltip" data-placement="top"><i class="glyph-icon icon-trash"></i></button>'
               ]).node().id='maintenance-detail-'+nomorMaintenanceBarang;
               table.draw(false);
               $('#cari').empty();
               showAlert('success', 'Berhasil menambahkan data '+ kode +' - '+nama);
               arrMaintenanceDetail.push(kode);
               nomorMaintenanceBarang++;
            }

          }


        },error:function(data){
               console.log(data);
          }
      });
  });

});
