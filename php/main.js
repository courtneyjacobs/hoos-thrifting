/**
 * Author: Courtney Jacobs (cj5he), Amara Vo (av2jf)
*/


/*
 * sell.html
*/


//*** Show error if image not selected
function imageError() {
    // if image not selected
    document.getElementById('imgError').innerHTML = "Please choose an image.";
    
}
//*** Live word count for description box.
// Source: https://stackoverflow.com/questions/14086398/count-textarea-characters
function checkWordCt() {
    document.getElementById('desc').onkeydown = function () {
        document.getElementById('wordCt').innerHTML = "<small>" + (250 - this.value.length) +"</small>";
    };
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
    youEarn.value = "$" + earnings.toFixed(2);              // add trailing 0's
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

    /*
    // fundraise form
    if (document.getElementById("fundraise-form")){ 

        // if charity field is empty, then charity error is visible
        //if (document.getElementById("charityError").style.visibility="visible") {
        //  event.preventDefault();                                                         // prevents form from submitting
        //  document.getElementById("charityName").focus();     
        //}
        // if promo is invalid, promo error is NOT empty
        //else 
        
        // if promoError is not shown 
        if (document.getElementById("promoError").innerHTML != "") {
            event.preventDefault();                                                         // focus on box, prevents form from submitting
            document.getElementById("promo").focus();       
        }
        else {
            event.preventDefault();                                                         // prevents page from refreshing
            document.getElementById("fundraise-form").style.display="none";
            document.getElementById("Confirm-Submission").style.display="block";
            document.getElementById("Confirm-Text").innerHTML = "Thank you, good luck with your fundraiser!";
        }
    }
    */
}

/*
 * fundraise.html
*/
var pastPromo = ["GOPUFF", "UVA20", "UVAUPC", "H"];                                     // global list - all code should be capitalized

//*** Verify if promo code can be used.
function checkPromo() {

    // Hide any error messages, then we can re-show them later if they are supposed to be there.
    //document.getElementById("promoError").style.visibility="hidden";                      // hide the text

    var enteredPromo = document.getElementById("promo").value.toUpperCase();            // standardize all codes to uppercase
    var promoStatus = document.getElementById("promoError").style.visibility;

}


//*** Ensure that a charity name has been inputted each time a button is selected.
function checkCharity() {
    
    //alert('document.getElementById("charityName").value.length');

    ///document.getElementById("charityError").style.visibility="hidden";                       // hide the text
    var charityStatus = document.getElementById("charityError").style.visibility;
    var CIOchecked = document.getElementById("CIO-purpose").checked;
    var charityChecked = document.getElementById("Charity-purpose").checked;

    // if Charity is selected
    if (charityChecked) {
        // make it required
        document.getElementById("charityName").required = true;

    }

    // if CIO checked
    if (CIOchecked) {
        // clear field of charity input
        if (document.getElementById("charityName").value.length > 0) {
            document.getElementById("charityName").value = "";                              // CLEAR TEXT FIELD 
        }

        // make charity name optional
        document.getElementById("charityName").required = false;

    }
    
}

//*** Set default Start Date to the current date.
// Source: https://css-tricks.com/prefilling-date-input/
function setCurrentDate() {
    //alert("hello");
    let today = new Date().toISOString().substr(0, 10);
    document.querySelector("#start").value = today;
    document.getElementById("start").min = today;
}


