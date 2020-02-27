
/*
	sell.html
*/

// Valid Inputs

// Check if price is within range.
function validPrice() {

	var price = parseFloat(document.getElementById("price").value);
	if (price <= 1000 && price >= 1) {
		setEarnings();
	}
	// show error
	else {
		var youEarn = document.getElementById("youearn");
		youEarn.value = "Value must be <= $1000";
	}

}

// Update earnings field as user types in price.
function setEarnings() {

	var price = parseFloat(document.getElementById("price").value);
	var fee = 0.1*price;
	var earnings = price - fee; 

	var youEarn = document.getElementById("youearn");
	youEarn.value = "$" + earnings;

}

/*
	contact.html
*/

// Show confirmation message
function confirmMessage() {
	// once Submit button is clicked
	event.preventDefault();			// prevents page from refreshing
	document.getElementById("contact-form").style.display="none";
	document.getElementById("Confirm-Submission").style.display="block";

}

/*
	fundraise.html
*/
var pastPromo = ["GOPUFF", "UVA20", "UVAUPC", "H"];				// global list - all code should be capitalized

function checkPromo() {
	var enteredPromo = document.getElementById("promo").value.toUpperCase();
	var status = document.getElementById("promoError").style.visibility;

	// if error text is hidden
	if (status == "hidden") {		
		if (pastPromo.includes(enteredPromo) && (enteredPromo.length >= 3)) {			// if promo already exists
			document.getElementById("promoError").style.visibility="visible";			// show error message
		}
		else{																			// combo of letters isn't in list yet
			// add promo code to database list if submit button is clicked
		}
	}
	// if error text is already shown
	else {
		document.getElementById("promoError").style.visibility="hidden";
		checkPromo();		// call function again
	}
}


