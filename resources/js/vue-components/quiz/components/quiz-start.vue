<template>
    <div>
        <h1>Hi, {{ name }}</h1>
        <div v-if="error.length" class="alert alert-danger">
            {{ error }}
        </div>

        <select v-model="selectedQuizId">
            <option value="">Please select a quiz</option>
            <option :value="quiz.id" v-for="quiz in quizzes">
                {{ quiz.title }}
            </option>
        </select>

        <button @click="startQuiz" :disabled="!canStartQuiz">
            Start
        </button>
    </div>
</template>

<script>
    import axios from 'axios';
    import {Question} from "../models/quiz.models.js";

    export default {


        props: {
            name: {
                required: true,
            },
            quizzes: {
                required: true,
            },

        },

        data() {
            return {
                selectedQuizId: '',
                loading: false,
                error: '',
            }
        },

        methods: {
            startQuiz() {
                this.error = '';

                if (!this.canStartQuiz) {
                    return;
                }

                let data = new FormData;
                data.append('quizId', this.selectedQuizId);

                axios.post('/quiz/start', data)
                    .then((response) => {
                        if (response.data.error) {
                            this.error = res.data.error;
                            return;
                        }

                        let question = Question.fromArray(response.data.questionData);

                        this.$emit('quiz-started', {
                            'quizId': this.selectedQuizId,
                            'firstQuestion': question,
                        })

                    }).finally(() => {
                        this.loading = false;
                    });
            }
        },

        computed: {
            canStartQuiz() {
                return !!this.selectedQuizId && !this.loading;
            }
        }
    }
</script>

<style scoped>

</style>