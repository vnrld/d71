<x-webpage-layout>
@php
    /**
     * @var \App\Models\Article $first
     */
    $first = $articles['first'];
@endphp
    <div class="bg-gray-200 w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t">

        <!--Lead Card-->
        <div class="flex h-full bg-white rounded overflow-hidden shadow-lg">
            <a href="{{url('/post', ['slug' => $first->getSlug()])}}" class="flex flex-wrap no-underline hover:no-underline">
                <div class="w-full md:w-2/3 rounded-t">
                    <img src="https://source.unsplash.com/collection/494263/800x600" class="h-full w-full shadow">
                </div>

                <div class="w-full md:w-1/3 flex flex-col flex-grow flex-shrink">
                    <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                        <p class="w-full text-gray-600 text-xs md:text-sm pt-6 px-6">{{$first->getPublishAt()}}</p>
                        <div class="w-full font-bold text-xl text-gray-900 px-6">
                            {{$first->getTitle()}}
                        </div>
                        <p class="text-gray-800 font-serif text-base px-6 mb-5">
                            {{$first->getIntro()}}
                        </p>
                    </div>

                    <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="Author Name"
                                 src="http://i.pravatar.cc/300" alt="Avatar of Author">
                            <p class="text-gray-600 text-xs md:text-sm">1 MIN READ</p>
                        </div>
                    </div>
                </div>

            </a>
        </div>
        <!--/Lead Card-->


        <!--Posts Container-->
        <div class="flex flex-wrap justify-between pt-12 -mx-6">

            @foreach($articles['posts'] as $posts)
                @foreach($posts as $post)
            <!--1/2 col -->
            <div class="w-full md:w-1/2 p-6 flex flex-col flex-grow flex-shrink">
                <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                    <a href="{{url('/post', ['slug' => $post->getSlug()])}}" class="flex flex-wrap no-underline hover:no-underline">
                        <img src="https://source.unsplash.com/collection/3657445/800x600"
                             class="h-full w-full rounded-t pb-6">
                        <p class="w-full text-gray-600 text-xs md:text-sm px-6">{{$post->getPublishAt()}}</p>
                        <div class="w-full font-bold text-xl text-gray-900 px-6">{{$post->getTitle()}}</div>
                        <p class="text-gray-800 font-serif text-base px-6 mb-5">
                            {{$post->getIntro()}}
                        </p>
                    </a>
                </div>
                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="Author Name"
                             src="http://i.pravatar.cc/300" alt="Avatar of Author">
                        <p class="text-gray-600 text-xs md:text-sm">1 MIN READ</p>
                    </div>
                </div>
            </div>
                    @endforeach
                @endforeach

        </div>
        <!--/ Post Content-->

    </div>


    <!--Subscribe-->
    <div class="container font-sans bg-green-100 rounded mt-8 p-4 md:p-24 text-center">
        <h2 class="font-bold break-normal text-2xl md:text-4xl">Subscribe to Ghostwind CSS</h2>
        <h3 class="font-bold break-normal font-normal text-gray-600 text-base md:text-xl">Get the latest posts delivered
            right to your inbox</h3>
        <div class="w-full text-center pt-4">
            <form action="#">
                <div class="max-w-xl mx-auto p-1 pr-0 flex flex-wrap items-center">
                    <input type="email" placeholder="youremail@example.com"
                           class="flex-1 appearance-none rounded shadow p-3 text-gray-600 mr-2 focus:outline-none">
                    <button type="submit"
                            class="flex-1 mt-4 md:mt-0 block md:inline-block appearance-none bg-green-500 text-white text-base font-semibold tracking-wider uppercase py-4 rounded shadow hover:bg-green-400">
                        Subscribe
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Subscribe-->



</x-webpage-layout>
