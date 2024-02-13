
document.addEventListener('DOMContentLoaded', function () {
    // Display the welcome container initially
    const welcomeContainer = document.querySelector('.welcome-container');

    
    welcomeContainer.classList.add('visible');

    setTimeout(function () {
        // After three seconds, redirect to the login page
        window.location.href = 'buyerand seller log in.html'; 
    }, 2000);
});
function submitSignUp() {
   
    alert('Sign-up functionality is not implemented in this example.');
}

// foodmanagement.js

function submitForgotPasswordForm() {
    var emailOrPhone = document.getElementById("emailOrPhone").value;
    var emailErrorText = document.getElementById("emailErrorText");
    var pinInfoText = document.getElementById("pinInfoText");

    // Validate email format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailOrPhone)) {
        // Display error message and hide PIN info text
        emailErrorText.style.display = "block";
        pinInfoText.style.display = "none";
        return;
    }

    
    alert("PIN sent successfully to " + emailOrPhone);

    // Display the information text
    emailErrorText.style.display = "none";
    pinInfoText.style.display = "block";

       // Simulate sending PIN, show PIN info text, and display "Next" button
       var pinInfoText = document.getElementById("pinInfoText");
       pinInfoText.style.display = "block";

       var nextButton = document.getElementById("nextButton");
       nextButton.style.display = "block";
   }

   function goToPinEntryPage() {
       // Redirect to the PIN entry page
       window.location.href = "pinentry.html";
   }

  
    function resendCode() {
        
        alert("Code resent! Check your email or phone.");
        // Optionally, you can show a success message or handle the resend process as needed
    }

    function submitPinEntryForm() {
       
        // Redirect to the update password page
        window.location.href = 'updatepassword.html'; // Change 'update-password.html' to the actual page URL
    }
    // foodmanagement.js

function submitUpdatePasswordForm() {
    
    
    // Redirect to the buyer-seller login page
    window.location.href = 'buyerand seller log in.html'; // Replace 'login.html' with the actual URL of your login page
}


function loginBuyer() {
   
    // Redirect to the "about us" page
    window.location.href = 'aboutus.html'; // Replace 'aboutus.html' with the actual URL of your "about us" page
}
function loginSeller() {
    // Add your login logic here if needed

   
    window.location.href = 'seller_aboutus.html';
}

function showItems(category) {
    var itemsContainer = document.getElementById('itemsContainer');
    
    // Clear the existing content
    itemsContainer.innerHTML = '';

    // Create and display items based on the selected category
    if (category === 'food') {
       
        var foodItems = ['Food Item 1', 'Food Item 2', 'Food Item 3'];
        for (var i = 0; i < foodItems.length; i++) {
            var itemDiv = document.createElement('div');
            itemDiv.textContent = foodItems[i];
            itemsContainer.appendChild(itemDiv);
        }
    } else if (category === 'waste') {
       
        var wasteItems = ['Waste Item 1', 'Waste Item 2', 'Waste Item 3'];
        for (var j = 0; j < wasteItems.length; j++) {
            var itemDiv = document.createElement('div');
            itemDiv.textContent = wasteItems[j];
            itemsContainer.appendChild(itemDiv);
        }
    }
}
