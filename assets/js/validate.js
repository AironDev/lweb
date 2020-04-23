function validateLogin() {
	console.log('Validating...');
	try {
		pw = document.getElementById('password').value;
		em = document.getElementById('email').value;
		console.log("Validating pw="+pw);
		if (pw == null || pw == "" || em == null || em == "" ) {
			alert("Both fields must be filled out");
			return false;
		}
		return true;

	} catch(e) {
		return false;
	}
	return false;
}


function validateAddNew(input) {
	var fn = document.getElementById('fname').value;
	var ln = document.getElementById('lname').value;
	var em = document.getElementById('email').value;
	var he = document.getElementById('headline').value;
	var su = document.getElementById('summary').value;

	var fnErr = document.getElementById('fnameErr');
	var lnErr = document.getElementById('lnameErr');
	var emErr = document.getElementById('emailErr');
	var heErr = document.getElementById('headlineErr');
	var suErr = document.getElementById('summaryErr');

var regex = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/; // /^\S+@\S+\.\S+$/;
switch(input){
		case 'fname':
			(fn === "") ? fnErr.innerHTML = 'Please enter your First Name' : fnErr.innerHTML = '';
			break;

		case 'lname':
			(ln === "") ? lnErr.innerHTML = 'Please enter your Last Name' : lnErr.innerHTML = '';
			break;

		case 'email':
			(regex.test(em) === false) ? emErr.innerHTML = 'Email address must contain @' : emErr.innerHTML = '';
			break;

		case 'headline':
			(he === "") ? heErr.innerHTML = 'Headline is required' : heErr.innerHTML = '';
			break;

		case 'summary':
			(su === "") ? suErr.innerHTML = 'Summary is required' : suErr.innerHTML = '';
			break;

		default:
			break;

}




// // last name check
// 	if(em == ""){
// 		emErr.innerHTML = 'Field is required';
// 	}else{
// 		emErr.innerHTML = '';
// 	}



}

console.log('form validate.js');