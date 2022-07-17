<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>أبعاد - تسجيل دخول</title>
    <link rel="shortcut icon" href="img/favicon.ico">

    <link class="js-stylesheet" href="{{ asset('dashboard/css/ar-light.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ asset('dashboard/css/custom.css') }}" rel="stylesheet">
</head>


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="main d-flex justify-content-center w-100">
        <main class="content d-flex p-0">
            <div class="container d-flex flex-column">
                <div class="row h-100">
                    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">

                            <div class="text-center mt-4">
                                <h1 class="h2"> أهلا بك مجددا </h1>
                                <p class="lead">
                                    الرجاء تسجيل الدخول للمتابعة للوحة التحكم
                                </p>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <div class="text-center">
                                            <img src="{{ asset('dashboard/img/logo.jpg') }}" alt="Chris Wood"
                                                class="img-fluid rounded-circle" width="132" height="132" />
                                        </div>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">الايميل</label>
                                                <input class="form-control form-control-lg" type="email" name="email"
                                                    placeholder="الرجاء ادخال الايميل هنا" required autofocus />
                                                @if ($errors->has('email'))
                                                    <p class="alert alert-danger text-right">{{ $errors->first('email') }}</p>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">كلمة المرور</label>
                                                <input class="form-control form-control-lg" type="password"
                                                    name="password" placeholder="الرجاء ادخال كلمة المرور" />
                                                    @if ($errors->has('password'))
                                                        <p class="alert alert-danger text-right">{{ $errors->first('password') }}</p>
                                                    @endif
                                                @if (Route::has('password.request'))
                                                <small>
                                                    <a href="{{ route('password.request') }}"> نسيت كلمة المرور ؟ </a>
                                                </small>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="form-check align-items-center">
                                                    <input id="customControlInline" type="checkbox"
                                                        class="form-check-input" value="remember-me" name="remember-me"
                                                        checked>
                                                    <label class="form-check-label text-small"
                                                        for="customControlInline"> تذكرني </label>
                                                </div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <button type="submit" class="btn btn-lg btn-primary"> تسجيل دخول </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="js/app.js"></script>

</body>

</html>
