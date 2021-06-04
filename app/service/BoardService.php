<?php
    class APP__BoardService {
        private APP__BoardRepository $boardRepository;

        public function __construct() {
            global $App__boardRepository;
            $this->boardRepository = $App__boardRepository;
        }

        public function writeBoard(string $name, string $code, int $App__loginedMemberId){
            return $this->boardRepository->writeBoard($name, $code, $App__loginedMemberId);
          }
    }
?>