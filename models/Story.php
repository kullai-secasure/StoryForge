<?php
class Story {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getNextChapter($storyId, $choiceHash) {
        $stmt = $this->db->prepare(
            "SELECT c.* FROM chapters c 
             JOIN story_choices sc ON c.id = sc.next_chapter_id 
             WHERE sc.story_id = ? AND sc.choice_hash = ?"
        );
        $stmt->execute([$storyId, $choiceHash]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updateStory($storyId, $content, $authorId) {
        $stmt = $this->db->prepare(
            "UPDATE stories SET content = ?, updated_at = NOW() 
             WHERE id = ? AND author_id = ?"
        );
        return $stmt->execute([$content, $storyId, $authorId]);
    }
}
?>
