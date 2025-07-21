<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <!-- MDBootstrap 5 CDN -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"
        rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Add this in your HTML head or just before </body> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            /* background: linear-gradient(to right, #0f2027, #203a43, #2c5364); */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border-radius: 1rem;
        }

        .form-outline input {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <h3 class="text-center mb-4">🔐Admin Login</h3>
                    <form id="loginForm" method="post">
                        <div class="form-outline mb-4">
                            <input type="text" id="username" name="username" class="form-control" required />
                            <label class="form-label" for="username">Username</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="password" name="password" class="form-control" required />
                            <label class="form-label" for="password">Password</label>
                        </div>

                        <button type="submit" id="loginBtn" class="btn btn-primary btn-block mb-4 w-100">
                            Login
                        </button>

                        <div class="text-center">
                            <a href="#">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MDB JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let loginBtn = $('#loginBtn');
                loginBtn.prop('disabled', true);
                loginBtn.html('Loading...');
                $.ajax({
                    url: 'code/logincode.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        response = JSON.parse(response);
                        console.log(response.message);
                        if (response.success) {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Login Successful',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer);
                                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                                }
                            });

                            setTimeout(() => {
                                window.location.href = response.redirect;
                            }, 2100);

                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer);
                                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                                }
                            });

                            loginBtn.prop('disabled', false);
                            loginBtn.html('Login');
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        alert('An error occurred while processing your request.');
                        loginBtn.prop('disabled', false);
                        loginBtn.html('Login');
                    }

                });
            });
        });
    </script>
</body>

</html>