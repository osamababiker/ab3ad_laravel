@include('dashboard/components/header')

<body data-theme="default" data-layout="fluid" data-sidebar-position="right" data-sidebar-behavior="sticky">
    <div class="wrapper">

        @include('dashboard/components/sidebar')

        <div class="main">

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"> جدول ادارة التصنيفات </h1>


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> ادارة التصنيفات </h5>
                                    <h6 class="card-subtitle text-muted"> بمقدورك التعديل على بيانات التصنيف وصوره في التطبيق او حتى حذفه </h6>
                                </div>
                                <div class="card-body">
                                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>اسم التصنيف</th>
                                                <th>صورة التصنيف</th>
                                                <th>ادارة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <a target="_blank" href="{{ asset('upload/categories/'.$category->image) }}">
                                                        <img src="{{ asset('upload/categories/'.$category->image) }}" width="100" height="100" alt="">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="javascript::void()" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal_{{ $category->id }}"  style="color: red;"> <i class="fa fa-trash"></i> </a>
                                                    &nbsp;
                                                    <a href="javascript::void()" data-bs-toggle="modal" data-bs-target="#editCategoryModal_{{ $category->id }}"> <i class="fa fa-edit"></i> </a>
                                                </td>
                                            </tr>
                                            <!-- to edit categories info --->
                                            @include('dashboard/categories/components/editModal');
                                            <!-- to delete categories -->
                                            @include('dashboard/categories/components/deleteModal');
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            @include('dashboard/components/footer')
