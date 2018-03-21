(function(){
    function validateLoginData(event){
        var all_data_valid = true;

        var uname = document.querySelector('input[name=user_name]').value;
        var pass = document.querySelector('input[name=password]').value;

        var error_list = document.querySelector('#ErrorList');

        if(uname == ''){
            all_data_valid = false;
            alert('Username is required');
            console.log('Username is required');
        }
        if(pass == ''){
            all_data_valid = false;
            alert('Password is required');
            console.log('Password is required');
        }
        

        if(!all_data_valid){
            event.preventDefault();
        }
        
    }

    var login_btn = document.querySelector('#LoginForm button');
    login_btn.addEventListener('click',validateLoginData);

})();