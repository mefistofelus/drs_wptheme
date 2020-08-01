<div id="chatContainer">
	<div id="chatTopBar" class="blue-gradient">
		<h5 class="chat-title">
		<span class="badge badge-primary mr-2">
			<i class="fa fa-comments" style="font-size: 20px"></i>
		</span>Внутрішній чат ДРС України для загальних оголошень та повідомлень
		</h5>
	</div>
	<div id="chatLineHolder"></div>
	
	<div id="chatUsers" class="rounded"></div>
	
	<div id="chatBottomBar" class="blue-gradient">
		<div class="tip"></div>
		
		<form class="text-center" id="loginForm" method="post" action="">
			<input id="name" name="name" class="rounded" maxlength="16" placeholder="Прізвище та ім'я" />
			<input id="email" name="email" class="rounded" placeholder="Email" />
			<input type="submit" class="blueButton rounded z-depth-1" value="Увійти" />
		</form>
		
		<form id="submitForm" method="post" action="">
			<input id="chatText" name="chatText" class="rounded" />
			<input type="submit" class="blueButton" value="Надіслати" />
		</form>
		
	</div>
</div>