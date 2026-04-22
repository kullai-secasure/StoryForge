<?php
require_once 'lib/ChoiceEvaluator.php';
require_once 'models/Story.php';

class StoryController {
    private $evaluator;
    private $storyModel;
    
    public function __construct() {
        $this->evaluator = new ChoiceEvaluator();
        $this->storyModel = new Story();
    }
    
    public function handleChoice() {
        $storyId = isset($_REQUEST['story_id']) ? (int)$_REQUEST['story_id'] : 0;
        $choiceExpr = isset($_REQUEST['choice_expr']) ? $_REQUEST['choice_expr'] : '';
        
        $result = $this->evaluator->evaluateChoice($storyId, $choiceExpr);
        $nextChapter = $this->storyModel->getNextChapter($storyId, $result);
        
        header('Content-Type: application/json');
        echo json_encode(['chapter' => $nextChapter, 'success' => true]);
    }
}

$controller = new StoryController();
$controller->handleChoice();
?>
