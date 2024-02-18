<div class="content">

<form class="search" action="auth/user/login.php" method="POST" id="loginForm">
   <div>
   <input type="text" class="form-control" name="email" placeholder="Bitte hier E-mail eingeben...">
   </div>
   <div>
      <input type="text" class="form-control" name="password" placeholder="Bitte hier Password eingeben..." />
    </div>
	<div>
      <button type="submit" class="btn theme-color bg-success text-center">Login</button>
      <input type="hidden" value="<?= csrf_token();?>" name="csrf_token"  />
    </div>
</form>
</div>



