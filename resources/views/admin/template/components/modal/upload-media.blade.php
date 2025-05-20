<div class="relative z-50 hidden" id="modal-upload-media">
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative space-y-4 transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:py-6 sm:px-8">
                <div class="space-y-3">
                    <div class="text-center space-y-4">
                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">Upload Media</h3>
                        <div class="border-2 border-gray-300 border-dashed rounded-lg py-4 space-y-4">
                            <div class="flex items-center justify-center w-full">
                                <label for="input-media"
                                    class="flex flex-col items-center justify-center w-full cursor-pointer dark:hover:bg-gray-800 dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click to
                                                upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                                            (MAX. 800x400px)</p>
                                    </div>
                                    <input id="input-media" name="input_media[]" type="file" multiple
                                        class="hidden" />
                                </label>

                            </div>
                            <div id="preview-media" class="hidden flex gap-2 items-center flex-wrap justify-center">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                    <button type="button"
                        class="btn-upload-media inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2"><span>Upload</span></button>
                    <button type="button"
                        class="btn-cancel-media-upload mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
