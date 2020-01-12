<template>
    <v-btn icon @click="vularIdFullScreen()">
        <v-icon>fullscreen</v-icon>
    </v-btn>
</template>

<script>
export default {
    name: 'vular-fullscreen-button',
    methods:{
        vularIdFullScreen () {
            let doc = window.document;
            let docEl = doc.documentElement;

            let requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
            let cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

            if (!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
                requestFullScreen.call(docEl);
            }
            else {
                cancelFullScreen.call(doc);
            }
        }
    }
}
</script>