<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="fixed z-20 inset-0 overflow-y-auto" v-if="($page.props.flash.success || $page.props.flash.error || $page.props.flash.warning) && show">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <transition
                enter-active-class="ease-out duration-300"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="ease-in duration-200"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            </transition>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <transition
                enter-active-class="ease-out duration-300"
                enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                leave-active-class="ease-in duration-200"
                leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:p-6" :class="$page.props.flash.warning?'sm:max-w-2xl':'sm:max-w-sm'" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full" :class="$page.props.flash.success?'bg-green-100':($page.props.flash.error?'bg-red-100':'bg-yellow-100')">
                        <!-- Heroicon name: outline/check -->
                        <svg v-if="$page.props.flash.success" class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>

                        <!-- Heroicon name: outline/x -->
                        <svg v-else-if="$page.props.flash.error" class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg"fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>

                        <!-- Heroicon name: outline/exclamation-triangle -->
                        <svg v-else-if="$page.props.flash.warning" class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg"fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 v-if="$page.props.flash.success" class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                            {{ $page.props.flash.success }}
                        </h3>
                        <h3 v-if="$page.props.flash.error" class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                            {{ $page.props.flash.error }}
                        </h3>
                        <div v-if="$page.props.flash.warning" class="text-lg leading-6 font-medium text-gray-900 text-left" id="modal-headline">
                            <p class="text-xs mt-4" style="color: #ff0000; line-height: normal">{{ $page.props.flash.notice }}</p>
                            <ul v-if="Object.keys($page.props.flash.warnings).length > 0" class="text-xs ml-4" style="line-height: normal; list-style: disc;">
                                <li v-for="(warning, i) in $page.props.flash.warnings">
                                    {{warning}}
                                </li>
                            </ul>
                        </div>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                <!--Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur amet labore.-->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6">
                    <inertia-link v-if="$page.props.flash.redirect" :href="$page.props.flash.redirect" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:text-sm">
                        {{ $page.props.flash.action }}
                    </inertia-link>
                    <inertia-link v-else-if="$page.props.current_route === 'accounts.edit' || $page.props.current_route === 'accounts.create'" href="#" onclick="history.back();return false;" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:text-sm">
                        Ok
                    </inertia-link>
                    <button v-else @click="show = false" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:text-sm">
                        OK
                    </button>
                </div>
            </div>
            </transition>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            show: true,
        }
    },
    watch: {
        '$page.props.flash': {
            handler() {
                this.show = true
            },
            deep: true,
        },
    },
}
</script>

