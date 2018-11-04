<template>
    <b-card>
        <b-media>
            <h5>
                <strong>{{ this.cheat.name }}</strong>
                <small class="text-muted">{{ this.cheat.code }}</small>
            </h5>
            <p>{{ this.cheat.description }}</p>
            <p class="text-right">@{{ this.cheat.creator.name }}</p>
        </b-media>
    </b-card>
</template>

<script>
export default {
    props: [
        'cheat',
    ]
}
</script>
