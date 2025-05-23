<div
                class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-xs sm:gap-x-6 sm:px-6 lg:px-8">
                <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- Separator -->
                <div class="h-6 w-px bg-gray-900/10 lg:hidden" aria-hidden="true"></div>

                <div class="flex flex-1 justify-end gap-x-4 self-stretch lg:gap-x-6">
                    <div class="flex items-center gap-x-4 lg:gap-x-6">

                        <!-- Profile dropdown -->
                        <div class="relative">
                            <button type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button"
                                aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="size-8 rounded-full bg-gray-50"
                                    src="{{ Auth::user() ? get_media(Auth::user()->image_id) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                                    alt="">
                                <span class="hidden lg:flex lg:items-center">
                                    <span class="ml-4 text-sm/6 font-semibold text-gray-900" aria-hidden="true">{{ Auth::user() ? Auth::user()->name : '' }}</span>
                                    <svg class="ml-2 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>
                            <div class="absolute hidden right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-hidden"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1">
                                <!-- Active: "bg-gray-50 outline-hidden", Not Active: "" -->
                                <a href="#" class="block px-3 py-1 text-sm/6 text-gray-900" role="menuitem"
                                    tabindex="-1" id="user-menu-item-0">Your profile</a>
                                <a href="#" class="block px-3 py-1 text-sm/6 text-gray-900" role="menuitem"
                                    tabindex="-1" id="user-menu-item-1">Sign out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>