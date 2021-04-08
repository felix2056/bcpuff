@extends('layouts.master')

@section('title')
    Edit Product {{ $product->name }}
@endsection

@section('content')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Product (<strong>{{ $product->name }}</strong>)</h4>
                    </div>
                    <div class="box-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-700 font-size-16">Product Name</label>
                                            <input name="name" type="text" class="form-control"
                                                placeholder="Product Name" value="{{ $product->name }}">

                                            @error('name')
                                            <span class="alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-700 font-size-16">Product Category</label>
                                            <select name="category_id"  class="form-control">
                                                <option>Select category</option>

                                                @foreach (App\Models\Category::all() as $category)
                                                    <option value="{{ $category->id }}" @if($product->category_id ==  $category->id) selected="selected" @endif>{{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                            <span class="text text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-700 font-size-16">Price</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-money"></i></div>
                                                <input type="text" name="price" class="form-control" placeholder="15"
                                                    value="{{ $product->price }}">
                                            </div>

                                            @error('price')
                                                <span class="alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-700 font-size-16">Stock</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="ti-cut"></i></div>
                                                <input type="text" name="stock" class="form-control" value="{{ $product->stock }}" placeholder="100">
                                            </div>

                                            @error('stock')
                                            <span class="alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-700 font-size-16">Product Summary</label>
                                            <input type="text" name="summary" class="form-control" value="{{ $product->summary }}" placeholder="Enter product summary">
                                        
                                            @error('summary')
                                            <span class="alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-700 font-size-16">Product Description</label>
                                            <textarea name="description" id="ckeditor" class="form-control p-20" rows="4"
                                                placeholder="Enter product description">{{ $product->description }}</textarea>

                                            @error('description')
                                            <span class="alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->

                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="box-title mt-20">Upload Image</h4>
                                        <div class="product-img text-left">
                                            <img id="output-image" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                            <div class="btn btn-info mb-20">
                                                <span>Upload Image</span>
                                                <input type="file" name="image" accept=".jpeg, .jpg, .png" onchange="preview_image(event)" class="upload">
                                            </div>
                                        </div>

                                        @error('image')
                                        <span class="alert-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions mt-10">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>


<script>
ClassicEditor
    .create(document.querySelector('#ckeditor'))
    .then(editor => {
        console.log( editor );
    })
    .catch(error => {
        console.error( error );
    });

    function insertImage() {
        var file  = document.getElementById('blog_image').click();
    }

    function preview_image(event) 
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            var output_image = document.getElementById('output-image');
            output_image.src = reader.result;
        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection