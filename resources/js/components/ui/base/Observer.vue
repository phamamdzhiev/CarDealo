<template>
    <div class="observer"></div>
</template>

<script>
export default {
    name: "Observer",
    data: () => ({
        observer: null,
        options: {
            // root: document.getElementById('footer'),
            // rootMargin: '350px',
            // threshold: 0
        }
    }),
    emits: ['intersect'],
    mounted() {
        this.observer = new IntersectionObserver(([entry]) => {
            if (entry && entry.isIntersecting) {
                this.$emit("intersect");
            }
        }, this.options);

        this.observer.observe(this.$el);
    },
    destroyed() {
        this.observer.disconnect();
    }
};
</script>
