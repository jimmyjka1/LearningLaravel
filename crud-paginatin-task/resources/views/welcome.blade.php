<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


    <!-- Styles -->
    <style>

    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }


        a {
            cursor: pointer;
        }

        * {
            /* outline: 1px solid rgba(0, 0, 0, 0.082) */
        }

        .error-help-block {
            color: red;
        }

    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center flex-column">
        <h1 class="center">Products</h1>

        <div class="form-container d-flex justify-content-between align-items-between w-100 px-5">

            <div class="w-25">
                <select name="num_rows" id="input_num_rows" class="form-select">
                    <option value="10" @selected($num_rows == 10)>10</option>
                    <option value="20" @selected($num_rows == 20)>20</option>
                    <option value="50" @selected($num_rows == 50)>50</option>
                    <option value="100" @selected($num_rows == 100)>100</option>
                    <option value="200" @selected($num_rows == 200)>200</option>
                </select>
            </div>
            <div class="paginationContainer">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id="pagination-list">
                        {{-- <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li> --}}

                    </ul>
                </nav>
            </div>
            <div class="w-25 d-flex justify-content-center align-items-center">
                <input type="search" class="form-control d-inline-block" placeholder="Search ..">
                <button class="btn btn-outline-secondary">Search</button>
            </div>
        </div>
        <div class="table-container w-75 my-3">
            <table class="table table-striped">
                <tr>
                    <th onclick="">
                        ID
                        @if ($sort_column == 'id')
                            <span id="sort">
                                @if ($sort_direction == 'ASC')
                                    <i class="bi bi-sort-down" id="sort-down"></i>
                                @else
                                <i class="bi bi-sort-up" id="sort-up"></i>
                                @endif
                            </span>
                        @endif
                    </th>
                    <th>
                        Name
                        @if ($sort_column == 'name')
                            <span id="sort">
                                @if ($sort_direction == 'ASC')
                                    <i class="bi bi-sort-down" id="sort-down"></i>
                                @else
                                    <i class="bi bi-sort-up" id="sort-up"></i>
                                @endif
                            </span>
                        @endif
                    </th>
                    <th>
                        Brand
                    </th>
                    <th>
                        Category
                    </th>
                    <th>
                        Stock
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Image
                    </th>
                    <th>
                        Description
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                <tbody id='data-items'>

                </tbody>
            </table>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newModel"
                onclick="$('#save_product_button').attr('onclick', 'create_new()');">Add New Product</button>
        </div>
    </div>



    <div class="modal fade" id="newModel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modal-heading">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="product_form">
                        <div class="mb-3">
                            <label for="input_name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="input_name" name="name">
                            <span class="text-danger" id='name_error'></span>
                        </div>
                        <div class="mb-3">
                            <label for="input_brand" class="col-form-label">Brand</label>
                            <select name="brand_id" id="input_brand" class="form-select">
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id='brand_id_error'></span>
                        </div>
                        <div class="mb-3">
                            <label for="input_category" class="col-form-label">Category</label>
                            <select name="category_id" id="input_category" class="form-select">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id='category_id_error'></span>
                        </div>


                        <div class="mb-3">
                            <label for="input_stock" class="col-form-label">Stock:</label>
                            <input type="" class="form-control" id="input_stock" name="stock">
                            <span class="text-danger" id='stock_error'></span>
                        </div>

                        <div class="mb-3">
                            <label for="input_price" class="col-form-label">Price:</label>
                            <input type="text" class="form-control" id="input_price" name="price">
                            <span class="text-danger" id='price_error'></span>
                        </div>

                        <div class="mb-3">
                            <label for="input_file" class="col-form-label">Image</label>
                            <input type="file" class="form-control" id="input_file" name="image_file">
                            <span class="text-danger" id='image_file_error'></span>
                        </div>

                        <div class="mb-3">
                            <label for="input_description" class="col-form-label">Description:</label>
                            <textarea class="form-control" id="input_description" name="description"></textarea>
                            <span class="text-danger" id='description_error'></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="create_new()"
                        id="save_product_button">Save</button>
                </div>
            </div>
        </div>
    </div>
</body>


