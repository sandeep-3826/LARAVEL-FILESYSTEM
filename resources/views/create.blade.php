@extends('layouts.master')

@section('title' | 'Create User')

@section('content')

    <div style="margin-top: 10px; margin-bottom: 10px;">
        <a href="{{ URL('/') }}" type="button" class="btn btn-success">Back (Users List)</a>
    </div>
    <form method="POST" id="create_user_form" action="#">

        <div class="form-group">
            <label for="email">First Name*</label>
            <input type="text" class="form-control" id="first_name" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="pwd">Last Name*</label>
            <input type="text" class="form-control" id="last_name" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="pwd">Email*</label>
            <input type="email" class="form-control" id="email" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="pwd">Password*</label>
            <input type="password" class="form-control" id="password" autocomplete="off">
        </div>
        
        <button type="button" class="btn btn-success" onclick="return onSubmitHandler()">Submit</button>

    </form>

@endsection

<script type="text/javascript">
    
    onSubmitHandler = async () => {

        let first_name = document.getElementById('first_name').value;
        let last_name = document.getElementById('last_name').value;
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;

        //simple alert validation msg
        if (first_name == '' || last_name == '' || email == '' || password == '') {
            alert('All fields are required');
            return;
        }

        const data = {
            first_name : first_name,
            last_name : last_name,
            email : email,
            password : password
        }

        try {
            const result = await fetch('http://127.0.0.1:8000/api/auth/register' , {
                method : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })

            if (result.status == 200) {
                alert('Record has been created successfully');
                window.location = "http://127.0.0.1:8000";
                return;
            }

        } catch (error) {
            alert('Something went wrong! please try later');
            return;
        }

    }

</script>