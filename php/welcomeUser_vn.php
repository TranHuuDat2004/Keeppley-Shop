<?php if ($userLogin['userName']): ?>
            <li><a href="#">Xin chào, <?php echo $userLogin['userName']; ?></a></li>
        <?php else: ?>
            <li><a href="../html/reaction_form.html">Đăng nhập</a></li>
        <?php endif; ?>