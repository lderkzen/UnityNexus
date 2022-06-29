<template>
    <Head title="Login" />
    <div class="min-h-screen flex justify-around items-center">
        <div class="flex flex-col sm:flex-row items-center">
            <img src="/images/hou_logo_small.png" alt="HoU Logo" />
            <div class="flex flex-col items-center py-6 px-8 bg-default rounded-md">
                <a href="/auth/discord/redirect" class="py-2 px-4 bg-discord rounded-sm font-semibold">Sign in with Discord</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    hasLayout: true
}
</script>
