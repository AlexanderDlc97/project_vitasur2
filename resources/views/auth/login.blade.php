<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITASUR | INICIAR SESIÓN</title>
    <link rel="icon" href="/images/icon.png">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .img_login
        {
            background-image: url(/images/login-background.jpg);
            background-size: cover;
            object-fit: cover;
            width: auto;
            height: 100vh;
            /* border-radius: 30px 0 30px 0; */
        }

        .icon_login{
            width: 150px;
            height: auto;
        }
        
    </style>
</head>
<body class="">
    <section>
        <div class="row g-0">
           <div class="col-12 col-md-5 col-lg-4 d-flex vh-100">
            <div class="row g-0 justify-content-center align-self-center w-100">
                <div class="col-12 col-lg-10">
                    <div class="card border-0 bg-transparent align-self-center">
                        <div class="card-body">
                             <div class="text-center">
                                <img src="/images/icon.png" class="icon_login" alt="">
                            </div> 
                            <div class="py-4 text-center">
                                <h3 class="fw-bold text-uppercase">Iniciar Sesión</h3>
                                <span class="text-center">Por favor inicie sesión en su cuenta</span>         
                            </div>
                            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                                @csrf
                                <div class="pb-3">
                                    <label for="email_id" class="form-label">Correo Electrónico</label>
                                    <input id="email" type="email" class="form-control border-dark @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email" autofocus>                             
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="pb-3">
                                    <label for="password_id" class="form-label">Contraseña</label>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" id="password" class="form-control border-dark border-end-0 @error('password') is-invalid @enderror" required maxlength="16" autocomplete="current-password">
                                        <span class="input-group-text border-start-0 px-2 border-dark" style="background-color: transparent;"><i class="bi bi-lock-fill icono" style="cursor: pointer"></i></span>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="mt-3">
                                    <button type="submit" class="w-100 btn btn-info fw-bold text-uppercase">Iniciar Sesion</button>
                                </div>
                            </form>
                                               
                        </div>
                    </div>
                </div>
            </div>
           </div>
            <div class="col-12 col-md-7 col-lg-8 d-none d-md-block">
                <div class="img_login d-flex">
                    <div class="pt-3 ms-3 pb-2 align-self-end text-center">
                        <small class="text-white">Copyright © <?php echo date("Y");?>  <a href="{{url('/')}}" class="text-decoration-none link-light fw-bold">VITASUR</a> - Todos los derechos reservados</small>
                    </div>
                </div>
            </div>            
       </div>
    </section>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="/js/select2.min.js"></script>
    <script>
        const   pass = document.getElementById("password"),
                icon = document.querySelector(".icono");
        icon.addEventListener("click", e => {
            if (password.type === "password"){
                password.type = "text";
                icon.classList.remove('bi-lock-fill');
                icon.classList.add('bi-unlock-fill');
            }else{
                password.type = "password";
                icon.classList.add('bi-lock-fill');
                icon.classList.remove('bi-unlock-fill');
            }
        })
    </script>
</body>
</html>