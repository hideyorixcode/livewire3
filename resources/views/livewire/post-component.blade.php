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
                        <table class="table table-bordered table-striped mt-4">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Body</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            @forelse ($posts as $post)
                                <tbody wire:key="{{ $post->id }}">
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td> {{ $post->title }}</td>
                                    <td> {{ $post->body }}</td>
                                    <td>

                                        <button data-bs-toggle="modal" data-bs-target="#formModal"
                                                wire:click="edit({{ $post->id }})"
                                                class="btn btn-primary btn-sm">Edit
                                        </button>

                                        <span
                                            onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                            wire:click="delete({{ $post->id }})" class="cursor-pointer">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                 width="16" height="16"
                                                                                 fill="currentColor" class="bi bi-trash"
                                                                                 viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                                                <path
                                                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                                            </svg>
                                                                        </span>
                                    </td>
                                </tr>
                                </tbody>
                            @empty
                                <p>No post found</p>
                            @endforelse
                        </table>
                        {{ $posts->links() }}
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
