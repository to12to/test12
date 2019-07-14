// FETCH DATA
fetch('libanonreizendb/api/tour/read.php').then((res) => res.json())
.then(response => {
	console.log(response);
	let output = '';
	for(let i in response){
		output += `<tr>
			<td>${response[i].id}</td>
			<td>${response[i].name}</td>
			<td>${response[i].description}</td>
			<td>${response[i].price}</td>
		</tr>`;
	}

	document.querySelector('.tbody').innerHTML = output;
}).catch(error => console.log(error));

// DATA TABLES
$(document).ready(function(){
	$('.table').DataTable();
})