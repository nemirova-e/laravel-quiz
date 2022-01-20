<?php

namespace App\Service;

use App\DTO\QuizDTO;
use App\DTO\QuestionDTO;
use App\DTO\ChoiceDTO;
use App\DTO\AnswersDTO;
use App\DTO\AnswerDTO;

use Exception;

class QuizResultService
{
    private QuizDTO $quiz;
    private AnswersDTO $answers;

    public function __construct(QuizDTO $quiz, AnswersDTO $answers)
    {
        $this->quiz = $quiz;
        $this->answers = $answers;
    }

    public function getResult(): float
    {
        $rightAnswersCount = 0;
        $questionsCount = count($this->quiz->getQuestions());
        if ($this->quiz->getUUID() != $this->answers->getQuizUUID()) {
            return 0;
        }

        for ($i = 0; $i < count($this->answers->getAnswers()); $i++) {
            /** @var AnswerDTO $answer */
            $answer = $this->answers->getAnswers()[$i];
            $questionUuid = $answer->getQuestionUUID();

            for ($j = 0; $j < count($this->quiz->getQuestions()); $j++) {
                /** @var QuestionDTO $q */
                $q = $this->quiz->getQuestions()[$j];

                if ($q->getUUID() == $questionUuid) {
                    $rightChoices = [];

                    for ($k = 0; $k < count($q->getChoices()); $k++) {
                        /** @var ChoiceDTO $choice */
                        $choice = $q->getChoices()[$k];
                        if ($choice->isCorrect()) {
                            $rightChoices [] = $choice->getUUID();
                        }
                    }

                    $userChoices = $answer->getСhoices();
                    if (count($userChoices) == count($rightChoices)) {
                        if (count(array_diff($rightChoices, $userChoices)) == 0) {
                            $rightAnswersCount++;
                        }
                    }
                }


            }
        }
        $result = $rightAnswersCount /  $questionsCount;
        return $result;
    }
}








