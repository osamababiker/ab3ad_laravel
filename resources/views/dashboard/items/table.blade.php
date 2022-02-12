@include('dashboard/components/header')

<body data-theme="default" data-layout="fluid" data-sidebar-position="right" data-sidebar-behavior="sticky">
    <div class="wrapper">

        @include('dashboard/components/sidebar')

        <div class="main">

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"> جدول ادارة المنتجات  </h1>


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> ادارة المنتجات  </h5>
                                    <h6 class="card-subtitle text-muted"> بمقدورك متابعة المنتجات في التطبيق والتعديل عليها او ازالتها  </h6>
                                </div>
                                <div class="card-body">
                                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th> اسم المنتج </th>
                                                <th> سعر المنتج </th>
                                                <th>تصنيف المنتج</th>
                                                <th> صورة المنتج</th>
                                                <th> الاعدادات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td> {{ $item->price }} </td>
                                                <td>{{ $item->category->name }}</td> 
                                                <td>
                                                    <img width="150" height="150" src="{{ asset('upload/items/'. $item->image) }}" alt="">
                                                </td>
                                                <td>
                                                    <a href="javascript::void()" data-bs-toggle="modal" data-bs-target="#deleteItemModal_{{ $item->id }}"  style="color: red;"> <i class="fa fa-trash"></i> </a>
                                                    &nbsp;
                                                    <a href="javascript::void()" data-bs-toggle="modal" data-bs-target="#editItemModal_{{ $item->id }}"> <i class="fa fa-edit"></i> </a>
                                                </td>
                                            </tr>
                                            <!-- to edit item info --->
                                            @include('dashboard/items/components/editModal');
                                            <!-- to delete item -->
                                            @include('dashboard/items/components/deleteModal');
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
