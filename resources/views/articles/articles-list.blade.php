<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table id="articles-list" style="border: #718096">
                        <tr>
                            <td>Title</td><td>Created At</td><td>Publish At</td><td></td><td></td>
                        </tr>
                        @foreach($articles as $article)
                            <tr>
                            <td>{{$article->getTitle()}}</td>
                            <td>{{$article->getCreatedAt()}}</td>
                            <td>{{$article->getPublishAt()}}</td>
                            <td><a href="{{url('articles/' . $article->getId())}}">Edit</a></td>
                            <td><a href="{{url('articles/preview/' . $article->getId())}}">Preview</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
