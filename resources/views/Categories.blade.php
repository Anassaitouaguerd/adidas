<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Soft UI Dashboard by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('partials/_side')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials/_nav')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12 mb-lg-0 mb-4">
                            <div class="card mt-4">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                            <h6 class="mb-0">Payment Method</h6>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button type="button" class="btn bg-gradient-dark mb-0"
                                                data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                                <i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Categorie
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- modal to add new categories --}}

                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="new_category" method="POST" class="mt-4">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="name">Category Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" placeholder="Enter category name">
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- end madale add new categoris --}}
                                <div class="card-body p-3">
                                    <h4 class="mb-3 text-sm">Name categories</h4>
                                    <div class="card-body pt-4 p-3">
                                        <ul class="list-group">
                                            @foreach ($all_categories as $category)
                                                <li
                                                    class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                    <div class="d-flex flex-column">
                                                        <h5 class="mb-3 text-sm"> {{ $category->name }}</h5>
                                                    </div>
                                                    <div class="ms-auto text-end">
                                                        <button
                                                            class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modaleDelete{{ $category->id }}">
                                                            <i class="far fa-trash-alt me-2"></i>Delete
                                                        </button>
                                                        <button class="btn btn-link text-dark px-3 mb-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modaleUpdate{{ $category->id }}">
                                                            <i class="fas fa-pencil-alt text-dark me-2"></i>Edit</a>
                                                        </button>
                                                    </div>
                                                    {{-- modal to update categories --}}

                                                    <div class="modal fade" id="modaleUpdate{{ $category->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="modaleUpdatetitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLongTitle">
                                                                        Modal title</h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="update_category" method="POST"
                                                                        class="mt-4">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            value="{{ $category->id }}"
                                                                            name="id">
                                                                        <div class="form-group">
                                                                            <label for="name">Category Name</label>
                                                                            <input type="text"
                                                                                value="{{ $category->name }}"
                                                                                class="form-control" id="name"
                                                                                name="name"
                                                                                placeholder="Enter category name">
                                                                        </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save changes</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- end madale update categories --}}


                                                    {{-- modal to delete categories --}}

                                                    <div class="modal fade" id="modaleDelete{{ $category->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="modaleDeleteTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modaleDeleteTitle">
                                                                        Confirm Deletion</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to delete this category?
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <form action="delete_category" method="POST">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            value="{{ $category->id }}"
                                                                            name="id">
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- end modal to delete categories --}}


                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('partials/_footer')

                
            </div>
    </main>

    <!--   Core JS Files   -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>
