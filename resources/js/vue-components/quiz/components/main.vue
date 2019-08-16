<template>
    <div>
        <h1>
            {{ text }}
        </h1>

        <quiz-start v-if="currentStep === 1"
                    :name="name"
                    :quizzes="quizzes"
                    @quiz-started="onQuizStarted">
        </quiz-start>

        <quiz-questions :current-question="currentQuestion"
                        v-else-if="currentStep === 2"
                        @results-received="onResultsReceived">
        </quiz-questions>

        <quiz-results v-else-if="currentStep === 3"
                      :current-quiz="currentQuiz"
                      :result="result"
                      @quiz-finished="onQuizFinished">
        </quiz-results>

        <div v-else>
            <button @click="currentStep = 1">
                How did you...?
            </button>
        </div>
    </div>
</template>

<script>

    import QuizStartComponent from './quiz-start.vue';
    import QuizQuestionsComponent from './quiz-questions.vue';
    import QuizResultsComponent from './quiz-results.vue';
    import {Quiz} from './../models/quiz.models.js';

    export default {
        components: {
            'quiz-start': QuizStartComponent,
            'quiz-questions': QuizQuestionsComponent,
            'quiz-results': QuizResultsComponent,
        },

        props: {
            name: {
                required: true,
            },

            quizzesProp: {
                default: [],
                required: true,
            },
        },

        created(){
            this.quizzes = this.quizzesProp.map((quizDatum) => {
                return Quiz.fromArray(quizDatum);
            });
        },

        data() {
            return {
                text: 'Quizzes competition',

                /** @type Array{Quiz} */
                quizzes: [],

                /** @var {Number}*/
                currentStep: 1,

                /** @var {?Number} */
                currentQuiz: null,

                /** @var {?Question} */
                currentQuestion: null,

                /** @var {?Result} */
                result: null,
            }
        },

        methods: {
            /**
             * @param {{quizId: number, firstQuestion: Question}}emittedData
             */
            onQuizStarted(emittedData) {
                let quizId = emittedData.quizId;

                this.currentQuiz = this.quizzes.find((quiz) => {
                    return quiz.id === quizId;
                });

                this.currentQuestion = emittedData.firstQuestion;

                this.currentStep++;
            },

            /**
             * @param {{Result}} emittedResult
             */
            onResultsReceived(emittedResult) {
                this.result = emittedResult;

                this.currentStep++;

                this.currentQuestion = null;
            },

            onQuizFinished() {
                this.currentStep = 1;

                this.currentQuiz = null;
                this.result = null;
            }
        }
    }
</script>