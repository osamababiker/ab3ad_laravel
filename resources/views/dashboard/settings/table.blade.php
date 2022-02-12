@include('dashboard/components/header')

<body data-theme="default" data-layout="fluid" data-sidebar-position="right" data-sidebar-behavior="sticky">
    <div class="wrapper">

        @include('dashboard/components/sidebar')

        <div class="main">

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"> جدول بيانات التطبيق </h1>

                    @if(session()->has('settingsUpdated'))
                        <div class="alert alert-success alert-dismissible" id="successAlert"  role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-message">
                                <strong> اهلا {{ Auth::user()->name }} </strong> {{session()->get('settingsUpdated')}}
                            </div>
                        </div>
                    @endif


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> ادارة بيانات التطبيق </h5>
                                    <h6 class="card-subtitle text-muted"> بمقدورك التعديل على بيانات الماركات وصورها في التطبيق او حتى حذفها </h6>
                                </div>
                                <div class="card-body">
                                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>اسم التطبيق</th>
                                                <th>  اصدار التطبيق</th>
                                                <th> رقم الهاتف </th>
                                                <th>  الايميل </th>
                                                <th>  العنوان </th>
                                                <th> سياسة الاستخدام </th>
                                                <th>ادارة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $info->appName }}</td>
                                                <td>{{ $info->appVersion }}</td>
                                                <td>{{ $info->phone }}</td>
                                                <td>{{ $info->email }}</td>
                                                <td>{{ $info->address }}</td>
                                                <td>{{ $info->policy }}</td>
                                                <td>
                                                    <a href="javascript::void()" data-bs-toggle="modal" data-bs-target="#editInfoModal_{{ $info->id }}"> <i class="fa fa-edit"></i> </a>
                                                </td>
                                            </tr>
                                            <!-- Start Edit settings modal -->
                                            @include('dashboard/settings/components/editModal')
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            @include('dashboard/components/footer')
