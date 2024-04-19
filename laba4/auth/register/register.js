const modal_register = new bootstrap.Modal(document.getElementById('register_modal'));

document.addEventListener('DOMContentLoaded', (e) => {
    e.preventDefault();

    modal_register.show();

    const register_params = {
        form: document.getElementById('register_form'),
    };

    function resetErrors(){
        document.getElementById('err_reg_username').textContent = '';
        document.getElementById('err_password').textContent = '';
        document.getElementById('err_re_password').textContent = '';
    }

    function matchErrors(code){
        switch (code) {
            case 1:
            case 2:
                return 'err_reg_username';
            case 3:
                return 'err_password';
            case 4:
            case 5:
                return 'err_re_password';
        }
    }


    register_params.form.onsubmit = async (e) => {
        e.preventDefault();

        const formData = new FormData(register_params.form);


        const response = await data(formData).then(response => response.json());

        resetErrors();

        if(response.errors?.length >= 1){
            for (const error of response.errors) {
                const className = matchErrors(parseInt(error.code));
                document.getElementById(className).textContent = error.message;
            }
        }
        else{
            window.location.href = response.url;
        }
    }

    async function data(data){
        const url = 'http://localhost:63342/laba4/auth/register/validate.php';

        return await fetch(url, {
            method: 'POST',
            body: JSON.stringify(Object.fromEntries(data)),
            headers: {
                'Content-Type': 'application/json'
            }
        });
    }

});

window.onclick = e => {
    modal_register.show();
}