<div>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Halaman
                    </div>
                    <h2 class="page-title">
                        Posts
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                      <span class="d-none d-sm-inline">
                        <a href="#" class="btn">
                          Saring Data
                        </a>
                      </span>



                        <button href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#formModal" wire:click="create">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <i class="fas fa-fw fa-plus"></i> <span class="">Tambah</span>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-lg">


            <div class="row g-1">
                <div class="col-12">
                    @component('components.alert')
                    @endcomponent
                </div>

                <div class="card">
                    <div class="card-body">
                        <livewire:post-table tableName="table1"/>
                    </div>
                </div>


            </div>

        </div>
    </div>


    <div wire:ignore.self class="modal modal-blur fade"
         data-bs-backdrop="static"
         data-bs-keyboard="false"
         id="formModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="formModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="formSubmit" wire:submit.prevent="{{ $postId ? 'update' : 'store' }}">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white text-center" id="staticBackdropLabel">
                            {{ $postId ? 'Edit Post' : 'Create Post' }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <fieldset class="">
                            <!-- Inline Form -->
                            <div class="row g-3">
                                <div class="col-12 col-md-12 mb-1">
                                    <label for="title" class="form-label required">Judul</label>
                                    <input type="text"
                                           class="form-control @error('form.title') is-invalid @enderror"
                                           id="title"
                                           placeholder="Silahkan Masukan Judul" wire:model="form.title">
                                    <div class="invalid-feedback">
                                        @error('form.title')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 mb-1">
                                    <label for="body" class="form-label required">Konten</label>
                                    <input type="text" class="form-control @error('form.body') is-invalid @enderror"
                                           id="body"
                                           placeholder="Silahkan Masukan Konten" wire:model="form.body">
                                    <div class="invalid-feedback">
                                        @error('form.body')
                                        {{ $message }}
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </fieldset>

                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="submit"
                                class="btn btn-primary" id="submitButton">
                            <i class="fa-solid fa-paper-plane me-2"></i>{{ $postId ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    {{--    <div class="modal-backdrop fade show"></div>--}}


</div>
@push('custom_scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            var formModal = new bootstrap.Modal('#formModal');
            document.addEventListener('closeModal', () => {
                formModal.hide();
            });
        });
    </script>
@endpush
