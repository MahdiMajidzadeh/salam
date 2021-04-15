<div>
    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
            @include('template.messages')
            <div class="card my-4">
                <div class="card-body">
                    <form class="form-inline">
                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="شابک" wire:model="isbn">
                        <button type="submit" class="btn btn-primary mb-2" wire:click.prevent="search">جستجو</button>
                    </form>
                    <hr>
                    <form wire:submit.prevent="save">
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" class="form-control" wire:model="book.title">
                        </div>
                        <div class="form-group">
                            <label>ناشر</label>
                            <input type="text" class="form-control" wire:model="book.publisher">
                        </div>
                        <div class="form-group">
                            <label>نویسنده(ها)</label>
                            <input type="text" class="form-control" wire:model="book.authors_line">
                        </div>
                        <div class="text-center">
                            @if(!is_null($book['cover']))
                                <img src="{{$book['cover']}}" class="img-thumbnail w-25">
                            @endif
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" wire:model="cover">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">افزودن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
