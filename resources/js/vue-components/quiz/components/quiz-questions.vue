<template>
    <div>
        <h2>{{ currentQuestion.text}}</h2>

        <template v-for="answer in currentQuestion.answers">
            <button @click="selectAnswer(answer)"
                    class="btn"
                    :class="getAnswerButtonClass(answer)">
                {{ answer.text }}
            </button>
        </template>

    <div>
        <button class="btn btn-success"
                @click="getNextQuestion"
                :disabled="isButtonDisabled">
            Next
        </button>
    </div>
    </div>

</template>

<script>
    import axios from 'axios';
    import {Question, Answer} from "../models/quiz.models.js";
    import {Result} from "../models/quiz.models";

    export default {
        props: {
            /** @type {Question}*/
            currentQuestion: {
                required: true,
            }
        },

        data() {
            return {
                /** @var {?Answer} */
                selectedAnswer: null,

                /** @type {boolean} */
                loading: false,
            }
        },

        methods: {
            selectAnswer(answer) {
                this.selectedAnswer = answer;
            },

            getAnswerButtonClass(answer) {
                return {
                    'btn-secondary': answer !== this.selectedAnswer,
                    'btn-primary': answer === this.selectedAnswer,
                }
            },

            getNextQuestion() {
                if (!this.selectedAnswer){
                    return;
                }

                let data = new FormData;
                data.append('answerId', this.selectedAnswer.id);

                this.loading = true;

                axios.post('/quiz/next-question', data)
                    .then((response) => {

                        if (response.data.error) {
                            window.alert(response.data.error);
                            return;
                        }

                        if (response.data.resultData) {
                            this.onResultsReceived(response.data.resultData);
                            return;
                        }

                        this.selectedAnswer = null;
                        let nextQuestion = Question.fromArray(response.data.questionData);

                        this.currentQuestion.id = nextQuestion.id;
                        this.currentQuestion.text = nextQuestion.text;
                        this.currentQuestion.answers = nextQuestion.answers;

                    }).finally(() => {
                        this.loading = false;
                    });
            },

            onResultsReceived(resultData) {
                let result = Result.fromArray(resultData);

                this.$emit('results-received', result);
            }

        },

        computed: {
            isButtonDisabled() {
                return !this.selectedAnswer || this.loading;
            }
        }
    }
</script>

<style scoped>

</style>