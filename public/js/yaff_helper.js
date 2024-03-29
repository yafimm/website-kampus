function convertRupiahToNumber(value){
    // menghilangkan tulisan rupiah
    number = value.substr(3);
    // Menghilangkan titik pada ribuan
    number = number.replace(/\./g, '');
    // menghilangkan format rupiah;
    return parseInt(number.replace(/,/g, '.'));
};

function convertNumberToRupiah(value){
  let rupiah = '';
  let angkarev = value.toString().split('').reverse().join('');
  for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
  return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('')+',00';
}

function showAlert(type, message)
{
    let alert = '<div class="alert alert-'+type+' alert-dismissible" role="alert">'+
                    message+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                      '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                '</div>';

    $('#alertDiv').append(alert).hide().fadeIn(1000);

    setTimeout(function() {
        $("#alertDiv").children('div').fadeOut(300, function() {
            $("#alertDiv").children('div').remove();
        });
    }, 5000);
}
//
// function convertToRupiah(angka)
// {
// 	let rupiah = '';
// 	let angkarev = angka.toString().split('').reverse().join('');
// 	for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
// 	return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
// }
// /**
//  * Usage example:
//  * alert(convertToRupiah(10000000)); -> "Rp. 10.000.000"
//  */
//
// function convertToAngka(rupiah)
// {
// 	 return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
// }
