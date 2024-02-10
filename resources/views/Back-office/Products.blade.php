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
    @include('partials/_side');
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('partials/_nav')
        <div class="mt-4 mb-4">
            <div class="col-6 text-end">
                <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal"
                    data-bs-target="#exampleModalCenter">
                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Product
                </button>
            </div>
        </div>
        </div>
        {{-- modal to add new product --}}

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Products</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/admin/newProduct" method="POST" class="mt-4" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Product Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter product name">
                            </div>
                            <div class="form-group">
                                <label for="name">Product Description</label>
                                <textarea name="description" class="form-control" id="desc" cols="10" rows="10">
                    
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Product Price</label>
                                <input type="number" class="form-control" id="price" name="price" min="0"
                                    placeholder="Enter product price">
                            </div>
                            <div class="form-group">
                                <label for="category">Product Category</label>
                                <select class="form-select" id="category" name="category">
                                    @foreach ($all_categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end madale add new product --}}
        </div>

        <div class="container-fluid py-4 mt-4">
            <div class="row">
                @foreach ($all_product as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="Uploads/{{ $product->image }}" alt="user1">
                            <div class="card-body">
                                <h4 class="card-title">{{ $product->name }}</h4>
                                <h6>Description : </h6>
                                <p class="card-text text-secondary">{{ $product->description }}</p>
                                <h6>Price : </h6>
                                <p class="card-text text-xs font-weight-bold">{{ $product->price }} DH</p>
                                <h6>category : </h6>
                                <p class="ms-2">{{ $product->category_name }}</p>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-around align-items-center">
                                    <button class="btn btn-danger btn-sm float-end" data-bs-toggle="modal"
                                    data-bs-target="#modaleDelete{{ $product->id }}">delet</button>
                                    <button class="btn btn-secondary btn-sm float-end" data-bs-toggle="modal"
                                    data-bs-target="#updateProduct{{$product->id}}">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- modal to update product --}}

                    <div class="modal fade" id="updateProduct{{$product->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Products</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/admin/updateProduct" method="POST" class="mt-4"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{$product->id}}" name="id">
                                        <div class="form-group">
                                            <label for="name">Product Image</label>
                                            <input type="file" class="form-control" id="image"
                                                name="image">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Product Name</label>
                                            <input type="text" value="{{ $product->name }}" class="form-control" id="name" name="name"
                                                placeholder="Enter product name">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Product Description</label>
                                            <textarea name="description" class="form-control" id="desc" cols="10" rows="10">
                                                {{ $product->description }}
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Product Price</label>
                                            <input type="number" value="{{ $product->price }}" class="form-control" id="price" name="price"
                                                min="0" placeholder="Enter product price">
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Product Category</label>
                                            <select class="form-select" id="category" name="category">
                                                @foreach ($all_categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
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
                    {{-- end madale update product --}}
                    {{-- modal to delete categories --}}

                    <div class="modal fade" id="modaleDelete{{ $product->id }}"
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
                                    <form action="/admin/deletePproduct" method="POST">
                                        @csrf
                                        <input type="hidden"
                                            value="{{ $product->id }}"
                                            name="id">
                                        <button type="submit"
                                            class="btn btn-danger">Confirm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end modal to delete categories --}}
                @endforeach
            </div>
            @include('partials/_footer')
        </div>
    </main>
    <!--   Core JS Files   -->
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
