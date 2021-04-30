<x-webpage-layout>
    <div class="flex h-full bg-white rounded overflow-hidden shadow-lg">

            <div class="w-full md:w-2/3 rounded-t">
                <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                    <p class="w-full text-gray-600 text-xs md:text-sm pt-6 px-6">{{$article->getPublishAt()}}</p>
                    <div class="w-full text-xl text-gray-900 px-6">
                        <h1>{{$article->getTitle()}}</h1>
                        <p class="text-gray-800 font-serif text-base px-6 mb-5">
                            {!! $article->getHtml() !!}
                        </p>
                    </div>

                </div>

                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="Author Name"
                             src="http://i.pravatar.cc/300" alt="Avatar of Author">
                        <p class="text-gray-600 text-xs md:text-sm">1 MIN READ</p>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/3 flex flex-col flex-grow flex-shrink">

            </div>


    </div>
</x-webpage-layout>
