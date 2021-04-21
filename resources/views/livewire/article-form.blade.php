<div>
    <section class="relative py-6 bg-white bg-gray-200 min-w-screen animation-fade animation-delay">
        <div class="container h-full max-w-5xl mx-auto overflow-hidden rounded-lg shadow">
            @if ($success)
                <div class="inline-flex w-full ml-3 overflow-hidden bg-white rounded-lg shadow-sm">
                    <div class="flex items-center justify-center w-12 bg-green-500">
                    </div>
                    <div class="px-3 py-2 text-left">
                        <span class="font-semibold text-green-500">Success</span>
                        <p class="mb-1 text-sm leading-none text-gray-500">{{ $success }}</p>
                    </div>
                </div>
            @endif
            <div class="h-full sm:flex">
                <div class="flex items-center justify-center w-full p-10 bg-white">
                    <form wire:submit.prevent="submit(document.querySelector('#contents').value, document.querySelector('#articleId').value, Array.from(document.querySelector('#categoriesList').querySelectorAll('option:checked'),e=>e.value))" method="POST" class="w-full">
                        @csrf
                        <div class="pb-3">
                            @error('title')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            <input wire:model="title" class="w-full px-5 py-3 border border-gray-400 rounded-lg outline-none focus:shadow-outline" type="text" placeholder="Title" name="title" value="{{ old('title') }}" />
                        </div>
                        <div class="py-3">
                            @error('name')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            <input wire:model="intro" class="w-full px-5 py-3 border border-gray-400 rounded-lg outline-none focus:shadow-outline" type="text" placeholder="Intro" name="intro" value="{{ old('intro') }}" />
                        </div>
                        <div class="py-3" wire:ignore>
                            <select id="categoriesList" name="categoryList[]" multiple="multiple">
                                <option value="0" selected="selected">---</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->getId()}}">{{$category->getName()}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="py-3">
                            @error('contents')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            <div wire:ignore>
                                <textarea id="contents" name="contents">{{$contents}}</textarea>
                            </div>
                            <input type="hidden" name="articleId" id="articleId" value="{{$articleId}}">
                        </div>
                        <div class="py-3">
                            @error('publish_at')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            <input wire:model="publish_at" class="w-full px-5 py-3 border border-gray-400 rounded-lg outline-none focus:shadow-outline" type="text" placeholder="Date" name="publish_at" value="{{ old('publish_at') }}" />
                        </div>
                        <div class="pt-3">
                            <button class="flex px-6 py-3 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 hover:text-white focus:outline-none focus:shadow-outline focus:border-indigo-300" type="submit">
                                <span class="self-center float-left ml-3 text-base font-medium">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Initialise editors
        var contentsEditor = new SimpleMDE({ element: document.getElementById("contents") });
    </script>
</div>
