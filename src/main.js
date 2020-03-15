/**
 * Author: Courtney Jacobs (cj5he), Amara Vo (av2jf)
*/


/*
 * sell.html
*/

var items = [];

// Valid Inputs

//*** Creates <p> with items populated
function createItems() {
    document.getElementById("createdItems").innerHTML ="<p>Your Items</p>";
    var i=0;
    items.forEach( 
        item => {
            i++;
            document.getElementById("createdItems").innerHTML+="<strong> Item " + i + "</strong> <p> Category: " + item.category + ", Brand: " + item.brand + ", Size: " + item.size + ", Color: " +
            item.color + ", Condition: " + item.condition + ", Description: " + item.desc + ", Price: " + item.price + "</p><br>"; 
        }
    )
}

//*** Populate object from form
function populate() {
    var newItem = {
        category:"",
        brand:"",
        size:"",
        color:"white",
        condition:"new",
        desc:"none",
        price: "",
    };
    var getDropdown = dropID => {
        drop = document.getElementById(dropID);
        return drop.options[drop.selectedIndex].value;
    }
    newItem.category = getDropdown("category");
    newItem.brand = document.getElementById("brand").value;
    newItem.size = document.getElementById("size").value;
    newItem.color = document.getElementById("color").value;
    newItem.condition = document.getElementById("condition").value;
    newItem.desc = document.getElementById("desc").value;
    newItem.price = document.getElementById("price").value;
    items.push(newItem);
    createItems();
    document.getElementById("sell-form").reset();
}

//*** Check if entered price is within range.
function validPrice() {
    var price = parseFloat(document.getElementById("price").value);
    if (price <= 1000 && price >= 1) {
        setEarnings();
    }
    // show error
    else {
        var youEarnError = document.getElementById("youearnError");
        youEarnError.innerHTML = "Value must be less than or equal to $1000.00";
    }
}

//*** Update earnings field as user types in price.
function setEarnings() {
    var price = parseFloat(document.getElementById("price").value);
    var fee = 0.1*price;
    var earnings = price - fee; 

    var youEarn = document.getElementById("youearn");
    youEarn.value = "$" + earnings;
}

/*
 * contact.html
*/

//*** Show confirmation message after successful submission.
function confirmMessage() {

    // contact form
    if (document.getElementById("contact-form")) {
        var name = document.getElementById('FName').value;
        event.preventDefault();                                                             // prevents page from refreshing
        document.getElementById("Confirm-Text").innerHTML = "Thank you " + name + "! We will get in touch with you soon.";
        document.getElementById("contact-form").style.display="none";
        document.getElementById("Confirm-Submission").style.display="block";
    }

    // fundraise form
    if (document.getElementById("fundraise-form")){ 
        
        // if promo is invalid
        if (document.getElementById("promoError").style.visibility == "visible") {
            event.preventDefault();                                                         // prevents form from submitting
            document.getElementById("promo").focus();       
        }
        else {
            var name = document.getElementById('FName').value;
            event.preventDefault();                                                         // prevents page from refreshing
            document.getElementById("fundraise-form").style.display="none";
            document.getElementById("Confirm-Submission").style.display="block";
            document.getElementById("Confirm-Text").innerHTML = "Thank you " + name + ", good luck with your Fundraiser!";
        }
    }
}

/*
 * fundraise.html
*/
var pastPromo = ["GOPUFF", "UVA20", "UVAUPC", "H"];                                     // global list - all code should be capitalized

//*** Verify if promo code can be used.
function checkPromo() {
    var enteredPromo = document.getElementById("promo").value.toUpperCase();
    var status = document.getElementById("promoError").style.visibility;

    // if error text is hidden
    if (status == "hidden") {   

        if (document.getElementById("submitButton").disabled) {
            document.getElementById("submitButton").disabled="false";
        }           // if disabled button

        if (pastPromo.includes(enteredPromo) && (enteredPromo.length >= 3)) {           // if promo already exists
            document.getElementById("promoError").style.visibility="visible";           // show error message
        }
        else{                                                                           // combo of letters isn't in list yet
            //FUTURE: add promo code to database list if submit button is clicked
        }
        
    }
    // if error text is already shown
    else {
        document.getElementById("promoError").style.visibility="hidden";                // hide the text
        checkPromo();                                                                   // call function again
    }


}
