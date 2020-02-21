
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



