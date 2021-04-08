@extends('layouts.master')

@section('title')
    Carousel UI
@endsection

@section('styles')
    <style>
        .droparea {
            width: 100%;
        }

        .dropzone {
            border: 7px dashed #fff;
            background-color: #21283b !important;
            transition: ease-in-out 0.2s;
        }

        .dragenter {
            border: 7px dashed #ff0101;
        }

        .image-files {
            position: relative;
            display: inline-block;
            vertical-align: top;
            margin: 16px;
            min-height: 100px;
        }

        .image-files img {
            border-radius: 20px;
            overflow: hidden;
            width: 120px;
            height: 120px;
            position: relative;
            display: block;
            z-index: 10;
        }

        .dropzone-image-ul {
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            overflow: auto;
        }

        .image-files {
            position: relative;
        }

        .image-files .icon-cross-thin {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 99;
            color: #fff;
            font-size: 19px;
            width: 30px;
            height: 30px;
            cursor: pointer;
            background: #ef0000;
        }

    </style>
@endsection

@section('content')
    <div class="container-full">
        <section class="content mt-100">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="droparea" id="droparea">
                                <label for="product-image" style="color: #fff;">
                                    <strong>Choose an image</strong>
                                    <span> or drag it here</span>.
                                </label>
                                
                                <input type="file" accept=".jpeg, .jpg, .png" ref="image" multiple @change="addImage2" id="product-image" style="display: none;">

                                <div v-cloak @click.self="pickImage" @drop.prevent="addImage"
                                    @dragenter.prevent="dragenter" @dragleave.prevent="dragleave" @dragover.prevent
                                    class="upload-item-list" style="display: block">
                                    <!-- UPLOAD ITEM -->
                                    <div @click.self="pickImage" class="upload-item dropzone" :class="dragndrop">
                                        <ul @click.self="pickImage" v-if="previews.length > 0" class="dropzone-image-ul">
                                            <li class="image-files" v-for="(preview, index) in previews"
                                                :key="index">
                                                <!-- UPLOAD ITEM DELETE -->
                                                <i @click.prevent="removeImage(preview)"
                                                    class="fa fa-times interactive-input-action-icon icon-cross-thin badge badge-danger">
                                                    <use xlink:href="#svg-cross-thin"></use>
                                                </i>
                                                <!-- UPLOAD ITEM DELETE -->

                                                <img :src="preview.url" alt="">
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /UPLOAD ITEM -->
                                </div>

                                <div class="popup-box-sidebar-footer mt-3">
                                    <!-- BUTTON -->
                                    <button class="btn btn-primary" @click.prevent="uploadImages">
                                        <i class="mdi mdi-upload"></i>Upload</button>
                                        {{-- {{ uploading ? "Uploading..." : "Upload" }} --}}
                                    </button>
                                    <!-- /BUTTON -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Vue ({
                el: '#droparea',

                data() {
                    return {
                        uploading: false,
                        dragndrop: "",

                        images: [],
                        previews: []
                    };
                },

                async created() {
                    await this.getImages();
                },

                methods: {
                    getImages() {
                        //Fetch uploaded images
                        let url = `/administration/api/get-images`;

                        axios
                            .get(url)
                            .then(response => {
                                this.previews = response.data.images;
                            })
                            .catch(error => {
                                console.log(error.response.data);
                            });
                    },

                    pickImage() {
                        this.$refs.image.click()
                    },

                    addImage(e) {
                        let droppedFiles = e.dataTransfer.files;
                        if(!droppedFiles) return;

                        var imageType = ["image/jpeg", "image/jpg", "image/png", "image/jfif"];

                        // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
                        ([...droppedFiles]).forEach(f => {
                            if(imageType.indexOf(f.type) === -1) {
                                Swal.fire({
                                    type: "error",
                                    title: "Something Went Wrong!",
                                    text: "Unsupported image type; Should support: jpg, jpeg, jfif, png",
                                });
                            } else {
                                if (this.images.length >= 8) {
                                    Swal.fire({
                                        type: "error",
                                        title: "Something Went Wrong!",
                                        text: "Cannot exceed 8 images",
                                    });
                                    return;
                                }

                                this.images.push(f);
                                this.readFile(f);
                            }
                        });
                    },

                    addImage2(e) {
                        var imageType = ["image/jpeg", "image/jpg", "image/png", "image/jfif"];

                        let self = this;
                        let images = e.target.files;

                        for (let i = 0; i < images.length; i++) {
                            if(imageType.indexOf(images[i].type) === -1) {
                                Swal.fire({
                                    type: "error",
                                    title: "Something Went Wrong!",
                                    text: "Unsupported image type; Should support: jpg, jpeg, jfif, png",
                                });
                                continue;
                            }

                            if (this.images.length >= 8) {
                                Swal.fire({
                                    type: "error",
                                    title: "Something Went Wrong!",
                                    text: "Cannot exceed 8 images",
                                });
                                return;
                            }

                            this.images.push(images[i]);
                            this.readFile(images[i]);
                        }
                    },

                    readFile(file) {
                        let self = this;
                        const reader = new FileReader();

                        reader.readAsDataURL(file);
                        reader.onload = e => {
                            self.previews.push({
                                type: 'nUploaded',
                                url: e.target.result,
                                file: file
                            });
                        };
                    },

                    removeImage(image){
                        //return;
                        if (image.type == 'nUploaded') {
                            //alert(key)
                            //let img = this.images[key]
                            this.images = this.images.filter(f => {
                                return f != image.file;
                            });

                            this.previews = this.previews.filter(f => {
                                return f.file != image.file;
                            });
                        } 
                        
                        else if (image.type == 'yUploaded') {
                            if (this.previews.length <= 2) {
                                Swal.fire({
                                    type: "warning",
                                    title: "Something Went Wrong!",
                                    text: "A minimum of 2 images is required!"
                                });
                                return;
                            }

                            let self = this;
                
                            Swal.fire({
                                title: "Delete This Preview?",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes, delete!"
                            }).then(result => {
                                if (result.value) {
                                    let url = `/administration/api/delete-image/${image.id}`;
                                    let image_id = image.id;

                                    axios.post(url, { image_id })
                                    .then((response) => {
                                        Swal.fire({
                                            type: "success",
                                            title: "Successfully deleted image!"
                                        });

                                        return self.getImages();
                                    })
                                    .catch((error) => {
                                        Swal.fire({
                                            type: "error",
                                            title: "Something Went Wrong!"
                                        });
                                    });
                                }
                            });
                        }

                        else {
                            Swal.fire({
                                type: "error",
                                title: "Something Went Wrong!",
                                text: "Cannot delete image",
                            });
                        }
                    },

                    dragenter() {
                        this.dragndrop = 'dragenter'
                    },

                    dragleave() {
                        this.dragndrop = 'dragleave'
                    },

                    async uploadImages() {
                        this.uploading = true;
                        let timerInterval;

                        let url = `/administration/api/upload-images`;

                        let formData = new FormData();

                        if (this.images.length < 2) {
                            Swal.fire({
                                type: "info",
                                title: "Missing Product Images!",
                                text: "Images help buyers evaluate your product more. Include at least 2 images to proceed",
                            });

                            this.uploading = false;
                            return;
                        }

                        
                        for (let i = 0; i < this.images.length; i++) {
                            formData.append("images[]", this.images[i]);
                        }

                        let headers = { "Content-Type": "multipart/form-data" };
                            
                        axios
                            .post(url, formData, { headers })
                            .then(response => {
                                this.adding = false;

                                Swal.fire({
                                    type: "success",
                                    title: "Successfully uploaded images!"
                                })
                            })
                            .catch(error => {
                                this.uploading = false;
                                Swal.fire({
                                    type: "error",
                                    title: "Something Went Wrong!",
                                    text: "Could not upload images",
                                });
                            });
                    },
                }
            });
        });
     </script>
@endsection
