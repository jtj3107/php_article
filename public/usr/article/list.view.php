<?php
  $boardId = isset($_GET['boardId']) ? $_GET['boardId'] : 0;
  

//   $boardsql = DB__secSql();
//   $boardsql->add("SELECT *");
//   $boardsql->add("FROM board");

//   $boards = DB__getRows($boardsql);
?>
<?php 
  $pageTitle = "LIST";
?>
<?php include_once __DIR__ . "/../head2.php" ?>
        <!-- Post preview-->
        <div class="post-preview container" >
        <?php foreach( $boards as $board ) { ?>
        <a href="list.php?boardId=<?=$board['id']?>"><button type="button" class="btn btn-primary"><?=$board['name']?></button></a>
        <?php } ?>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">번호</th>
                    <th scope="col">제목</th>
                    <th scope="col">작성자</th>
                    <th scope="col">좋아요</th>
                    <th scope="col">작성날짜</th>
                    </tr>
                </thead>
            <?php foreach ($articles as $article){ ?>
                <?php 
                if ($article['boardId'] == $boardId or $boardId == 0) {?>
                    <?php
                    $memberId = $article['memberId'];
                    $articleBoardId = $article['boardId'];
                    
                    $memberSql = DB__secSql();
                    $memberSql->add("SELECT *");
                    $memberSql->add("FROM `member`");
                    $memberSql->add("WHERE id = ?", $memberId);
                
                    $member = DB__getRow($memberSql);
            
                    $memberSql = DB__secSql();
                    $memberSql->add("SELECT *");
                    $memberSql->add("FROM board");
                    $memberSql->add("WHERE id = ?", $articleBoardId);
                
                    $board = DB__getRow($memberSql);
                    $boardName = isset($board['name']) ? $board['name'] : "카테고리없음";
                ?>    
                    <tbody>
                        <tr>
                        <th scope="row"><?=$article['id']?></th>
                        <td><a href="detail.php?id=<?=$article['id']?>"><?=$article['title']?></a></td>
                        <td><?=$member['nickname']?></td>
                        <td><?=$article['like_count']?></td>
                        <td><?=$article['regDate']?></td>    
                        </tr>         
                    </tbody>          
        <!-- Divider-->
            <?php } ?>
        <?php } ?>
        </table>
        <a href="write.php"><button type="button" class="btn btn-secondary">글작성</button></a>
        <a href="../board/write.php"><button type="button" class="btn btn-secondary">게시판 추가</button></a>
        </div>
        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://github.com/jtj3107/php_blog_2021/tree/master/public/usr">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2021</div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="/js/scripts.js"></script>
    </body>
</html>
