<template>
    <div>
        <header-section/>
        <router-view/>
    </div>
</template>

<script>
import HeaderSection from './components/Header';

export default {
    name: 'App',
    components: {
        HeaderSection,
    },
}
</script>
