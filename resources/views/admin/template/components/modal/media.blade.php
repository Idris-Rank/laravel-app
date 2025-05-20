<div class="relative z-50 hidden" id="modal-media">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10">
        <div class="w-full h-screen p-6">
            <div class="bg-white w-full h-full p-6 rounded-lg">
                <div class="h-full flex flex-col gap-4 justify-between">

                    <div class="flex gap-2 items-center justify-between">
                        <div class="flex gap-4 items-center">
                            <h1 class="text-2xl font-medium">Media</h1>
                            <div
                                class="group h-8 w-auto shrink-0 rounded font-semibold px-3 py-2 cursor-pointer text-indigo-500 hover:text-indigo-900 border border-indigo-500 hover:border-indigo-900 shadow-sm hover:shadow-base transition duration-300 inline-flex gap-x-1 justify-between items-center">
                                <button
                                    class="btn-open-upload-media whitespace-nowrap text-xs sm:text-sm font-medium tracking-normal">
                                    Add Media
                                </button>
                            </div>
                        </div>
                        <div>
                            <span
                                class="btn-close-media hover:bg-indigo-700 cursor-pointer block rounded-full bg-indigo-600 text-white p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12">
                                    </path>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center w-full justify-between">
                        <div>
                            <select id="media-type" name="media_type"
                                class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option>All media items</option>
                            </select>
                        </div>
                        <form method="GET">
                            <div class="flex gap-4 items-center">
                                <div>
                                    <input type="search" name="s" value="{{ request('s') ?? '' }}"
                                        autocomplete="off"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                </div>

                                <button
                                    class="group h-8 w-auto shrink-0 rounded font-semibold px-3 py-2 cursor-pointer text-indigo-500 hover:text-indigo-900 border border-indigo-500 hover:border-indigo-900 shadow-sm hover:shadow-base transition duration-300 inline-flex gap-x-1 justify-between items-center">
                                    <span
                                        class="whitespace-nowrap text-xs sm:text-sm font-medium tracking-normal">Search</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="img h-full sm:flex w-full gap-4 overflow-y-auto sm:overflow-hidden">
                        <div class="w-full h-full flex flex-col gap-4">
                            <div class="h-full overflow-hidden">
                                <div class="flex flex-col h-full scrollbar-thin overflow-y-auto pr-4">
                                    <div class="media-list grid grid-cols-12 gap-4">
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-center">
                                <div class="space-y-2">
                                    <div>
                                        <p class="text-sm">Showing <span class="showing">0</span> of <span
                                                class="count-media">0</span> media items</p>
                                    </div>
                                    <div class="flex items-center gap-2 justify-center">
                                        <button type="button" data-page="1"
                                            class="btn-load-more-media inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                            <span class="">Load more</span>
                                        </button>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
