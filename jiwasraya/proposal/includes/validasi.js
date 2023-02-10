function validasi(field) {
  if (field.value.length > 0){
 		for (var i=0; i < field.value.length; i++){
				 var digit = field.value.charAt(i)
				 if (digit < "0" || digit > "9"){
				 		if (digit ==  ","){
							 alert("Jangan memasukkan koma")
							 return false
						}	else {
								alert(digit+" bukan merupakan angka")
								return false
						}
					} 
		}
		var a = field.value.length
 		var b = "000000000"+field.value
		field.value=b.substring(a,b.length) 
  }
	return true			
}

function validasi10(field)
{
 		for (var i=0; i < field.value.length; i++){
				 var digit = field.value.charAt(i)
				 if (digit < "0" || digit > "9"){
				 		if (digit ==  ","){
							 alert("Jangan memasukkan koma")
							 return false
						}
						else {
								alert(digit+" bukan merupakan angka")
								return false
						}
					} 
		}
		var a = field.value.length
		if (!field.value =='') {
 		var b = "0000000000"+field.value
		field.value=b.substring(a,b.length)
		}
		return true			
}
function validasi9(field)
{
 		for (var i=0; i < field.value.length; i++){
				 var digit = field.value.charAt(i)
				 if (digit < "0" || digit > "9"){
				 		if (digit ==  ","){
							 alert("Jangan memasukkan koma")
							 return false
						}
						else {
								alert(digit+" bukan merupakan angka")
								return false
						}
					} 
		}
		var a = field.value.length
		if (!field.value =='') {
 		 var b = "000000000"+field.value
		 field.value=b.substring(a,b.length)
		}
		return true			
}
function validasi8(field)
{
 		for (var i=0; i < field.value.length; i++){
				 var digit = field.value.charAt(i)
				 if (digit < "0" || digit > "9"){
				 		if (digit ==  ","){
							 alert("Jangan memasukkan koma")
							 return false
						}
						else {
								alert(digit+" bukan merupakan angka")
								return false
						}
					} 
		}
		var a = field.value.length
		if (!field.value =='') {
 		 var b = "00000000"+field.value
		 field.value=b.substring(a,b.length) 
		}
		return true			
}

function validasix(field)
{
 		for (var i=0; i < field.value.length; i++){
				 var digit = field.value.charAt(i)
				 if (digit < "0" || digit > "9"){
				 		if (digit ==  ","){
							 alert("Jangan memasukkan koma")
							 return false
						}
						else {
								alert(digit+" bukan merupakan angka")
								return false
						}
					} 
		}
		return true			
}