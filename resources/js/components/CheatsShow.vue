<template>
    <b-card>
        <b-media>
            <h5>
                <strong>{{ cheat.name }}</strong>
                <small class="text-muted">Code: {{ cheat.code }}</small>
            </h5>
            <p>{{ cheat.description }}</p>
            <p class="text-right">
                @{{ cheat.creator.name }}
                <b-btn
                    @click="$emit('edit', cheat)"
                    size="sm"
                    variant="outline-info"
                    v-if="is_auth">
                    Edit
                </b-btn>
            </p>
        </b-media>
    </b-card>
</template>

<script>
export default {
    computed: {
        is_auth() {
            return window.is_auth;
        }
    },
    props: [
        'cheat',
    ]
}
</script>
