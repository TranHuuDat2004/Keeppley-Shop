<?php if ($userLogin['userName']): ?>
                    <li><a href="#">Welcome, <?php echo $userLogin['userName']; ?></a></li>
                <?php else: ?>
                    <li><a href="../html/reaction_form.html">Login</a></li>
                <?php endif; ?>