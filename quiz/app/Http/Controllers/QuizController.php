<?php

namespace App\Http\Controllers;

use App\DTO\AnswerDTO;
use App\DTO\AnswersDTO;
use App\DTO\ChoiceDTO;
use App\DTO\QuestionDTO;
use App\DTO\QuizDTO;
use App\Service\QuizResultService;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function start () {
        $quiz=$this->getQuiz();

        return view('quiz.start',[
            'quizName' => $quiz->getTitle()
        ]);
    }

    public function question1 (Request $request) {
        $question=$this->getQuiz()->getQuestions()[0];

        return view('quiz.question1',[
            'question'=>$question
        ]);
    }

    public function question2 (Request $request) {
        $answer=$request->post('answer');
        $answers= [
            $this->getQuiz()->getQuestions()[0]->getUUID() => $answer
        ];

        $question=$this->getQuiz()->getQuestions()[1];

        return view('quiz.question2',[
            'question'=>$question,
            'answersJson'=>json_encode($answers)
        ]);
    }

    public function question3 (Request $request) {
        $answersJson=$request->post('answersJson');
        $answers=json_decode($answersJson, true);

        $answer=$request->post('answer');
        $answers[$this->getQuiz()->getQuestions()[1]->getUUID()]=$answer;

        $question=$this->getQuiz()->getQuestions()[2];

        return view('quiz.question3',[
            'question'=>$question,
            'answersJson'=>json_encode($answers)
        ]);
    }

    public function question4 (Request $request) {
        $answersJson=$request->post('answersJson');
        $answers=json_decode($answersJson, true);

        $answer=$request->post('answer');
        $answers[$this->getQuiz()->getQuestions()[2]->getUUID()]=$answer;
        $question=$this->getQuiz()->getQuestions()[3];

        return view('quiz.question4',[
            'question'=>$question,
            'answersJson'=>json_encode($answers)
        ]);
    }

    public function question5 (Request $request) {
        $answersJson=$request->post('answersJson');
        $answers=json_decode($answersJson, true);

        $answer=$request->post('answer');
        $answers[$this->getQuiz()->getQuestions()[3]->getUUID()]=$answer;
        $question=$this->getQuiz()->getQuestions()[4];

        return view('quiz.question5',[
            'question'=>$question,
            'answersJson'=>json_encode($answers)
        ]);
    }

    public function finish (Request $request) {
        $answersJson=$request->post('answersJson');
        $answers=json_decode($answersJson, true);

        $answer=$request->post('answer');
        $answers[$this->getQuiz()->getQuestions()[4]->getUUID()]=$answer;

        $answersDto = new AnswersDTO($this->getQuiz()->getUUID()) ;

        foreach ($answers as $key => $answerChoices) {
            $answerDto = new AnswerDTO($key);

            foreach ($answerChoices as $answerChoice) {
                $answerDto ->addChoiceUUID($answerChoice);
            }
            $answersDto->addAnswer($answerDto);
        }
        $rezultService= new QuizResultService($this->getQuiz(),$answersDto);
        $result = $rezultService->getResult();

        return view ('quiz.finish', [
            'result' => $result
        ]);
    }

     private function getQuiz(): QuizDTO {
        $quiz = new QuizDTO('q1', 'Тест PHP');

        $q1 = new QuestionDTO('q1', 'Сколько типов данных в PHP?');

        $q1c1 = new ChoiceDTO('q1c1', 'A. 7', false);
        $q1c2 = new ChoiceDTO('q1c2', 'B. 8', true);
        $q1c3 = new ChoiceDTO('q1c3', 'C. 9', false);
        $q1c4 = new ChoiceDTO('q1c4', 'D. 6', false);

        $q1->addChoice($q1c1);
        $q1->addChoice($q1c2);
        $q1->addChoice($q1c3);
        $q1->addChoice($q1c4);

        $quiz->addQuestion($q1);


         $q2 = new QuestionDTO('q2', 'Как пишется многострочный комментарий?');

         $q2c1 = new ChoiceDTO('q2c1', 'A. /* это комментарий */', true);
         $q2c2 = new ChoiceDTO('q2c2', 'B. / это комментарий /', false);
         $q2c3 = new ChoiceDTO('q2c3', 'C. <* это комментарий *>', false);
         $q2c4 = new ChoiceDTO('q2c4', 'D. ## это комментарий ##', false);

         $q2->addChoice($q2c1);
         $q2->addChoice($q2c2);
         $q2->addChoice($q2c3);
         $q2->addChoice($q2c4);

         $quiz->addQuestion($q2);


         $q3 = new QuestionDTO('q3', 'Какой из следующих операторов используется для конкатенации строк?');

         $q3c1 = new ChoiceDTO('q3c1', 'A .', true);
         $q3c2 = new ChoiceDTO('q3c2', 'B => ', false);
         $q3c3 = new ChoiceDTO('q3c3', 'C -> ', false);
         $q3c4 = new ChoiceDTO('q3c4', 'D &', false);

         $q3->addChoice($q3c1);
         $q3->addChoice($q3c2);
         $q3->addChoice($q3c3);
         $q3->addChoice($q3c4);

         $quiz->addQuestion($q3);


         $q4 = new QuestionDTO('q4', 'Как определить константу?');

         $q4c1 = new ChoiceDTO('q4c1', 'A. variable(“FOO”, “BAR”);', false);
         $q4c2 = new ChoiceDTO('q4c2', 'B. constant(“FOO”, “BAR”);', false);
         $q4c3 = new ChoiceDTO('q4c3', 'C. define(“FOO”, “BAR”);', true);
         $q4c4 = new ChoiceDTO('q4c4', 'D. const FOO="BAR"', true);

         $q4->addChoice($q4c1);
         $q4->addChoice($q4c2);
         $q4->addChoice($q4c3);
         $q4->addChoice($q4c4);

         $quiz->addQuestion($q4);

         $q5 = new QuestionDTO('q5', 'Какое имя переменной некорректно?');

         $q5c1 = new ChoiceDTO('q5c1', 'A. $1object', true);
         $q5c2 = new ChoiceDTO('q5c2', 'B. $object', false);
         $q5c3 = new ChoiceDTO('q5c3', 'C. object', true);
         $q5c4 = new ChoiceDTO('q5c4', 'D. $objectClass', false);

         $q5->addChoice($q5c1);
         $q5->addChoice($q5c2);
         $q5->addChoice($q5c3);
         $q5->addChoice($q5c4);

         $quiz->addQuestion($q5);

        return $quiz;
     }

}
