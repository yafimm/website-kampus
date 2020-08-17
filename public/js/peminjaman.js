function hapusItem(index)
{
  $('div#peminjaman-'+index).remove();
}



$(document).ready(function(){
  $('#inventaris').change(function () {
      var selectedObject = $(this).find('option:selected');
      var id = selectedObject.data("invid");
      var nama = selectedObject.data("invnama");
      if (id == 'title') {
      } else {
          $("#content-daftar-inventaris").append('<div id="peminjaman-'+peminjamanId+'" class="form-group">' +
              '<div class="col-sm-3">' +
              '</div>' +
              '<label class="col-sm-3 control-label">' + nama + '</label>' +
              '<div class="col-sm-3">' +
              '<input type="hidden" name="idinventaris[]" value="' + id + '">' +
              '<input required name="jumlahinventaris[]" min="1" type="number" class="form-control"' +
              'id="" placeholder="Jumlah barang">'+
              '</div>'+
              '<div class="col-sm-3">' +
              '<button class="btn btn-danger btn-sm" type="button"'+
                  'onclick="hapusItem('+peminjamanId+', value)" data-toggle="tooltip" data-placement="top"title="Hapus Data"><i class="glyph-icon icon-trash"></i>'+
              '</button>' +
              '</div>' +
              '</div>');

            peminjamanId++;
      }
  });
});
