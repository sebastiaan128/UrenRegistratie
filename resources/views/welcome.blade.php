<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
    <link rel="preconnect" href="https://fonts.bunny.net%22%3E/">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
.gradient-custom-2 {
background: #fccb90;

background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

background: linear-gradient(to right,  #421A9C, #421A9C, #01259D, #04A9FB);
}

    @media (min-width: 768px) {
    .gradient-form {
    height: 100vh !important;
    }
    }
    @media (min-width: 769px) {
    .gradient-custom-2 {
    border-top-right-radius: .3rem;
    border-bottom-right-radius: .3rem;
    }
    }</style>
<body>

    <section class="h-100 gradient-form" >
        <div class="container py-5 h-100 ">
          <div class="row d-flex justify-content-center align-items-center h-100 ">
          <div class="col-xl-10 pb-5 rounded-3 ">
              <div class="card rounded-3 text-black ">
                <div class="row g-0 " >
                  <div class="col-lg-6 " style="background-color: #00062B">
                    <div class="card-body p-md-5 mx-md-4">

                      <div class="text-center">
                       <img src="https://img.freepik.com/premium-vector/modern-logo-design-template_591497-151.jpg"
                          style="width: 185px;" alt="logo">
                        <h4 class="mt-1 mb-5 text-white pb-1">Welcome to the API</h4>
                      </div>

                      {{-- <form action="{{ route('authcheck') }}" method="post"> --}}
                         @csrf
                         <p class="text-white">Please login to your account</p>

                        <div class="form-outline mb-4">
                          <input type="email" id="form2Example11" class="form-control" name="email"
                            placeholder="Email" />
                          <label class="form-label" for="form2Example11"></label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="password" id="form2Example22" class="form-control" name="password" placeholder="Password"  />
                          <label class="form-label" for="form2Example22" ></label>
                        </div>
                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissble">
                            {{ Session::get('error') }}
                          <button type="button" class="btn-close py-1" style="margin-left: 80px" data-bs-dismiss="alert"></button>

                        </div>
                        @endif

                        <div class="text-center pt-1 mb-5 pb-1">
                        <button class="btn btn-light btn-block fa-lg gradient-custom-2 text-white w-50 mb-3" type="submit">Inloggen</button>
                          {{-- <a class="text-muted" href="#!">Forgot password?</a> --}}
                        </div>



                      </form>

                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                      <h4 class="mb-4">API koppeling</h4>
                      <p class="small mb-0">
                        We hebben een API-koppeling gemaakt tussen WooCommerce en Laravel. Wanneer een bestelling in WooCommerce wordt geplaatst, worden de factuurgegevens via een webhook verzonden naar Moneybird, waar ze als factuur worden weergegeven.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>
