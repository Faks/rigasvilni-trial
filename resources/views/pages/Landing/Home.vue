<template>
    <div class="col-12">
        <div class="col-lg-8 mx-auto p-3 py-md-5">
            <form @submit.prevent>
                <div class="ml-sm-5 pl-sm-5 pt-2">
                    <div class="py-2 h5">
                        <b>
                            {{ quiz.title }}
                        </b>
                    </div>
                    <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3"
                         id="options">
                        <label
                            v-for="answer in quiz.answers"
                            class="options">
                            {{ answer.text }}
                            <input
                                v-model="selected.answer"
                                :value="answer"
                                type="radio"
                                name="answer">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="d-flex align-items-center pt-3">
                    <div class="ml-auto mr-sm-5">
                        <button
                            @click="storeAnswer()"
                            class="btn btn-success">
                            Answer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from "vue";
import {Component, Watch} from "vue-property-decorator";
import {Inertia, Page} from "@inertiajs/inertia";

Component.registerHooks([
    "beforeRouteEnter",
    "beforeRouteUpdate",
    "beforeRouteLeave",
    "metaInfo",
]);

@Component({})
export default class Home extends Vue {
    constructor(options: any) {
        super(options);
    }

    private index: Number = 0;

    private quiz: Object | any = {};

    private selected: Object | any = {
        answer: {}
    };

    private $page: Page;

    private $toastr: any;

    private route: any;

    public created() {
        this.quiz = this.$page.props.quizzes[0];
    }

    public metaInfo(): any {
        return {
            meta: [
                {
                    name: "description",
                    content: "Test description",
                },
                {
                    name: "keywords",
                    content: "Test keywords",
                },
            ],
            title: "Rigas Vilni Trial - Quiz Modern Day Monolith",
        };
    }

    private storeAnswer(): void {
        this.storeUserAnswer();
        setTimeout(() => {
            this.progressToNextQuiz();
            this.progressResetQuiz();
        }, 500)
    }

    private progressToNextQuiz(): void {
        if (this.selected.answer.is_correct === 1) {
            this.index = ++this.index;

            if (this.index === 20) {
                Inertia.visit(this.route('results', {
                    gameUuid: this.$page.props.gameUuid
                }));
            } else {
                this.quiz = this.$page.props.quizzes[this.index];
            }
        }
    }

    private progressResetQuiz(): void {
        if (this.selected.answer.is_correct === 0) {
            Inertia.visit(this.route('results', {
                gameUuid: this.$page.props.gameUuid
            }));
        }
    }

    private storeUserAnswer(): void {
        this.$inertia.post(this.route('user-answers.store', {
                gameUuid: this.$page.props.gameUuid
            }),
            {
                answer_id: this.selected.answer.id,
            });
    }

    @Watch('$page.props.errors')
    onChangeErrors(val: any): void {
        if (typeof val.answer_id !== "undefined") {
            this.$toastr.e(val.answer_id);
        }
    }

    @Watch('$page.props.flash')
    onChangeFlash(val: any): void {
        if (typeof val.success !== "undefined") {
            this.$toastr.s(val.success);
        }
    }
}
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

.options {
    position: relative;
    padding-left: 40px
}

#options label {
    display: block;
    margin-bottom: 15px;
    font-size: 14px;
    cursor: pointer
}

.options input {
    opacity: 0
}

.checkmark {
    position: absolute;
    top: -1px;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #555;
    border: 1px solid #ddd;
    border-radius: 50%
}

.options input:checked ~ .checkmark:after {
    display: block
}

.options .checkmark:after {
    content: "";
    width: 10px;
    height: 10px;
    display: block;
    background: white;
    position: absolute;
    top: 50%;
    left: 50%;
    border-radius: 50%;
    transform: translate(-50%, -50%) scale(0);
    transition: 300ms ease-in-out 0s
}

.options input[type="radio"]:checked ~ .checkmark {
    background: #21bf73;
    transition: 300ms ease-in-out 0s
}

.options input[type="radio"]:checked ~ .checkmark:after {
    transform: translate(-50%, -50%) scale(1)
}
</style>
