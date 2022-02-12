@include('dashboard/components/header')

<body data-theme="default" data-layout="fluid" data-sidebar-position="right" data-sidebar-behavior="sticky">
    <div class="wrapper">

        @include('dashboard/components/sidebar')

        <main class="content">
            <div class="container-fluid p-0">

                <div class="row mb-2 mb-xl-3">
                    <div class="col-auto d-none d-sm-block">
                        <h3>لوحة التحكم</h3>
                    </div>

                    <div class="col-auto ms-auto text-end mt-n1">
                        <span class="dropdown me-2">
                            <button class="btn btn-light bg-white shadow-sm dropdown-toggle" id="day" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="align-middle mt-n1" data-feather="calendar"></i> اليوم
                            </button>
                        </span>

                        <button class="btn btn-primary shadow-sm">
                            <i class="align-middle" data-feather="filter">&nbsp;</i>
                        </button>
                        <button class="btn btn-primary shadow-sm">
                            <i class="align-middle" data-feather="refresh-cw">&nbsp;</i>
                        </button>
                    </div>
                </div>

                @if(session()->has('categoryCreated'))
                    <div class="alert alert-success alert-dismissible" id="successAlert"  role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-message">
                            <strong> اهلا {{ Auth::user()->name }} </strong> {{session()->get('categoryCreated')}}
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12 col-lg-12 d-flex">
                        <div class="card flex-fill w-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0"> اضافة تصنيف جديد </h5>
                            </div>
                            <div class="card-body d-flex w-100">
                                <form action="{{ route('categoriesForm') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="custom-form-field row">
                                        <div class="form-group col-6">
                                            <label for="name" class="mb"> اسم التصنيف </label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="ادخل اسم التصنيف هنا">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="image" class="mb"> صورة  التصنيف </label>
                                            <input type="file" name="image" id="image" class="form-control" placeholder="ادخل صورة التصنيف هنا">
                                        </div>

                                        <div class="form-group col-12">
                                            <label for=""></label>
                                            <button type="submit" name="saveCategoryBtn" class="btn btn-primary"> اضافة التصنيف </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        @include('dashboard/components/footer')
