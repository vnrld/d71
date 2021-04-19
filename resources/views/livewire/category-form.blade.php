<div>
    <h2>List of categories</h2>

    <table id="list-categories-table">
        @foreach($categories as $category)
            <tr>
                <td>{{$category->getName()}}</td>
                <td>
                    <button wire:click="deleteCategory({{ $category->getId() }})">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
    <form id="new-category" wire:submit.prevent="submit">

        <h2>Add a category</h2>

        <div class="form-group">
            <label for="category-name">Name</label>
            <input type="text" class="form-control" id="category-name" placeholder="Enter name" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn-blue btn-primary">Save</button>

    </form>
</div>
