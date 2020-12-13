@extends('backend.layouts.admin_master')

@section('content')
<!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item">
                            <a href="{{url('admin/dashboard')}}" class="text-white">Home</a>
                        </li>
                        <li class="breadcrumb-item">Product</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!--Widget-4 -->
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="d-flex justify-content-between m-0">Add Product
                        <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-primary waves-effect"><i class="  mdi mdi-arrow-left-thick"></i> Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-row">
                            <div class="form-group col-md-4">
                               <label>Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="product_name" class="form-control" placeholder="product name" required>
                                @error('product_name')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                               <label>Product Code <span class="text-danger">*</span></label>
                               <input type="text" name="product_code" class="form-control" placeholder="product code" required>
                               @error('product_code')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Product Price <span class="text-danger">*</span></label>
                                <input type="number" name="product_price" class="form-control" placeholder="product price" required>
                                @error('product_price')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                               <label>Product Quantity <span class="text-danger">*</span></label>
                                <input type="number" name="product_quantity" class="form-control" placeholder="product quantity" required>
                                @error('product_quantity')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                               <label>Category<span class="text-danger">*</span></label>
                               <select name="category" class="form-control" required>
                                   <option value="">Choose One</option>
                                   @foreach($Category as $value)
                                   <option value="{{$value->id}}">{{ucwords($value->name)}}</option>
                                   @endforeach
                               </select>
                                @error('category')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Product Brand <span class="text-danger">*</span></label>
                                <select name="brand" class="form-control" required>
                                   <option value="">Choose One</option>
                                   @foreach($Brand as $value)
                                   <option value="{{$value->id}}">{{ucwords($value->name)}}</option>
                                   @endforeach
                                </select>
                                @error('brand')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                               <label>Short Description<span class="text-danger">*</span></label>
                                <textarea name="short_description" id="editorOne" class="form-control"></textarea>
                                @error('short_description')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Long Description<span class="text-danger">*</span></label>
                                <textarea name="long_description" id="editorTwo" class="form-control"></textarea>
                                @error('long_description')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Main Thumbnail<span class="text-danger">*</span></label><br>
                                <input type="file" name="image_thumbnail" required><br>
                                @error('image_thumbnail')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Product Gallery</label><br>
                                <input type="file" name="image_gallery_one" required><br>
                                @error('image_gallery_one')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Product Gallery</label><br>
                                <input type="file" name="image_gallery_two" required><br>
                                @error('image_gallery_two')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" name="publish" value="1" class="form-check-input" id="publish">
                            <label class="form-check-label pl-0" for="publish">Publish</label>
                            @error('publish')
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm mt-4">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@push('swetalertjs')

    <script>
        $('#editorOne').summernote({
            height: 120
        });

        $('#editorTwo').summernote({
            height: 120
        });
    </script>

@endpush
