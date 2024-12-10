<template>
    <div>
        <div class="flex sm:mt-2 md:flex md:items-center md:justify-between">
            <div class="flex-2 my-auto">
                <slot name="header-title"></slot>
            </div>
            <div class="sm:flex-1">
                <slot name="header-action"></slot>
            </div>
        </div>
    </div>
</template>
