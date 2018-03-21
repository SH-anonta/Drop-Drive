(function(){
    function addErrorMsg(msg){
        var error_msg = document.querySelector('#error_msg');
        var li = document.createElement("li");
        li.appendChild(document.createTextNode(msg));
        error_msg.appendChild(li);
    }

    function clearErrorMsgs(){
        var error_msg = document.querySelector('#error_msg');
        error_msg.innerHTML = '';
    }

    function validateRegisterData(event){
        clearErrorMsgs();
        var all_data_valid = true;

        var uname = document.querySelector('input[name=user_name]').value;
        var email = document.querySelector('input[name=email]').value;
        var pass = document.querySelector('input[name=password]').value;
        var confirm_pass = document.querySelector('input[name=confirm_password]').value;

        if(uname == ''){
            all_data_valid = false;
            addErrorMsg('Username is required ');
        }
        if(email == ''){
            all_data_valid = false;
            addErrorMsg('Email is required');
        }
        if(pass == ''){
            all_data_valid = false;
            addErrorMsg('Password is required ');
        }
        if(confirm_pass == ''){
            all_data_valid = false;
            addErrorMsg('Confirm Password is required ');
        }
        if(pass != confirm_pass){
            all_data_valid = false;
            addErrorMsg('Passwords do not match');
        }

        if(!all_data_valid){
            event.preventDefault();
        }
        
    }

    var register_btn = document.querySelector('#RegisterForm button');
    register_btn.addEventListener('click',validateRegisterData);

})();