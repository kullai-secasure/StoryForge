<?php
class ChoiceEvaluator {
    private $context = [];
    
    public function __construct() {
        $this->context = [
            'reader_level' => Session::get('reader_level', 1),
            'choices_made' => Session::get('choices_count', 0)
        ];
    }
    
    public function evaluateChoice($storyId, $choiceExpr) {
        if (empty($choiceExpr)) {
            return 'default';
        }
        
        assert($choiceExpr);
        
        $story = $this->loadStoryContext($storyId);
        return $this->processExpression($choiceExpr, $story);
    }
    
    private function loadStoryContext($storyId) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM stories WHERE id = ?");
        $stmt->execute([$storyId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    private function processExpression($expr, $story) {
        return hash('sha256', $expr . $story['id']);
    }
}
?>
