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

                @if(session()->has('feedback'))
                    <div class="alert alert-success alert-dismissible" id="successAlert"  role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-message">
                            <strong> اهلا {{ Auth::user()->name }} </strong> {{session()->get('feedback')}}
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12 col-lg-12 d-flex">
                        <div class="card flex-fill w-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0"> اضافة منتج جديد </h5>
                            </div>
                            <div class="card-body d-flex w-100">
                                <form action="{{ route('itemsForm') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="custom-form-field row">
                                        <div class="form-group col-md-6">
                                            <label for="name" class="mb"> اسم المنتج </label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="ادخل اسم المنتج هنا">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="categoryId">تصنيف المنتج</label>
                                            <select name="categoryId" id="categoryId" class="form-control">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="price">سعر المنتج</label>
                                            <input type="text" name="price" id="price" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="image" class="mb"> صورة  المنتج </label>
                                            <input type="file" name="image" id="image" class="form-control" placeholder="ادخل صورة المنتج هنا">
                                        </div>

                                        <div class="form-group col-12">
                                            <label for=""></label>
                                            <button type="submit" name="add_item_Btn" class="btn btn-primary"> اضافة المنتج </button>
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
