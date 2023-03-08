//Play sound when they add to cart

var x = document.getElementById("myAudio"); 

function playAudio() { 
  x.play(); 
} 

function checkPassword() {
    
    // Form Validation

    const passwordRegexLength = new RegExp('.{8,}');
    const passwordRegexDigit = new RegExp('.*[0-9].*');

    var errorTag = document.getElementById("errorMessage");
    var password = document.getElementById("password").value;
    var checkpassword = document.getElementById("checkpassword").value;
    var createButton = document.getElementById("createaccount");
    errorTag.innerText = '';

    if(passwordRegexLength.test(password) && passwordRegexDigit.test(password) && password === checkpassword){
        //password Vailid
        createButton.disabled = false;
        
    }
    else{
    // Password invalid
        if(!passwordRegexLength.test(password)){
            //messages.push('Password must be at Least 6 characters')
            errorTag.innerText += '*Password must be 8 characters long. ';
        }
        if (!passwordRegexDigit.test(password)) {
            errorTag.innerText += ' *Password must contain a number. ';
        }
        if (password !== checkpassword) {
            errorTag.innerText += ' *Password and "Verify Password" do not match.';
        }
        createButton.disabled = true;
    }
}