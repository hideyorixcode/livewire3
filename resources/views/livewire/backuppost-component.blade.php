<div>
    <div class="row g-1">
        <div class="col-12">
            @component('components.alert')
            @endcomponent
        </div>

        <div class="col-12 d-flex justify-content-end mb-5">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal"
                    wire:click="create">
                <i class="fas fa-fw fa-plus"></i> <span class="">Tambah</span>
            </button>
        </div>


        <div class="col-12">
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
                                       <span wire:click="edit({{ $post->id }})" class="cursor-pointer"><svg
                                               xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                               fill="currentColor"
                                               class="bi bi-pencil cursor-pointer" viewBox="0 0 16 16">
                                               <path
                                                   d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                           </svg>
                                       </span>

                            <span
                                onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                wire:click="delete({{ $post->id }})" class="cursor-pointer">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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
    @if ($isOpen)
        <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-bg-dark">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $postId ? 'Edit Post' : 'Create Post' }}
                        </h5>
                        <svg wire:click="closeModal" xmlns="http://www.w3.org/2000/svg" width="32"
                             height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </div>
                    <div class="modal-body">

                        <form wire:submit.prevent="{{ $postId ? 'update' : 'store' }}">

                            <div class="form-group">
                                <label for="title">Post Title</label>
                                <input type="text" class="form-control @error('form.title') is-invalid @enderror"
                                       wire:model="form.title" id="title" placeholder="Enter post title">
                                @error('form.title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="body">Post Body</label>
                                <textarea class="form-control @error('form.body') is-invalid @enderror"
                                          wire:model="form.body" id="body"
                                          rows="4" placeholder="Enter post body"></textarea>
                                @error('form.body')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">
                                {{ $postId ? 'Update' : 'Create' }}
                            </button>
                            <button type="button" wire:click="closeModal"
                                    class="btn btn-secondary mt-4">Close
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
