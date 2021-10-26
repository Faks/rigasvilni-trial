<template>
    <div class="col-12">
        <div class="col-lg-8 mx-auto p-3 py-md-5">
            <div class="ml-sm-5 pl-sm-5 pt-2">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col"
                        >#
                        </th>
                        <th scope="col">
                            Question
                        </th>
                        <th scope="col">
                            User Answer
                        </th>
                        <th scope="col">
                            Answer
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        v-if="userAnswer"
                        v-for="userAnswer in userAnswers"
                        :class="determenUserAnswerCorrectness(userAnswer)">
                        <th scope="row">
                            {{ userAnswer.id }}
                        </th>
                        <td>
                            {{ userAnswer.answer.quiz.title }}
                        </td>
                        <td>
                            {{ userAnswer.answer.text }}
                        </td>
                        <td>
                            {{ userAnswer.answer.quiz.answers[0].text }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex align-items-center pt-3">
                <div class="ml-auto mr-sm-5">
                    <button
                        @click="restartGame()"
                        class="btn btn-success">
                        Try again
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Vue} from "vue-property-decorator";
import {Inertia, Page} from "@inertiajs/inertia";

Component.registerHooks([
    "beforeRouteEnter",
    "beforeRouteUpdate",
    "beforeRouteLeave",
    "metaInfo",
]);

@Component({})
export default class Result extends Vue {
    constructor(options: any) {
        super(options);
    }

    private userAnswers: Iterable<Object> | any = [];

    private $page: Page;

    private $toastr: any;

    private route: any;

    public created() {
        this.userAnswers = this.$page.props.userAnswers;
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
            title: "Rigas Vilni - Results Modern Day Monolith",
        };
    }

    private restartGame(): void {
        Inertia.visit(this.route('game.reset'));
    }

    private determenUserAnswerCorrectness(userAnswer: Object | any): Array<Object> {
        return [
            {
                'text-success': userAnswer.answer.text === userAnswer.answer.quiz.answers[0].text
            },
            {
                'text-danger': userAnswer.answer.text !== userAnswer.answer.quiz.answers[0].text
            }
        ];
    }
}
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
</style>
