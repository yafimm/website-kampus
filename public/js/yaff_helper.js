function convertRupiahToNumber(value){
    // menghilangkan tulisan rupiah
    number = value.substr(3);
    // Menghilangkan titik pada ribuan
    number = number.replace('.','');
    // menghilangkan format rupiah;
    return parseInt(number.replace(',','.'));
};

function convertNumberToRupiah(value){
  let rupiah = '';
  let angkarev = value.toString().split('').reverse().join('');
  for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
  return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('')+',00';
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