<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
{{-- {!! JsValidator::formRequest('App\Http\Requests\ProductCreateRequest', '#product_form') !!} --}}
<script>
    global_num_rows = {{ $num_rows }};
    global_page = {{ $page }};
    global_sort_column = "{{ $sort_column }}";
    global_sort_direction = "{{ $sort_direction }}";

    $("#input_num_rows").change(function(e) {
        global_num_rows = this.value
        load_all_product();

    })

    function update_pagination(current_page, total_pages) {
        page_container = $("#pagination-list");
        page_container.html('');
        next_disabled = (current_page >= total_pages) ? "disabled" : "";
        previous_disabled = (current_page <= 1) ? "disabled" : "";


        page_container.append('<li class="page-item ' + previous_disabled +
            '"><a class="page-link " onclick="load_all_product(null, page=' + Math.max(1, current_page - 1) +
            ')">Previous</a></li>');

        for (let index = 1; index <= total_pages; index++) {
            page_container.append('<li class="page-item ' + ((index == current_page) ? "active" : " ") +
                '"><a class="page-link " onclick="load_all_product(null, page=' + index + ')">' + index +
                '</a></li>');
        }

        page_container.append('<li class="page-item ' + next_disabled +
            '"><a class="page-link " onclick="load_all_product(null, page=' + Number(Number(current_page) + 1) +
            ')">Next</a></li>')
    }

    function setError(json) {
        if (json.errors.name != null) {
            $('#name_error').text(json.errors.name);
        }
        if (json.errors.category_id != null) {
            $('#category_id_error').text(json.errors.category_id);
        }
        if (json.errors.brand_id != null) {
            $('#brand_id_error').text(json.errors.brand_id);
        }
        if (json.errors.stock != null) {
            $('#stock_error').text(json.errors.stock);
        }
        if (json.errors.price != null) {
            $('#price_error').text(json.errors.price);
        }
        if (json.errors.image_file != null) {
            $('#image_file_error').text(json.errors.image_file);
        }
        if (json.errors.description != null) {
            $('#description_error').text(json.errors.description);
        }

        // console.log(json.errors.name);
    }

    function clear_all_errors() {
        $('#name_error').text("");
        $('#category_id_error').text("");
        $('#brand_id_error').text("");
        $('#stock_error').text("");
        $('#price_error').text("");
        $('#image_file_error').text("");
        $('#description_error').text("");
    }

    function load_all_product(num_rows = null, page = null, sort_column = null, sort_direction = null) {
        num_rows = num_rows ?? global_num_rows;
        page = page ?? global_page;
        sort_column = sort_column ?? global_sort_column;
        sort_direction = sort_direction ?? global_sort_direction;

        global_num_rows = num_rows;
        global_page = page;
        global_sort_column = sort_column;
        global_sort_direction = sort_direction

        $target = $('#data-items');
        $target.html('');
        $.get({
            url: '{{ route('product.index') }}',
            data: {
                num_rows: num_rows,
                page: page,
                sort_column: sort_column,
                sort_direction: sort_direction
            },
            success: function(json) {
                update_pagination(json.page, json.total_pages);

                global_num_rows = json.num_rows;
                global_page = json.page;
                global_sort_column = json.sort_column;
                global_sort_direction = json.sort_direction

                json.data.forEach(element => {
                    state = element.status == 1 ? 'Active' : 'Inactive';
                    row = `<tr>
                        <td>` + element.id + `
                        <td>` + element.name + `</td>
                        <td>` + element.brand.name + `</td>
                        <td>` + element.category.name + `</td>
                        <td>` + element.stock + `</td>
                        <td>` + element.price + `</td>
                        <td>Image</td>
                        <td>` + element.price + `</td>
                        <td> ` + state + ` </td>
                        <td>
                            <button class="btn btn-warning" onclick="updateProduct(` + element.id + `)">Edit</button>
                            <button class="btn btn-danger" onclick="deleteProduct(` + element.id + `)">Delete</button>
                        </td>
                    </tr>`;
                    $target.append(row);
                });

            }
        })
    }



    function create_new() {
        $('#method-type').remove();
        form = $("#product_form");
        form_data = new FormData(form[0]);
        $.ajax({
            url: '{{ route('product.store') }}',
            type: 'POST',
            data: form_data,
            success: function(response) {
                clear_all_errors();
                load_all_product();
                Swal.fire({
                    icon: 'success',
                    title: 'Product Saved',
                    showConfirmButton: false,
                    timer: 1500
                });
                $("#newModel").modal('toggle');
            },
            error: function(response) {
                setError(response.responseJSON);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }


    function updateProduct(id) {
        form = $("#product_form");
        $.get({
            url: "{{ route('product.index') }}/" + id,
            success: function(response) {
                input_name = $("#input_name");
                input_category = $("#input_category");
                input_brand = $("#input_brand");
                input_stock = $("#input_stock");
                input_price = $("#input_price");
                input_description = $("#input_description");

                input_name.val(response.name);
                input_category.val(response.category_id);
                input_brand.val(response.brand_id);
                input_stock.val(response.stock);
                input_price.val(response.price);
                input_description.val(response.description);
                save_product_button = $('#save_product_button');
                save_product_button.attr('onclick', "update('" + response.update_url + "')")
                form.append("<input id='method-type' type='hidden' name='_method' value='PUT'>");
                $("#newModel").modal('toggle');

            }

        })
    }

    function update(url) {
        form = $("#product_form");
        form_data = new FormData(form[0]);
        $.ajax({
            url: url,
            data: form_data,
            type: "POST",
            success: function(response) {
                console.log(response);
                clear_all_errors();
                Swal.fire({
                    icon: 'success',
                    title: 'Product Updated',
                    showConfirmButton: false,
                    timer: 1500
                });
                save_product_button.attr('onclick', "create_new()");
                load_all_product();


                $("#newModel").modal('toggle');

            },
            error: function(response) {
                // setError(response.responseJSON);
                console.log(response);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }

    function deleteProduct(id) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('product.index') }}/" + id,
                    type: "DELETE",
                    success: function(response) {
                        load_all_product();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    },
                    error: function(response) {
                        console.log(response);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });



            }
        })


    }

    load_all_product();
</script>

</html>
