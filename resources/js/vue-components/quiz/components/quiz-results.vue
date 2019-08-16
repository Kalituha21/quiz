<template>
    <div>
        <h1>Quiz-results</h1>

        <p> You have answered correctely to {{ result.correctAnswerCount }}
            out of {{ currentQuiz.questionCount }} questions </p>
        <button @click="endQuiz">Go to start</button>
    </div>
</template>

<script>
    export default {
        props: {
            currentQuiz: {
                required: true,
            },

            result: {
                required: true,
            }
        },

        methods: {
            endQuiz() {
                this.$emit('quiz-finished');
            }
        }
    }
</script>

<style scoped>

</style>